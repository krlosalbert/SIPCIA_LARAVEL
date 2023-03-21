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
    //constructor para la autenticacion
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //metodo para visualizar las entradas
    public function View()
    {
        //instancio la clase para visualizar las entradas en la vista
        $entries = entries::select(
                                    '*', 
                                    'entries.id as entry_id',
                                    'entries.date as entry_date',
                                    'suppliers.name as supplier_name', 
                                    'invoices.number as invoice_number',
                                    'accounts.name as account_name'
                                )
        ->join('suppliers', 'entries.supplier_id', '=', 'suppliers.id')
        ->join('invoices', 'entries.invoice_id', '=', 'invoices.id')
        ->join('accounts', 'invoices.account_id', '=', 'accounts.id')
        ->get();
        //retorno los datos obtenidos a la vista
        return view('Entries.view', compact('entries'));
    }

    //metodo para ver los productos registrados en cada una de las entradas
    public function View_products(Request $request)
    {
        //dd($request->id);
        //tomo el id mandado desde la vista
        $search = $request->id;
        //instancio la clase para hacer la consulta de la entrada correspondiente
        $products = entries_products::select(
                                                '*', 
                                                'products.name as products_name', 
                                                'products.brand as products_brand',
                                                'accounts.name as products_account_name',
                                                'entries_products.amount as products_amount',
                                                'products.price as products_price'
                                            )
        ->join('products', 'entries_products.product_id', '=', 'products.id')
        ->join('accounts', 'products.account', '=', 'accounts.id')
        ->where('entries_products.entry_id', '=', $search)
        ->get();
        //retorno las variables a la vista
        return view('Entries.Details_entries', compact('products'));
    }

    //vista de las creacion de entradas
    public function New(Request $request)
    {
        //instancio la clase para traer los proveedores registrados
        $suppliers = Suppliers::All();
        //instancio la clase para traer todas las facturas registradas
        $invoices = invoices::All();
        //pregunto si existe una variable de sesion llamada productos
        if(\Session::get('products')){
            //si existe la variable le agrego el valor a una nueva variable llamada products
            $products = \Session::get('products');
        }else{
            //si no existe mando un arreglo vacio a la vista
            $products = array();
        }
        //retorno los datos obtenidos a la vista
        return view('Entries.NewEntries', compact('products', 'suppliers', 'invoices') );
    }

    //busqueda de productos en la db
    public function Search(Request $request)
    {
        //obtengo lo mandado por la vista y lo agrego a la variable search
        $search = $request->input('search');
        //instancio la clase para traer los datos de la db que contengan lo que lleva la variable search
        $products_with_accounts = Products::select(
                                                    '*',
                                                    'products.id as product_id',
                                                    'products.name as product_name',
                                                    'accounts.name as account_name'
                                                )
        ->join('accounts', 'products.account', '=', 'accounts.id')
        ->where('products.name', 'LIKE', '%'.$search.'%')
        ->get();
        //retorno los datos obtenidos a la vista
        return view('Entries.table_products', compact('products_with_accounts'));
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
        $products = array(
            
            'id' => $request->id,
            'amount' => $request->amount,
            'searchs' => $searchs->toarray()
            
        );
        //agrego el array a mi variable de sesion llamada products
        \Session::push('products', $products);
        //retorno los datos a mi vista        
        return redirect('NewEntries')->with([ 'x' =>0 ]);

    }

    //eliminar productos de la variable de sesion
    public function deleteProduct(Request $request)
    {
        //obtengo el dato mandado de la vista
        $indice = $request->input('indice');
        // Obtener la lista de productos de la sesión
        $productos = session('products');
        // Eliminar el producto con el índice dado
        unset($productos[$indice]);
        // Guardar la lista actualizada en la sesión
        session(['products' => $productos]);
        //redirecciono para volver a la misma vista
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

    //metodo para traer los datos para la edicion
    public function ReadUpdate(Request $request)
    {
        //tomo el valor mandado de la vista y se lo doy a mi variable serach
        $search = $request->id;
        //instancio la clase y le paso como parametro mi variable
        $entries = entries::select('entries.id as entry_id', 'entries.date as entry_date', 'suppliers.name as supplier_name', 'invoices.number as invoice_number')
        ->join('suppliers', 'entries.supplier_id', '=', 'suppliers.id')
        ->join('invoices', 'entries.invoice_id', '=', 'invoices.id')
        ->where('entries.id', '=', $search)
        ->get();
        //recorro mi arreglo traido de la db para mandarlo a la vista
        foreach($entries as $entry){}
        //instancio la clase para traer los proveedores registrados
        $suppliers = Suppliers::All();
        //instancio la clase para traer las facturas registradas
        $invoices = invoices::All();
        //retorno mis variables a la vista
        return view('Entries.Update', compact('entry', 'suppliers', 'invoices') );
    }

    //metodo para actualizar los datos en la db
    public function Update(Request $request, $id){
        //instancio la clase para traer los datos a actualizar pasandole como parametro el id
        $entry = entries::find($id);
        //tomo los datos y le paso como parametro todos los datos mandados por la vista
        // Actualizar el proveedor si ha sido modificado
        if ($request->input('supplier_id')!=null) {
            $entry->supplier_id = $request->input('supplier_id');
        }

        // Actualizar la factura si ha sido modificado
        if ($request->input('invoice_id')!=null) {
            $entry->invoice_id = $request->input('invoice_id');
        }
        //guardo la informacion en la db
        $entry->save();
        //redirecciono a la vista con un mensaje de exito
        return redirect()->route('ViewEntries')->with('success', 'Entrada Actualizada con exito');
    }

    //metodo para eliminar una entrada
    public function destroy($id){
        //instancio la clase para traer la entrada a eliminar
        $entry = entries::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($entry->delete()) {
            //si es correcto mando un mensaje de exito
            return response()->json(['success' => true]);
        }
        //de lo contrario mando un mensaje falso
        return response()->json(['success' => false]);
    }

}
