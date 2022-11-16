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

            //verificar esta linea antes era image
            'image' => 'required',
        ]);

        if (!$validator->fails()) {
            $foodRecipe = new FoodRecipe();
            $foodRecipe->name = $request->name;
            $foodRecipe->description = $request->description;
            /* Linea de codigo permite almacenar archivos en la carpeta public */
            // $images = $request->file('image');
            // $imageName = ' ';
            // foreach ($images as $image) {
            //     $new_name = rand().'.'.$image->getClientOriginalName();
            //     $image->move(public_path('/uploads/images'),$new_name);
            //     $imageName = $imageName.$new_name.", ";
            // }
            // $imagedb = $imageName;
            // // return response()->json($imagedb);
            // /* Agrega 1 imagen y/o archivo al la ruta Storage/app/public 
            // *   ejecutar comando[] php artisan storage:link  
            // *   $file = $request->file('image')->store('public/recipes');
            // *
            // */
            // $foodRecipe->image = $imagedb;
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

            //verificar el codigo de status, antes era 201
        }
    }


    public function show($id)
    {
        return FoodRecipe::find($id);
    }


    public function update(Request $request, $id)
    {
        $record = FoodRecipe::find0rFail($request->id);
            $record->name = $request->name;
            $record->description = $request->description;
            /* Linea de codigo permite alacenar archivos en la carpeta public */
            $images = $request->file('image');
            $imageName = ' ';
            foreach ($images as $image) {
                $new_name = rand().'.'.$image->getClientOriginalName();
                $image->move(storage_path('app/public/recipe'),$new_name);
                $imageName = $imageName.$new_name.", ";
            }
            $imagedb = $imageName;
            // return response()->json($imagedb);
            /* Agrega 1 imagen y/o archivo al la ruta Storage/app/public 
            *   ejecutar comando[] php artisan storage:link  
            *   $file = $request->file('image')->store('public/recipes');
            *
            */
            $record->image = $imagedb;
            $record->link =$request->link;
            $record->save();

        return response()->json([
            'sucess' => 'Acualizado Satisfactorio',
            'data' => $record
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
