<x-guest-layout>

    <div class="min-h-screen bg-[#F7F4F2] flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-6xl">

            <div class="grid grid-cols-1 lg:grid-cols-2 bg-white rounded-[28px] overflow-hidden shadow-[0_20px_70px_rgba(41,51,49,0.08)] border border-[#E3DDD8]">

                {{-- ===================================================== --}}
                {{-- LEFT SIDE — BRAND / MESSAGE --}}
                {{-- ===================================================== --}}

                <div class="relative hidden lg:flex flex-col justify-between overflow-hidden p-12 bg-gradient-to-br from-[#F0F6F2] via-[#F6F3F1] to-[#F7F4F2]">

                    {{-- Decorative shapes --}}
                    <div class="absolute -top-20 -right-24 h-72 w-72 rounded-full bg-[#7FA68A]/12"></div>

                    <div class="absolute -bottom-24 -left-20 h-80 w-80 rounded-full bg-[#D99AA6]/10"></div>

                    <div class="absolute top-1/3 left-16 h-24 w-24 rounded-full bg-[#C7A45B]/10"></div>


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

                        <div class="inline-flex items-center gap-2 rounded-full bg-white/80 border border-white px-4 py-2 text-xs font-medium text-[#547460] shadow-sm">
                            <span class="flex h-2 w-2 rounded-full bg-[#7FA68A]"></span>
                            Bienvenue dans OncoCare
                        </div>

                        <h1
                            class="mt-6 text-5xl leading-tight font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            Un espace pensé
                            <br>
                            <span class="text-[#7FA68A]">pour vous accompagner.</span>
                        </h1>

                        <p class="mt-6 max-w-sm text-sm leading-7 text-[#66706D]">
                            Créez votre compte pour accéder à un espace
                            personnel dédié au suivi, aux rendez-vous
                            et à l’accompagnement.
                        </p>


                        {{-- Benefits --}}
                        <div class="mt-8 space-y-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white border border-[#E3DDD8] text-[#7FA68A]">
                                    ✓
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Un espace personnel
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Retrouvez vos informations au même endroit
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white border border-[#E3DDD8] text-[#D99AA6]">
                                    ♡
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Une expérience humaine
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Simple, claire et rassurante
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white border border-[#E3DDD8] text-[#7567A8]">
                                    🔒
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Accès sécurisé
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Vos accès sont protégés selon votre rôle
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Disclaimer --}}
                    <div class="relative z-10">

                        <p class="max-w-md text-xs leading-5 text-[#66706D]">
                            OncoCare est une plateforme de suivi et
                            d’accompagnement. Elle ne remplace pas
                            l’avis ou la décision de votre médecin.
                        </p>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- RIGHT SIDE — REGISTER --}}
                {{-- ===================================================== --}}

                <div class="flex items-center justify-center p-7 sm:p-10 lg:p-12">

                    <div class="w-full max-w-lg">


                        {{-- Mobile logo --}}
                        <div class="mb-8 text-center lg:hidden">

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

                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#6F917B]">
                                Créer votre espace
                            </p>

                            <h2
                                class="mt-3 text-4xl font-medium leading-tight text-[#293331]"
                                style="font-family: 'Newsreader', serif;"
                            >
                                Créez votre compte
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-[#66706D]">
                                Rejoignez OncoCare et retrouvez vos informations
                                importantes dans un seul espace.
                            </p>

                        </div>


                        {{-- Errors --}}
                        @if ($errors->any())

                            <div class="mb-6 rounded-2xl border border-[#EACFD4] bg-[#FBF0F2] p-4">

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


                        {{-- Register form --}}
                        <form
                            method="POST"
                            action="{{ route('register') }}"
                            class="space-y-5"
                        >

                            @csrf


                            {{-- Nom + Prenom --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                {{-- Nom --}}
                                <div>

                                    <label
                                        for="nom"
                                        class="mb-2 block text-sm font-semibold text-[#293331]"
                                    >
                                        Nom
                                    </label>

                                    <input
                                        id="nom"
                                        name="nom"
                                        type="text"
                                        value="{{ old('nom') }}"
                                        required
                                        autofocus
                                        autocomplete="family-name"
                                        placeholder="Votre nom"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7FA68A] focus:bg-white focus:ring-4 focus:ring-[#7FA68A]/10"
                                    >

                                    <x-input-error
                                        :messages="$errors->get('nom')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- Prenom --}}
                                <div>

                                    <label
                                        for="prenom"
                                        class="mb-2 block text-sm font-semibold text-[#293331]"
                                    >
                                        Prénom
                                    </label>

                                    <input
                                        id="prenom"
                                        name="prenom"
                                        type="text"
                                        value="{{ old('prenom') }}"
                                        required
                                        autocomplete="given-name"
                                        placeholder="Votre prénom"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7FA68A] focus:bg-white focus:ring-4 focus:ring-[#7FA68A]/10"
                                    >

                                    <x-input-error
                                        :messages="$errors->get('prenom')"
                                        class="mt-2"
                                    />

                                </div>

                            </div>


                            {{-- Telephone --}}
                            <div>

                                <label
                                    for="telephone"
                                    class="mb-2 block text-sm font-semibold text-[#293331]"
                                >
                                    Téléphone
                                </label>

                                <input
                                    id="telephone"
                                    name="telephone"
                                    type="text"
                                    value="{{ old('telephone') }}"
                                    autocomplete="tel"
                                    placeholder="+212 6 XX XX XX XX"
                                    class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7FA68A] focus:bg-white focus:ring-4 focus:ring-[#7FA68A]/10"
                                >

                                <x-input-error
                                    :messages="$errors->get('telephone')"
                                    class="mt-2"
                                />

                            </div>


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
                                    autocomplete="username"
                                    placeholder="votre@email.com"
                                    class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7FA68A] focus:bg-white focus:ring-4 focus:ring-[#7FA68A]/10"
                                >

                                <x-input-error
                                    :messages="$errors->get('email')"
                                    class="mt-2"
                                />

                            </div>


                            {{-- Password --}}
                            <div>

                                <label
                                    for="password"
                                    class="mb-2 block text-sm font-semibold text-[#293331]"
                                >
                                    Mot de passe
                                </label>

                                <div class="relative">

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Créez votre mot de passe"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 pr-20 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7FA68A] focus:bg-white focus:ring-4 focus:ring-[#7FA68A]/10"
                                    >

                                    <button
                                        type="button"
                                        onclick="toggleRegisterPassword('password', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg px-2 py-1 text-xs text-[#66706D] hover:bg-[#F1EEEB]"
                                    >
                                        Afficher
                                    </button>

                                </div>

                                <p class="mt-2 text-[11px] text-[#8B918E]">
                                    Utilisez un mot de passe suffisamment sécurisé.
                                </p>

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="mt-2"
                                />

                            </div>


                            {{-- Confirm password --}}
                            <div>

                                <label
                                    for="password_confirmation"
                                    class="mb-2 block text-sm font-semibold text-[#293331]"
                                >
                                    Confirmer le mot de passe
                                </label>

                                <div class="relative">

                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Confirmez votre mot de passe"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 pr-20 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7FA68A] focus:bg-white focus:ring-4 focus:ring-[#7FA68A]/10"
                                    >

                                    <button
                                        type="button"
                                        onclick="toggleRegisterPassword('password_confirmation', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg px-2 py-1 text-xs text-[#66706D] hover:bg-[#F1EEEB]"
                                    >
                                        Afficher
                                    </button>

                                </div>

                                <x-input-error
                                    :messages="$errors->get('password_confirmation')"
                                    class="mt-2"
                                />

                            </div>


                            {{-- Privacy box --}}
                            <div class="rounded-2xl border border-[#D7E6DB] bg-[#F1F7F2] p-4">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-white text-[#7FA68A] border border-[#DCE9DF]">
                                        🔒
                                    </div>

                                    <div>

                                        <p class="text-xs font-semibold text-[#41644B]">
                                            Votre confidentialité compte
                                        </p>

                                        <p class="mt-1 text-[11px] leading-5 text-[#607467]">
                                            Votre accès aux informations de la plateforme
                                            dépendra de votre rôle et de vos autorisations.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">

                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex min-h-[44px] items-center justify-center rounded-xl border border-[#E3DDD8] bg-white px-5 py-3 text-sm font-semibold text-[#293331] transition hover:border-[#CBC2BC] hover:bg-[#FCFBFA]"
                                >
                                    Déjà inscrit ?
                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex min-h-[44px] flex-1 items-center justify-center rounded-xl bg-[#7FA68A] px-6 py-3 text-sm font-semibold text-white shadow-[0_8px_20px_rgba(127,166,138,0.20)] transition hover:-translate-y-0.5 hover:bg-[#6F987B] focus:outline-none focus:ring-4 focus:ring-[#7FA68A]/20 sm:flex-none"
                                >
                                    Créer mon compte
                                    <span class="ml-2">→</span>
                                </button>

                            </div>

                        </form>


                        {{-- Footer --}}
                        <div class="mt-8 text-center text-[11px] text-[#8B918E]">
                            En créant votre compte, vous utilisez un espace
                            destiné au suivi et à l’accompagnement.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        function toggleRegisterPassword(id, button) {
            const input = document.getElementById(id);

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