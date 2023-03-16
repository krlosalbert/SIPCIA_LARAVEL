<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator; 
use DataTables;


class UserController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function FromUsers(){
        // Obtener todos los roles
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function ReadJoin(Request $request){
        $users_with_roles = (object) User::select('users.id', 'users.name', 'users.lastname', 'users.addres', 'users.phone', 'users.email', 'roles.name as role_name')
        ->join('roles', 'users.role', '=', 'roles.id')
        ->get();
        return view('Users.View', compact('users_with_roles'), ['x'=>0]);
    }

    public function ReadUpdate($id){
        $user = User::findOrFail($id);
        // Obtener todos los roles
        $roles = Role::all();
        return view('Users.Update', compact('user', 'roles'));
    }

    public function Update(Request $request, $id){
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        return redirect()->route('ReadUpdate', $id)->with('success', 'Usuario Actualizado con exito');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
