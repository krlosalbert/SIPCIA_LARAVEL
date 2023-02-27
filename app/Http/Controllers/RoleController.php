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

    public function destroy($id){

        $role = Role::findOrFail($id);
        if ($role->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
