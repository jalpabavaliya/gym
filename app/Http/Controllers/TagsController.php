<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tags::orderBy('id','DESC')->paginate(5);
        return view('tags.index',compact('tags'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getTags(Request $request)
    {
        if ($request->ajax()) {
            $data = Tags::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('user-edit')){
                            $action .= '<a href="'.route("tags.edit",$row->id).'"><i class="fa fa-pencil aria-hidden="true""></i></a>';
                    }
                    if(Auth::user()->can('user-delete')){
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("tags.destroy",$row->id).'"><i class="fa fa-trash"></i></a>';
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
        $list = Tags::get();
        return view('tags.create',compact('list'));
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
            'name' => 'required|unique:tags,name',
        ]);
        Tags::create(['name' => $request->input('name')]);
        return redirect()->route('tags.index')
                        ->with('success','Tag created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Tags::find($id);
        return view('tags.show',compact('tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tags::find($id);
        return view('tags.edit',compact('tags'));
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

        $tags = Tags::find($id);
        $tags->name = $request->input('name');
        $tags->save();
        return redirect()->route('tags.index')
                        ->with('success','Tag updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("tags")->where('id',$id)->delete();
        return redirect()->route('tags.index')
                        ->with('success','Tag deleted successfully');
    }
}
