     <link rel="stylesheet" href="{{ asset('css/etudiant-style/menu-style.css') }}">
     <!-- Header for mobile -->
     <header>
        <button class="menu-toggle-button" id="menu-active" aria-label="Open Menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i> MaVieISPITSO
        </div>
        <div class="user-actions">
            <button class="icon-button" aria-label="Notifications" style="position: relative;">
                <i class="fa-solid fa-bell"></i>
                <span class="badge-notification">3</span>
            </button>
            <button class="icon-button" aria-label="User Profile">
                <i class="fa-solid fa-user"></i>
            </button>
        </div>
    </header>

    <!-- Overlay for mobile menu -->
    <div class="overlay" id="overlay"></div>

    <!-- Mobile Navigation -->
    <nav class="mobile-menu" id="mobilenav" aria-label="Mobile Navigation">
        <div class="mobile-menu-header">
            <div class="mobile-logo">
                <i class="fa-solid fa-graduation-cap"></i> MaVieISPITSO
            </div>
            <button class="button-close" id="close-menu" aria-label="Close Menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="mobile-menu-content">
            <ul>
                <li>
                    <a href="{{ url('/home') }}" class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i> Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ url('/notes') }}" class="nav-item {{ request()->routeIs('notes') ? 'active' : '' }}">
                        <i class="fa-solid fa-marker"></i> Mes Notes
                    </a>
                </li>
                <li>
                    <a href="{{ url('/emploiDuTemps') }}" class="nav-item {{ request()->routeIs('emploi') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar"></i> Mon emploi du temps
                    </a>
                </li>
                <li>
                    <a href="{{ url('/annonces') }}" class="nav-item {{ request()->routeIs('annonce') ? 'active' : '' }}">
                        <i class="fa-solid fa-bullhorn"></i> Annonces
                    </a>
                </li>
                <li>
                    <a href="{{ url('/profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> Mon compte
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-bell"></i> Mes notifications
                        <span class="badge badge-primary" style="margin-left: auto;">3</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mobile-footer">
            <button class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i> Se déconnecter
            </button>
        </div>
    </nav>

    <!-- Desktop Navigation -->
    <nav class="desktop-menu" id="desktop-nav" aria-label="Desktop Navigation">
        <div class="desktop-logo">
            <i class="fa-solid fa-graduation-cap"></i> <span>MaVieISPITSO</span>
        </div>
        <div class="desktop-menu-content">
            <ul>
                <li>
                    <a href="{{ url('/home') }}" class="desktop-nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="label">Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/notes') }}" class="desktop-nav-item {{ request()->routeIs('notes') ? 'active' : '' }}">
                        <i class="fa-solid fa-marker"></i>
                        <span class="label">Mes Notes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/emploiDuTemps') }}" class="desktop-nav-item {{ request()->routeIs('emploi') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar"></i>
                        <span class="label">Mon emploi du temps</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/annonces') }}" class="desktop-nav-item {{ request()->routeIs('annonce') ? 'active' : '' }}">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span class="label">Annonces</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/profile') }}" class="desktop-nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="label">Mon compte</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="desktop-nav-item" style="position: relative;">
                        <i class="fa-solid fa-bell"></i>
                        <span class="label">Mes notifications</span>
                        <span class="badge badge-primary" style="margin-left: auto;">3</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="desktop-footer">
          
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a style="text-decoration: none;" class="desktop-logout-button" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>{{ __('Se deconnecter') }}</span>
                </a>
            </form>
        </div>
    </nav>
     <main>
        <div class="name-displayer">
            <h1>Bonjour, Ilyes Amrani</h1> 
            <p>Lundi 01 janvier 2025</p>
        </div>
    </main>

    <script src="{{ asset('js/etudiant-js/menus-script.js') }}"></script>
