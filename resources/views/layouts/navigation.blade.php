<nav class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="text-xl font-bold text-pink-600">
                    OncoCare
                </a>
            </div>

            <!-- User -->
            <div class="flex items-center gap-4">

                <span class="text-sm text-slate-600">
                    {{ auth()->user()->prenom }}
                </span>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-red-500 text-white text-sm font-medium hover:bg-red-600 transition"
                    >
                        Déconnexion
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>