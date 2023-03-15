<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Accounts;

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
        if(\Session::get('products')){
            $products = \Session::get('products');
        }else{
            $products = array();
        }

        if(\Session::get('products_with_accounts')){
            $products_with_accounts = \Session::get('products_with_accounts');
        }else{
            $products_with_accounts = array();
        }

        return view('Entries.NewEntries', compact('products_with_accounts', 'products') + ['x'=>0]);
    }
    
    public function Search(Request $request){
        
        $products_with_accounts = (object) Products::select('products.*', 'accounts.name as account_name')
        ->join('accounts', 'products.account', '=', 'accounts.id')
        ->where('products.name', 'like', "%$request->search%")
        ->get();   

        \Session::push('products_with_accounts', $products_with_accounts);
        
        return redirect('NewEntries')->with(['products_with_accounts' => $products_with_accounts, 'x' =>0 ]);
      
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
        
        return redirect('NewEntries')->with([ 'x' =>0 ]);

    }
    
}
