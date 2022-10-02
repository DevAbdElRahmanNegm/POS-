<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){


        $orders = Order::whereHas('client' , function ($q) use ($request){
            return $q->where('name' , 'like' , '%' . $request->search . '%');
        })->paginate(5);
        return view('dashboard.orders.index' , compact('orders'));
    }

    public function products(Order $order){

        $products  = $order->products;

        return view('dashboard.orders.products' , compact('products' , 'order'));
     }

     public function edit(){

        return view('dashboard.clients.orders.edit');
     }

     public function destroy(Order $order){

        foreach ($order->products as $product){

                $product->update([
                    'stock' => $product->stock + $product->pivot->quantity,
                ]);
        }
        $order->delete();
         return redirect()->route('dashboard.orders.index');
     }
}