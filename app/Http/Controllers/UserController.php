<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        try {
            $user = User::find($id);
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
    
            $user->update();

        } catch (\Throwable $th) {
            return redirect()->route('user.edit', ['id' => $id])->with('error', 'Ha ocurrido un error');
        }

        return redirect()->route('user.edit', ['id' => $id])->with('message','Actualizado correctamente');
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->route('user.index', ['id' => $id])->with('error', 'Usuario no eliminado ha ocurrido un error');
            
        }
        
        return redirect()->route('home')->with('message','Eliminado correctamente');

    }
}
