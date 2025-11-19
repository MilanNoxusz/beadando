<!DOCTYPE HTML>
<html>
	<head>
		<title>Napfény Tours - Ahol az utazás a lélekhez ér</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<div id="page-wrapper">

				<header id="header" class="alt">
						<h1><a href="index.html">Napfény Tours</a></h1>
						<nav>
							<a href="#menu">Menü</a>
						</nav>
					</header>

				<nav id="menu">
    <div class="inner">
        <h2>Menü</h2>
        <ul class="links">
            <li><a href="{{ route('home') }}">Kezdőlap</a></li>
            <li><a href="#">Ajánlataink</a></li>
            <li><a href="#">Signature Collection</a></li>

            @if (Auth::check()) 
                <li><a href="{{ route('messages') }}">Üzenetek</a></li>

                @if (Auth::user()->role == 1)
                    <li><a href="{{ route('admin') }}" style="color: red;">ADMINisztráció</a></li>
                @endif

                <li><hr></li> <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            Kijelentkezés ({{ Auth::user()->name }})
                        </a>
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
									<a href="#" class="image"><img src="images/pic01.jpg" alt="Napfényes tengerpart pálmafákkal" /></a>
									<div class="content">
										<h2 class="major">Több mint nyaralás</h2>
										<p>Minket Muskó "Nap" Milán és Sári "fény" Bencének hívnak , és 25 éve az a célunk, hogy fényt csempésszünk az életbe. Nálunk nincsenek dobozos termékek. Mi nem turistákat utaztatunk, hanem felfedezőket kísérünk. Legyen szó spirituális elvonulásról vagy adrenalin-túráról, a "Napfény Garancia" végigkíséri útján.</p>
										<a href="#" class="special">Ismerje meg filozófiánkat</a>
									</div>
								</div>
							</section>

						<section id="two" class="wrapper alt spotlight style2">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic02.jpg" alt="Luxus villa belső tér" /></a>
									<div class="content">
										<h2 class="major">Signature Collection</h2>
										<p>Azoknak, akik nem ismernek kompromisszumot. Magánrepülős transzferek, villák saját séffel, VIP belépés a világ legzártabb múzeumaiba. A Signature Collection a Napfény Tours legexkluzívabb szolgáltatása, ahol a lehetetlen nem létezik.</p>
										<a href="#" class="special">Luxus utak megtekintése</a>
									</div>
								</div>
							</section>

						<section id="three" class="wrapper spotlight style3">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic03.jpg" alt="Zöld erdő vagy dzsungel" /></a>
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
											<a href="#" class="image"><img src="images/pic04.jpg" alt="Bali templom" /></a>
											<h3 class="major">Spirituális Bali</h3>
											<p>14 napos feltöltődés Ubud dzsungeleiben, privát jógaoktatóval és tisztítókúrával. Találjon vissza önmagához.</p>
											<a href="#" class="special">Részletek</a>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic05.jpg" alt="Velencei csatorna" /></a>
											<h3 class="major">Velence Rejtett Arca</h3>
											<p>Hosszú hétvége a lagúnák városában, távol a tömegtől. Privát csónaktúra és borkóstoló a tetőteraszokon.</p>
											<a href="#" class="special">Részletek</a>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic06.jpg" alt="Szafari Kenyában" /></a>
											<h3 class="major">Luxus Szafari</h3>
											<p>Kenya vadregényes tájain, az "öt nagyvad" nyomában. Szállás prémium sátortáborban a szavannán.</p>
											<a href="#" class="special">Részletek</a>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic07.jpg" alt="Izland sarki fény" /></a>
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
            <form method="post" action="#">
                @csrf <div class="fields">
                    <div class="field">
                        <label for="name">Név</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" readonly />
                    </div>
                    <div class="field">
                        <label for="email">Email cím</label>
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" readonly />
                    </div>
                    <div class="field">
                        <label for="message">Üzenet / Álom úti cél</label>
                        <textarea name="message" id="message" rows="4"></textarea>
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Üzenet küldése" /></li>
                </ul>
            </form>
        @else
            <p>Kérjük, <a href="{{ route('login') }}">jelentkezzen be</a> az üzenetküldéshez!</p>
        @endauth

        <ul class="contact">
            </ul>
    </div>
</section>

			</div>

		<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>