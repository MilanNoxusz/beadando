<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class DbFilesSeeder extends Seeder
{
    public function run(): void
    {
        $base = base_path('db_files');

        // Disable FK checks for truncation (MySQL)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tavasz')->truncate();
        DB::table('szallodak')->truncate();
        DB::table('helysegek')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Import helyseg.txt
        $file = $base . DIRECTORY_SEPARATOR . 'helyseg.txt';
        if (is_readable($file)) {
            if (($h = fopen($file, 'r')) !== false) {
                while (($row = fgetcsv($h, 0, "\t", '"')) !== false) {
                    // Skip header rows
                    if (!isset($row[0]) || strtolower(trim($row[0], '"')) === 'az') {
                        continue;
                    }

                    $az = (int) trim($row[0], '"');
                    $nev = isset($row[1]) ? trim($row[1], '"') : null;
                    $orszag = isset($row[2]) ? trim($row[2], '"') : null;

                    DB::table('helysegek')->insert([
                        'az' => $az,
                        'nev' => $nev,
                        'orszag' => $orszag,
                    ]);
                }
                fclose($h);
            }
        }

        // Import szalloda.txt
        $file = $base . DIRECTORY_SEPARATOR . 'szalloda.txt';
        if (is_readable($file)) {
            if (($h = fopen($file, 'r')) !== false) {
                while (($row = fgetcsv($h, 0, "\t", '"')) !== false) {
                    if (!isset($row[0]) || strtolower(trim($row[0], '"')) === 'az') {
                        continue;
                    }

                    $az = trim($row[0], '"');
                    $nev = isset($row[1]) ? trim($row[1], '"') : null;
                    $besorolas = isset($row[2]) ? (int)$row[2] : null;
                    $helyseg_az = isset($row[3]) ? (int)$row[3] : null;
                    $tengerpart_tav = isset($row[4]) ? (int)$row[4] : null;
                    $repter_tav = isset($row[5]) ? (int)$row[5] : null;
                    $felpanzio = isset($row[6]) ? ((int)$row[6] === 1) : false;

                    DB::table('szallodak')->insert([
                        'az' => $az,
                        'nev' => $nev,
                        'besorolas' => $besorolas,
                        'helyseg_az' => $helyseg_az,
                        'tengerpart_tav' => $tengerpart_tav,
                        'repter_tav' => $repter_tav,
                        'felpanzio' => $felpanzio,
                    ]);
                }
                fclose($h);
            }
        }

        // Import tavasz.txt
        $file = $base . DIRECTORY_SEPARATOR . 'tavasz.txt';
        if (is_readable($file)) {
            if (($h = fopen($file, 'r')) !== false) {
                while (($row = fgetcsv($h, 0, "\t", '"')) !== false) {
                    // header
                    if (!isset($row[0]) || strtolower(trim($row[0])) === 'szalloda_az') {
                        continue;
                    }

                    $szalloda_az = trim($row[0], '"');
                    $indulas_raw = isset($row[1]) ? trim($row[1]) : null;
                    // convert 2011.01.05 to 2011-01-05
                    $indulas = null;
                    if ($indulas_raw) {
                        $indulas = str_replace('.', '-', $indulas_raw);
                        // ensure format Y-m-d
                        $time = strtotime($indulas);
                        $indulas = $time ? date('Y-m-d', $time) : null;
                    }

                    $idotartam = isset($row[2]) ? (int)$row[2] : null;
                    $ar = isset($row[3]) ? (int)$row[3] : null;

                    DB::table('tavasz')->insert([
                        'szalloda_az' => $szalloda_az,
                        'indulas' => $indulas,
                        'idotartam' => $idotartam,
                        'ar' => $ar,
                    ]);
                }
                fclose($h);
            }
        }
    }
}
