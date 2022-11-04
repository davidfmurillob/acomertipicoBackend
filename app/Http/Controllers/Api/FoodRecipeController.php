<?php

namespace App\Http\Controllers\Api;

use App\Models\FoodRecipe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodRecipeController extends Controller
{
    
    public function index()
    {
        return response()->json([
            FoodRecipe::all()
        ]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'time'=>'required',
            'elaboration'=> 'required',
            'type' => 'required',
            'person' => 'required',
            'image' => 'required',
            'video_link' => 'required'
        ]);

        $foodRecipe = new FoodRecipe($request->all());
        $file =$request->image->store('public/recipes');

        $foodRecipe->image = $file;

        $foodRecipe->save();
        
        return response()->json([
            'message' =>  'Registro',
                'info' =>  'El registro fue satisfactorio',
                'receta'=> $foodRecipe
        ],201);
    }

    
    public function show($id)
    {
        return FoodRecipe::find($id);
    }

    
    public function update(Request $request, $id)
    {
        $foodRecipe = FoodRecipe::findorfail($id);
        $foodRecipe->update($request->all());
        return $foodRecipe;
    }

    
    public function destroy($id)
    {
        $recipe = FoodRecipe::findOrfail($id);
        $recipe->delete();

        return 204;
    }
}
