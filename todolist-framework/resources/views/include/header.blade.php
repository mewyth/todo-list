    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('jadwal.index') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/index.php/jadwal' ) {echo 'active';} ?>" aria-current="page" href="{{ route('jadwal.index') }}">Home</a>
                    </li>
                    @if (session()->has('user'))
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('logout') }}">Log Out</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/index.php/login' ) {echo 'active';} ?>" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/index.php/register' ) {echo 'active';} ?>" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                </ul>
                <span class="navbar-text">
                    @if (session()->has('user'))
                        Selamat Datang, {{session('user.name')}}
                    @else
                        Anda Belum Login
                    @endif
                </span>
            </div>
        </div>
    </nav>
