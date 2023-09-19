<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;
use App\CPU\ImageManager;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meals = Meal::orderBy('id','DESC')->paginate(50000000000000);
        return view('meal.index',compact('meals'))
            ->with('i', ($request->input('page', 1) - 1) * 50000000000000);
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
                            // $action .= '<a href="'.route("meal.edit",$row->id).'"><i class="fa fa-pencil aria-hidden="true""></i></a>';
                            $action = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editmeal" data-id="'.$row->id.'"><i class="fa fa-pencil">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></a>';

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
            'meal_categories_id' => 'required',
            'tag' => 'required',
            'contain' => 'required',
        ]);

        $data = $request->input();
        // dd($data);
        $ins = array(
            'meal_name' => $data['meal_name'] ? $data['meal_name'] : 'N/A',
            'prep_time' => $data['prep_time'] ? $data['prep_time'] : 'N/A',
            'cook_time' => $data['cook_time'] ? $data['cook_time'] : 'N/A',
            'meal_categories_id' => $data['meal_categories_id'] ? implode(",", $data['meal_categories_id']) : '0',
            'tag' => $data['tag'] ? implode(",", $data['tag']) : '0',
            'contain' => $data['contain'] ? implode(",", $data['contain']) : '0',   
        );
        
        if (!empty($data['meal_id'])) {
            if($request->has('image')) {
                $ins['image'] = ImageManager::update('modal/', $data['image'], 'png', $request->file('image'));
            }
            Meal::where('id', $data['meal_id'])->update($ins);
            return redirect()->route('meal.index')->with('success','Meal Updated successfully');
        } else {
            $ins['image'] = ImageManager::upload('modal/', 'png', $request->file('image'));
            Meal::create($ins)->meal_id;
            return redirect()->route('meal.index')->with('success','Meal created successfully');
        }
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
        DB::table("meals")->where('id',$id)->delete();
        return redirect()->route('meal.index')
                        ->with('success','Meal deleted successfully');
    }
}
