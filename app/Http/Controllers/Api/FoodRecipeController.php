<?php

namespace App\Http\Controllers\Api;

use App\Models\FoodRecipe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Cache\Store;

class FoodRecipeController extends Controller
{

    public function index()
    {
        $query1 = FoodRecipe::all();
        return response()->json([
            'status' => 200,
            'data' => $query1
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
            'image' => 'required',
        ]);

        if (!$validator->fails()) {
            $foodRecipe = new FoodRecipe();
            $foodRecipe->name = $request->name;
            $foodRecipe->description = $request->description;
            // //link de receta
            $foodRecipe->link =$request->link;

            $file = $request->file('image')->store('public/Recetas');
            $foodRecipe->image = $file;


            $foodRecipe->save();
            // sirve de ves en cuando
            // $file = $request->image->store('public/recipes');

            return response()->json([
                'status' => 200,
                'message' =>  'Receta registrada',
                'info' =>  'El registro fue satisfactorio',
                'receta' => $foodRecipe
            ], 200);
        }
    }


    public function show($id)
    {
        $recipe =FoodRecipe::find($id);
        return response()->json([
            'status' => 200,
            'message' => 'Receta Seleccionada',
            'recipe' => $recipe
        ]);
    }


    public function update(Request $request, $id)
    {
        $record = FoodRecipe::find0rFail($request->id);
            $record->name = $request->name;
            $record->description = $request->description;
            $record->link =$request->link;
            $record->link =$request->link;
            $file = $request->file('image')->store('public/Recetas');
            $record->image = $file;
            $record->save();

        return response()->json([
            'status' => 200,
            'sucess' => 'Acualizado Satisfactorio',
            'data' => $record
        ]);
    }


    public function destroy($id)
    {
        $recipe = FoodRecipe::findOrfail($id);
        $recipe->delete();

        return response()->json([
            'status' => 200,
            'sucess' => 'Accion Exitosa',
            'data' =>  204
        ]);
    }
}
