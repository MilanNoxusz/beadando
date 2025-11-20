@extends('layouts.html5up')

@section('title', 'Diagram — Ajánlataink')

@section('content')
<div id="page-wrapper">
    <header id="header" class="alt">
        <h1>Diagram</h1>
        <nav>
            <a href="{{ route('home') }}">Vissza a főoldalra</a>
        </nav>
    </header>

    <section class="inner">
        <p>Az alábbi diagram a `szallodak` tábla besorolás szerinti megoszlását mutatja.</p>
        <canvas id="diagramCanvas" width="800" height="400"></canvas>
        <pre id="diagram-debug" style="background:#f7f7f7;border:1px solid #ddd;padding:10px;margin-top:12px;white-space:pre-wrap;"></pre>
    </section>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function () {
            function renderChart(labels, values) {
                var ctx = document.getElementById('diagramCanvas').getContext('2d');
                if (window._szChart) {
                    try { window._szChart.destroy(); } catch (e) { }
                }
                window._szChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Szállodák száma (besorolás)',
                            data: values,
                            backgroundColor: labels.map((_,i) => 'rgba(54,162,235,0.5)'),
                            borderColor: labels.map((_,i) => 'rgba(54,162,235,1)'),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }

            // fetch data and render on load (with debug output)
            document.addEventListener('DOMContentLoaded', function () {
                var debug = document.getElementById('diagram-debug');
                function dbg(msg){ try{ if(debug) debug.textContent += msg + '\n'; console.log(msg);}catch(e){}
                }

                dbg('Starting diagram data fetch...');

                fetch('{{ route('szallodak.diagram.data') }}')
                    .then(function (res) {
                        dbg('HTTP status: ' + res.status + ' ' + res.statusText);
                        if (!res.ok) throw new Error('HTTP error ' + res.status);
                        return res.json();
                    })
                    .then(function (data) {
                        dbg('Received data: ' + JSON.stringify(data));

                        if (typeof Chart === 'undefined') {
                            dbg('Chart.js is not loaded (Chart is undefined).');
                            return;
                        }

                        var labels = Object.keys(data || {});
                        var values = labels.map(function (k) { return data[k]; });

                        dbg('Labels: ' + JSON.stringify(labels));
                        dbg('Values: ' + JSON.stringify(values));

                        renderChart(labels, values);
                    })
                    .catch(function (err) {
                        dbg('Error fetching or rendering diagram: ' + (err && err.message ? err.message : err));
                        console.error('Diagram adat lekérési hiba', err);
                    });
            });
        })();
    </script>
@endpush

@endsection
