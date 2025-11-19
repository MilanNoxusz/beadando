@extends('layouts.html5up')

@section('title', 'Üzenetek - Napfény Tours')

@section('content')
<div id="page-wrapper">
    <section class="wrapper">
        <div class="inner">
            <h2 class="major">Üzenetek</h2>
            @if($messages->count())
                <div style="margin-bottom:16px;font-size:0.95rem;color:#555;">Megjelenítve: {{ $messages->total() }} üzenet</div>
                <div style="overflow:auto;">
                    <table style="width:100%;border-collapse:collapse">
                        <thead>
                            <tr style="text-align:left;border-bottom:1px solid #ddd;">
                                <th style="padding:8px">Felhasználó</th>
                                <th style="padding:8px">Mikor</th>
                                <th style="padding:8px">Üzenet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $m)
                                <tr style="border-bottom:1px solid #f1f1f1;vertical-align:top;">
                                    <td style="padding:8px;width:160px">{{ $m->user->name ?? '---' }}</td>
                                    <td style="padding:8px;width:180px">{{ $m->created_at->format('Y-m-d H:i') }}</td>
                                    <td style="padding:8px">{{ $m->body }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="margin-top:12px">{{ $messages->links() }}</div>
            @else
                <p>Nincsenek még üzenetek.</p>
            @endif
        </div>
    </section>
</div>
@endsection