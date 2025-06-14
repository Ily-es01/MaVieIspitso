@props(['totalEtudiants' => 0, 'totalClasses' => 0, 'totalHeures' => 0])

<?php
  use Carbon\Carbon;
?>
<link rel="stylesheet" href="{{ asset('css/enseignant-style/menu.css') }}">
     <!-- Header for mobile -->
     <header>
        <button class="menu-toggle-button" id="menu-active" aria-label="Open Menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i> MaVieISPITSO
        </div>
        <div class="user-actions">
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
                    <a href="{{ url('/enseignant/annonces') }}" class="nav-item {{ request()->routeIs('enseignant.annonces.index','enseignant.annonces.create','enseignant.annonces.store','enseignant.annonces.edit','enseignant.annonces.update','enseignant.annonces.destroy') ? 'active' : '' }}">
                        <i class="fa-solid fa-bullhorn"></i> Annonces
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> Mon compte
                    </a>
                </li>
            </ul>
        </div>
        <div class="mobile-footer">
            <form style="width: 100%" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fa-solid fa-right-from-bracket"></i> Se déconnecter
                </button>
            </form>

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
                    <a href="{{ url('/enseignant/home') }}" class="desktop-nav-item {{ request()->routeIs('enseignant.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="label">Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/gestion/notes') }}" class="desktop-nav-item {{ request()->routeIs('enseignant.notes.index','enseignant.notes.store','enseignant.notes.update','enseignant.notes.destroy') ? 'active' : '' }}">
                        <i class="fa-solid fa-marker"></i>
                        <span class="label">Notes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/enseignant/emploi') }}" class="desktop-nav-item {{ request()->routeIs('enseignant.emploi') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar"></i>
                        <span class="label">Mon emploi du temps</span>
                    </a>
                </li>
                <li>
                      <a href="{{ url('/enseignant/annonces') }}" class="desktop-nav-item {{ request()->routeIs('enseignant.annonces.index','enseignant.annonces.create','enseignant.annonces.store','enseignant.annonces.edit','enseignant.annonces.update','enseignant.annonces.destroy') ? 'active' : '' }}">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span class="label">Annonces</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('enseignant.profile.edit', ['id' => Auth::user()->id]) }}" class="desktop-nav-item {{ request()->routeIs('enseignant.profile.edit','enseignant.profile.update') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="label">Mon compte</span>
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


    <script src="{{ asset('js/etudiant-js/menus-script.js') }}"></script>
