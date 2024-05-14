<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {    
        // get user paginate 10
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name){
                return $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            })
            ->paginate(5);

        return view('pages.users.index', compact('users'));
    }

    public function create(){
        return view('pages.users.create');
    }

    public function store(Request $request){
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        User::create($data);
        return redirect()->route('users.index');
    }

    public function show($id){
        return view('pages.dashboard');
    }

    public function edit($id){
        $user = User::findOrFail($id);

        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $user = User::findOrFail($id);
        // check password is not empty
        if($request->input('password')){
            $data['password'] = Hash::make($request->input('password'));
        }else{
            // password is empty
            $data['password'] = $user->password;
        }

        $user->update($data);
        
        return redirect()->route('users.index');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
