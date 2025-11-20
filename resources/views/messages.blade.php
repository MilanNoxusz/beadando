@extends('layouts.html5up')

@section('title', 'Üzenetek - Napfény Tours')

@section('content')
<div id="page-wrapper">
    <section class="wrapper">
        <div class="inner">
            <h2 class="major">Üzenetek</h2>
            @if($messages->count())
                <div style="margin-bottom:12px;font-size:0.95rem;color:#555;">Megjelenítve: <strong>{{ $messages->total() }}</strong> üzenet</div>

                <div class="messages-list">
                    @foreach($messages as $m)
                        <article class="message-card">
                            <header class="message-meta">
                                <div class="meta-left">
                                    <div class="avatar">{{ strtoupper(substr($m->user->name ?? '---',0,1)) }}</div>
                                    <div>
                                        <div class="name">{{ $m->user->name ?? '---' }}</div>
                                        <div class="time">{{ $m->created_at->format('Y-m-d H:i') }}</div>
                                    </div>
                                </div>
                                <div class="meta-right">
                                    <!-- Sort links preserved as small controls -->
                                    <a class="sort-link" href="{{ request()->fullUrlWithQuery(['sort' => 'user', 'dir' => ($sort === 'user' && $dir === 'asc') ? 'desc' : 'asc']) }}">Felhasználó @if(isset($sort) && $sort === 'user') {!! $dir === 'asc' ? '&uarr;' : '&darr;' !!} @endif</a>
                                </div>
                            </header>
                            <div class="message-body">{{ $m->body }}</div>
                        </article>
                    @endforeach
                </div>

                <div style="margin-top:16px">{{ $messages->links() }}</div>
            @else
                <div class="no-messages">Nincsenek még üzenetek. Légy te az első!</div>
            @endif
        </div>
    </section>
</div>
@endsection