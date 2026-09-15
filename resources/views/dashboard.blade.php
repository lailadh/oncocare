<x-app-layout>

    <x-slot name="header">

        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#6C63A8]">
                OncoCare
            </p>

            <h2
                class="mt-1 text-3xl font-medium leading-tight text-[#34324A]"
                style="font-family: 'Newsreader', serif;"
            >
                Tableau de bord
            </h2>
        </div>

    </x-slot>


    <div class="py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- ===================================================== --}}
            {{-- WELCOME CARD --}}
            {{-- ===================================================== --}}

            <div
                class="relative isolate overflow-hidden rounded-[24px] border border-[#E3DDD8] bg-white p-7 shadow-[0_8px_30px_rgba(52,50,74,0.05)]"
            >

                {{-- Décoration --}}
                <div
                    class="absolute -right-20 -top-20 z-0 h-60 w-60 rounded-full bg-[#EEEAF8]"
                ></div>

                <div
                    class="absolute -bottom-20 right-40 z-0 h-44 w-44 rounded-full bg-[#F8E9EE]"
                ></div>


                @auth

                    {{-- ================================================= --}}
                    {{-- MEDECIN --}}
                    {{-- ================================================= --}}

                    @if(auth()->user()->role === 'medecin')

                        <div class="relative z-10">

                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-[#EEEAF8] px-3 py-1.5 text-xs font-semibold text-[#6C63A8]"
                            >
                                <span class="h-2 w-2 rounded-full bg-[#D98FA5]"></span>
                                Espace médecin
                            </div>


                            <h1
                                class="mt-5 text-4xl font-medium leading-tight text-[#34324A] sm:text-[42px]"
                                style="font-family: 'Newsreader', serif;"
                            >
                                Bonjour Dr.
                                {{ auth()->user()->prenom }}
                                👋
                            </h1>


                            <p class="mt-3 max-w-2xl text-sm leading-7 text-[#667085]">
                                Bienvenue dans votre espace médecin.
                                Gérez facilement vos patients, leurs suivis
                                et vos rendez-vous.
                            </p>


                            {{-- Role --}}
                            <div class="mt-5 flex flex-wrap items-center gap-3">

                                <span class="text-xs font-medium text-[#667085]">
                                    Votre espace :
                                </span>

                                <span class="onco-role-badge medecin">
                                    Médecin
                                </span>

                            </div>


                            {{-- Small indicators --}}
                            <div class="mt-6 flex flex-wrap gap-3">

                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-[#F8E9EE] px-3 py-2 text-xs font-semibold text-[#9B6172]"
                                >
                                    <span class="h-2 w-2 rounded-full bg-[#D98FA5]"></span>
                                    Suivi des patients
                                </span>

                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-[#EAF2FF] px-3 py-2 text-xs font-semibold text-[#4C78C8]"
                                >
                                    <span class="h-2 w-2 rounded-full bg-[#5B8DEF]"></span>
                                    Activité médicale
                                </span>

                            </div>

                        </div>


                    {{-- ================================================= --}}
                    {{-- PATIENT / PROCHE / ADMIN --}}
                    {{-- ================================================= --}}

                    @else

                        <div class="relative z-10">

                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-[#F5F2FA] px-3 py-1.5 text-xs font-semibold text-[#655A88]"
                            >

                                <span class="h-2 w-2 rounded-full bg-[#7567A8]"></span>

                                Espace sécurisé

                            </div>


                            <h1
                                class="mt-5 text-4xl font-medium leading-tight text-[#34324A]"
                                style="font-family: 'Newsreader', serif;"
                            >
                                Bienvenue
                                {{ auth()->user()->prenom }}
                                👋
                            </h1>


                            <p class="mt-3 max-w-2xl text-sm leading-7 text-[#667085]">
                                Bienvenue dans votre espace personnel OncoCare.
                                Votre tableau de bord vous permet d'accéder rapidement
                                aux fonctionnalités disponibles selon votre rôle.
                            </p>


                            {{-- Role --}}
                            <div class="mt-6 flex flex-wrap items-center gap-3">

                                <span class="text-xs font-medium text-[#667085]">
                                    Votre espace :
                                </span>


                                @if(auth()->user()->role === 'patient')

                                    <span class="onco-role-badge patient">
                                        Patient
                                    </span>

                                @elseif(auth()->user()->role === 'proche')

                                    <span class="onco-role-badge proche">
                                        Proche
                                    </span>

                                @elseif(auth()->user()->role === 'admin')

                                    <span class="onco-role-badge admin">
                                        Administrateur
                                    </span>

                                @endif

                            </div>

                        </div>

                    @endif

                @endauth

            </div>


            {{-- ===================================================== --}}
            {{-- QUICK ACCESS --}}
            {{-- ===================================================== --}}

            <div class="mt-8">

                <div class="mb-5">

                    <h3
                        class="text-2xl font-medium text-[#34324A]"
                        style="font-family: 'Newsreader', serif;"
                    >
                        Accès rapide
                    </h3>

                    <p class="mt-1 text-sm text-[#667085]">
                        Accédez directement aux principales fonctionnalités de votre espace.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">


                    {{-- ================================================= --}}
                    {{-- PATIENT --}}
                    {{-- ================================================= --}}

                    @auth
                        @if(auth()->user()->role === 'patient')

                            {{-- Mes suivis --}}
                            <a
                                href="{{ route('patient.suivis.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#E8BBC4] hover:shadow-[0_10px_30px_rgba(217,154,166,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBF1F3] text-[#D99AA6]">
                                    ♡
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Mes suivis
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez votre historique médical.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#9A6470]">
                                    Consulter →
                                </span>

                            </a>


                            {{-- Rendez-vous --}}
                            <a
                                href="{{ route('patient.rendezvous.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#E8BBC4] hover:shadow-[0_10px_30px_rgba(217,154,166,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F8F1E1] text-[#C7A45B]">
                                    ◷
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Rendez-vous
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez vos rendez-vous médicaux.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#9A6470]">
                                    Consulter →
                                </span>

                            </a>


                            {{-- Mes proches --}}
                            <a
                                href="{{ route('patient.autorisations.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#E8BBC4] hover:shadow-[0_10px_30px_rgba(217,154,166,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBF1F3] text-[#D99AA6]">
                                    ◌
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Mes proches
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Gérez les accès de vos proches.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#9A6470]">
                                    Gérer →
                                </span>

                            </a>


                            {{-- Notifications --}}
                            <a
                                href="{{ route('notifications.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#E8BBC4] hover:shadow-[0_10px_30px_rgba(217,154,166,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F5F2FA] text-[#7567A8]">
                                    ◉
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Notifications
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez vos dernières notifications.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#9A6470]">
                                    Ouvrir →
                                </span>

                            </a>

                        @endif
                    @endauth


                    {{-- ================================================= --}}
                    {{-- MEDECIN --}}
                    {{-- ================================================= --}}

                    @auth
                        @if(auth()->user()->role === 'medecin')

                            {{-- Patients --}}
                            <a
                                href="{{ route('medecin.patients.index') }}"
                                class="group rounded-[18px] border border-[#E2DFF0] bg-white p-5 shadow-[0_4px_18px_rgba(108,99,168,0.06)] transition duration-200 hover:-translate-y-1 hover:border-[#C4BDE0] hover:shadow-[0_10px_30px_rgba(108,99,168,0.12)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#EEEAF8] text-[#6C63A8]">
                                    ◌
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Mes patients
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les patients que vous accompagnez.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#6C63A8]">
                                    Consulter →
                                </span>

                            </a>


                            {{-- Suivis --}}
                            <a
                                href="{{ route('suivis.index') }}"
                                class="group rounded-[18px] border border-[#F0D7DF] bg-white p-5 shadow-[0_4px_18px_rgba(217,143,165,0.05)] transition duration-200 hover:-translate-y-1 hover:border-[#E2B4C2] hover:shadow-[0_10px_30px_rgba(217,143,165,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F8E9EE] text-[#D98FA5]">
                                    ♡
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Suivis médicaux
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Gérez les suivis de vos patients.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#A9687B]">
                                    Ouvrir →
                                </span>

                            </a>


                            {{-- Rendez-vous --}}
                            <a
                                href="{{ route('rendezvous.index') }}"
                                class="group rounded-[18px] border border-[#DCE7F8] bg-white p-5 shadow-[0_4px_18px_rgba(91,141,239,0.06)] transition duration-200 hover:-translate-y-1 hover:border-[#B8CFF4] hover:shadow-[0_10px_30px_rgba(91,141,239,0.12)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#EAF2FF] text-[#5B8DEF]">
                                    ◷
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Rendez-vous
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Gérez vos rendez-vous.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#4C78C8]">
                                    Ouvrir →
                                </span>

                            </a>


                            {{-- Notifications --}}
                            <a
                                href="{{ route('notifications.index') }}"
                                class="group rounded-[18px] border border-[#E2DFF0] bg-white p-5 shadow-[0_4px_18px_rgba(108,99,168,0.06)] transition duration-200 hover:-translate-y-1 hover:border-[#C4BDE0] hover:shadow-[0_10px_30px_rgba(108,99,168,0.12)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#EEEAF8] text-[#6C63A8]">
                                    ◉
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Notifications
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez vos notifications.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#6C63A8]">
                                    Ouvrir →
                                </span>

                            </a>

                        @endif
                    @endauth


                    {{-- ================================================= --}}
                    {{-- PROCHE --}}
                    {{-- ================================================= --}}

                    @auth
                        @if(auth()->user()->role === 'proche')

                            {{-- Autorisations --}}
                            <a
                                href="{{ route('proche.autorisations.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#AFC8BA] hover:shadow-[0_10px_30px_rgba(127,166,138,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F0F6F2] text-[#7FA68A]">
                                    ◌
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Mes autorisations
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les accès accordés.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#4E755B]">
                                    Consulter →
                                </span>

                            </a>


                            {{-- Suivis --}}
                            <a
                                href="{{ route('proche.suivis.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#AFC8BA] hover:shadow-[0_10px_30px_rgba(127,166,138,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F0F6F2] text-[#7FA68A]">
                                    ♡
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Suivis accessibles
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez uniquement les informations autorisées.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#4E755B]">
                                    Ouvrir →
                                </span>

                            </a>


                            {{-- Rendez-vous --}}
                            <a
                                href="{{ route('proche.rendezvous.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#AFC8BA] hover:shadow-[0_10px_30px_rgba(127,166,138,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F0F6F2] text-[#7FA68A]">
                                    ◷
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Rendez-vous
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les rendez-vous accessibles.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#4E755B]">
                                    Ouvrir →
                                </span>

                            </a>


                            {{-- Notifications --}}
                            <a
                                href="{{ route('notifications.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#AFC8BA] hover:shadow-[0_10px_30px_rgba(127,166,138,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F0F6F2] text-[#7FA68A]">
                                    ◉
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Notifications
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les notifications qui vous concernent.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#4E755B]">
                                    Ouvrir →
                                </span>

                            </a>

                        @endif
                    @endauth


                    {{-- ================================================= --}}
                    {{-- ADMIN --}}
                    {{-- ================================================= --}}

                    @auth
                        @if(auth()->user()->role === 'admin')

                            {{-- Utilisateurs --}}
                            <a
                                href="{{ route('admin.users.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#A98DAD] hover:shadow-[0_10px_30px_rgba(107,76,111,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F4EFF5] text-[#6B4C6F]">
                                    ◌
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Utilisateurs
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les comptes de la plateforme.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#654867]">
                                    Ouvrir →
                                </span>

                            </a>


                            {{-- Médecins --}}
                            <a
                                href="{{ route('admin.medecins.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#A98DAD] hover:shadow-[0_10px_30px_rgba(107,76,111,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F4EFF5] text-[#6B4C6F]">
                                    ✚
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Médecins
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les comptes des médecins.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#654867]">
                                    Consulter →
                                </span>

                            </a>


                            {{-- Patients --}}
                            <a
                                href="{{ route('admin.patients.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#A98DAD] hover:shadow-[0_10px_30px_rgba(107,76,111,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F4EFF5] text-[#6B4C6F]">
                                    ♡
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Patients
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les comptes des patients.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#654867]">
                                    Consulter →
                                </span>

                            </a>


                            {{-- Proches --}}
                            <a
                                href="{{ route('admin.proches.index') }}"
                                class="group rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(52,50,74,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#A98DAD] hover:shadow-[0_10px_30px_rgba(107,76,111,0.10)]"
                            >

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F4EFF5] text-[#6B4C6F]">
                                    ◌
                                </div>

                                <h4 class="mt-4 text-sm font-semibold text-[#34324A]">
                                    Proches
                                </h4>

                                <p class="mt-1 text-xs leading-5 text-[#667085]">
                                    Consultez les comptes des proches.
                                </p>

                                <span class="mt-4 inline-flex text-xs font-semibold text-[#654867]">
                                    Consulter →
                                </span>

                            </a>

                        @endif
                    @endauth

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- PRIVACY --}}
            {{-- ===================================================== --}}

            <div
                class="mt-8 rounded-[18px] border border-[#D7E6DB] bg-[#F1F7F2] p-5"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl border border-[#DCE9DF] bg-white text-[#7FA68A]"
                    >
                        🔒
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-[#41644B]">
                            Votre confidentialité est une priorité
                        </p>

                        <p class="mt-1 max-w-3xl text-xs leading-5 text-[#607467]">
                            OncoCare adapte l'accès aux informations selon votre rôle
                            et vos autorisations. Chaque utilisateur n'accède qu'aux
                            fonctionnalités et données qui lui sont destinées.
                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>