<x-guest-layout>

    <div class="min-h-screen bg-[#F7F4F2] flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-6xl">

            <div class="grid grid-cols-1 lg:grid-cols-2 bg-white rounded-[28px] overflow-hidden shadow-[0_20px_70px_rgba(41,51,49,0.08)] border border-[#E3DDD8]">

                {{-- ===================================================== --}}
                {{-- LEFT SIDE — ONCOCARE BRAND --}}
                {{-- ===================================================== --}}

                <div class="relative hidden lg:flex flex-col justify-between overflow-hidden p-12 bg-gradient-to-br from-[#F6E9EC] via-[#F8F1F2] to-[#F7F4F2]">

                    {{-- Decorative shapes --}}
                    <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full bg-[#D99AA6]/15"></div>

                    <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-full bg-[#7FA68A]/10"></div>

                    <div class="absolute top-1/3 right-10 h-20 w-20 rounded-full bg-[#C7A45B]/10"></div>


                    {{-- Logo --}}
                    <div class="relative z-10">

                        <a
                            href="/"
                            class="inline-flex items-baseline text-3xl font-medium tracking-tight"
                            style="font-family: 'Newsreader', serif;"
                        >
                            <span class="text-[#293331]">Onco</span>
                            <span class="text-[#C7A45B] mx-1">•</span>
                            <span class="text-[#293331]">Care</span>
                        </a>

                        <p class="mt-2 text-sm text-[#66706D]">
                            Suivi & accompagnement
                        </p>

                    </div>


                    {{-- Main message --}}
                    <div class="relative z-10 max-w-md">

                        <div class="inline-flex items-center gap-2 rounded-full bg-white/80 border border-white px-4 py-2 text-xs font-medium text-[#8F6570] shadow-sm">
                            <span class="flex h-2 w-2 rounded-full bg-[#D99AA6]"></span>
                            Un espace pensé pour vous
                        </div>

                        <h1
                            class="mt-6 text-5xl leading-tight font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            Votre suivi,
                            <br>
                            <span class="text-[#D99AA6]">au même endroit.</span>
                        </h1>

                        <p class="mt-6 max-w-sm text-sm leading-7 text-[#66706D]">
                            OncoCare vous accompagne dans l’organisation
                            de votre suivi et de vos rendez-vous, dans un
                            espace pensé pour la confidentialité et la sérénité.
                        </p>


                        {{-- Trust points --}}
                        <div class="mt-8 space-y-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white border border-[#E3DDD8] text-[#7FA68A]">
                                    ✓
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Informations sécurisées
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Accès adapté à chaque rôle
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white border border-[#E3DDD8] text-[#D99AA6]">
                                    ♡
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Accompagnement humain
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Une expérience simple et rassurante
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Disclaimer --}}
                    <div class="relative z-10">

                        <div class="flex items-start gap-3 max-w-md">

                            <div class="mt-0.5 text-[#7567A8]">
                                🔒
                            </div>

                            <p class="text-xs leading-5 text-[#66706D]">
                                OncoCare est une plateforme de suivi et
                                d’accompagnement. Elle ne remplace pas
                                l’avis ou la décision de votre médecin.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- RIGHT SIDE — LOGIN --}}
                {{-- ===================================================== --}}

                <div class="flex items-center justify-center p-7 sm:p-10 lg:p-14">

                    <div class="w-full max-w-md">


                        {{-- Mobile logo --}}
                        <div class="mb-10 text-center lg:hidden">

                            <a
                                href="/"
                                class="inline-flex items-baseline text-3xl font-medium"
                                style="font-family: 'Newsreader', serif;"
                            >
                                <span class="text-[#293331]">Onco</span>
                                <span class="text-[#C7A45B] mx-1">•</span>
                                <span class="text-[#293331]">Care</span>
                            </a>

                            <p class="mt-2 text-xs text-[#66706D]">
                                Suivi & accompagnement
                            </p>

                        </div>


                        {{-- Heading --}}
                        <div class="mb-8">

                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#9A737C]">
                                Espace personnel
                            </p>

                            <h2
                                class="mt-3 text-4xl font-medium leading-tight text-[#293331]"
                                style="font-family: 'Newsreader', serif;"
                            >
                                Bienvenue sur OncoCare
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-[#66706D]">
                                Connectez-vous pour retrouver votre espace
                                de suivi et d’accompagnement.
                            </p>

                        </div>


                        {{-- Session status --}}
                        <x-auth-session-status
                            class="mb-5"
                            :status="session('status')"
                        />


                        {{-- Validation errors --}}
                        @if ($errors->any())

                            <div class="mb-5 rounded-2xl border border-[#EACFD4] bg-[#FBF0F2] p-4">

                                <div class="flex gap-3">

                                    <div class="mt-0.5 text-[#9A5661]">
                                        !
                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-[#7F4C56]">
                                            Vérifiez les informations saisies.
                                        </p>

                                        <ul class="mt-2 space-y-1 text-xs text-[#945864]">

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        @endif


                        {{-- Login form --}}
                        <form
                            method="POST"
                            action="{{ route('login') }}"
                            class="space-y-5"
                        >

                            @csrf


                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block text-sm font-semibold text-[#293331]"
                                >
                                    Email
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="votre@email.com"
                                    class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#D99AA6] focus:bg-white focus:ring-4 focus:ring-[#D99AA6]/10"
                                >

                                <x-input-error
                                    :messages="$errors->get('email')"
                                    class="mt-2"
                                />

                            </div>


                            {{-- Password --}}
                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <label
                                        for="password"
                                        class="block text-sm font-semibold text-[#293331]"
                                    >
                                        Mot de passe
                                    </label>

                                    @if (Route::has('password.request'))

                                        <a
                                            href="{{ route('password.request') }}"
                                            class="text-xs font-medium text-[#7567A8] transition hover:text-[#604F8F]"
                                        >
                                            Mot de passe oublié ?
                                        </a>

                                    @endif

                                </div>


                                <div class="relative">

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Votre mot de passe"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 pr-12 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#D99AA6] focus:bg-white focus:ring-4 focus:ring-[#D99AA6]/10"
                                    >

                                    <button
                                        type="button"
                                        onclick="togglePassword()"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg px-2 py-1 text-xs text-[#66706D] hover:bg-[#F1EEEB]"
                                        aria-label="Afficher le mot de passe"
                                    >
                                        Afficher
                                    </button>

                                </div>

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="mt-2"
                                />

                            </div>


                            {{-- Remember --}}
                            <div class="flex items-center justify-between pt-1">

                                <label
                                    for="remember_me"
                                    class="inline-flex cursor-pointer items-center gap-3"
                                >

                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        name="remember"
                                        class="h-4 w-4 rounded border-[#D8D1CC] text-[#D99AA6] focus:ring-[#D99AA6]"
                                    >

                                    <span class="text-xs text-[#66706D]">
                                        Se souvenir de moi
                                    </span>

                                </label>

                            </div>


                            {{-- Submit --}}
                            <button
                                type="submit"
                                class="mt-2 w-full rounded-xl bg-[#D99AA6] px-5 py-3.5 text-sm font-semibold text-white shadow-[0_8px_20px_rgba(217,154,166,0.22)] transition hover:-translate-y-0.5 hover:bg-[#CC8D9A] focus:outline-none focus:ring-4 focus:ring-[#D99AA6]/20"
                            >
                                Se connecter
                            </button>

                        </form>


                        {{-- Register --}}
                        @if (Route::has('register'))

                            <div class="mt-8 border-t border-[#EEEAE6] pt-7 text-center">

                                <p class="text-sm text-[#66706D]">
                                    Vous n'avez pas encore de compte ?
                                </p>

                                <a
                                    href="{{ route('register') }}"
                                    class="mt-2 inline-flex text-sm font-semibold text-[#7567A8] hover:text-[#604F8F]"
                                >
                                    Créer un compte
                                    <span class="ml-1">→</span>
                                </a>

                            </div>

                        @endif


                        {{-- Small privacy message --}}
                        <div class="mt-8 flex items-center justify-center gap-2 text-center text-[11px] text-[#8B918E]">
                            <span>🔒</span>
                            <span>Vos accès sont protégés selon votre rôle.</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Password visibility --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const button = event.currentTarget;

            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = 'Masquer';
            } else {
                input.type = 'password';
                button.textContent = 'Afficher';
            }
        }
    </script>

</x-guest-layout>