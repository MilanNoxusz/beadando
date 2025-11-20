@extends('layouts.html5up')

@section('title', $szalloda->nev ?? 'Ajánlat részletei')

@section('content')
<div id="page-wrapper">
    <header id="header" class="alt">
        <h1>{{ $szalloda->nev ?? 'Részletek' }}</h1>
        <nav>
            <a href="{{ route('szallodak.index') }}">Vissza az ajánlatokhoz</a>
        </nav>
    </header>

    <section class="inner">
        <ul class="details">
            <li><strong>Azonosító:</strong> {{ $szalloda->az }}</li>
            <li><strong>Név:</strong> {{ $szalloda->nev }}</li>
            <li><strong>Besorolás:</strong> {{ $szalloda->besorolas ?? '-' }}</li>
            <li><strong>Helység az:</strong> {{ $szalloda->helyseg_az ?? '-' }}</li>
            <li><strong>Félpanzió:</strong> {{ $szalloda->felpanzio ? 'Igen' : 'Nem' }}</li>
        </ul>

        <pre>{{ json_encode($szalloda->toArray(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
    </section>
</div>
@endsection
