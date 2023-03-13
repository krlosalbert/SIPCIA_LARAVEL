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

    protected function Create(Request $request)
    {
        //dd($request);
        $suppliers = $request->validate([
            'nit' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'city' => ['required', 'string'],
            'addres' => ['required', 'string'],
            'phone' => ['required', 'integer'],
            'email' => ['required', 'email'],
        ]);
        
        // Crear un nuevo proveedor
        $supplier = Suppliers::create([
            'nit' => $suppliers['nit'],
            'name' => $suppliers['name'],
            'city' => $suppliers['city'],
            'addres' => $suppliers['addres'],
            'phone' => $suppliers['phone'],
            'email' => $suppliers['email'],
        ]);
        
        // Redireccionar a la vista de proveedores
        return redirect()->route('ViewSuppliers')->with('success', 'Proveedor Guardado  con exito');
    }


    public function ReadUpdate($id){
        $supplier = Suppliers::findOrFail($id);

        return view('Suppliers.Update', compact('supplier'));
    
    }

    public function Update(Request $request, $id){

        $supplier = Suppliers::find($id);
        $supplier->fill($request->all());
        $supplier->save();
        return redirect()->route('ReadUpdateSuppliers', $id)->with('success', 'Proveedor Actualizado con exito');
    }

    public function destroy($id){

        $supplier = Suppliers::findOrFail($id);
        if ($supplier->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
