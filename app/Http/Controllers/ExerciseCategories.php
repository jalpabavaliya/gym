<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseCategory;
use DB;

class ExerciseCategories extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exercise_categories = ExerciseCategory::orderBy('id','DESC')->paginate(5);
        return view('exercise_categories.index',compact('exercise_categories'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = ExerciseCategory::get();
        return view('exercise_categories.create',compact('list'));
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
            'name' => 'required|unique:exercise_categories,name',
        ]);
        ExerciseCategory::create(['name' => $request->input('name')]);
        return redirect()->route('exercise_categories.index')
                        ->with('success','Exercise Category created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercise_categories = ExerciseCategory::find($id);
        return view('exercise_categories.show',compact('exercise_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exercise_categories = ExerciseCategory::find($id);
        return view('exercise_categories.edit',compact('exercise_categories'));
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

        $tags = ExerciseCategory::find($id);
        $tags->name = $request->input('name');
        $tags->save();
        return redirect()->route('exercise_categories.index')
                        ->with('success','Exercise Category updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("exercise_categories")->where('id',$id)->delete();
        return redirect()->route('exercise_categories.index')
                        ->with('success','Exercise Category deleted successfully');
    }
}
