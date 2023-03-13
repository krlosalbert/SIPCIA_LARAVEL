<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntriesController extends Controller
{
    public function New()
    {
        return view('Entries.NewEntries');
    }
}
