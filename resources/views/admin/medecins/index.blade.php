<x-app-layout>

    <div class="space-y-7">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div
                    class="mb-3 inline-flex items-center gap-2 rounded-full
                           bg-[#F1EFF8] px-3 py-1.5 text-xs font-semibold
                           text-[#655A88]"
                >
                    <span class="h-2 w-2 rounded-full bg-[#7567A8]"></span>

                    Administration · Médecins
                </div>

                <h1
                    class="text-4xl font-medium leading-tight text-[#293331]"
                    style="font-family: 'Newsreader', serif;"
                >
                    Gestion des médecins
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#66706D]">
                    Consultez les comptes médecins et gérez les demandes
                    d'accès à l'espace médical OncoCare.
                </p>

            </div>


            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl
                       border border-[#E3DDD8] bg-white px-4 py-2.5
                       text-sm font-semibold text-[#293331]
                       shadow-[0_4px_18px_rgba(41,51,49,0.04)]
                       transition hover:border-[#C9C0DB] hover:bg-[#FCFBFA]"
            >
                <span>←</span>
                <span>Retour Dashboard</span>
            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- FLASH MESSAGES --}}
        {{-- ========================================================= --}}

        @if(session('success'))

            <div class="rounded-2xl border border-[#D5E5D9] bg-[#F0F7F1] p-4">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-9 w-9 flex-shrink-0 items-center
                               justify-center rounded-xl bg-white text-[#7FA68A]"
                    >
                        ✓
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-[#4D7257]">
                            Opération réussie
                        </p>

                        <p class="mt-1 text-xs leading-5 text-[#607467]">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="rounded-2xl border border-[#EACFD4] bg-[#FBF0F2] p-4">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-9 w-9 flex-shrink-0 items-center
                               justify-center rounded-xl bg-white text-[#9A5661]"
                    >
                        !
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-[#7F4C56]">
                            Une action n'a pas pu être effectuée
                        </p>

                        <p class="mt-1 text-xs leading-5 text-[#945864]">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- SUMMARY --}}
        {{-- ========================================================= --}}

        @php
            $pendingCount = $medecins->where('statut', 'en_attente')->count();
            $activeCount = $medecins->where('statut', 'active')->count();
            $refusedCount = $medecins->where('statut', 'refuse')->count();
        @endphp

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

            {{-- Total --}}
            <div class="rounded-[18px] border border-[#DDD8EC] bg-[#F4F1F9] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.08em]
                                   text-[#756D84]"
                        >
                            Total
                        </p>

                        <p
                            class="mt-2 text-4xl font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            {{ $medecins->count() }}
                        </p>

                        <p class="mt-1 text-xs text-[#756D84]">
                            médecins enregistrés
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center
                               rounded-2xl bg-white text-[#7567A8] shadow-sm"
                    >
                        ✚
                    </div>

                </div>

            </div>


            {{-- En attente --}}
            <div class="rounded-[18px] border border-[#E7DDBF] bg-[#FBF7EA] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.08em]
                                   text-[#8B7746]"
                        >
                            Demandes en attente
                        </p>

                        <p
                            class="mt-2 text-4xl font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            {{ $pendingCount }}
                        </p>

                        <p class="mt-1 text-xs text-[#8B7746]">
                            à valider ou refuser
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center
                               rounded-2xl bg-white text-[#B28B45] shadow-sm"
                    >
                        ⏳
                    </div>

                </div>

            </div>


            {{-- Actifs --}}
            <div class="rounded-[18px] border border-[#D8E6DC] bg-[#F1F7F2] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.08em]
                                   text-[#607467]"
                        >
                            Comptes actifs
                        </p>

                        <p
                            class="mt-2 text-4xl font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            {{ $activeCount }}
                        </p>

                        <p class="mt-1 text-xs text-[#607467]">
                            médecins actifs
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center
                               rounded-2xl bg-white text-[#7FA68A] shadow-sm"
                    >
                        ✓
                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- TABLE --}}
        {{-- ========================================================= --}}

        <div
            class="overflow-hidden rounded-[22px] border border-[#E3DDD8]
                   bg-white shadow-[0_5px_22px_rgba(41,51,49,0.045)]"
        >

            {{-- Table header --}}
            <div class="border-b border-[#EEEAE6] px-6 py-5">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2
                            class="text-2xl font-medium text-[#293331]"
                            style="font-family: 'Newsreader', serif;"
                        >
                            Liste des médecins
                        </h2>

                        <p class="mt-1 text-xs text-[#66706D]">
                            Consultez le statut de chaque compte et traitez les demandes en attente.
                        </p>

                    </div>

                    <div
                        class="inline-flex w-fit items-center gap-2 rounded-xl
                               bg-[#F1EFF8] px-3 py-2 text-xs font-semibold
                               text-[#655A88]"
                    >
                        <span class="h-2 w-2 rounded-full bg-[#7567A8]"></span>

                        {{ $medecins->count() }} médecin(s)
                    </div>

                </div>

            </div>


            {{-- Responsive --}}
            <div class="overflow-x-auto">

                <table class="min-w-full border-collapse">

                    <thead class="bg-[#FAF9F8]">

                        <tr>

                            <th
                                class="whitespace-nowrap px-6 py-4 text-left
                                       text-[10px] font-bold uppercase tracking-[0.08em]
                                       text-[#7D8581]"
                            >
                                Médecin
                            </th>

                            <th
                                class="whitespace-nowrap px-6 py-4 text-left
                                       text-[10px] font-bold uppercase tracking-[0.08em]
                                       text-[#7D8581]"
                            >
                                Email
                            </th>

                            <th
                                class="whitespace-nowrap px-6 py-4 text-left
                                       text-[10px] font-bold uppercase tracking-[0.08em]
                                       text-[#7D8581]"
                            >
                                Téléphone
                            </th>

                            <th
                                class="whitespace-nowrap px-6 py-4 text-left
                                       text-[10px] font-bold uppercase tracking-[0.08em]
                                       text-[#7D8581]"
                            >
                                Statut
                            </th>

                            <th
                                class="whitespace-nowrap px-6 py-4 text-right
                                       text-[10px] font-bold uppercase tracking-[0.08em]
                                       text-[#7D8581]"
                            >
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EEEAE6]">

                        @forelse($medecins as $medecin)

                            <tr class="group transition hover:bg-[#FBFAFD]">

                                {{-- Médecin --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-11 w-11 flex-shrink-0
                                                   items-center justify-center rounded-full
                                                   bg-[#F1EFF8] text-sm font-semibold
                                                   text-[#655A88]"
                                        >
                                            {{ strtoupper(substr($medecin->prenom ?? 'M', 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-[#293331]">
                                                {{ $medecin->prenom }} {{ $medecin->nom }}
                                            </p>

                                            <p class="mt-0.5 text-[11px] text-[#8B918E]">
                                                Compte médecin OncoCare
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td class="px-6 py-5">

                                    <span class="text-sm text-[#66706D]">
                                        {{ $medecin->email }}
                                    </span>

                                </td>


                                {{-- Téléphone --}}
                                <td class="px-6 py-5">

                                    <span class="text-sm text-[#66706D]">
                                        {{ $medecin->telephone ?? '—' }}
                                    </span>

                                </td>


                                {{-- Statut --}}
                                <td class="px-6 py-5">

                                    @if($medecin->statut === 'active')

                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                                   bg-[#EAF4EC] px-3 py-1.5 text-xs
                                                   font-semibold text-[#4B7655]"
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#7FA68A]"></span>
                                            Actif
                                        </span>

                                    @elseif($medecin->statut === 'en_attente')

                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                                   bg-[#FBF3DA] px-3 py-1.5 text-xs
                                                   font-semibold text-[#8B7746]"
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#C49A5A]"></span>
                                            En attente
                                        </span>

                                    @elseif($medecin->statut === 'refuse')

                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                                   bg-[#FBF0F2] px-3 py-1.5 text-xs
                                                   font-semibold text-[#8F5963]"
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#C98A97]"></span>
                                            Refusé
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                                   bg-[#F1F3F2] px-3 py-1.5 text-xs
                                                   font-semibold text-[#68716D]"
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#9AA39E]"></span>
                                            {{ ucfirst($medecin->statut ?? 'Inconnu') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Action --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-wrap justify-end gap-2">

                                        {{-- EN ATTENTE --}}
                                        @if($medecin->statut === 'en_attente')

                                            {{-- Valider --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.update', $medecin) }}"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="hidden"
                                                    name="role"
                                                    value="medecin"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="statut"
                                                    value="active"
                                                >

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-xl bg-[#16423C]
                                                           px-3.5 py-2 text-xs font-semibold
                                                           text-white transition
                                                           hover:bg-[#123832]"
                                                >
                                                    ✓ Valider
                                                </button>

                                            </form>


                                            {{-- Refuser --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.update', $medecin) }}"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="hidden"
                                                    name="role"
                                                    value="medecin"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="statut"
                                                    value="refuse"
                                                >

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-xl border border-[#EACFD4]
                                                           bg-[#FBF0F2]
                                                           px-3.5 py-2 text-xs font-semibold
                                                           text-[#8F5963] transition
                                                           hover:bg-[#F7E7EA]"
                                                >
                                                    × Refuser
                                                </button>

                                            </form>


                                        @else

                                            {{-- Modifier --}}
                                            <a
                                                href="{{ route('admin.users.edit', $medecin) }}"
                                                class="inline-flex items-center gap-2
                                                       rounded-xl border border-[#E3DDD8]
                                                       bg-white px-3.5 py-2 text-xs
                                                       font-semibold text-[#5E6863]
                                                       transition hover:bg-[#F8F7F5]"
                                            >
                                                Modifier
                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-16">

                                    <div class="mx-auto max-w-md text-center">

                                        <div
                                            class="mx-auto flex h-16 w-16 items-center
                                                   justify-center rounded-full
                                                   bg-[#F1EFF8] text-2xl text-[#7567A8]"
                                        >
                                            ✚
                                        </div>

                                        <h3
                                            class="mt-5 text-2xl font-medium text-[#293331]"
                                            style="font-family: 'Newsreader', serif;"
                                        >
                                            Aucun médecin
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-[#66706D]">
                                            Aucun compte médecin n'est actuellement
                                            enregistré sur la plateforme.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SECURITY INFO --}}
        {{-- ========================================================= --}}

        <div class="rounded-[20px] border border-[#DDD8EC] bg-[#F4F1F9] p-5">

            <div class="flex items-start gap-3">

                <div
                    class="flex h-10 w-10 flex-shrink-0 items-center
                           justify-center rounded-xl bg-white text-[#7567A8]"
                >
                    🔒
                </div>

                <div>

                    <p class="text-sm font-semibold text-[#655A88]">
                        Validation des comptes médecins
                    </p>

                    <p class="mt-1 max-w-3xl text-xs leading-5 text-[#716A82]">
                        Les demandes de compte médecin restent en attente
                        jusqu'à leur traitement par un administrateur.
                        Un médecin validé peut accéder à son espace médical,
                        tandis qu'un compte refusé ne peut pas utiliser les
                        fonctionnalités réservées aux médecins.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>