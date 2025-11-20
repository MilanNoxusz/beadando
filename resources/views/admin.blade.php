@extends('layouts.html5up')

@section('title', 'Adminisztráció - Tavaszi utak')

@section('content')
<div id="page-wrapper">
    <section class="wrapper">
        <div class="inner">
            <header class="major">
                <h2>Adminisztráció - Tavaszi utak kezelése</h2>
            </header>

            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="margin-bottom: 20px;">
                <a href="{{ route('admin.create') }}" class="button primary small">Új út hozzáadása</a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Szálloda</th>
                            <th>Indulás</th>
                            <th>Időtartam (nap)</th>
                            <th>Ár (Ft)</th>
                            <th>Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tavaszok as $tavasz)
                        <tr>
                            <td>{{ $tavasz->id }}</td>
                            <td>
                                {{ $tavasz->szalloda ? $tavasz->szalloda->nev : $tavasz->szalloda_az }}
                            </td>
                            <td>{{ $tavasz->indulas }}</td>
                            <td>{{ $tavasz->idotartam }}</td>
                            <td>{{ number_format($tavasz->ar, 0, ',', ' ') }} Ft</td>
                            <td>
                                <a href="{{ route('admin.edit', $tavasz->id) }}" class="button small">Szerkesztés</a>
                                
                                <form action="{{ route('admin.destroy', $tavasz->id) }}" method="POST" style="display:inline-block; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button small primary" onclick="return confirm('Biztosan törölni szeretnéd?')">Törlés</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection