<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Accounts;
use App\Models\Suppliers;
use App\Models\invoices;
use App\Models\entries;
use App\Models\entries_products;
use Illuminate\Support\Facades\Session;

class EntriesController extends Controller
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
    
    public function View()
    {
        $entries = entries::select('*', 'entries.id as entry_id', 'suppliers.name as supplier_name', 'invoices.number as invoice_number')
        ->join('suppliers', 'entries.supplier_id', '=', 'suppliers.id')
        ->join('invoices', 'entries.invoice_id', '=', 'invoices.id')
        ->get();
        return view('Entries.view', compact('entries'));
    }

    public function View_products(Request $request)
    {
        $search = $request->id;

        $products = entries_products::select(
                                                '*', 
                                                'products.name as products_name', 
                                                'products.brand as products_brand',
                                                'products.account as products_account',
                                                'products.price as products_price'
                                            )
        ->join('products', 'entries_products.product_id', '=', 'products.id')
        ->where('entry_id', '=', $search)
        ->get();

        //dd($products);
        return view('Entries.Details_entries', compact('products'));
    }


    //vista de las creacion de entradas
    public function New(Request $request)
    {
        $suppliers = Suppliers::All();

        $invoices = invoices::All();

        if(\Session::get('products')){
            $products = \Session::get('products');
        }else{
            $products = array();
        }
        return view('Entries.NewEntries', compact('products', 'suppliers', 'invoices') );
    }

    //busqueda de productos en la db
    public function Search(Request $request)
    {
        $search = $request->input('search');
        $products_with_accounts = Products::select('products.*')
                    ->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('brand', 'LIKE', '%'.$search.'%')
                    ->orWhere('account', 'LIKE', '%'.$search.'%')
                    ->get();
        return view('Entries.table_products', compact('products_with_accounts'));
    }
    
    // añadir los productos a la variable de sesion
    public function add_to_session(Request $request)
    {
        $searchs = (object) Products::select('products.*', 'accounts.name as account_name')
        ->join('accounts', 'products.account', '=', 'accounts.id')
        ->where('products.id', '=', "$request->id")
        ->get();   

        $products = array(

            'id' => $request->id,
            'amount' => $request->amount,
            'searchs' => $searchs->toarray()

        );
        \Session::push('products', $products);
        //dd(\Session::get('products'));
        
        return redirect('NewEntries')->with([ 'x' =>0 ]);

    }

    //eliminar productos de la variable de sesion
    public function deleteProduct(Request $request)
    {
        $indice = $request->input('indice');

        // Obtener la lista de productos de la sesión
        $productos = session('products');

        // Eliminar el producto con el índice dado
        unset($productos[$indice]);

        // Guardar la lista actualizada en la sesión
        session(['products' => $productos]);

        return redirect()->back()->with(['delete' => true]);

    }

    //insertar los datos a las tablas correspondientes
    public function create(Request $request)
    {
        //obtener los datos enviados para la validacion
        $date = $request->validate([
            'date' => ['required', 'date'],
            'supplier' => ['required', 'integer'],
            'invoice' => ['required', 'integer'],
        ]);
        
        // Crear la nueva entrada
        $entries = entries::create([
            'date' => $date['date'],
            'supplier_id' => $date['supplier'],
            'invoice_id' => $date['invoice'],
        ]);

        //obtener el ultimo id de la entrada para registrar los nuevos productos ingresados
        $lastregister= entries::latest()->latest()->value('id');

        //tomar los datos de la variable de sesion
        $products = \Session::get('products');
               
        //recorrer la variable de sesion para hacer la insersion en la tabla entries_products
        foreach($products as $product)
        {
            //insertar cada uno de los datos que existen en la variable
            $insert = entries_products::create([
                'amount' => $product['amount'],
                'entry_id' => $lastregister,
                'product_id' => $product['id'],
            ]);

        };    

        // vaciar la variable de sesion
        Session::forget('products');

        // Redireccionar a la vista de nuevas entradas
        return redirect()->route('NewEntries')->with('success', 'entrada Guardada  con exito');




    }
}
