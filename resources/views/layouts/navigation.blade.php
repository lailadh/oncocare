<nav x-data="{ open: false }">

    {{-- SIDEBAR --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 hidden w-[236px] flex-col bg-[#16302B] text-[#F7F5EC] lg:flex"
    >

        {{-- Logo --}}
        <div class="flex h-20 items-center px-7">
            <a href="{{ route('dashboard') }}"
               class="font-serif text-2xl tracking-tight text-[#F7F5EC]">
                Onco<span class="text-[#B8863E]">•</span>Care
            </a>
        </div>

        {{-- Navigation --}}
        <div class="flex-1 px-4">

            {{-- Espace --}}
            <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#9DB0A7]">
                Espace
            </p>

            <div class="space-y-1">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition
                   {{ request()->routeIs('dashboard')
                        ? 'bg-[#1F433C] text-[#F7F5EC]'
                        : 'text-[#C9D4CE] hover:bg-[#1F433C] hover:text-white' }}">
                    <span class="text-base">⌂</span>
                    <span>Tableau de bord</span>
                </a>

                {{-- Médecin --}}
                @if(auth()->user()->role === 'medecin')

                    <a href="{{ route('suivis.index') }}"
                       class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition
                       {{ request()->routeIs('suivis.*')
                            ? 'bg-[#1F433C] text-[#F7F5EC]'
                            : 'text-[#C9D4CE] hover:bg-[#1F433C] hover:text-white' }}">
                        <span class="text-base">◫</span>
                        <span>Suivi médical</span>
                    </a>

                    <a href="{{ route('rendezvous.index') }}"
                       class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition
                       {{ request()->routeIs('rendezvous.*')
                            ? 'bg-[#1F433C] text-[#F7F5EC]'
                            : 'text-[#C9D4CE] hover:bg-[#1F433C] hover:text-white' }}">
                        <span class="text-base">□</span>
                        <span>Rendez-vous</span>
                    </a>

                @endif

                {{-- Patient --}}
                @if(auth()->user()->role === 'patient')

                    <a href="{{ route('patient.suivis.index') }}"
                       class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition
                       {{ request()->routeIs('patient.suivis.*')
                            ? 'bg-[#1F433C] text-[#F7F5EC]'
                            : 'text-[#C9D4CE] hover:bg-[#1F433C] hover:text-white' }}">
                        <span class="text-base">◫</span>
                        <span>Mes suivis</span>
                    </a>

                    <a href="{{ route('patient.rendezvous.index') }}"
                       class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition
                       {{ request()->routeIs('patient.rendezvous.*')
                            ? 'bg-[#1F433C] text-[#F7F5EC]'
                            : 'text-[#C9D4CE] hover:bg-[#1F433C] hover:text-white' }}">
                        <span class="text-base">□</span>
                        <span>Mes rendez-vous</span>
                    </a>

                @endif

            </div>

            {{-- Compte --}}
            <p class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#9DB0A7]">
                Compte
            </p>

            <div class="space-y-1">

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition
                   {{ request()->routeIs('profile.*')
                        ? 'bg-[#1F433C] text-[#F7F5EC]'
                        : 'text-[#C9D4CE] hover:bg-[#1F433C] hover:text-white' }}">
                    <span class="text-base">○</span>
                    <span>Profil</span>
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] transition hover:bg-[#1F433C] hover:text-white">
                        <span class="text-base">↪</span>
                        <span>Déconnexion</span>
                    </button>
                </form>

            </div>

        </div>

        {{-- Footer --}}
        <div class="border-t border-[#315047] px-7 py-5">
            <p class="text-xs leading-5 text-[#9DB0A7]">
                Suivi & accompagnement
                <br>
                <span class="text-[#6E8F76]">
                    — hors diagnostic médical.
                </span>
            </p>
        </div>

    </aside>


    {{-- MOBILE SIDEBAR --}}
    <div
        x-show="open"
        class="fixed inset-0 z-40 bg-black/40 lg:hidden"
        @click="open = false"
        x-cloak
    ></div>

    <aside
        x-show="open"
        class="fixed inset-y-0 left-0 z-50 flex w-[236px] flex-col bg-[#16302B] text-[#F7F5EC] lg:hidden"
        x-cloak
    >

        <div class="flex h-20 items-center justify-between px-7">
            <span class="font-serif text-2xl">
                Onco<span class="text-[#B8863E]">•</span>Care
            </span>

            <button @click="open = false"
                    class="text-xl text-[#C9D4CE]">
                ×
            </button>
        </div>

        <div class="flex-1 px-4">

            <a href="{{ route('dashboard') }}"
               class="mb-1 flex items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] hover:bg-[#1F433C]">
                <span>⌂</span>
                Tableau de bord
            </a>

            @if(auth()->user()->role === 'medecin')

                <a href="{{ route('suivis.index') }}"
                   class="mb-1 flex items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] hover:bg-[#1F433C]">
                    <span>◫</span>
                    Suivi médical
                </a>

                <a href="{{ route('rendezvous.index') }}"
                   class="mb-1 flex items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] hover:bg-[#1F433C]">
                    <span>□</span>
                    Rendez-vous
                </a>

            @endif

            @if(auth()->user()->role === 'patient')

                <a href="{{ route('patient.suivis.index') }}"
                   class="mb-1 flex items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] hover:bg-[#1F433C]">
                    <span>◫</span>
                    Mes suivis
                </a>

                <a href="{{ route('patient.rendezvous.index') }}"
                   class="mb-1 flex items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] hover:bg-[#1F433C]">
                    <span>□</span>
                    Mes rendez-vous
                </a>

            @endif

            <a href="{{ route('profile.edit') }}"
               class="mt-6 flex items-center gap-3 rounded-md px-3 py-2.5 text-sm text-[#C9D4CE] hover:bg-[#1F433C]">
                <span>○</span>
                Profil
            </a>

        </div>

    </aside>


    {{-- TOPBAR --}}
    <header class="fixed right-0 top-0 z-30 hidden h-20 items-center justify-between border-b border-[#DAD5C4] bg-[#F7F5EC] px-8 lg:left-[236px] lg:flex">

        <div>
            <p class="text-xs uppercase tracking-[0.15em] text-[#6E6B61]">
                Espace {{ auth()->user()->role === 'medecin' ? 'Médecin' : 'Patient' }}
            </p>
        </div>

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#D9E3D6] text-sm font-semibold text-[#16302B]">
                {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
            </div>

            <div class="leading-tight">
                <p class="text-sm font-semibold text-[#262420]">
                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                </p>

                <p class="text-xs text-[#5B5A52]">
                    {{ ucfirst(auth()->user()->role) }}
                </p>
            </div>

        </div>

    </header>


    {{-- MOBILE TOPBAR --}}
    <header class="fixed left-0 right-0 top-0 z-30 flex h-16 items-center justify-between border-b border-[#DAD5C4] bg-[#F7F5EC] px-5 lg:hidden">

        <button @click="open = true"
                class="text-2xl text-[#16302B]">
            ☰
        </button>

        <span class="font-serif text-xl text-[#16302B]">
            Onco<span class="text-[#B8863E]">•</span>Care
        </span>

        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#D9E3D6] text-xs font-semibold text-[#16302B]">
            {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
        </div>

    </header>

</nav>