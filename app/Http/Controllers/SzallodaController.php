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
     * Diagram adatok (JSON)
     */
    public function diagramData()
    {
        try {
            // Itt a biztonságos, hagyományos szintaxist használjuk
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
            return response()->json([
                'error' => 'Szerver hiba történt: ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function diagramPage()
    {
        return view('diagram');
    }

    // --- A lenti függvényekben javítottuk a szintaxist a régi PHP verziók miatt ---

    public function diagramDataByBesorolas()
    {
        $rows = DB::table('szallodak')
            ->select('besorolas', DB::raw('count(*) as cnt'))
            ->groupBy('besorolas')
            ->orderBy('besorolas')
            ->get();

        // JAVÍTVA: fn() nyíl függvény helyett hagyományos function
        $labels = $rows->map(function($r) {
            return $r->besorolas ?? 'Nincs besorolás';
        })->toArray();

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

        // JAVÍTVA: hagyományos function használata
        $labels = $rows->pluck('besorolas')->map(function($v) {
            return $v ?? 'Nincs';
        })->toArray();

        // JAVÍTVA: hagyományos function használata
        $values = $rows->pluck('avg_tav')->map(function($v) {
            return round($v, 1);
        })->toArray();

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}