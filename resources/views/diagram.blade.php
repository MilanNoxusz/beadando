extends('layouts.html5up')

@section('title', 'Statisztikák')

@section('content')
<div id="page-wrapper">
    <header id="header" class="alt">
        <h1>Statisztikák</h1>
        <nav>
            <a href="{{ route('home') }}">Vissza a főoldalra</a>
        </nav>
    </header>

    <section class="inner">
        <header class="major">
            <h2>Adatbázis diagramok</h2>
            <p>Grafikus kimutatások a szállodák és az utazások adataiból.</p>
        </header>

        <div class="box">
            <h3>Szállodák megoszlása besorolás szerint</h3>
            <p>Ez a diagram azt mutatja, hány szálloda tartozik az egyes csillag-besorolásokhoz.</p>
            <div style="position: relative; height:40vh; width:100%">
                <canvas id="besorolasChart"></canvas>
            </div>
        </div>

        <br>

        <div class="box">
            <h3>Tavaszi utak árainak alakulása</h3>
            <p>Az indulási dátumokhoz tartozó átlagos utazási árak (HUF).</p>
            <div style="position: relative; height:40vh; width:100%">
                <canvas id="arChart"></canvas>
            </div>
        </div>

    </section>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. Diagram betöltése: Besorolás (Oszlopdiagram)
            fetch('{{ route('szallodak.diagram.data') }}')
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    // Adatok előkészítése
                    var labels = [];
                    var values = [];
                    
                    // Mivel a data lehet tömb vagy objektum, biztosra megyünk
                    if (Array.isArray(data)) {
                        // Ha a szerver már {labels, values} formátumban küldené, de most nem így van a diagramData-ban
                         // A te diagramData metódusod kulcs-érték párokat ad vissza (pl: {"3": 4, "4": 5})
                         var keys = Object.keys(data);
                         for (var i = 0; i < keys.length; i++) {
                             labels.push(keys[i] + ' csillag');
                             values.push(data[keys[i]]);
                         }
                    } else {
                         var keys = Object.keys(data);
                         for (var i = 0; i < keys.length; i++) {
                             labels.push(keys[i] + ' csillag');
                             values.push(data[keys[i]]);
                         }
                    }

                    var ctx = document.getElementById('besorolasChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Szállodák száma',
                                data: values,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: { beginAtZero: true, ticks: { stepSize: 1 } }
                            }
                        }
                    });
                })
                .catch(function(err) { console.error('Hiba a besorolás diagramnál:', err); });

            // 2. Diagram betöltése: Tavaszi Árak (Vonaldiagram)
            fetch('{{ route('szallodak.diagram.tavasz') }}')
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    // Itt a controller már {labels: [], values: []} formátumot küld
                    var ctx2 = document.getElementById('arChart').getContext('2d');
                    new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: data.labels, // Indulás dátumok
                            datasets: [{
                                label: 'Átlagár (HUF)',
                                data: data.values, // Árak
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.3 // Ettől lesz kicsit hullámos/szép a vonal
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: { beginAtZero: false } // Az áraknál nem kell 0-tól indulni, jobban látszik a változás
                            }
                        }
                    });
                })
                .catch(function(err) { console.error('Hiba az ár diagramnál:', err); });
        });
    </script>
@endpush
@endsection