<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkOut;

class WorkOutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workouts = WorkOut::orderBy('id','DESC')->paginate(5);
        return view('workouts.index',compact('workouts'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getWorkouts(Request $request)
    {
        if ($request->ajax()) {
            $data = WorkOut::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('user-edit')){
                            $action .= '<a href="'.route("workouts.edit",$row->id).'"><i class="fa fa-pencil aria-hidden="true""></i></a>';
                    }
                    if(Auth::user()->can('user-delete')){
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("workouts.destroy",$row->id).'"><i class="fa fa-trash"></i></a>';
                    }
                    return $action ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = WorkOut::get();
        return view('workouts.create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'workout_type' => 'required',
        ]);
        WorkOut::create(
            [
                'name' => $request->input('name'),
                'workout_type' => $request->input('workout_type'),
            ]
        );
        return redirect()->route('workouts.index')
                        ->with('success','Workouts created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workouts = WorkOut::find($id);
        return view('workouts.show',compact('workouts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workouts = WorkOut::find($id);
        $exercise = Exercise::get();
        return view('workouts.edit',compact('workouts','exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $workouts = WorkOut::find($id);
        $workouts->name = $request->input('name');
        $workouts->save();
        return redirect()->route('workouts.index')
                        ->with('success','Workouts updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("work_outs")->where('id',$id)->delete();
        return redirect()->route('workouts.index')
                        ->with('success','Workouts deleted successfully');
    }
}
