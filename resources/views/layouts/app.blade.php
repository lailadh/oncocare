<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OncoCare') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap"
        rel="stylesheet"
    >

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="onco-body">

    {{-- ========================================================= --}}
    {{-- NOTIFICATIONS NON LUES --}}
    {{-- ========================================================= --}}
    @auth
        @php
            $unreadNotificationsCount = auth()->user()
                ->notificationsPersonnelles()
                ->where('lu', false)
                ->count();
        @endphp
    @endauth


    <div class="onco-app">

        {{-- ========================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================================================= --}}

        <aside
            id="oncoSidebar"
            class="onco-sidebar"
        >

            {{-- Logo --}}
            <div class="onco-logo-area">

                <a href="{{ route('dashboard') }}" class="onco-logo">
                    <span>Onco</span>
                    <span class="onco-logo-dot">•</span>
                    <span>Care</span>
                </a>

                <p class="onco-sidebar-subtitle">
                    Suivi & accompagnement
                </p>

            </div>


            {{-- User summary --}}
            @auth

                <div class="onco-user-card">

                    <div class="onco-avatar">
                        {{ strtoupper(substr(auth()->user()->prenom ?? 'U', 0, 1)) }}
                    </div>

                    <div class="onco-user-info">

                        <div class="onco-user-name">
                            {{ auth()->user()->prenom }}
                            {{ auth()->user()->nom }}
                        </div>

                        <div class="onco-user-role">

                            @if(auth()->user()->role === 'medecin')
                                Médecin

                            @elseif(auth()->user()->role === 'patient')
                                Patient

                            @elseif(auth()->user()->role === 'proche')
                                Proche

                            @elseif(auth()->user()->role === 'admin')
                                Administrateur

                            @else
                                Utilisateur
                            @endif

                        </div>

                    </div>

                </div>

            @endauth


            {{-- ========================================================= --}}
            {{-- NAVIGATION --}}
            {{-- ========================================================= --}}

            <nav class="onco-nav">

                <div class="onco-nav-title">
                    ESPACE
                </div>


                {{-- ================================================= --}}
                {{-- PATIENT --}}
                {{-- ================================================= --}}

                @auth

                    @if(auth()->user()->role === 'patient')

                        {{-- Dashboard --}}
                        <a
                            href="{{ route('dashboard') }}"
                            class="onco-nav-link {{ request()->routeIs('dashboard') ? 'active patient-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">⌂</span>
                            <span>Tableau de bord</span>
                        </a>


                        {{-- Mes suivis --}}
                        <a
                            href="{{ route('patient.suivis.index') }}"
                            class="onco-nav-link {{ request()->routeIs('patient.suivis.*') ? 'active patient-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">♡</span>
                            <span>Mes suivis</span>
                        </a>


                        {{-- Rendez-vous --}}
                        <a
                            href="{{ route('patient.rendezvous.index') }}"
                            class="onco-nav-link {{ request()->routeIs('patient.rendezvous.*') ? 'active patient-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◷</span>
                            <span>Rendez-vous</span>
                        </a>


                        {{-- Mes proches --}}
                        <a
                            href="{{ route('patient.autorisations.index') }}"
                            class="onco-nav-link {{ request()->routeIs('patient.autorisations.*') ? 'active patient-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◌</span>
                            <span>Mes proches</span>
                        </a>


                        {{-- Notifications --}}
                        <a
                            href="{{ route('notifications.index') }}"
                            class="onco-nav-link {{ request()->routeIs('notifications.*') ? 'active patient-nav' : '' }}"
                        >

                            <span class="onco-nav-icon relative">

                                ◉

                                @if($unreadNotificationsCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 min-w-[18px] h-[18px]
                                               px-1 rounded-full bg-[#C49A5A] text-white
                                               text-[10px] font-bold
                                               flex items-center justify-center
                                               leading-none"
                                    >
                                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                                    </span>
                                @endif

                            </span>

                            <span>Notifications</span>

                        </a>

                    @endif

                @endauth


                {{-- ================================================= --}}
                {{-- MEDECIN --}}
                {{-- ================================================= --}}

                @auth

                    @if(auth()->user()->role === 'medecin')

                        {{-- Dashboard --}}
                        <a
                            href="{{ route('dashboard') }}"
                            class="onco-nav-link {{ request()->routeIs('dashboard') ? 'active medecin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">⌂</span>
                            <span>Tableau de bord</span>
                        </a>


                        {{-- Mes patients --}}
                        <a
                            href="{{ route('medecin.patients.index') }}"
                            class="onco-nav-link {{ request()->routeIs('medecin.patients.*') ? 'active medecin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◌</span>
                            <span>Mes patients</span>
                        </a>


                        {{-- Suivis médicaux --}}
                        <a
                            href="{{ route('suivis.index') }}"
                            class="onco-nav-link {{ request()->routeIs('suivis.*') ? 'active medecin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">♡</span>
                            <span>Suivis médicaux</span>
                        </a>


                        {{-- Rendez-vous --}}
                        <a
                            href="{{ route('rendezvous.index') }}"
                            class="onco-nav-link {{ request()->routeIs('rendezvous.*') ? 'active medecin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◷</span>
                            <span>Rendez-vous</span>
                        </a>


                        {{-- Notifications --}}
                        <a
                            href="{{ route('notifications.index') }}"
                            class="onco-nav-link {{ request()->routeIs('notifications.*') ? 'active medecin-nav' : '' }}"
                        >

                            <span class="onco-nav-icon relative">

                                ◉

                                @if($unreadNotificationsCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 min-w-[18px] h-[18px]
                                               px-1 rounded-full bg-[#C49A5A] text-white
                                               text-[10px] font-bold
                                               flex items-center justify-center
                                               leading-none"
                                    >
                                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                                    </span>
                                @endif

                            </span>

                            <span>Notifications</span>

                        </a>

                    @endif

                @endauth


                {{-- ================================================= --}}
                {{-- PROCHE --}}
                {{-- ================================================= --}}

                @auth

                    @if(auth()->user()->role === 'proche')

                        {{-- Dashboard --}}
                        <a
                            href="{{ route('dashboard') }}"
                            class="onco-nav-link {{ request()->routeIs('dashboard') ? 'active proche-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">⌂</span>
                            <span>Tableau de bord</span>
                        </a>


                        {{-- Mes autorisations --}}
                        <a
                            href="{{ route('proche.autorisations.index') }}"
                            class="onco-nav-link {{ request()->routeIs('proche.autorisations.*') ? 'active proche-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◌</span>
                            <span>Mes autorisations</span>
                        </a>


                        {{-- Suivis accessibles --}}
                        <a
                            href="{{ route('proche.suivis.index') }}"
                            class="onco-nav-link {{ request()->routeIs('proche.suivis.*') ? 'active proche-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">♡</span>
                            <span>Suivis accessibles</span>
                        </a>


                        {{-- Rendez-vous accessibles --}}
                        <a
                            href="{{ route('proche.rendezvous.index') }}"
                            class="onco-nav-link {{ request()->routeIs('proche.rendezvous.*') ? 'active proche-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◷</span>
                            <span>Rendez-vous accessibles</span>
                        </a>


                        {{-- Notifications --}}
                        <a
                            href="{{ route('notifications.index') }}"
                            class="onco-nav-link {{ request()->routeIs('notifications.*') ? 'active proche-nav' : '' }}"
                        >

                            <span class="onco-nav-icon relative">

                                ◉

                                @if($unreadNotificationsCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 min-w-[18px] h-[18px]
                                               px-1 rounded-full bg-[#C49A5A] text-white
                                               text-[10px] font-bold
                                               flex items-center justify-center
                                               leading-none"
                                    >
                                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                                    </span>
                                @endif

                            </span>

                            <span>Notifications</span>

                        </a>

                    @endif

                @endauth


                {{-- ================================================= --}}
                {{-- ADMIN --}}
                {{-- ================================================= --}}

                @auth

                    @if(auth()->user()->role === 'admin')

                        {{-- Dashboard --}}
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="onco-nav-link {{ request()->routeIs('admin.dashboard') ? 'active admin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">⌂</span>
                            <span>Tableau de bord</span>
                        </a>


                        {{-- Utilisateurs --}}
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="onco-nav-link {{ request()->routeIs('admin.users.*') ? 'active admin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◌</span>
                            <span>Utilisateurs</span>
                        </a>


                        {{-- Médecins --}}
                        <a
                            href="{{ route('admin.medecins.index') }}"
                            class="onco-nav-link {{ request()->routeIs('admin.medecins.*') ? 'active admin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">✚</span>
                            <span>Médecins</span>
                        </a>


                        {{-- Patients --}}
                        <a
                            href="{{ route('admin.patients.index') }}"
                            class="onco-nav-link {{ request()->routeIs('admin.patients.*') ? 'active admin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">♡</span>
                            <span>Patients</span>
                        </a>


                        {{-- Proches --}}
                        <a
                            href="{{ route('admin.proches.index') }}"
                            class="onco-nav-link {{ request()->routeIs('admin.proches.*') ? 'active admin-nav' : '' }}"
                        >
                            <span class="onco-nav-icon">◌</span>
                            <span>Proches</span>
                        </a>


                        {{-- Notifications ADMIN --}}
                        <a
                            href="{{ route('notifications.index') }}"
                            class="onco-nav-link {{ request()->routeIs('notifications.*') ? 'active admin-nav' : '' }}"
                        >

                            <span class="onco-nav-icon relative">

                                ◉

                                @if($unreadNotificationsCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 min-w-[18px] h-[18px]
                                               px-1 rounded-full bg-[#C49A5A] text-white
                                               text-[10px] font-bold
                                               flex items-center justify-center
                                               leading-none"
                                    >
                                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                                    </span>
                                @endif

                            </span>

                            <span>Notifications</span>

                        </a>

                    @endif

                @endauth

            </nav>


            {{-- ========================================================= --}}
            {{-- ACCOUNT --}}
            {{-- ========================================================= --}}

            <div class="onco-sidebar-bottom">

                <div class="onco-nav-title">
                    COMPTE
                </div>


                {{-- Profile --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="onco-nav-link {{ request()->routeIs('profile.*') ? 'active account-nav' : '' }}"
                >
                    <span class="onco-nav-icon">◎</span>
                    <span>Mon profil</span>
                </a>


                {{-- Logout --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="onco-logout"
                    >
                        <span class="onco-nav-icon">↪</span>
                        <span>Déconnexion</span>
                    </button>

                </form>


                <div class="onco-disclaimer">
                    Suivi & accompagnement
                    <br>
                    — hors diagnostic médical.
                </div>

            </div>

        </aside>


        {{-- ========================================================= --}}
        {{-- MAIN AREA --}}
        {{-- ========================================================= --}}

        <div class="onco-main">

            {{-- ===================================================== --}}
            {{-- TOPBAR --}}
            {{-- ===================================================== --}}

            <header class="onco-topbar">

                {{-- Mobile --}}
                <div class="onco-mobile-left">

                    <button
                        type="button"
                        onclick="toggleOncoSidebar()"
                        class="onco-mobile-menu"
                        aria-label="Ouvrir le menu"
                    >
                        ☰
                    </button>

                    <a
                        href="{{ route('dashboard') }}"
                        class="onco-mobile-logo"
                    >
                        Onco<span>•</span>Care
                    </a>

                </div>


                {{-- Right --}}
                <div class="onco-topbar-right">

                    {{-- ================================================= --}}
                    {{-- NOTIFICATIONS --}}
                    {{-- ================================================= --}}

                    @auth

                        <a
                            href="{{ route('notifications.index') }}"
                            class="onco-top-icon relative"
                            aria-label="Notifications"
                        >

                            🔔

                            @if($unreadNotificationsCount > 0)

                                <span
                                    class="absolute -top-1 -right-1 min-w-[18px] h-[18px]
                                           px-1 rounded-full bg-[#C49A5A] text-white
                                           text-[10px] font-bold
                                           flex items-center justify-center
                                           leading-none"
                                >
                                    {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                                </span>

                            @endif

                        </a>

                    @endauth


                    {{-- ================================================= --}}
                    {{-- PROFILE --}}
                    {{-- ================================================= --}}

                    @auth

                        <a
                            href="{{ route('profile.edit') }}"
                            class="onco-profile-chip"
                        >

                            <div class="onco-profile-avatar">
                                {{ strtoupper(substr(auth()->user()->prenom ?? 'U', 0, 1)) }}
                            </div>

                            <div class="onco-profile-text">

                                <span class="onco-profile-name">
                                    {{ auth()->user()->prenom }}
                                </span>

                                <span class="onco-profile-role">

                                    @if(auth()->user()->role === 'medecin')
                                        Médecin

                                    @elseif(auth()->user()->role === 'patient')
                                        Patient

                                    @elseif(auth()->user()->role === 'proche')
                                        Proche

                                    @elseif(auth()->user()->role === 'admin')
                                        Administrateur

                                    @endif

                                </span>

                            </div>

                        </a>

                    @endauth

                </div>

            </header>


            {{-- ========================================================= --}}
            {{-- PAGE HEADING --}}
            {{-- ========================================================= --}}

            @isset($header)

                <section class="onco-page-header">

                    <div class="onco-page-header-inner">
                        {{ $header }}
                    </div>

                </section>

            @endisset


            {{-- ========================================================= --}}
            {{-- PAGE CONTENT --}}
            {{-- ========================================================= --}}

            <main class="onco-content">

                {{ $slot }}

            </main>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MOBILE OVERLAY --}}
    {{-- ========================================================= --}}

    <div
        id="oncoOverlay"
        class="onco-overlay"
        onclick="toggleOncoSidebar()"
    >
    </div>


    {{-- ========================================================= --}}
    {{-- MOBILE SIDEBAR SCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        function toggleOncoSidebar() {

            const sidebar = document.getElementById('oncoSidebar');
            const overlay = document.getElementById('oncoOverlay');

            if (!sidebar || !overlay) {
                return;
            }

            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }
    </script>

</body>

</html>