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
            'data' => $query1
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        if (!$validator->fails()) {
            $foodRecipe = new FoodRecipe();
            $foodRecipe->name = $request->name;
            $foodRecipe->description = $request->description;
            /* Linea de codigo permite alacenar archivos en la carpeta public */
            $images = $request->file('image');
            $imageName = ' ';
            foreach ($images as $image) {
                $new_name = rand().'.'.$image->getClientOriginalName();
                $image->move(public_path('/uploads/images'),$new_name);
                $imageName = $imageName.$new_name.", ";
            }
            $imagedb = $imageName;
            // return response()->json($imagedb);
            /* Agrega 1 imagen y/o archivo al la ruta Storage/app/public 
            *   ejecutar comando[] php artisan storage:link  
            *   $file = $request->file('image')->store('public/recipes');
            *
            */
            $foodRecipe->image = $imagedb;
            $foodRecipe->link =$request->link;
            $foodRecipe->save();
            // sirve de ves en cuando
            // $file = $request->image->store('public/recipes');

            return response()->json([
                'message' =>  'Registro',
                'info' =>  'El registro fue satisfactorio',
                'receta' => $foodRecipe
            ], 201);
        }
    }


    public function show($id)
    {
        return FoodRecipe::find($id);
    }


    public function update(Request $request, $id)
    {
        $record = FoodRecipe::findorfail($id);
        $record->update($request->all());

        $images = $request->file('image');
            $imageName = ' ';
            foreach ($images as $image) {
                $new_name = rand().'.'.$image->getClientOriginalName();
                $image->move(public_path('/uploads/images'),$new_name);
                $imageName = $imageName.$new_name.", ";
            }
        $imagedb = $imageName;
        $record->image =$imagedb;
        $foodRecipe->save();

        return response()->json([
            'sucess' => 'Acualizado Satisfactorio',
            'data' => $foodRecipe
        ]);
    }


    public function destroy($id)
    {
        $recipe = FoodRecipe::findOrfail($id);
        $recipe->delete();

        return response()->json([
            'sucess' => 'Accion Exitosa',
            'data' =>  204
        ]);
    }
}
