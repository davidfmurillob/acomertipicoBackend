<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->establishment_id = $request->establishment_id;
        $order->user_id = $request->user_id;
        $order->save();

        foreach($request->products as $products){

            //variable local = $order_product
            $order_product = new Order_detail();
            $order_product->cantidad = $products["cantidad"];
            $order_product->precio_total = $products["precio_total"];
            $order_product->product_id = $products["product_id"];
            $order_product->order_id = $order->id;
            $order_product->save();

            return response()->json([
                "success" => true,
                "message" => "orden registrada",
            ], 201);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
