<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\users;
use App\Http\Requests\userUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only(['create', 'store']);
        $this->middleware(['permission:users_update'])->only(['edit', 'update']);
        $this->middleware(['permission:users_delete'])->only('destroy');

    }

    public function index(Request $request)
    {


        $users = User::whereRoleIs('admin')->where(function ($q) use ($request){

            return $q->when($request->search, function ($query) use ($request){
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

            })->latest()->paginate(10);


        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {


        return view('dashboard.users.create');

    }

    public function store(users $request)
    {


        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('images/users/' . $request->image->hashName()));
        }
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'image' => $request->image->hashName()
        ]);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        return redirect()->route('dashboard.users.index');
    }

    public function edit($id)
    {

        $user = User::findOrfail($id);

        return view('dashboard.users.edit', compact('user'));
    }

    public function update(userUpdate $request, User $user)
    {

        $requestArray = $request->except('permissions', 'image');
        if ($request->image) ;
        {
            if ($request->image != 'default.png') {

                unlink('images/users/' . $user->image);

            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('images/users/' . $request->image->hashName()));

            $requestArray['image'] = $request->image->hashName();
        }
        $user->update($requestArray);
        $user->syncPermissions($request->permissions);
        return redirect()->route('dashboard.users.index');

    }

    public function destroy(User $user)
    {

        unlink('images/users/' . $user->image);
        $user->delete();
        return redirect()->back();
    }
}
