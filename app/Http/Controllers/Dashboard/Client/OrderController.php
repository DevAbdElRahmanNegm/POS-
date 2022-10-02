<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.clients.index' , compact('clients'));
    }


    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create' , compact('client' , 'categories'));

    }


    public function store(Request $request , Client $client)
    {

        $request->validate([
            'products' => 'array|required',
            'quantity' => 'array|required'

        ]);

        $order = $client->orders()->create([]);
        $total_price = 0;
        foreach ($request->products as $index=>$product){

            $product_price = Product::findOrfail($product);
            $total_price += $product_price->sale_price * $request->quantity[$index] ;
            $order->products()->attach($product , ['quantity' => $request->quantity[$index]]);

            $product_price->update([
                'stock' => $product_price->stock - $request->quantity[$index]
            ]);
        }
        $order->update([
            'total_price' => $total_price
        ]);

        return redirect()->route('dashboard.clients.index');
    }


    public function edit(Client $client , Order $order)
    {
        return view('dashboard.clients.edit' , compact('client'));

    }

    public function update(Request $request, Client $Client , Order $order)
    {

        return redirect()->route('dashboard.clients.index');

    }


    public function destroy(Client $Client , Order $order)
    {

        return redirect()->route('dashboard.clients.index');

    }

}
