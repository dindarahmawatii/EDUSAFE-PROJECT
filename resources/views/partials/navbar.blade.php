<nav class="navbar">
    <div class="nav-menu-items">
        <a href="{{ url('/') }}" class="nav-link active">Main menu</a>
        <a href="#" class="nav-link">Nilai</a>
        <a href="#" class="nav-link">Evaluasi</a>
        <a href="#" class="nav-link">Rekap</a>

        @auth
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-btn register">Keluar</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-btn login">Masuk</a>
            <a href="{{ route('register') }}" class="nav-btn register">Daftar</a>
        @endauth
    </div>
</nav>