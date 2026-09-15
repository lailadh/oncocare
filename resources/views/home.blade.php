<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Onco•Care — Suivi & accompagnement</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F8F4EE;
        }
    </style>
</head>

<body class="min-h-screen text-[#4D4A46]">

    {{-- ========================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================= --}}

    <header class="sticky top-0 z-50 border-b border-[#E5DDD5] bg-[#F8F4EE]/95 backdrop-blur">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#B97884] text-xl font-bold text-white">
                    O
                </div>

                <div>
                    <div class="text-xl font-bold tracking-tight text-[#4D4A46]">
                        Onco<span class="text-[#B97884]">•</span>Care
                    </div>

                    <div class="text-xs text-[#7A756F]">
                        Suivi & accompagnement
                    </div>
                </div>

            </a>

            {{-- Navigation --}}
            <nav class="hidden items-center gap-8 md:flex">

                <a
                    href="#accueil"
                    class="text-sm font-medium text-[#706B66] transition hover:text-[#B97884]"
                >
                    Accueil
                </a>

                <a
                    href="#fonctionnalites"
                    class="text-sm font-medium text-[#706B66] transition hover:text-[#B97884]"
                >
                    Fonctionnalités
                </a>

                <a
                    href="#securite"
                    class="text-sm font-medium text-[#706B66] transition hover:text-[#B97884]"
                >
                    Sécurité
                </a>

            </nav>

            {{-- Auth --}}
            <div class="flex items-center gap-3">

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-xl bg-[#B97884] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#A86672]"
                    >
                        Mon espace
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="rounded-xl border border-[#B97884] px-5 py-2.5 text-sm font-semibold text-[#A86672] transition hover:bg-white"
                    >
                        Se connecter
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="hidden rounded-xl bg-[#B97884] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#A86672] sm:inline-flex"
                    >
                        Créer un compte
                    </a>

                @endauth

            </div>

        </div>

    </header>


    {{-- ========================================= --}}
    {{-- HERO --}}
    {{-- ========================================= --}}

    <main id="accueil">

        <section class="relative overflow-hidden">

            {{-- Decorative shapes --}}
            <div class="absolute -right-24 top-10 h-72 w-72 rounded-full bg-[#F1D6D8]/60"></div>

            <div class="absolute -left-24 bottom-0 h-72 w-72 rounded-full bg-[#DCE7DF]/70"></div>

            <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-6 py-16 lg:grid-cols-2 lg:gap-16 lg:py-20">

                {{-- ================================= --}}
                {{-- HERO TEXT --}}
                {{-- ================================= --}}

                <div>

                    <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-[#6F8F83] shadow-sm">

                        <span class="h-2.5 w-2.5 rounded-full bg-[#6F8F83]"></span>

                        Un espace pensé pour vous

                    </div>


                    <h1 class="max-w-2xl text-5xl font-semibold leading-tight tracking-tight text-[#4D4A46] md:text-6xl">

                        Votre suivi cancer,

                        <span class="text-[#B97884]">
                            plus simple,
                        </span>

                        <span class="text-[#6F8F83]">
                            plus serein.
                        </span>

                    </h1>


                    <p class="mt-6 max-w-xl text-lg leading-8 text-[#706B66]">

                        Onco•Care vous accompagne dans l’organisation
                        de votre suivi médical grâce à un espace sécurisé
                        dédié aux patients, médecins et proches autorisés.

                    </p>


                    {{-- Buttons --}}
                    <div class="mt-8 flex flex-wrap gap-4">

                        @auth

                            <a
                                href="{{ route('dashboard') }}"
                                class="rounded-2xl bg-[#B97884] px-7 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#A86672]"
                            >
                                Accéder à mon espace
                            </a>

                        @else

                            <a
                                href="{{ route('register') }}"
                                class="rounded-2xl bg-[#B97884] px-7 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#A86672]"
                            >
                                Créer un compte
                            </a>

                            <a
                                href="{{ route('login') }}"
                                class="rounded-2xl border border-[#B97884] bg-white px-7 py-3.5 text-sm font-semibold text-[#A86672] transition hover:bg-[#FFF9F8]"
                            >
                                Se connecter
                            </a>

                        @endauth

                    </div>


                    {{-- Reassurance --}}
                    <div class="mt-8 flex flex-wrap gap-x-8 gap-y-3 text-sm text-[#706B66]">

                        <div class="flex items-center gap-2">
                            <span class="font-bold text-[#6F8F83]">✓</span>
                            Espace sécurisé
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="font-bold text-[#6F8F83]">✓</span>
                            Accès personnalisé
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="font-bold text-[#6F8F83]">✓</span>
                            Suivi centralisé
                        </div>

                    </div>

                </div>


                {{-- ================================= --}}
                {{-- HERO IMAGE --}}
                {{-- ================================= --}}

                <div class="relative flex justify-center lg:justify-end">

                    <div class="relative w-full max-w-xl">

                        {{-- Soft card behind image --}}
                        <div class="absolute inset-6 rounded-[40px] bg-[#F1E6E3]"></div>

                        <div class="absolute -right-2 top-10 h-20 w-20 rounded-full bg-[#DCE7DF]"></div>

                        <div class="absolute -left-2 bottom-14 h-16 w-16 rounded-full bg-[#F1D6D8]"></div>


                        {{-- Image --}}
                        <div class="relative flex items-center justify-center rounded-[40px] p-5">

                            <img
                                src="{{ asset('images/oncocare-hero.png') }}"
                                alt="Illustration OncoCare"
                                class="relative z-10 block max-h-[600px] w-full object-contain drop-shadow-[0_18px_30px_rgba(120,90,90,0.15)]"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================= --}}
        {{-- FEATURES --}}
        {{-- ========================================= --}}

        <section
            id="fonctionnalites"
            class="bg-white py-20"
        >

            <div class="mx-auto max-w-7xl px-6">

                <div class="mx-auto max-w-2xl text-center">

                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#6F8F83]">
                        Fonctionnalités
                    </p>

                    <h2 class="mt-3 text-4xl font-semibold text-[#4D4A46]">
                        Tout au même endroit
                    </h2>

                    <p class="mt-4 leading-7 text-[#706B66]">
                        Les outils essentiels pour organiser votre suivi
                        et rester informé au quotidien.
                    </p>

                </div>


                <div class="mt-12 grid gap-6 md:grid-cols-3">

                    {{-- Feature 1 --}}
                    <div class="rounded-3xl border border-[#E8DFD8] bg-[#FCFAF7] p-7 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#F1D6D8] text-xl text-[#A86672]">
                            ♡
                        </div>

                        <h3 class="mt-5 text-xl font-semibold text-[#4D4A46]">
                            Suivi médical
                        </h3>

                        <p class="mt-3 leading-7 text-[#706B66]">
                            Retrouvez les informations essentielles
                            de votre suivi dans un espace organisé.
                        </p>

                    </div>


                    {{-- Feature 2 --}}
                    <div class="rounded-3xl border border-[#E8DFD8] bg-[#FCFAF7] p-7 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#DCE7DF] text-xl text-[#6F8F83]">
                            ◷
                        </div>

                        <h3 class="mt-5 text-xl font-semibold text-[#4D4A46]">
                            Rendez-vous
                        </h3>

                        <p class="mt-3 leading-7 text-[#706B66]">
                            Consultez vos rendez-vous et envoyez
                            facilement une demande à votre médecin.
                        </p>

                    </div>


                    {{-- Feature 3 --}}
                    <div class="rounded-3xl border border-[#E8DFD8] bg-[#FCFAF7] p-7 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#F3E7D1] text-xl text-[#B78C4A]">
                            🔒
                        </div>

                        <h3 class="mt-5 text-xl font-semibold text-[#4D4A46]">
                            Confidentialité
                        </h3>

                        <p class="mt-3 leading-7 text-[#706B66]">
                            Le patient garde le contrôle des accès
                            accordés à ses proches.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================= --}}
        {{-- SECURITY --}}
        {{-- ========================================= --}}

        <section
            id="securite"
            class="bg-[#E8DDD6] py-20"
        >

            <div class="mx-auto max-w-4xl px-6 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                    🔒
                </div>


                <h2 class="mt-6 text-4xl font-semibold text-[#4D4A46]">
                    Pensé autour de la confiance
                </h2>


                <p class="mx-auto mt-5 max-w-2xl leading-8 text-[#706B66]">

                    Onco•Care est un outil de suivi et d’accompagnement.
                    Il ne remplace pas le médecin et ne réalise pas
                    de diagnostic médical.

                </p>


                <div class="mt-8 flex flex-wrap justify-center gap-3">

                    <span class="rounded-full border border-[#D8CCC4] bg-white px-4 py-2 text-sm text-[#6B655F]">
                        Données protégées
                    </span>

                    <span class="rounded-full border border-[#D8CCC4] bg-white px-4 py-2 text-sm text-[#6B655F]">
                        Accès personnalisé
                    </span>

                    <span class="rounded-full border border-[#D8CCC4] bg-white px-4 py-2 text-sm text-[#6B655F]">
                        Contrôle des proches
                    </span>

                </div>

            </div>

        </section>


        {{-- ========================================= --}}
        {{-- CTA --}}
        {{-- ========================================= --}}

        <section class="bg-[#F8F4EE] py-20">

            <div class="mx-auto max-w-4xl px-6 text-center">

                <h2 class="text-4xl font-semibold text-[#4D4A46]">
                    Votre espace Onco•Care vous attend
                </h2>


                <p class="mt-4 text-[#706B66]">
                    Un espace simple pour mieux organiser votre suivi
                    et rester informé.
                </p>


                <div class="mt-8">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex rounded-2xl bg-[#B97884] px-8 py-3.5 text-sm font-semibold text-white transition hover:bg-[#A86672]"
                        >
                            Accéder à mon espace
                        </a>

                    @else

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex rounded-2xl bg-[#B97884] px-8 py-3.5 text-sm font-semibold text-white transition hover:bg-[#A86672]"
                        >
                            Créer un compte
                        </a>

                    @endauth

                </div>

            </div>

        </section>

    </main>


    {{-- ========================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================= --}}

    <footer class="border-t border-[#E5DDD5] bg-[#F8F4EE]">

        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-8 text-sm text-[#706B66] md:flex-row md:items-center md:justify-between">

            <div>
                <span class="font-semibold text-[#4D4A46]">
                    Onco•Care
                </span>

                — Suivi & accompagnement
            </div>

            <div>
                © {{ date('Y') }} Onco•Care
            </div>

        </div>

    </footer>

</body>

</html>