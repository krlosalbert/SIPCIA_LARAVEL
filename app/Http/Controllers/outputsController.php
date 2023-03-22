<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outputs;

class outputsController extends Controller
{
    public function View()
    {
        $outputs = outputs::All();

        return view('Outputs.View', compact('outputs'));
    }
}
