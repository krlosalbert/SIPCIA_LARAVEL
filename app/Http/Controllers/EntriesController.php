<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Accounts;
use App\Models\Suppliers;

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
    
    public function New(Request $request)
    {
        $suppliers = Suppliers::All();

        if(\Session::get('products')){
            $products = \Session::get('products');
        }else{
            $products = array();
        }
        
        return view('Entries.NewEntries', compact('products', 'suppliers') );
    }

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
    
    public function add_to_session(Request $request)
    {
        $searchs = (object) Products::select('products.*', 'accounts.name as account_name')
        ->join('accounts', 'products.account', '=', 'accounts.id')
        ->where('products.id', '=', "$request->id")
        ->get();   

        $products = (object) array(

            'id' => $request->id,
            'amount' => $request->amount,
            'searchs' => $searchs->toarray()

        );
        \Session::push('products', $products);
        //dd(\Session::get('products'));
        
        return redirect('NewEntries')->with([ 'x' =>0 ]);

    }


    public function eliminarDato(Request $request)
    {
        $indice = $request->input('indice');

        // Obtener la lista de productos de la sesión
        $productos = session('products');

        // Eliminar el producto con el índice dado
        unset($productos[$indice]);

        // Guardar la lista actualizada en la sesión
        session(['products' => $productos]);

        return redirect()->back()->with(['success' => true]);

        
         

    }
}
