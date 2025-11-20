<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Szalloda;

class SzallodaController extends Controller
{
    public function index()
    {
        $szallodak = Szalloda::all();
        return view('szallodak.index', compact('szallodak'));
    }

    public function show($az)
    {
        $szalloda = Szalloda::where('az', $az)->firstOrFail();
        return view('szallodak.show', compact('szalloda'));
    }
}
