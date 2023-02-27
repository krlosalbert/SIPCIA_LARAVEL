<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator; 


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

    public function View(){

        return view('Users.Form');
    }

    public function Create(Request $request){
        $user = new User();

        $user -> UserName = $request -> UserName;
        $user -> UserLastName = $request -> UserLastName;
        $user -> UserAddres = $request -> UserAddres;
        $user -> UserPhone = $request -> UserPhone;
        $user -> UserEmail = $request -> UserEmail;
        $user -> UserIdCard = $request -> UserIdCard;
        $user -> UserPassword = Hash::make($request->UserPassword ); // Encriptar la contraseña con la función bcrypt;
        $user -> RoleId = $request -> RoleId;
        $user -> save();

        return redirect('/viewUsers');

    }

    public function Read(Request $request){
        $user = User::all();

        return view('Users.View', compact('Users'), ['x'=>0]);

    }

    public function ReadJoin(Request $request){
        $users = User::join("tblrole", "tblrole.RoleId", "=", "users.role")
        ->select("*")->get();

        //dd($users);
        $users = User::paginate(3);

        
        return view('ViewUsers', compact('users'), ['x'=>0]);
    }

    public function ReadUpdate(Request $request){
            $id = $request;
/*          $user = User::join('tblrole', 'tbluser.RoleId', '=', 'tblrole.RoleId')
                    ->select('tbluser.*', 'tblrole.*') */
            $user = User::join("tblrole", "tbluser.RoleId", "=", "tblrole.RoleId")
                    ->select('tbluser.UserName', 'tbluser.UserIdCard', 'tblrole.RoleDescription')                    
                    ->where('tbluser.UserId', 11)
                    ->first();
        $role = Role::all();

        if($user) {
            // La variable $user no es null, se puede acceder a sus propiedades
            return view('Users.Update', compact('user'), ['Users'=>$user], ['Roles'=>$role]); 
        } else {
            // La variable $user es null, no se puede acceder a sus propiedades
            return redirect('/viewUsers');
        }
        
    }

    public function ReadUpdate2(Request $request){
        $id = $request;
        $user = User::findOrFail($id);

        $Role = Role::all();
        return view('Users.Update', ['Users'=>$user], ['Roles'=>$Role]);
    }

    public function Update(Request $request, $id){

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        return redirect()->route('ruta.index');
    }

    public function destroy($id){

        $user = User::findOrFail($id);
        if ($user->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
