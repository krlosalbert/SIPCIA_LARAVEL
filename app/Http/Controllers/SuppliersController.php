<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use Illuminate\Pagination\Paginator; 

class SuppliersController extends Controller
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

    public function View(){
        // Obtener todos los roles
        $suppliers = Suppliers::paginate(5);

        return view('Suppliers.View', compact('suppliers'), ['x'=>0]);
    }

    public function Form(){

        return view('Suppliers.Form');
    }


    public function ReadUpdate($id){
        $supplier = Suppliers::findOrFail($id);

        return view('Suppliers.Update', compact('supplier'));
    
    }
}
