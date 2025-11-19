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

        // Import helyseg.txt (with encoding detection/normalization)
        $file = $base . DIRECTORY_SEPARATOR . 'helyseg.txt';
        if (is_readable($file)) {
            $content = file_get_contents($file);
            if (!mb_check_encoding($content, 'UTF-8')) {
                $tried = false;
                $toTry = ['CP1250', 'ISO-8859-2', 'ISO-8859-1', 'WINDOWS-1250'];
                foreach ($toTry as $enc) {
                    $converted = @iconv($enc, 'UTF-8//IGNORE', $content);
                    if ($converted !== false && mb_check_encoding($converted, 'UTF-8')) {
                        $content = $converted;
                        $tried = true;
                        break;
                    }
                }
                if (!$tried) {
                    // leave content as-is (may cause DB errors)
                }
            }

            $lines = preg_split('/\r\n|\n|\r/', $content);
            foreach ($lines as $line) {
                if (trim($line) === '') continue;
                $row = str_getcsv($line, "\t", '"');
                if (!isset($row[0]) || strtolower(trim($row[0], '"')) === 'az') continue;

                $az = (int) trim($row[0], '"');
                $nev = isset($row[1]) ? trim($row[1], '"') : null;
                $orszag = isset($row[2]) ? trim($row[2], '"') : null;

                DB::table('helysegek')->insert([
                    'az' => $az,
                    'nev' => $nev,
                    'orszag' => $orszag,
                ]);
            }
        }

        // Import szalloda.txt (with encoding normalization)
        $file = $base . DIRECTORY_SEPARATOR . 'szalloda.txt';
        if (is_readable($file)) {
            $content = file_get_contents($file);
            if (!mb_check_encoding($content, 'UTF-8')) {
                $tried = false;
                $toTry = ['CP1250', 'ISO-8859-2', 'ISO-8859-1', 'WINDOWS-1250'];
                foreach ($toTry as $enc) {
                    $converted = @mb_convert_encoding($content, 'UTF-8', $enc);
                    if ($converted !== false && mb_check_encoding($converted, 'UTF-8')) {
                        $content = $converted;
                        $tried = true;
                        break;
                    }
                }
                if (!$tried) {
                    $converted = @iconv('CP1250', 'UTF-8//IGNORE', $content);
                    if ($converted !== false) $content = $converted;
                }
            }

            $lines = preg_split('/\r\n|\n|\r/', $content);
            foreach ($lines as $line) {
                if (trim($line) === '') continue;
                $row = str_getcsv($line, "\t", '"');
                if (!isset($row[0]) || strtolower(trim($row[0], '"')) === 'az') continue;

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
        }

        // Import tavasz.txt (with encoding normalization)
        $file = $base . DIRECTORY_SEPARATOR . 'tavasz.txt';
        if (is_readable($file)) {
            $content = file_get_contents($file);
            if (!mb_check_encoding($content, 'UTF-8')) {
                $tried = false;
                $toTry = ['CP1250', 'ISO-8859-2', 'ISO-8859-1', 'WINDOWS-1250'];
                foreach ($toTry as $enc) {
                    $converted = @mb_convert_encoding($content, 'UTF-8', $enc);
                    if ($converted !== false && mb_check_encoding($converted, 'UTF-8')) {
                        $content = $converted;
                        $tried = true;
                        break;
                    }
                }
                if (!$tried) {
                    $converted = @iconv('CP1250', 'UTF-8//IGNORE', $content);
                    if ($converted !== false) $content = $converted;
                }
            }

            $lines = preg_split('/\r\n|\n|\r/', $content);
            foreach ($lines as $line) {
                if (trim($line) === '') continue;
                $row = str_getcsv($line, "\t", '"');
                if (!isset($row[0]) || strtolower(trim($row[0])) === 'szalloda_az') continue;

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
        }
    }
}
