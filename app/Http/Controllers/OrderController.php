<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function addtocart(Request $request)
    {
        if(auth('sanctum')->check()) 
        { 

            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;

            $product_check = Product::where('id', $product_id)->first();

            if ($product_check) 
            {
                if(Order::where('product_id', $product_id)->where('user_id', $user_id)->exists())
                {
                    return response()->json([
                        'status' => 409,
                        'message' => $product_check->name. "Ya agregaste este producto al carrito",
                     ]);
                }
                else 
                {
                    $cartitem = new Order();
                    $cartitem->user_id = $user_id;
                    $cartitem->product_id = $product_id;
                    $cartitem->product_qty = $product_qty;
                    $cartitem->save();

                    return response()->json([
                        'status' => 201,
                        'message' => "Added to cart",
                     ]);
                }
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => "Product not found",
                 ]);
            }
            
        }
        else 
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login to add to cart',
            ]);
        }
    }

    public function viewcart()
    {
        if (auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitems  = Order::where('user_id', $user_id)->get();
            return response()->json([
                'status' => 200,
                'message' => $cartitems,
            ]);
        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login to view cart data',
            ]);
        }
    }

    public function updatequanty($cart_id, $scope)
    {
        if (auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitem = Order::where('id', $cart_id)->where('user_id', $user_id)->first();
            if ($scope == "inc")
            {
                $cartitem->product_qty +=1;
            }
            elseif ($scope =="dec")
            {
                $cartitem->product_qty -=1;
            }
            $cartitem->update();
            return response()->json([
                'status' => 200,
                'message' => 'Quanty Update',
            ]);
            
        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login to continue',
            ]); 
        }
    }

    public function deleteCartitem($cart_id)
    {
        if (auth('sanctum')->check()) 
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitem = Order::where('id', $cart_id)->where('user_id', $user_id)->first();
            if ($cartitem)
            {
                $cartitem->delete();
                return response()->json([
                    'status' => 404,
                    'message' => 'Cart item remove successfully',
                ]); 
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cart item not found',
                ]); 
            }

        }
        else 
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login to continue',
            ]);  
        }
    }
}
