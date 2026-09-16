<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center p-4 md:p-6">

        <div class="w-full max-w-[1450px] overflow-hidden rounded-[32px] bg-white border border-[#E8E3D8] shadow-[0_20px_60px_rgba(38,51,48,0.08)]">

            <div class="grid grid-cols-1 lg:grid-cols-[0.95fr_1.05fr] min-h-[760px]">

                {{-- ========================================================= --}}
                {{-- LEFT : IMAGE / ONCOCARE MESSAGE --}}
                {{-- ========================================================= --}}
                <div class="relative min-h-[520px] lg:min-h-full overflow-hidden bg-[#EEF2E9]">

                    {{-- Background image --}}
                    <img
                        src="{{ asset('images/oncocare-register-hero.png') }}"
                        alt="Accompagnement et soutien OncoCare"
                        class="absolute inset-0 h-full w-full object-cover"
                    >

                    {{-- Soft overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#F7F6F1]/95 via-[#F7F6F1]/35 to-transparent"></div>

                    <div class="relative z-10 h-full flex flex-col justify-between p-8 md:p-10 lg:p-12">

                        {{-- Logo --}}
                        <div>

                            <div class="flex items-center gap-2">

                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#16423C] text-white shadow-sm">
                                    <span class="text-xl font-bold">+</span>
                                </div>

                                <div>
                                    <div class="text-2xl md:text-3xl font-bold tracking-tight text-[#263330]">
                                        Onco<span class="text-[#C49A5A]">•</span>Care
                                    </div>

                                    <div class="text-xs md:text-sm text-[#667085] -mt-1">
                                        Suivi & accompagnement
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- Message --}}
                        <div class="max-w-xl mt-16">

                            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#5C8177]">
                                Une approche humaine
                            </p>

                            <h2 class="mt-4 text-4xl md:text-5xl xl:text-6xl font-semibold leading-[1.05] text-[#263330]">
                                Ensemble face
                                <span class="block text-[#5D8C7E]">
                                    au cancer.
                                </span>
                            </h2>

                            <p class="mt-6 max-w-lg text-base md:text-lg leading-8 text-[#465650]">
                                OncoCare vous accompagne à chaque étape de votre parcours,
                                avec un espace simple, humain et sécurisé.
                            </p>

                        </div>

                        {{-- Bottom values --}}
                        <div class="pt-12">

                            <div class="grid grid-cols-3 gap-4 max-w-xl">

                                <div class="pr-3 border-r border-[#CFCFC7]/70">
                                    <div class="text-xl mb-2 text-[#16423C]">
                                        ♧
                                    </div>

                                    <p class="text-xs md:text-sm font-semibold text-[#40514B]">
                                        Suivi personnalisé
                                    </p>
                                </div>

                                <div class="pr-3 border-r border-[#CFCFC7]/70">
                                    <div class="text-xl mb-2 text-[#B26E83]">
                                        ♡
                                    </div>

                                    <p class="text-xs md:text-sm font-semibold text-[#40514B]">
                                        Soutien humain
                                    </p>
                                </div>

                                <div>
                                    <div class="text-xl mb-2 text-[#C49A5A]">
                                        ♧
                                    </div>

                                    <p class="text-xs md:text-sm font-semibold text-[#40514B]">
                                        Données sécurisées
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- RIGHT : ROLE SELECTION --}}
                {{-- ========================================================= --}}
                <div class="bg-white p-6 sm:p-8 md:p-10 lg:p-12 xl:p-14 flex flex-col justify-center">

                    {{-- Header --}}
                    <div class="text-center max-w-2xl mx-auto">

                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#5C8177]">
                            Créer votre espace
                        </p>

                        <h1 class="mt-3 text-3xl md:text-4xl xl:text-5xl font-semibold text-[#263330] leading-tight">
                            Choisissez votre rôle
                        </h1>

                        <p class="mt-4 text-[#667085] leading-7 text-sm md:text-base">
                            Sélectionnez le profil qui correspond à votre situation
                            pour accéder à votre espace personnel.
                        </p>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- CARDS --}}
                    {{-- ===================================================== --}}
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-5">


                        {{-- Patient --}}
                        <a
                            href="{{ route('register.patient') }}"
                            class="group relative overflow-hidden rounded-[26px] border border-[#DDE6DE] bg-[#F5F8F3] p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#9EB8A3]"
                        >

                            <div class="absolute top-0 right-0 h-28 w-28 rounded-full bg-[#E3EEE4] -translate-y-10 translate-x-10"></div>

                            <div class="relative z-10">

                                <div class="h-24 flex items-center justify-center mb-4">
                                    <div class="h-20 w-20 rounded-full bg-[#E0EDE2] flex items-center justify-center text-4xl">
                                        👤
                                    </div>
                                </div>

                                <h2 class="text-xl font-semibold text-[#263330]">
                                    Patient
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-[#667085] min-h-[72px]">
                                    Accédez à vos rendez-vous, vos suivis
                                    et à votre parcours de soins.
                                </p>

                                <div class="mt-5 flex items-center justify-between">

                                    <span class="text-sm font-semibold text-[#16423C]">
                                        Créer mon espace
                                    </span>

                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#6F9B8D] text-white transition-transform duration-300 group-hover:translate-x-1">
                                        →
                                    </span>

                                </div>

                            </div>

                        </a>


                        {{-- Proche --}}
                        <a
                            href="{{ route('register.proche') }}"
                            class="group relative overflow-hidden rounded-[26px] border border-[#EEDDE3] bg-[#FBF3F5] p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#D9A5B4]"
                        >

                            <div class="absolute top-0 right-0 h-28 w-28 rounded-full bg-[#F5E1E7] -translate-y-10 translate-x-10"></div>

                            <div class="relative z-10">

                                <div class="h-24 flex items-center justify-center mb-4">
                                    <div class="h-20 w-20 rounded-full bg-[#F4DDE4] flex items-center justify-center text-4xl">
                                        🤝
                                    </div>
                                </div>

                                <h2 class="text-xl font-semibold text-[#263330]">
                                    Proche
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-[#667085] min-h-[72px]">
                                    Suivez et soutenez votre proche
                                    dans son parcours de soins.
                                </p>

                                <div class="mt-5 flex items-center justify-between">

                                    <span class="text-sm font-semibold text-[#A85F76]">
                                        Créer mon espace
                                    </span>

                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#C87992] text-white transition-transform duration-300 group-hover:translate-x-1">
                                        →
                                    </span>

                                </div>

                            </div>

                        </a>


                        {{-- Médecin --}}
                        <a
                            href="{{ route('register.medecin') }}"
                            class="group relative overflow-hidden rounded-[26px] border border-[#DDD9EF] bg-[#F5F3FB] p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ADA6D3]"
                        >

                            <div class="absolute top-0 right-0 h-28 w-28 rounded-full bg-[#E9E5F7] -translate-y-10 translate-x-10"></div>

                            <div class="relative z-10">

                                <div class="h-24 flex items-center justify-center mb-4">
                                    <div class="h-20 w-20 rounded-full bg-[#E8E4F7] flex items-center justify-center text-4xl">
                                        🩺
                                    </div>
                                </div>

                                <h2 class="text-xl font-semibold text-[#263330]">
                                    Médecin
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-[#667085] min-h-[72px]">
                                    Accédez à vos patients, vos rendez-vous
                                    et vos outils de suivi.
                                </p>

                                <div class="mt-5 flex items-center justify-between">

                                    <span class="text-sm font-semibold text-[#6C63A8]">
                                        Accéder au formulaire
                                    </span>

                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#7C75B6] text-white transition-transform duration-300 group-hover:translate-x-1">
                                        →
                                    </span>

                                </div>

                            </div>

                        </a>


                        {{-- Administrateur --}}
                        <div
                            class="relative overflow-hidden rounded-[26px] border border-[#E7DFC9] bg-[#FBF8F0] p-6"
                        >

                            <div class="absolute top-0 right-0 h-28 w-28 rounded-full bg-[#F2EBD8] -translate-y-10 translate-x-10"></div>

                            <div class="relative z-10">

                                <div class="h-24 flex items-center justify-center mb-4">
                                    <div class="h-20 w-20 rounded-full bg-[#F1E9D5] flex items-center justify-center text-4xl">
                                        🔐
                                    </div>
                                </div>

                                <h2 class="text-xl font-semibold text-[#263330]">
                                    Administrateur
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-[#667085] min-h-[72px]">
                                    Accès réservé aux équipes de gestion
                                    et d’administration de la plateforme.
                                </p>

                                <div class="mt-5">

                                    <span class="inline-flex items-center gap-2 rounded-full bg-[#F2E8CF] px-4 py-2 text-xs font-semibold text-[#9A7432]">
                                        🔒 Accès réservé
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Login --}}
                    <div class="mt-8 text-center">

                        <p class="text-sm text-[#667085]">
                            Vous avez déjà un compte ?

                            <a
                                href="{{ route('login') }}"
                                class="font-semibold text-[#16423C] hover:underline"
                            >
                                Se connecter
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>