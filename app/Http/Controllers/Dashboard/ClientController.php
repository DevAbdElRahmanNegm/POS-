<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients =  Client::when($request->search,function ($q) use ($request){
            return $q->where('name','like', '%' .$request->search.'%')
                ->orWhere('phone','like', '%' .$request->search.'%')
                ->orWhere('address','like', '%' .$request->search.'%');

        })->latest()->paginate(5);
        return view('dashboard.clients.index' , compact('clients'));
    }


    public function create()
    {
        return view('dashboard.clients.create');

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',

        ]);
        Client::create($request->all());
        return redirect()->route('dashboard.clients.index');
    }


    public function edit($id)
    {
        $client = Client::findOrfail($id);
        return view('dashboard.clients.edit' , compact('client'));

    }

    public function update(Request $request, Client $Client)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $Client->update($request->all());

        return redirect()->route('dashboard.clients.index');

    }


    public function destroy(Client $Client)
    {
        $Client->delete();
        return redirect()->route('dashboard.clients.index');

    }
}
