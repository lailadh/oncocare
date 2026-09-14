<x-guest-layout>

    <div class="min-h-screen bg-[#F7F4F2] flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-6xl">

            <div class="grid grid-cols-1 lg:grid-cols-2 bg-white rounded-[28px] overflow-hidden shadow-[0_20px_70px_rgba(41,51,49,0.08)] border border-[#E3DDD8]">

                {{-- ============================================== --}}
                {{-- LEFT SIDE --}}
                {{-- ============================================== --}}

                <div class="relative hidden lg:flex flex-col justify-between overflow-hidden p-12 bg-gradient-to-br from-[#F4EFF5] via-[#F8F4F5] to-[#F7F4F2]">

                    {{-- Decorative shapes --}}
                    <div class="absolute -top-24 -right-20 h-80 w-80 rounded-full bg-[#7567A8]/10"></div>

                    <div class="absolute -bottom-24 -left-20 h-80 w-80 rounded-full bg-[#7FA68A]/10"></div>

                    <div class="absolute top-1/3 left-20 h-24 w-24 rounded-full bg-[#C7A45B]/10"></div>


                    {{-- Logo --}}
                    <div class="relative z-10">

                        <a
                            href="/"
                            class="inline-flex items-baseline text-3xl font-medium tracking-tight"
                            style="font-family: 'Newsreader', serif;"
                        >
                            <span class="text-[#293331]">Onco</span>
                            <span class="mx-1 text-[#C7A45B]">•</span>
                            <span class="text-[#293331]">Care</span>
                        </a>

                        <p class="mt-2 text-sm text-[#66706D]">
                            Suivi & accompagnement
                        </p>

                    </div>


                    {{-- Main message --}}
                    <div class="relative z-10 max-w-md">

                        <div class="inline-flex items-center gap-2 rounded-full border border-white bg-white/80 px-4 py-2 text-xs font-medium text-[#655A88] shadow-sm">

                            <span class="h-2 w-2 rounded-full bg-[#7567A8]"></span>

                            Sécurité du compte

                        </div>


                        <h1
                            class="mt-6 text-5xl font-medium leading-tight text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            Choisissez un nouveau
                            <br>
                            <span class="text-[#7567A8]">
                                mot de passe sécurisé.
                            </span>
                        </h1>


                        <p class="mt-6 max-w-sm text-sm leading-7 text-[#66706D]">
                            Votre mot de passe protège l’accès à votre
                            espace personnel OncoCare. Choisissez une
                            combinaison suffisamment sécurisée et facile
                            à mémoriser.
                        </p>


                        {{-- Security points --}}
                        <div class="mt-8 space-y-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#E3DDD8] bg-white text-[#7567A8]">
                                    🔒
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Compte protégé
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Votre nouveau mot de passe sécurise votre accès
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#E3DDD8] bg-white text-[#7FA68A]">
                                    ✓
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#293331]">
                                        Contrôle de votre accès
                                    </p>

                                    <p class="text-xs text-[#66706D]">
                                        Vous seul choisissez votre nouveau mot de passe
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


                {{-- ============================================== --}}
                {{-- RIGHT SIDE --}}
                {{-- ============================================== --}}

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
                                <span class="mx-1 text-[#C7A45B]">•</span>
                                <span class="text-[#293331]">Care</span>
                            </a>

                            <p class="mt-2 text-xs text-[#66706D]">
                                Suivi & accompagnement
                            </p>

                        </div>


                        {{-- Heading --}}
                        <div class="mb-8">

                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#7567A8]">
                                Nouveau mot de passe
                            </p>

                            <h2
                                class="mt-3 text-4xl font-medium leading-tight text-[#293331]"
                                style="font-family: 'Newsreader', serif;"
                            >
                                Réinitialiser votre mot de passe
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-[#66706D]">
                                Définissez un nouveau mot de passe pour
                                sécuriser l’accès à votre compte OncoCare.
                            </p>

                        </div>


                        {{-- Errors --}}
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


                        {{-- Form --}}
                        <form
                            method="POST"
                            action="{{ route('password.store') }}"
                            class="space-y-5"
                        >

                            @csrf


                            {{-- Password reset token --}}
                            <input
                                type="hidden"
                                name="token"
                                value="{{ $request->route('token') }}"
                            >


                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block text-sm font-semibold text-[#293331]"
                                >
                                    Adresse e-mail
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email', $request->email) }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="votre@email.com"
                                    class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7567A8] focus:bg-white focus:ring-4 focus:ring-[#7567A8]/10"
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
                                    Nouveau mot de passe
                                </label>

                                <div class="relative">

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Nouveau mot de passe"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 pr-20 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7567A8] focus:bg-white focus:ring-4 focus:ring-[#7567A8]/10"
                                    >

                                    <button
                                        type="button"
                                        onclick="toggleResetPassword('password', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg px-2 py-1 text-xs text-[#66706D] hover:bg-[#F1EEEB]"
                                    >
                                        Afficher
                                    </button>

                                </div>

                                <p class="mt-2 text-[11px] leading-5 text-[#8B918E]">
                                    Choisissez un mot de passe suffisamment sécurisé.
                                </p>

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="mt-2"
                                />

                            </div>


                            {{-- Confirm --}}
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
                                        placeholder="Confirmer le mot de passe"
                                        class="w-full rounded-xl border border-[#E3DDD8] bg-[#FCFBFA] px-4 py-3.5 pr-20 text-sm text-[#293331] placeholder-[#A3A6A3] outline-none transition focus:border-[#7567A8] focus:bg-white focus:ring-4 focus:ring-[#7567A8]/10"
                                    >

                                    <button
                                        type="button"
                                        onclick="toggleResetPassword('password_confirmation', this)"
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


                            {{-- Security info --}}
                            <div class="rounded-2xl border border-[#DED9EB] bg-[#F5F2FA] p-4">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl border border-[#E5E0F0] bg-white text-[#7567A8]">
                                        🔐
                                    </div>

                                    <div>

                                        <p class="text-xs font-semibold text-[#655A88]">
                                            Sécurité du compte
                                        </p>

                                        <p class="mt-1 text-[11px] leading-5 text-[#716A82]">
                                            Après la modification, utilisez votre
                                            nouveau mot de passe pour vous connecter
                                            à OncoCare.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Submit --}}
                            <button
                                type="submit"
                                class="w-full rounded-xl bg-[#7567A8] px-5 py-3.5 text-sm font-semibold text-white shadow-[0_8px_20px_rgba(117,103,168,0.20)] transition hover:-translate-y-0.5 hover:bg-[#665991] focus:outline-none focus:ring-4 focus:ring-[#7567A8]/20"
                            >
                                Réinitialiser le mot de passe
                            </button>

                        </form>


                        {{-- Back to login --}}
                        <div class="mt-8 text-center">

                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center text-sm font-semibold text-[#7567A8] hover:text-[#60548E]"
                            >
                                <span class="mr-2">←</span>
                                Retour à la connexion
                            </a>

                        </div>


                        {{-- Privacy --}}
                        <div class="mt-8 flex items-center justify-center gap-2 text-center text-[11px] text-[#8B918E]">

                            <span>🔒</span>

                            <span>
                                Votre accès reste protégé.
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        function toggleResetPassword(id, button) {
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