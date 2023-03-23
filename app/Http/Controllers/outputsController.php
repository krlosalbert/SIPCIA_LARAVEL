<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outputs;
use App\Models\subaccounts;
use App\Models\departments;
use App\Models\employees;
use App\Models\User;
use App\Models\Products;
use App\Models\outputs_products;
use Illuminate\Support\Facades\Session;



class outputsController extends Controller
{
    public function View()
    {
        $outputs = outputs::select('*',
                                    'outputs.id as output_id',
                                    'outputs.date as output_date',
                                    'outputs.number as output_number',
                                    'subaccounts.name as subaccount_name',
                                    'departments.name as department_name',
                                    'employees.name as employee_name',
                                    'users.name as user_name',
                                    'users.lastname as user_lastname'
                                )
        ->join('subaccounts', 'outputs.subaccount_id', '=', 'subaccounts.id')
        ->join('departments', 'outputs.department_id', '=', 'departments.id')
        ->join('employees', 'outputs.employee_id', '=', 'employees.id')
        ->join('users', 'outputs.user_id', '=', 'users.id')
        ->get();

       // dd($outputs);

        return view('Outputs.View', compact('outputs'));
    }

     //vista de las creacion de entradas
     public function New(Request $request)
     {
        //instancio la clase para traer las subcunetas registradas
        $subaccounts = subaccounts::All();
         //instancio la clase para traer todas las dependencias registradas
        $departments = departments::All();
        //instancio la clase para traer todas los empleados registrados
        $employees = employees::All();
        //instancio la clase para traer todas los usuarios registrados
        $users = User::All();
         //pregunto si existe una variable de sesion llamada productos
         if(\Session::get('products_outputs')){
             //si existe la variable le agrego el valor a una nueva variable llamada products
             $products = \Session::get('products_outputs');
         }else{
             //si no existe mando un arreglo vacio a la vista
             $products = array();
         }
         //retorno los datos obtenidos a la vista
         return view('Outputs.NewOutput', compact('products', 'subaccounts', 'departments', 'employees', 'users') );
     }

    //añadir los productos a la variable de sesion
    public function add_to_session(Request $request)
    {
        //dd($request->id);
        //instancio la clase para buscar los productos por el id
        $searchs = Products::select('*', 'products.name as product_name','accounts.name as account_name')
        ->join('accounts', 'products.account', '=', 'accounts.id')
        ->where('products.id', '=', $request->id)
        ->get();   

        //dd($request->id);
        //inicializo mi array anexandole los datos mandados por la vista y insertando los datos obtenidos en la consulta a la db
        $products_outputs = array(
            
            'id' => $request->id,
            'amount' => $request->amount,
            'searchs' => $searchs->toarray()
            
        );
        //agrego el array a mi variable de sesion llamada products
        \Session::push('products_outputs', $products_outputs);
        //retorno los datos a mi vista        
        return redirect('NewOutputs')->with([ 'x' =>0 ]);

    }

    //eliminar productos de la variable de sesion
    public function deleteProduct(Request $request)
    {
        //obtengo el dato mandado de la vista
        $indice = $request->input('indice');
        // Obtener la lista de productos de la sesión
        $products = session('products_outputs');
        // Eliminar el producto con el índice dado
        unset($products[$indice]);
        // Guardar la lista actualizada en la sesión
        session(['products_outputs' => $products]);
        //redirecciono para volver a la misma vista
        return redirect()->back()->with(['delete' => true]);

    }

    //insertar los datos a las tablas correspondientes
    public function create(Request $request)
    {
        //obtener los datos enviados para la validacion
        $date = $request->validate([
            'date' => ['required', 'date'],
            'number' => ['required', 'integer'],
            'subaccount_id' => ['required', 'integer'],
            'department_id' => ['required', 'integer'],
            'employee_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
        ]);
        // Crear la nueva entrada
        $outputs = outputs::create([
            'date' => $date['date'],
            'number' => $date['number'],
            'subaccount_id' => $date['subaccount_id'],
            'department_id' => $date['department_id'],
            'employee_id' => $date['employee_id'],
            'user_id' => $date['user_id'],
        ]);
        //obtener el ultimo id de la entrada para registrar los nuevos productos ingresados
        $lastregister= outputs::latest()->latest()->value('id');
        //tomar los datos de la variable de sesion
        $products = \Session::get('products_outputs');     
        //recorrer la variable de sesion para hacer la insersion en la tabla outputs_products
        foreach($products as $product)
        {
            //insertar cada uno de los datos que existen en la variable
            $insert = outputs_products::create([
                'amount' => $product['amount'],
                'output_id' => $lastregister,
                'product_id' => $product['id'],
            ]);

        };    
        // vaciar la variable de sesion
        Session::forget('products_outputs');
        // Redireccionar a la vista de nuevas entradas
        return redirect()->route('NewOutputs')->with('success', 'entrada Guardada  con exito');

    }
}
