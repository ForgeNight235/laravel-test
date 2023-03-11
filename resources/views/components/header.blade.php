<!-- Header -->
<header id="header">
    <h1><a href="/">Future Imperfect</a></h1>
    <nav class="links">
        <ul>
            <li><a href="#">Главная</a></li>
            @guest()
                <li><a href="/signup">Регистрация</a></li>
                <li><a href="/signin">Авторизация</a></li>
            @endguest

            @auth()
                <li><a href="#">{{ \Illuminate\Support\Facades\Auth::user()->username }}</a></li>
                <li><a href="{{ route('auth.logout') }}">Выход</a></li>
            @endauth
        </ul>
    </nav>
    <nav class="main">
        <ul>
            <li class="search">
                <a class="fa-search" href="#search">Search</a>
                <form id="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </li>
            <li class="menu">
                <a class="fa-bars" href="#menu">Menu</a>
            </li>
        </ul>
    </nav>
</header>
