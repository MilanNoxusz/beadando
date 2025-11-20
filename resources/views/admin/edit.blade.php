@extends('layouts.html5up')

@section('title', 'Út szerkesztése')

@section('content')
<div id="page-wrapper">
    <section class="wrapper">
        <div class="inner">
            <h2 class="major">Út szerkesztése</h2>

            <form method="POST" action="{{ route('admin.update', $tavasz->id) }}">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="szalloda_az">Szálloda</label>
                    <select name="szalloda_az" id="szalloda_az" required>
                        @foreach($szallodak as $szalloda)
                            <option value="{{ $szalloda->az }}" {{ $tavasz->szalloda_az == $szalloda->az ? 'selected' : '' }}>
                                {{ $szalloda->nev }} ({{ $szalloda->az }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="indulas">Indulás dátuma</label>
                    <input type="date" name="indulas" id="indulas" value="{{ $tavasz->indulas }}" required>
                </div>

                <div class="field">
                    <label for="idotartam">Időtartam (nap)</label>
                    <input type="number" name="idotartam" id="idotartam" value="{{ $tavasz->idotartam }}" min="1" required>
                </div>

                <div class="field">
                    <label for="ar">Ár (Ft)</label>
                    <input type="number" name="ar" id="ar" value="{{ $tavasz->ar }}" min="0" required>
                </div>

                <ul class="actions">
                    <li><input type="submit" value="Frissítés" class="primary" /></li>
                    <li><a href="{{ route('admin') }}" class="button">Mégse</a></li>
                </ul>
            </form>
        </div>
    </section>
</div>
@endsection