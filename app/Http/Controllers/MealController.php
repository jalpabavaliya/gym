<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meal = Meal::orderBy('id','DESC')->paginate(5);
        return view('meal.index',compact('meal'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getMeal(Request $request)
    {
        if ($request->ajax()) {
            $data = Meal::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('user-edit')){
                            $action .= '<a href="'.route("meal.edit",$row->id).'"><i class="fa fa-pencil aria-hidden="true""></i></a>';
                    }
                    if(Auth::user()->can('user-delete')){
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("meal.destroy",$row->id).'"><i class="fa fa-trash"></i></a>';
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
        $list = Meal::get();
        return view('meal.create',compact('list'));
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
            'name' => 'required|unique:meal,name',
        ]);
        Meal::create(['name' => $request->input('name')]);
        return redirect()->route('meal.index')
                        ->with('success','Meal created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal = Meal::find($id);
        return view('meal.show',compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = Meal::find($id);
        return view('meal.edit',compact('meal'));
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

        $meal = Meal::find($id);
        $meal->name = $request->input('name');
        $meal->save();
        return redirect()->route('meal.index')
                        ->with('success','Meal updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("meal")->where('id',$id)->delete();
        return redirect()->route('meal.index')
                        ->with('success','Meal deleted successfully');
    }
}
