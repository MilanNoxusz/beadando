@extends('layouts.html5up')

@section('title', 'Napfény Tours - Ahol az utazás a lélekhez ér')

@section('content')
<div id="page-wrapper">

	@if(session('status'))
		<div id="flash-status" style="margin:16px auto;max-width:980px;background:#e6ffed;border-left:4px solid #2ecc71;padding:12px 16px;border-radius:4px;color:#064e2d;">
			{{ session('status') }}
		</div>
	@endif

	<header id="header" class="alt">
		<h1><a href="{{ route('home') }}">Napfény Tours</a></h1>
		<nav>
			<a href="#menu">Menü</a>
		</nav>
	</header>

	<nav id="menu">
		<div class="inner">
			<h2>Menü</h2>
			<ul class="links">
				<li><a href="{{ route('home') }}">Főoldal</a></li>
				<li><a href="{{ route('szallodak.index') }}">Ajánlataink</a></li>
				<li><a href="{{ route('szallodak.diagram') }}">Diagram</a></li>

				@if (Auth::check())
					<li><a href="{{ route('messages') }}">Üzenetek</a></li>

					@if (Auth::user()->role == 1)
						<li><a href="{{ route('admin') }}" style="color: red;">ADMINisztráció</a></li>
					@endif

					<li><hr></li>
					<li>
						<form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;">Kijelentkezés ({{ Auth::user()->name }})</button>
                        </form>
                    </li>

				@else
					<li><hr></li>
					<li><a href="{{ route('login') }}">Bejelentkezés</a></li>
					<li><a href="{{ route('register') }}">Regisztráció</a></li>
				@endif

				<li><hr></li>
				<li><a href="#">Rólunk</a></li>
				<li><a href="#">Kapcsolat</a></li>
			</ul>
			<a href="#" class="close">Bezárás</a>
		</div>
	</nav>

	<section id="banner">
		<div class="inner">
			<div class="logo"><span class="icon fa-sun"></span></div>
			<h2>Napfény Tours</h2>
			<p>Ahol az utazás a lélekhez ér. <br /> Prémium élmények, személyre szabott kalandok.</p>
		</div>
	</section>


	<section id="wrapper">

		<section id="one" class="wrapper spotlight style1">
			<div class="inner">
				<a href="#" class="image"><img src="{{ asset('images/pic01.jpg') }}?v={{ file_exists(public_path('images/pic01.jpg')) ? filemtime(public_path('images/pic01.jpg')) : time() }}" alt="Napfényes tengerpart pálmafákkal" /></a>
				<div class="content">
					<h2 class="major">Több mint nyaralás</h2>
					<p>Minket Muskó "Nap" Milán és Sári "fény" Bencének hívnak , és 25 éve az a célunk, hogy fényt csempésszünk az életbe. Nálunk nincsenek dobozos termékek. Mi nem turistákat utaztatunk, hanem felfedezőket kísérünk. Legyen szó spirituális elvonulásról vagy adrenalin-túráról, a "Napfény Garancia" végigkíséri útján.</p>
					<a href="#" class="special">Ismerje meg filozófiánkat</a>
				</div>
			</div>
		</section>

		<section id="two" class="wrapper alt spotlight style2">
			<div class="inner">
				<a href="#" class="image"><img src="{{ asset('images/pic02.jpg') }}?v={{ file_exists(public_path('images/pic02.jpg')) ? filemtime(public_path('images/pic02.jpg')) : time() }}" alt="Luxus villa belső tér" /></a>
				<div class="content">
					<h2 class="major">Signature Collection</h2>
					<p>Azoknak, akik nem ismernek kompromisszumot. Magánrepülős transzferek, villák saját séffel, VIP belépés a világ legzártabb múzeumaiba. A Signature Collection a Napfény Tours legexkluzívabb szolgáltatása, ahol a lehetetlen nem létezik.</p>
					<a href="#" class="special">Luxus utak megtekintése</a>
				</div>
			</div>
		</section>

		<section id="three" class="wrapper spotlight style3">
			<div class="inner">
				<a href="#" class="image"><img src="{{ asset('images/pic03.jpg') }}?v={{ file_exists(public_path('images/pic03.jpg')) ? filemtime(public_path('images/pic03.jpg')) : time() }}" alt="Zöld erdő vagy dzsungel" /></a>
				<div class="content">
					<h2 class="major">Felelős Utazás</h2>
					<p>Hiszünk abban, hogy a világot szebb állapotban kell hagynunk, mint ahogy találtuk. Minden foglalás után fát ültetünk az Amazonas-medencében. Utazzon tiszta lelkiismerettel, és fedezze fel a természetet anélkül, hogy kárt tenne benne.</p>
					<a href="#" class="special">Fenntarthatósági programunk</a>
				</div>
			</div>
		</section>

		<section id="four" class="wrapper alt style1">
			<div class="inner">
				<h2 class="major">Kiemelt Úti Céljaink</h2>
				<p>Válogatás a legnépszerűbb, gondosan összeállított élménycsomagjainkból. Ezek nem csak helyszínek – ezek életérzések.</p>
				<section class="features">
					<article>
						<a href="#" class="image"><img src="{{ asset('images/pic04.jpg') }}?v={{ file_exists(public_path('images/pic04.jpg')) ? filemtime(public_path('images/pic04.jpg')) : time() }}" alt="Bali templom" /></a>
						<h3 class="major">Spirituális Bali</h3>
						<p>14 napos feltöltődés Ubud dzsungeleiben, privát jógaoktatóval és tisztítókúrával. Találjon vissza önmagához.</p>
						<a href="#" class="special">Részletek</a>
					</article>
					<article>
						<a href="#" class="image"><img src="{{ asset('images/pic05.jpg') }}?v={{ file_exists(public_path('images/pic05.jpg')) ? filemtime(public_path('images/pic05.jpg')) : time() }}" alt="Velencei csatorna" /></a>
						<h3 class="major">Velence Rejtett Arca</h3>
						<p>Hosszú hétvége a lagúnák városában, távol a tömegtől. Privát csónaktúra és borkóstoló a tetőteraszokon.</p>
						<a href="#" class="special">Részletek</a>
					</article>
					<article>
						<a href="#" class="image"><img src="{{ asset('images/pic06.jpg') }}" alt="Szafari Kenyában" /></a>
						<h3 class="major">Luxus Szafari</h3>
						<p>Kenya vadregényes tájain, az "öt nagyvad" nyomában. Szállás prémium sátortáborban a szavannán.</p>
						<a href="#" class="special">Részletek</a>
					</article>
					<article>
						<a href="#" class="image"><img src="{{ asset('images/pic07.jpg') }}" alt="Izland sarki fény" /></a>
						<h3 class="major">Izland és a Tűz</h3>
						<p>Vulkántúrák és a sarki fény vadászata. Egy expedíció, ahol a természet elemi ereje dominál.</p>
						<a href="#" class="special">Részletek</a>
					</article>
				</section>
				<ul class="actions">
					<li><a href="#" class="button">Összes ajánlat böngészése</a></li>
				</ul>
			</div>
		</section>

	</section>

	<section id="footer">
		<div class="inner">
			<h2 class="major">Lépjen velünk kapcsolatba</h2>
			@auth
			<p>Üdvözöljük, {{ Auth::user()->name }}! Kérjen egyedi ajánlatot.</p>
			<section id="contact" class="wrapper style1">
			    <div class="inner">
			        <h2 class="major">Üzenet küldése</h2>

			        @if (session('status'))
			            <div class="flash-success">{{ session('status') }}</div>
			        @endif

			        @if ($errors->any())
			            <div class="flash-errors">
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif

			        <div class="contact-card">
			            <form method="POST" action="{{ route('messages.store') }}">
			                @csrf
		
			                <div class="contact-fields">
			                    <label for="body">Üzenet szövege</label>
			                    <textarea name="body" id="body" rows="5" placeholder="Ide írd az üzenetet..." required></textarea>
			                </div>

			                <div class="form-actions">
			                    <button type="submit" class="btn-primary">Küldés</button>
			                    <button type="reset" class="btn-muted">Mégse</button>
			                </div>
			            </form>
			        </div>
		
			    </div>
			</section>
			@endauth

			@guest
				<div class="inner">
					<p>Üzenetküldéshez kérlek <a href="{{ route('login') }}">jelentkezz be</a>.</p>
				</div>
			@endguest
			<ul class="contact"></ul>
		</div>
	</section>

</div>
 