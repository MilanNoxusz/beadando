@extends('layouts.html5up')

@section('title', 'Új út felvétele')

@section('content')
<div id="page-wrapper">
    <section class="wrapper">
        <div class="inner">
            <h2 class="major">Új tavaszi út felvétele</h2>

            <form method="POST" action="{{ route('admin.store') }}">
                @csrf

                <div class="field">
                    <label for="szalloda_az">Szálloda</label>
                    <select name="szalloda_az" id="szalloda_az" required>
                        <option value="">-- Válassz szállodát --</option>
                        @foreach($szallodak as $szalloda)
                            <option value="{{ $szalloda->az }}">{{ $szalloda->nev }} ({{ $szalloda->az }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="indulas">Indulás dátuma</label>
                    <input type="date" name="indulas" id="indulas" required>
                </div>

                <div class="field">
                    <label for="idotartam">Időtartam (nap)</label>
                    <input type="number" name="idotartam" id="idotartam" min="1" required>
                </div>

                <div class="field">
                    <label for="ar">Ár (Ft)</label>
                    <input type="number" name="ar" id="ar" min="0" required>
                </div>

                <ul class="actions">
                    <li><input type="submit" value="Mentés" class="primary" /></li>
                    <li><a href="{{ route('admin') }}" class="button">Mégse</a></li>
                </ul>
            </form>
        </div>
    </section>
</div>
@endsection