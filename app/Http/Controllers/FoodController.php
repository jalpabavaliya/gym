<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class FoodController extends Controller
{
    public function index(Request $request)
    {
        // $food = Food::orderBy('id','DESC')->paginate(10);
        // return view('food.index',compact('food'))->with('i', ($request->input('page', 1) - 1) * 10);
        return view('food.index');
    }

    
    public function getFood(Request $request)
    {
        if ($request->ajax()) {
            $data = Food::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('user-edit')){
                            // $action .= '<a href="javascript:void(0)" data-id="'.$row->id.'"><i class="editfood fa fa-pencil aria-hidden="true""></i></a>';
                            $action = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editfood" data-id="'.$row->id.'"><i class="fa fa-pencil">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></a>';
                    }
                    if(Auth::user()->can('user-delete')){
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("food.destroy",$row->id).'"><i class="fa fa-trash"></i></a>';
                    }
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'food_name' => 'required',
            'serving_size' => 'required',
            'serving_type' => 'required',
            'calories' => 'required',
            'protein' => 'required',
            'carbs' => 'required',
            'fat' => 'required',
        ]);
        $data = $request->input();
        $ins = array(
            'food_name' => $data['food_name'],
            'serving_size' => $data['serving_size'],
            'serving_type' => $data['serving_type'],
            'calories' => $data['calories'],
            'protein' => $data['protein'],
            'carbs' => $data['carbs'],
            'fat' => $data['fat'],
            'saturated_fat' => $data['saturated_fat'] ? $data['saturated_fat'] : '0',
            'trans_fat' => $data['trans_fat'] ? $data['trans_fat'] : '0',
            'polyunsaturated_fat' => $data['polyunsaturated_fat'] ? $data['polyunsaturated_fat'] : '0',
            'monounsaturated_fat' => $data['monounsaturated_fat'] ? $data['monounsaturated_fat'] : '0',
            'cholesterol' => $data['cholesterol'] ? $data['cholesterol'] : '0',
            'sodium' => $data['sodium'] ? $data['sodium'] : '0',
            'dietary_fiber' => $data['dietary_fiber'] ? $data['dietary_fiber'] : '0',
            'sugar' => $data['sugar'] ? $data['sugar'] : '0',
            'vitamin_a' => $data['vitamin_a'] ? $data['vitamin_a'] : '0',
            'vitamin_c' => $data['vitamin_c'] ? $data['vitamin_c'] : '0',
            'vitamin_d' => $data['vitamin_d'] ? $data['vitamin_d'] : '0',
            'vitamin_e' => $data['vitamin_e'] ? $data['vitamin_e'] : '0',
            'thiamin' => $data['thiamin'] ? $data['thiamin'] : '0',
            'riboflavin' => $data['riboflavin'] ? $data['riboflavin'] : '0',
            'niacin' => $data['niacin'] ? $data['niacin'] : '0',
            'vitamin_b_6' => $data['vitamin_b_6'] ? $data['vitamin_b_6'] : '0',
            'vitamin_b_12' => $data['vitamin_b_12'] ? $data['vitamin_b_12'] : '0',
            'pantothenic_acid' => $data['pantothenic_acid'] ? $data['pantothenic_acid'] : '0',
            'calcium' => $data['calcium'] ? $data['calcium'] : '0',
            'iron' => $data['iron'] ? $data['iron'] : '0',
            'potassium' => $data['potassium'] ? $data['potassium'] : '0',
            'phosphorus' => $data['phosphorus'] ? $data['phosphorus'] : '0',
            'magnesium' => $data['magnesium'] ? $data['magnesium'] : '0',
            'zinc' => $data['zinc'] ? $data['zinc'] : '0',
            'selenium' => $data['selenium'] ? $data['selenium'] : '0',
            'copper' => $data['copper'] ? $data['copper'] : '0',
            'manganese' => $data['manganese'] ? $data['manganese'] : '0',
            'alcohol' => $data['alcohol'] ? $data['alcohol'] : '0',
            'caffeine' => $data['caffeine'] ? $data['caffeine'] : '0',
        );

        if (!empty($data['food_id'])) {
            Food::where('id', $data['food_id'])->update($ins);
            return redirect()->route('food.index')->with('success','Food Updated successfully');
        } else {
            Food::create($ins)->id;
            return redirect()->route('food.index')->with('success','Food created successfully');
        }
    }


    public function edit($id)
    {
        $food = Food::where('id', $id)->orderBy('id', 'DESC')->first();
        return response()->json($food);
    }

    public function destroy($id)
    {
        DB::table("foods")->where('id',$id)->delete();
        return redirect()->route('food.index')
                        ->with('success','Food deleted successfully');
    }
}
