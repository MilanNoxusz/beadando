<?php

namespace App\Http\Controllers;

use App\Models\Tavasz;
use App\Models\Szalloda;
use Illuminate\Http\Request;

class AdminTavaszController extends Controller
{
    // Lista megjelenítése (READ) + RENDEZÉS
    public function index(Request $request)
    {
        $query = Tavasz::with('szalloda');

        // Rendezési paraméterek lekérése (alapértelmezett: indulás dátuma szerint, növekvő)
        $sortBy = $request->query('sort_by', 'indulas');
        $sortDir = $request->query('sort_dir', 'asc');

        // Biztonsági lista: csak ezekre az oszlopokra engedünk rendezni
        $allowedSorts = ['id', 'indulas', 'idotartam', 'ar', 'szalloda_nev'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'indulas';
        }

        if ($sortBy === 'szalloda_nev') {
            // Speciális eset: ha szálloda névre rendezünk, össze kell kapcsolni a táblákat
            $query->join('szallodak', 'tavasz.szalloda_az', '=', 'szallodak.az')
                  ->orderBy('szallodak.nev', $sortDir)
                  ->select('tavasz.*'); // Csak a tavasz adatait kérjük le, hogy ne keveredjenek az ID-k
        } else {
            // Normál rendezés
            $query->orderBy($sortBy, $sortDir);
        }

        $tavaszok = $query->get();

        // Átadjuk a view-nak a rendezési beállításokat is
        return view('admin', compact('tavaszok', 'sortBy', 'sortDir'));
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