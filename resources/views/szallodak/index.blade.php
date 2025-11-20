@extends('layouts.html5up')

@section('title', 'Ajánlataink')

@section('content')
<div id="page-wrapper">
    <header id="header" class="alt">
        <h1>Ajánlataink</h1>
        <nav>
            <a href="{{ route('home') }}">Vissza a főoldalra</a>
        </nav>
    </header>

    <section class="inner">
        @if($szallodak->isEmpty())
            <p>Nincsenek ajánlatok.</p>
        @else
            <ul class="links">
                @foreach($szallodak as $s)
                    <li>
                        <a href="{{ route('szallodak.show', $s->az) }}">{{ $s->nev }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection
