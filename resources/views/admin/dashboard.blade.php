<x-app-layout>

    <div class="space-y-8">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

            <div>
                <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-[#F4EFF5] px-3 py-1.5 text-xs font-semibold text-[#6B4C6F]">
                    <span class="h-2 w-2 rounded-full bg-[#6B4C6F]"></span>
                    Espace administration
                </div>

                <h1
                    class="text-4xl font-medium leading-tight text-[#293331]"
                    style="font-family: 'Newsreader', serif;"
                >
                    Dashboard Administrateur
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#66706D]">
                    Bienvenue {{ auth()->user()->prenom }}.
                    Retrouvez ici une vue d'ensemble des comptes de la plateforme
                    OncoCare.
                </p>
            </div>


            {{-- Security indicator --}}
            <div class="inline-flex w-fit items-center gap-2 rounded-xl border border-[#E3DDD8] bg-white px-4 py-3 shadow-[0_4px_18px_rgba(41,51,49,0.04)]">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#F4EFF5] text-[#6B4C6F]">
                    🔒
                </div>

                <div>
                    <p class="text-xs font-semibold text-[#293331]">
                        Accès administrateur
                    </p>

                    <p class="mt-0.5 text-[11px] text-[#66706D]">
                        Supervision de la plateforme
                    </p>
                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- STATISTICS --}}
        {{-- ========================================================= --}}

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


            {{-- USERS --}}
            <a
                href="{{ route('admin.users.index') }}"
                class="group relative overflow-hidden rounded-[20px] border border-[#E3DDD8] bg-white p-6 shadow-[0_4px_18px_rgba(41,51,49,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#CDB8D0] hover:shadow-[0_12px_35px_rgba(107,76,111,0.10)]"
            >

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#6B4C6F]/5"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#F4EFF5] text-[#6B4C6F] text-lg">
                            ◌
                        </div>

                        <span class="text-xs font-semibold text-[#6B4C6F]">
                            Voir
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-semibold text-[#66706D]">
                        Utilisateurs
                    </p>

                    <p class="mt-1 text-4xl font-medium text-[#293331]"
                       style="font-family: 'Newsreader', serif;"
                    >
                        {{ $totalUsers }}
                    </p>

                    <p class="mt-2 text-xs text-[#8B918E]">
                        Comptes enregistrés
                    </p>

                </div>

            </a>


            {{-- PATIENTS --}}
            <a
                href="{{ route('admin.patients.index') }}"
                class="group relative overflow-hidden rounded-[20px] border border-[#E3DDD8] bg-white p-6 shadow-[0_4px_18px_rgba(41,51,49,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#E8BBC4] hover:shadow-[0_12px_35px_rgba(217,154,166,0.10)]"
            >

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#D99AA6]/7"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FBF1F3] text-[#D99AA6] text-lg">
                            ♡
                        </div>

                        <span class="text-xs font-semibold text-[#9A6470]">
                            Voir
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-semibold text-[#66706D]">
                        Patients
                    </p>

                    <p class="mt-1 text-4xl font-medium text-[#293331]"
                       style="font-family: 'Newsreader', serif;"
                    >
                        {{ $totalPatients }}
                    </p>

                    <p class="mt-2 text-xs text-[#8B918E]">
                        Comptes patients
                    </p>

                </div>

            </a>


            {{-- MEDECINS --}}
            <a
                href="{{ route('admin.medecins.index') }}"
                class="group relative overflow-hidden rounded-[20px] border border-[#E3DDD8] bg-white p-6 shadow-[0_4px_18px_rgba(41,51,49,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#A9A2CC] hover:shadow-[0_12px_35px_rgba(117,103,168,0.10)]"
            >

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#7567A8]/5"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#F1EFF8] text-[#7567A8] text-lg">
                            ✚
                        </div>

                        <span class="text-xs font-semibold text-[#655A88]">
                            Voir
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-semibold text-[#66706D]">
                        Médecins
                    </p>

                    <p class="mt-1 text-4xl font-medium text-[#293331]"
                       style="font-family: 'Newsreader', serif;"
                    >
                        {{ $totalMedecins }}
                    </p>

                    <p class="mt-2 text-xs text-[#8B918E]">
                        Comptes médecins
                    </p>

                </div>

            </a>


            {{-- PROCHES --}}
            <a
                href="{{ route('admin.proches.index') }}"
                class="group relative overflow-hidden rounded-[20px] border border-[#E3DDD8] bg-white p-6 shadow-[0_4px_18px_rgba(41,51,49,0.045)] transition duration-200 hover:-translate-y-1 hover:border-[#AFC8BA] hover:shadow-[0_12px_35px_rgba(127,166,138,0.10)]"
            >

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#7FA68A]/6"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#F0F6F2] text-[#7FA68A] text-lg">
                            ◌
                        </div>

                        <span class="text-xs font-semibold text-[#4E755B]">
                            Voir
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-semibold text-[#66706D]">
                        Proches
                    </p>

                    <p class="mt-1 text-4xl font-medium text-[#293331]"
                       style="font-family: 'Newsreader', serif;"
                    >
                        {{ $totalProches }}
                    </p>

                    <p class="mt-2 text-xs text-[#8B918E]">
                        Comptes proches
                    </p>

                </div>

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- QUICK MANAGEMENT --}}
        {{-- ========================================================= --}}

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


            {{-- Platform overview --}}
            <div class="lg:col-span-2 rounded-[22px] border border-[#E3DDD8] bg-white p-6 shadow-[0_4px_18px_rgba(41,51,49,0.045)]">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h2
                            class="text-2xl font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            Vue d'ensemble
                        </h2>

                        <p class="mt-1 text-xs text-[#66706D]">
                            Répartition actuelle des comptes OncoCare
                        </p>
                    </div>

                    <span class="text-xs font-medium text-[#8B918E]">
                        {{ $totalUsers }} utilisateurs
                    </span>

                </div>


                <div class="mt-7 space-y-5">


                    {{-- Patients --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="h-2.5 w-2.5 rounded-full bg-[#D99AA6]"></span>

                                <span class="text-sm font-medium text-[#293331]">
                                    Patients
                                </span>

                            </div>

                            <span class="text-xs font-semibold text-[#66706D]">
                                {{ $totalPatients }}
                            </span>

                        </div>

                        <div class="h-2 overflow-hidden rounded-full bg-[#F1EEEB]">

                            <div
                                class="h-full rounded-full bg-[#D99AA6] transition-all"
                                style="width: {{ $totalUsers > 0 ? min(100, ($totalPatients / $totalUsers) * 100) : 0 }}%"
                            ></div>

                        </div>

                    </div>


                    {{-- Medecins --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="h-2.5 w-2.5 rounded-full bg-[#7567A8]"></span>

                                <span class="text-sm font-medium text-[#293331]">
                                    Médecins
                                </span>

                            </div>

                            <span class="text-xs font-semibold text-[#66706D]">
                                {{ $totalMedecins }}
                            </span>

                        </div>

                        <div class="h-2 overflow-hidden rounded-full bg-[#F1EEEB]">

                            <div
                                class="h-full rounded-full bg-[#7567A8] transition-all"
                                style="width: {{ $totalUsers > 0 ? min(100, ($totalMedecins / $totalUsers) * 100) : 0 }}%"
                            ></div>

                        </div>

                    </div>


                    {{-- Proches --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="h-2.5 w-2.5 rounded-full bg-[#7FA68A]"></span>

                                <span class="text-sm font-medium text-[#293331]">
                                    Proches
                                </span>

                            </div>

                            <span class="text-xs font-semibold text-[#66706D]">
                                {{ $totalProches }}
                            </span>

                        </div>

                        <div class="h-2 overflow-hidden rounded-full bg-[#F1EEEB]">

                            <div
                                class="h-full rounded-full bg-[#7FA68A] transition-all"
                                style="width: {{ $totalUsers > 0 ? min(100, ($totalProches / $totalUsers) * 100) : 0 }}%"
                            ></div>

                        </div>

                    </div>


                    {{-- Admin --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="h-2.5 w-2.5 rounded-full bg-[#6B4C6F]"></span>

                                <span class="text-sm font-medium text-[#293331]">
                                    Administrateurs
                                </span>

                            </div>

                            <span class="text-xs font-semibold text-[#66706D]">
                                {{ max(0, $totalUsers - $totalPatients - $totalMedecins - $totalProches) }}
                            </span>

                        </div>

                        <div class="h-2 overflow-hidden rounded-full bg-[#F1EEEB]">

                            <div
                                class="h-full rounded-full bg-[#6B4C6F] transition-all"
                                style="width: {{ $totalUsers > 0 ? min(100, (max(0, $totalUsers - $totalPatients - $totalMedecins - $totalProches) / $totalUsers) * 100) : 0 }}%"
                            ></div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Security card --}}
            <div class="rounded-[22px] border border-[#D8CCD9] bg-[#F4EFF5] p-6">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#6B4C6F] shadow-sm">
                    🔐
                </div>

                <h2
                    class="mt-5 text-2xl font-medium text-[#432F46]"
                    style="font-family: 'Newsreader', serif;"
                >
                    Sécurité de la plateforme
                </h2>

                <p class="mt-3 text-sm leading-6 text-[#68596A]">
                    Les accès OncoCare sont contrôlés selon le rôle de chaque
                    utilisateur et les autorisations qui lui sont associées.
                </p>


                <div class="mt-6 space-y-3">

                    <div class="flex items-start gap-3 rounded-xl bg-white/70 p-3">

                        <span class="mt-0.5 text-[#6B4C6F]">
                            ✓
                        </span>

                        <p class="text-xs leading-5 text-[#68596A]">
                            Accès différenciés selon les rôles.
                        </p>

                    </div>


                    <div class="flex items-start gap-3 rounded-xl bg-white/70 p-3">

                        <span class="mt-0.5 text-[#6B4C6F]">
                            ✓
                        </span>

                        <p class="text-xs leading-5 text-[#68596A]">
                            Données médicales protégées.
                        </p>

                    </div>


                    <div class="flex items-start gap-3 rounded-xl bg-white/70 p-3">

                        <span class="mt-0.5 text-[#6B4C6F]">
                            ✓
                        </span>

                        <p class="text-xs leading-5 text-[#68596A]">
                            Autorisations contrôlées par le patient.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- QUICK ACCESS --}}
        {{-- ========================================================= --}}

        <div>

            <div class="mb-4">

                <h2
                    class="text-2xl font-medium text-[#293331]"
                    style="font-family: 'Newsreader', serif;"
                >
                    Accès rapides
                </h2>

                <p class="mt-1 text-xs text-[#66706D]">
                    Consultez les différents espaces de supervision.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">


                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center justify-between rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(41,51,49,0.04)] transition hover:-translate-y-1 hover:border-[#CDB8D0]"
                >

                    <div>

                        <p class="text-sm font-semibold text-[#293331]">
                            Utilisateurs
                        </p>

                        <p class="mt-1 text-xs text-[#66706D]">
                            Comptes et rôles
                        </p>

                    </div>

                    <span class="text-lg text-[#6B4C6F]">
                        →
                    </span>

                </a>


                <a
                    href="{{ route('admin.medecins.index') }}"
                    class="flex items-center justify-between rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(41,51,49,0.04)] transition hover:-translate-y-1 hover:border-[#A9A2CC]"
                >

                    <div>

                        <p class="text-sm font-semibold text-[#293331]">
                            Médecins
                        </p>

                        <p class="mt-1 text-xs text-[#66706D]">
                            Comptes médecins
                        </p>

                    </div>

                    <span class="text-lg text-[#7567A8]">
                        →
                    </span>

                </a>


                <a
                    href="{{ route('admin.patients.index') }}"
                    class="flex items-center justify-between rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(41,51,49,0.04)] transition hover:-translate-y-1 hover:border-[#E8BBC4]"
                >

                    <div>

                        <p class="text-sm font-semibold text-[#293331]">
                            Patients
                        </p>

                        <p class="mt-1 text-xs text-[#66706D]">
                            Comptes patients
                        </p>

                    </div>

                    <span class="text-lg text-[#D99AA6]">
                        →
                    </span>

                </a>


                <a
                    href="{{ route('admin.proches.index') }}"
                    class="flex items-center justify-between rounded-[18px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(41,51,49,0.04)] transition hover:-translate-y-1 hover:border-[#AFC8BA]"
                >

                    <div>

                        <p class="text-sm font-semibold text-[#293331]">
                            Proches
                        </p>

                        <p class="mt-1 text-xs text-[#66706D]">
                            Comptes proches
                        </p>

                    </div>

                    <span class="text-lg text-[#7FA68A]">
                        →
                    </span>

                </a>

            </div>

        </div>

    </div>

</x-app-layout>