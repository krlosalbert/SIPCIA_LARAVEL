<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
use App\Models\Accounts;
use App\Models\Suppliers;

class invoicesController extends Controller
{
    //metodo para ver las facturas registradas
    public function View()
    {
        //instancio la clase para traer las facturas registradas
        $invoices = invoices::select('*', 'invoices.id as invoices_id','accounts.name as account_name', 'suppliers.name as supplier_name')
        ->join('accounts', 'invoices.account_id', '=', 'accounts.id')
        ->join('suppliers', 'invoices.supplier_id', '=', 'suppliers.id')
        ->get(); 
        //retorno la variable a la vista
        return view('Invoices.View', compact('invoices'));
    }

    //metodo para el formulario de creacion de nuevas facturas
    public function Form()
    {
        //instancio la clase para traer todos los proveedores registrados
        $suppliers = Suppliers::All();
        //instancio la clase para traer todas las cuentas registradas
        $accounts = Accounts::All();
        //retorno las variebles con los datos a la vista
        return view('Invoices.Form', compact('suppliers', 'accounts'));
    }

    //metodo para crear las facturas
    public function Create(Request $request)
    {
        //obtener los datos enviados para la validacion
        $date = $request->validate([
            'date' => ['required', 'date'],
            'number' => ['required', 'string'],
            'number_entries' => ['required', 'string'],
            'supplier_id' => ['required', 'integer'],
            'account_id' => ['required', 'integer'],
            'total' => ['required', 'integer'],
        ]);
        // Crear la nueva entrada
        $invoice = invoices::create([
            'date' => $date['date'],
            'number' => $date['number'],
            'number_entries' => $date['number_entries'],
            'supplier_id' => $date['supplier_id'],
            'account_id' => $date['account_id'],
            'total' => $date['total'],
        ]);

        //retorno a la vista las variables
        return redirect()->route('ViewInvoices')->with('success', 'Factura Guardada  con exito');

    }

    //metodo para traer los datos para la edicion
    public function ReadUpdate(Request $request)
    {
        //tomo el valor mandado de la vista y se lo doy a mi variable serach
        $search = $request->id;
        //instancio la clase y le paso como parametro mi variable
        $invoices = invoices::select('*',
                                        'invoices.id as invoice_id',
                                        'invoices.date as invoice_date',
                                        'invoices.number as invoice_number',
                                        'invoices.number_entries as invoice_number_entries',
                                        'invoices.account_id as invoice_account_id',
                                        'invoices.total as invoice_total',
                                        'suppliers.name as supplier_name',
                                        'accounts.name as account_name'
                                    )
        ->join('suppliers', 'invoices.supplier_id', '=', 'suppliers.id')
        ->join('accounts', 'invoices.account_id', '=', 'accounts.id')
        ->where('invoices.id', '=', $search)
        ->get();
        //recorro mi arreglo traido de la db para mandarlo a la vista
        foreach($invoices as $invoice){};
        //instancio la clase para traer los proveedores registrados
        $suppliers = Suppliers::All();
        //instancio la clase para traer las facturas registradas
        $accounts = Accounts::All();
        //retorno mis variables a la vista
        return view('Invoices.update', compact('invoice', 'suppliers', 'accounts') );
    }

    //metodo para actualizar los datos en la db
    public function Update(Request $request, $id){
        //instancio la clase para traer los datos a actualizar pasandole como parametro el id
        $invoice = invoices::find($id);
        //tomo los datos y le paso como parametro todos los datos mandados por la vista
        // Actualizar la fecha si ha sido modificada
        if ($request->input('date')!=null) {
            $invoice->date = $request->input('date');
        }
        // Actualizar el numero de factura si ha sido modificado
        if ($request->input('number')!=null) {
            $invoice->number = $request->input('number');
        }
        // Actualizar el numero de entradas ha sido modificada
        if ($request->input('number_entries')!=null) {
            $invoice->number_entries = $request->input('number_entries');
        }
        //Actualizar el proveedor si ha sido modificado
        if ($request->input('supplier_id')!=null) {
            $invoice->supplier_id = $request->input('supplier_id');
        }

        // Actualizar la cuenta si ha sido modificado
        if ($request->input('account_id')!=null) {
            $invoice->account_id = $request->input('account_id');
        }

        // Actualizar el total de la factura si ha sido modificado
        if ($request->input('total')!=null) {
            $invoice->total = $request->input('total');
        }
        //guardo la informacion en la db
        $invoice->save();
        //redirecciono a la vista con un mensaje de exito
        return redirect()->route('ViewInvoices')->with('success', 'Factura Actualizada con exito');
    }

    //metodo para eliminar una entrada
    public function destroy($id){
        //instancio la clase para traer la entrada a eliminar
        $invoices = invoices::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($invoices->delete()) {
            //si es correcto mando un mensaje de exito
            return response()->json(['success' => true]);
        }
        //de lo contrario mando un mensaje falso
        return response()->json(['success' => false]);
    }
}
