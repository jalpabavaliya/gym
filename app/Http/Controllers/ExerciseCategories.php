<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
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
        $exercise = Exercise::orderBy('id','DESC')->paginate(50000000000000);
        return view('exercise.index',compact('exercise'))
            ->with('i', ($request->input('page', 1) - 1) * 50000000000000);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Exercise::get();
        return view('exercise.create',compact('list'));
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
            'title' => 'required',
            'type' => 'required',
            'instructions' => 'required',
            'description' => 'required',
            'video_url' => 'required',
        ]);
        $url = "";
        if(isset($request->video_url)){
            $originalString = $request->video_url;
            $array = collect(explode("?v=", $originalString));
            $url = $array[1];
        }
    
        Exercise::create(
            [
                'title' => $request->input('title'),
                'type' => $request->input('type'),
                'instructions' => $request->input('instructions'),
                'description' => $request->input('description'),
                'tag' => isset($request->tags) ? implode(",",$request->tags) : '',
                'video_url' => $url
            ]
        );
        return redirect()->route('exercise.index')
                        ->with('success','Exercise created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercise = Exercise::find($id);
        return view('exercise.show',compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exercise = Exercise::find($id);
        $exercise->tag = explode(',',$exercise->tag);
        return view('exercise.edit',compact('exercise'));
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
            'title' => 'required',
            'type' => 'required',
            'instructions' => 'required',
            'description' => 'required',
            'video_url' => 'required',
        ]);
        $url = "";
        if(isset($request->video_url)){
            $originalString = $request->video_url;
            $array = collect(explode("?v=", $originalString));
            $url = $array[1];
        }
        $exercise = Exercise::find($id);
        $exercise->title = $request->input('title');
        $exercise->type = $request->input('type');
        $exercise->instructions = $request->input('instructions');
        $exercise->description = $request->input('description');
        $exercise->tag = isset($request->tags) ? implode(",",$request->tags) : '';
        $exercise->video_url = $url;
        $exercise->save();
        return redirect()->route('exercise.index')
                        ->with('success','Exercise updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("exercises")->where('id',$id)->delete();
        return redirect()->route('exercise.index')
                        ->with('success','Exercise deleted successfully');
    }
}
