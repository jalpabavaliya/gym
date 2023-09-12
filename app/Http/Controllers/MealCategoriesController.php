<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\MealCategories;

class MealCategoriesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meal_categories = MealCategories::orderBy('id','DESC')->paginate(5);
        return view('meal_categories.index',compact('meal_categories'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getMealCategory(Request $request)
    {
        if ($request->ajax()) {
            $data = MealCategories::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('user-edit')){
                            $action .= '<a href="'.route("meal-category.edit",$row->id).'"><i class="fa fa-pencil aria-hidden="true""></i></a>';
                    }
                    if(Auth::user()->can('user-delete')){
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("meal-category.destroy",$row->id).'"><i class="fa fa-trash"></i></a>';
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
        $list = MealCategories::get();
        return view('meal_categories.create',compact('list'));
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
            'name' => 'required|unique:meal_categories,name',
        ]);
        MealCategories::create(['name' => $request->input('name')]);
        return redirect()->route('meal-category.index')
                        ->with('success','Category created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal_categories = MealCategories::find($id);
        return view('meal_categories.show',compact('meal_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal_categories = MealCategories::find($id);
        return view('meal_categories.edit',compact('meal_categories'));
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

        $meal_categories = MealCategories::find($id);
        $meal_categories->name = $request->input('name');
        $meal_categories->save();
        return redirect()->route('meal-category.index')
                        ->with('success','Category updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("meal_categories")->where('id',$id)->delete();
        return redirect()->route('meal-category.index')
                        ->with('success','Category deleted successfully');
    }
}
