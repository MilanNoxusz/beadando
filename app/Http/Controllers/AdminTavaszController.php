<?php

namespace App\Http\Controllers;

use App\Models\Tavasz;
use App\Models\Szalloda;
use Illuminate\Http\Request;

class AdminTavaszController extends Controller
{
    // Lista megjelenítése (READ)
    public function index()
    {
        $tavaszok = Tavasz::with('szalloda')->orderBy('indulas')->get();
        return view('admin', compact('tavaszok'));
    }

    // Létrehozás űrlap (CREATE FORM)
    public function create()
    {
        $szallodak = Szalloda::all();
        return view('admin.create', compact('szallodak'));
    }

    // Mentés adatbázisba (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'szalloda_az' => 'required|exists:szallodak,az',
            'indulas' => 'required|date',
            'idotartam' => 'required|integer|min:1',
            'ar' => 'required|integer|min:0',
        ]);

        Tavasz::create($request->all());

        return redirect()->route('admin')->with('success', 'Út sikeresen létrehozva!');
    }

    // Szerkesztés űrlap (EDIT FORM)
    public function edit($id)
    {
        $tavasz = Tavasz::findOrFail($id);
        $szallodak = Szalloda::all();
        return view('admin.edit', compact('tavasz', 'szallodak'));
    }

    // Frissítés adatbázisban (UPDATE)
    public function update(Request $request, $id)
    {
        $request->validate([
            'szalloda_az' => 'required|exists:szallodak,az',
            'indulas' => 'required|date',
            'idotartam' => 'required|integer|min:1',
            'ar' => 'required|integer|min:0',
        ]);

        $tavasz = Tavasz::findOrFail($id);
        $tavasz->update($request->all());

        return redirect()->route('admin')->with('success', 'Út sikeresen frissítve!');
    }

    // Törlés (DELETE)
    public function destroy($id)
    {
        Tavasz::destroy($id);
        return redirect()->route('admin')->with('success', 'Út sikeresen törölve!');
    }
}