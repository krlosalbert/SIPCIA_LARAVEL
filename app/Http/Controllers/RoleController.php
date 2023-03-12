<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
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

    public function View()
    {
        $roles = Role::all();
        return view('/Role.View', compact('roles'), ['x'=>0]);
    }

    public function formRole()
    {
        return view('/Role.NewRole');
    }

    protected function Create(Request $request)
    {
        
        $roles = $request->validate([
            'name' => ['required', 'string'],
        ]);
    
        //dd($roles);
        // Crear un nuevo usuario
        $role = Role::create([
            'name' => $roles['name'],
        ]);
        
        // Redireccionar a la vista de roles
        return redirect()->route('ViewRoles')->with('success', 'Rol Guardado  con exito');
    }


    function ReadUpdate($id)
    {
        $role = Role::findOrFail($id);
        
        return view('Role.UpdateRole', compact('role'));

    }

    public function Update(Request $request, $id){

        $role = Role::find($id);
        $role->fill($request->all());
        $role->save();
        return redirect()->route('ReadUpdateRole', $id)->with('success', 'Role Actualizado con exito');
    }

    public function destroy($id){

        $role = Role::findOrFail($id);
        if ($role->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
