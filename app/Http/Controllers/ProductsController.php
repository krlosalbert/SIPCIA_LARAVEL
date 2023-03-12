<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Accounts;
use Illuminate\Pagination\Paginator; 

class ProductsController extends Controller
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


    public function View(Request $request){
        $products_with_accounts = Products::select('products.*', 'accounts.name as account_name')
            ->join('accounts', 'products.account', '=', 'accounts.id')
            ->get();   
  
        return view('Products.View', compact('products_with_accounts'), ['x'=>0]);
    }

    public function Form(){

        $accounts = Accounts::all();

        return view('Products.Form', compact('accounts'));
    }

    protected function Create(Request $request)
    {
        
        $products = $request->validate([
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'account' => ['required', 'integer'],
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
        ]);
    
        //dd($roles);
        // Crear un nuevo usuario
        $product = Products::create([
            'name' => $products['name'],
            'brand' => $products['brand'],
            'account' => $products['account'],
            'price' => $products['price'],
        ]);
        
        // Redireccionar a la vista de roles
        return redirect()->route('ViewProducts')->with('success', 'Producto Guardado  con exito');
    }

    public function ReadUpdate($id){
        $product = Products::findOrFail($id);

        // Obtener todos las cuentas
        $accounts = Accounts::all();
        
        return view('Products.Update', compact('product', 'accounts'));
    
    }

    public function Update(Request $request, $id){

        $products = Products::find($id);
        $products->fill($request->all());
        $products->save();
        return redirect()->route('ReadUpdateProducts', $id)->with('success', 'Producto Actualizado con exito');
    }

    public function destroy($id){

        $product = Products::findOrFail($id);
        if ($product->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
