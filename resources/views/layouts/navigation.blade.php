<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm">

```
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex justify-between items-center h-16">

        <!-- Logo -->
        <div class="flex items-center">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-lg">
                    O
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        OncoCare
                    </h1>

                    <p class="text-xs text-slate-500">
                        Suivi oncologique
                    </p>
                </div>

            </a>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex items-center gap-6 ml-10">

                <a href="{{ route('dashboard') }}"
                   class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                    Dashboard
                </a>


                @if(auth()->user()->role === 'medecin')

                    <a href="{{ route('suivis.index') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Suivis
                    </a>

                    <a href="{{ route('rendezvous.index') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Rendez-vous
                    </a>

                @endif


                @if(auth()->user()->role === 'patient')

                    <a href="{{ route('patient.suivis.index') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Mes suivis
                    </a>

                    <a href="{{ route('patient.rendezvous.index') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Mes rendez-vous
                    </a>

                @endif

            </div>

        </div>


        <!-- User -->
        <div class="hidden sm:flex items-center gap-4">

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-semibold">

                    {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}

                </div>

                <div class="text-left">

                    <p class="text-sm font-semibold text-slate-800">

                        {{ auth()->user()->prenom }}
                        {{ auth()->user()->nom }}

                    </p>

                    <p class="text-xs text-slate-500">

                        {{ ucfirst(auth()->user()->role) }}

                    </p>

                </div>

            </a>


            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition">

                    Logout

                </button>

            </form>

        </div>


        <!-- Mobile Button -->
        <div class="flex sm:hidden">

            <button
                @click="open = !open"
                class="p-2 rounded-lg text-slate-600 hover:bg-slate-100">

                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />

                </svg>

            </button>

        </div>

    </div>

</div>


<!-- Mobile Menu -->
<div
    x-show="open"
    class="sm:hidden border-t border-slate-200 bg-white">

    <div class="px-4 py-4 space-y-3">

        <a href="{{ route('dashboard') }}"
           class="block text-slate-700 font-medium">

            Dashboard

        </a>


        @if(auth()->user()->role === 'medecin')

            <a href="{{ route('suivis.index') }}"
               class="block text-slate-700 font-medium">

                Suivis

            </a>

            <a href="{{ route('rendezvous.index') }}"
               class="block text-slate-700 font-medium">

                Rendez-vous

            </a>

        @endif


        @if(auth()->user()->role === 'patient')

            <a href="{{ route('patient.suivis.index') }}"
               class="block text-slate-700 font-medium">

                Mes suivis

            </a>

            <a href="{{ route('patient.rendezvous.index') }}"
               class="block text-slate-700 font-medium">

                Mes rendez-vous

            </a>

        @endif


        <hr>


        <a href="{{ route('profile.edit') }}"
           class="block text-slate-700 font-medium">

            Mon profil

        </a>


        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="text-red-600 font-medium">

                Logout

            </button>

        </form>

    </div>

</div>
```

</nav>
