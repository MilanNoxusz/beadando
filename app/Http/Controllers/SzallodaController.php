<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Szalloda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    /**
     * Return JSON data for a diagram (counts grouped by besorolas).
     */
    // Fájl: app/Http/Controllers/SzallodaController.php

public function diagramData()
{
    try {
        $data = Szalloda::select('besorolas')
            ->get()
            ->groupBy(function ($item) {
                return $item->besorolas ?? 'Nincs besorolás';
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->toArray();

        return response()->json($data);
        
    } catch (\Throwable $e) { 
        // FIGYELEM: Ideiglenes hibakeresés!
        // Logolás helyett JSON-ben adjuk vissza a hibát, hogy lássuk a böngészőben.
        return response()->json([
            'error' => 'Szerver hiba történt: ' . $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
}
    /**
     * Show the diagram page (Blade view) which will render Chart.js.
     */
    public function diagramPage()
    {
        return view('diagram');
    }

    public function diagramDataByBesorolas()
    {
        $rows = DB::table('szallodak')
            ->select('besorolas', DB::raw('count(*) as cnt'))
            ->groupBy('besorolas')
            ->orderBy('besorolas')
            ->get();

        $labels = $rows->map(fn($r) => $r->besorolas ?? 'Nincs besorolás')->toArray();
        $values = $rows->pluck('cnt')->toArray();

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
public function diagramDataByHelyseg()
{
    $rows = DB::table('szallodak')
        ->leftJoin('helysegek', 'szallodak.helyseg_az', '=', 'helysegek.az')
        ->select(DB::raw('COALESCE(helysegek.nev, "Ismeretlen") as helyseg'), DB::raw('count(*) as cnt'))
        ->groupBy('helyseg')
        ->orderByDesc('cnt')
        ->get();

    return response()->json([
        'labels' => $rows->pluck('helyseg')->toArray(),
        'values' => $rows->pluck('cnt')->toArray(),
    ]);
}
public function diagramDataAvgTavByBesorolas()
{
    $rows = DB::table('szallodak')
        ->select('besorolas', DB::raw('AVG(tengerpart_tav) as avg_tav'))
        ->groupBy('besorolas')
        ->get();

    return response()->json([
        'labels' => $rows->pluck('besorolas')->map(fn($v)=> $v ?? 'Nincs')->toArray(),
        'values' => $rows->pluck('avg_tav')->map(fn($v) => round($v,1))->toArray(),
    ]);
}
}
