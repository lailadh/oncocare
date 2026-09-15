<x-app-layout>

    <div class="min-h-screen bg-[#F7F6F1]">

        <div class="onco-page">
            <div class="onco-container">

                @php
                    $totalRendezVous = $rendezVous->count();

                    $enAttente = $rendezVous
                        ->where('statut', 'en_attente')
                        ->count();

                    $confirme = $rendezVous
                        ->where('statut', 'confirme')
                        ->count();

                    $terminees = $rendezVous
                        ->where('statut', 'terminee')
                        ->count();
                @endphp


                {{-- ====================================================== --}}
                {{-- HEADER --}}
                {{-- ====================================================== --}}

                <div class="pt-8 md:pt-10">

                    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

                        <div>

                            {{-- Breadcrumb / retour --}}
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex items-center gap-2 text-sm font-medium text-[#667085] transition hover:text-[#514B70]"
                            >
                                <span>←</span>
                                <span>Retour au dashboard</span>
                            </a>


                            <div class="mt-5 flex items-start gap-4">

                                {{-- Icon --}}
                                <div
                                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-[#DED9EB] bg-[#F1EFF8] text-[#7567A8]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="3"
                                            y="4"
                                            width="18"
                                            height="17"
                                            rx="3"
                                        />
                                        <path d="M7 2v4M17 2v4M3 10h18"/>
                                        <path d="M8 14h.01M12 14h.01M16 14h.01"/>
                                        <path d="M8 18h.01M12 18h.01"/>
                                    </svg>
                                </div>


                                <div>

                                    <div class="mb-2 text-xs font-semibold uppercase tracking-[0.16em] text-[#7567A8]">
                                        Espace médecin
                                    </div>

                                    <h1 class="text-3xl font-semibold tracking-tight text-[#34324A] md:text-4xl">
                                        Mes rendez-vous
                                    </h1>

                                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#667085] md:text-[15px]">
                                        Consultez les rendez-vous de vos patients et
                                        traitez les demandes en attente.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- CTA --}}
                        <div class="shrink-0">

                            <a
                                href="{{ route('rendezvous.create') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#514B70] px-5 py-3 text-sm font-semibold text-white shadow-[0_8px_24px_rgba(81,75,112,0.16)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#45405F] hover:shadow-[0_12px_28px_rgba(81,75,112,0.20)]"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M12 5v14M5 12h14"/>
                                </svg>

                                <span>Créer un rendez-vous</span>

                            </a>

                        </div>

                    </div>

                </div>


                {{-- ====================================================== --}}
                {{-- ALERT SUCCESS --}}
                {{-- ====================================================== --}}

                @if(session('success'))

                    <div
                        class="mt-7 rounded-2xl border border-[#D5E5D9] bg-[#F0F7F1] px-5 py-4"
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[#7FA68A] shadow-sm"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4.5 w-4.5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="m8 12 2.5 2.5L16 9"/>
                                </svg>
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#4D7257]">
                                    Opération réussie
                                </p>

                                <p class="mt-1 text-sm leading-6 text-[#66736E]">
                                    {{ session('success') }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ====================================================== --}}
                {{-- ERROR --}}
                {{-- ====================================================== --}}

                @if($errors->has('rendezVous'))

                    <div
                        class="mt-5 rounded-2xl border border-[#F0D7DF] bg-[#FDF3F5] px-5 py-4"
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[#C9788D] shadow-sm"
                            >
                                !
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#9A5661]">
                                    Attention
                                </p>

                                <p class="mt-1 text-sm leading-6 text-[#756D84]">
                                    {{ $errors->first('rendezVous') }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ====================================================== --}}
                {{-- SUMMARY --}}
                {{-- ====================================================== --}}

                <div class="mt-8 grid gap-4 md:grid-cols-3">

                    {{-- Total --}}
                    <div
                        class="rounded-2xl border border-[#E3DDD8] bg-white p-5 shadow-[0_5px_22px_rgba(52,50,74,0.045)]"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p class="text-sm font-medium text-[#667085]">
                                    Total des rendez-vous
                                </p>

                                <div class="mt-3 text-3xl font-semibold text-[#34324A]">
                                    {{ $totalRendezVous }}
                                </div>

                                <p class="mt-1 text-xs text-[#8A8894]">
                                    rendez-vous enregistrés
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F1EFF8] text-[#7567A8]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="17"
                                        rx="3"
                                    />
                                    <path d="M7 2v4M17 2v4M3 10h18"/>
                                </svg>
                            </div>

                        </div>

                    </div>


                    {{-- Confirmés --}}
                    <div
                        class="rounded-2xl border border-[#DCE7DE] bg-white p-5 shadow-[0_5px_22px_rgba(52,50,74,0.045)]"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p class="text-sm font-medium text-[#667085]">
                                    Confirmés
                                </p>

                                <div class="mt-3 text-3xl font-semibold text-[#4D7257]">
                                    {{ $confirme }}
                                </div>

                                <p class="mt-1 text-xs text-[#88928D]">
                                    rendez-vous validés
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#EEF5EF] text-[#7FA68A]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="m8 12 2.5 2.5L16 9"/>
                                </svg>
                            </div>

                        </div>

                    </div>


                    {{-- En attente --}}
                    <div
                        class="rounded-2xl border border-[#EEE4CE] bg-white p-5 shadow-[0_5px_22px_rgba(52,50,74,0.045)]"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p class="text-sm font-medium text-[#667085]">
                                    En attente
                                </p>

                                <div class="mt-3 text-3xl font-semibold text-[#8A6B32]">
                                    {{ $enAttente }}
                                </div>

                                <p class="mt-1 text-xs text-[#88928D]">
                                    demandes à traiter
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#F8F1E1] text-[#C49A5A]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================== --}}
                {{-- MAIN APPOINTMENTS CARD --}}
                {{-- ====================================================== --}}

                <div
                    class="mt-8 overflow-hidden rounded-[22px] border border-[#E3DDD8] bg-white shadow-[0_8px_30px_rgba(52,50,74,0.05)]"
                >

                    {{-- Header --}}
                    <div
                        class="border-b border-[#EEE9E4] px-6 py-6 md:px-7"
                    >

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#F1EFF8] text-[#7567A8]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="3"
                                            y="4"
                                            width="18"
                                            height="17"
                                            rx="3"
                                        />
                                        <path d="M7 2v4M17 2v4M3 10h18"/>
                                        <path d="M8 14h.01M12 14h.01M16 14h.01"/>
                                    </svg>
                                </div>

                                <div>

                                    <h2 class="text-xl font-semibold text-[#34324A]">
                                        Liste des rendez-vous
                                    </h2>

                                    <p class="mt-1 text-sm text-[#667085]">
                                        Retrouvez les rendez-vous de vos patients et
                                        traitez les demandes en attente.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="inline-flex w-fit items-center rounded-full bg-[#F1EFF8] px-3 py-1.5 text-xs font-semibold text-[#655A88]"
                            >
                                {{ $totalRendezVous }} rendez-vous
                            </span>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- EMPTY --}}
                    {{-- ================================================== --}}

                    @if($rendezVous->isEmpty())

                        <div class="px-6 py-16 text-center md:px-10">

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F1EFF8] text-[#7567A8]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-7 w-7"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="17"
                                        rx="3"
                                    />
                                    <path d="M7 2v4M17 2v4M3 10h18"/>
                                    <path d="M12 14v3"/>
                                    <path d="M12 19h.01"/>
                                </svg>
                            </div>

                            <h3 class="mt-5 text-lg font-semibold text-[#34324A]">
                                Aucun rendez-vous trouvé
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#667085]">
                                Aucun rendez-vous n'est actuellement enregistré
                                pour vos patients.
                            </p>

                            <a
                                href="{{ route('rendezvous.create') }}"
                                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-[#514B70] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#45405F]"
                            >
                                <span>+</span>
                                <span>Créer un rendez-vous</span>
                            </a>

                        </div>

                    @else


                        {{-- ================================================== --}}
                        {{-- DESKTOP TABLE --}}
                        {{-- ================================================== --}}

                        <div class="hidden overflow-x-auto lg:block">

                            <table class="w-full">

                                <thead>

                                    <tr class="border-b border-[#EEE9E4] bg-[#FCFBF9]">

                                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.08em] text-[#8A8894]">
                                            Patient
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-[0.08em] text-[#8A8894]">
                                            Date
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-[0.08em] text-[#8A8894]">
                                            Heure
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-[0.08em] text-[#8A8894]">
                                            Motif
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-[0.08em] text-[#8A8894]">
                                            Statut
                                        </th>

                                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.08em] text-[#8A8894]">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-[#F0ECE8]">

                                    @foreach($rendezVous as $rendezVousItem)

                                        <tr
                                            class="group transition duration-200 hover:bg-[#FCFBF9]"
                                        >

                                            {{-- Patient --}}
                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#F1EFF8] text-sm font-semibold text-[#655A88]"
                                                    >
                                                        {{
                                                            strtoupper(
                                                                substr(
                                                                    $rendezVousItem->patient->utilisateur->prenom ?? 'P',
                                                                    0,
                                                                    1
                                                                )
                                                            )
                                                        }}
                                                    </div>

                                                    <div class="min-w-0">

                                                        <p class="truncate text-sm font-semibold text-[#34324A]">
                                                            {{ $rendezVousItem->patient->utilisateur->prenom ?? '' }}
                                                            {{ $rendezVousItem->patient->utilisateur->nom ?? '' }}
                                                        </p>

                                                        <p class="mt-0.5 text-xs text-[#8A8894]">
                                                            Patient OncoCare
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- Date --}}
                                            <td class="px-4 py-5">

                                                @if($rendezVousItem->date_heure)

                                                    <p class="text-sm font-semibold text-[#34324A]">
                                                        {{ $rendezVousItem->date_heure->format('d/m/Y') }}
                                                    </p>

                                                @else

                                                    <p class="text-sm font-medium text-[#8A6B32]">
                                                        Non planifiée
                                                    </p>

                                                    <p class="mt-1 text-xs text-[#A69A81]">
                                                        Date à définir
                                                    </p>

                                                @endif

                                            </td>


                                            {{-- Heure --}}
                                            <td class="px-4 py-5">

                                                @if($rendezVousItem->date_heure)

                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-lg bg-[#F8F6FB] px-2.5 py-1.5 text-xs font-semibold text-[#655A88]"
                                                    >

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="h-3.5 w-3.5"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                        >
                                                            <circle cx="12" cy="12" r="9"/>
                                                            <path d="M12 7v5l3 2"/>
                                                        </svg>

                                                        {{ $rendezVousItem->date_heure->format('H:i') }}

                                                    </span>

                                                @else

                                                    <span class="text-sm text-[#A5AAA7]">
                                                        —
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- Motif --}}
                                            <td class="px-4 py-5">

                                                <p class="max-w-[220px] text-sm leading-5 text-[#59625E]">
                                                    {{ $rendezVousItem->motif ?? 'Non renseigné' }}
                                                </p>

                                            </td>


                                            {{-- Statut --}}
                                            <td class="px-4 py-5">

                                                @if($rendezVousItem->statut === 'en_attente')

                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-full bg-[#F8F1E1] px-3 py-1.5 text-xs font-semibold text-[#8A6B32]"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#C49A5A]"></span>
                                                        En attente
                                                    </span>

                                                @elseif($rendezVousItem->statut === 'confirme')

                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-full bg-[#EEF5EF] px-3 py-1.5 text-xs font-semibold text-[#4D7257]"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#7FA68A]"></span>
                                                        Confirmé
                                                    </span>

                                                @elseif($rendezVousItem->statut === 'refuse')

                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-full bg-[#FBF1F3] px-3 py-1.5 text-xs font-semibold text-[#9A6470]"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#D99AA6]"></span>
                                                        Refusé
                                                    </span>

                                                @elseif($rendezVousItem->statut === 'terminee')

                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-full bg-[#F1F2F3] px-3 py-1.5 text-xs font-semibold text-[#6D6878]"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#96919E]"></span>
                                                        Terminé
                                                    </span>

                                                @else

                                                    <span
                                                        class="inline-flex items-center rounded-full bg-[#F1EFF8] px-3 py-1.5 text-xs font-semibold text-[#655A88]"
                                                    >
                                                        {{ ucfirst($rendezVousItem->statut) }}
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- Actions --}}
                                            <td class="px-6 py-5">

                                                <div class="flex flex-wrap justify-end gap-2">

                                                    {{-- Voir --}}
                                                    <a
                                                        href="{{ route('rendezvous.show', $rendezVousItem) }}"
                                                        class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-[#DDD9E7] bg-white px-3 py-2 text-xs font-semibold text-[#5E5877] transition hover:border-[#C7C0DB] hover:bg-[#F8F6FB]"
                                                    >
                                                        Voir
                                                        <span>→</span>
                                                    </a>


                                                    {{-- Planifier --}}
                                                    @if($rendezVousItem->statut === 'en_attente')

                                                        <a
                                                            href="{{ route('rendezvous.edit', $rendezVousItem) }}"
                                                            class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-[#514B70] px-3 py-2 text-xs font-semibold text-white transition hover:bg-[#45405F]"
                                                        >
                                                            Planifier
                                                        </a>

                                                    @endif


                                                    {{-- Supprimer --}}
                                                    <form
                                                        method="POST"
                                                        action="{{ route('rendezvous.destroy', $rendezVousItem) }}"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');"
                                                    >

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="inline-flex items-center justify-center rounded-lg border border-[#E9D8DE] bg-[#FFF9FA] px-3 py-2 text-xs font-semibold text-[#9A6470] transition hover:bg-[#FDF0F3]"
                                                        >
                                                            Supprimer
                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        {{-- ================================================== --}}
                        {{-- MOBILE / TABLET CARDS --}}
                        {{-- ================================================== --}}

                        <div class="divide-y divide-[#EEE9E4] lg:hidden">

                            @foreach($rendezVous as $rendezVousItem)

                                <div class="p-5 sm:p-6">

                                    <div class="flex items-start justify-between gap-4">

                                        {{-- Patient --}}
                                        <div class="flex min-w-0 items-center gap-3">

                                            <div
                                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#F1EFF8] text-sm font-semibold text-[#655A88]"
                                            >
                                                {{
                                                    strtoupper(
                                                        substr(
                                                            $rendezVousItem->patient->utilisateur->prenom ?? 'P',
                                                            0,
                                                            1
                                                        )
                                                    )
                                                }}
                                            </div>

                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-[#34324A]">
                                                    {{ $rendezVousItem->patient->utilisateur->prenom ?? '' }}
                                                    {{ $rendezVousItem->patient->utilisateur->nom ?? '' }}
                                                </p>

                                                <p class="mt-0.5 text-xs text-[#8A8894]">
                                                    Patient OncoCare
                                                </p>

                                            </div>

                                        </div>


                                        {{-- Status --}}
                                        <div class="shrink-0">

                                            @if($rendezVousItem->statut === 'en_attente')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#F8F1E1] px-3 py-1.5 text-xs font-semibold text-[#8A6B32]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#C49A5A]"></span>
                                                    En attente
                                                </span>

                                            @elseif($rendezVousItem->statut === 'confirme')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#EEF5EF] px-3 py-1.5 text-xs font-semibold text-[#4D7257]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#7FA68A]"></span>
                                                    Confirmé
                                                </span>

                                            @elseif($rendezVousItem->statut === 'refuse')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#FBF1F3] px-3 py-1.5 text-xs font-semibold text-[#9A6470]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#D99AA6]"></span>
                                                    Refusé
                                                </span>

                                            @elseif($rendezVousItem->statut === 'terminee')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#F1F2F3] px-3 py-1.5 text-xs font-semibold text-[#6D6878]"
                                                >
                                                    Terminé
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex rounded-full bg-[#F1EFF8] px-3 py-1.5 text-xs font-semibold text-[#655A88]"
                                                >
                                                    {{ ucfirst($rendezVousItem->statut) }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- Details --}}
                                    <div class="mt-5 grid gap-4 sm:grid-cols-2">

                                        <div
                                            class="rounded-xl bg-[#FCFBF9] p-4"
                                        >

                                            <p class="text-[11px] font-semibold uppercase tracking-[0.12em] text-[#8A8894]">
                                                Date & heure
                                            </p>

                                            @if($rendezVousItem->date_heure)

                                                <p class="mt-2 text-sm font-semibold text-[#34324A]">
                                                    {{ $rendezVousItem->date_heure->format('d/m/Y') }}
                                                </p>

                                                <p class="mt-1 text-sm font-medium text-[#655A88]">
                                                    {{ $rendezVousItem->date_heure->format('H:i') }}
                                                </p>

                                            @else

                                                <p class="mt-2 text-sm font-semibold text-[#8A6B32]">
                                                    Non planifiée
                                                </p>

                                                <p class="mt-1 text-xs text-[#A69A81]">
                                                    Date à définir
                                                </p>

                                            @endif

                                        </div>


                                        <div
                                            class="rounded-xl bg-[#FCFBF9] p-4"
                                        >

                                            <p class="text-[11px] font-semibold uppercase tracking-[0.12em] text-[#8A8894]">
                                                Motif
                                            </p>

                                            <p class="mt-2 text-sm leading-5 text-[#59625E]">
                                                {{ $rendezVousItem->motif ?? 'Non renseigné' }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- Actions --}}
                                    <div class="mt-5 flex flex-col gap-2 sm:flex-row">

                                        <a
                                            href="{{ route('rendezvous.show', $rendezVousItem) }}"
                                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-[#DDD9E7] bg-white px-4 py-2.5 text-sm font-semibold text-[#5E5877] transition hover:bg-[#F8F6FB]"
                                        >
                                            Voir les détails
                                            <span>→</span>
                                        </a>


                                        @if($rendezVousItem->statut === 'en_attente')

                                            <a
                                                href="{{ route('rendezvous.edit', $rendezVousItem) }}"
                                                class="inline-flex flex-1 items-center justify-center rounded-xl bg-[#514B70] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#45405F]"
                                            >
                                                Planifier
                                            </a>

                                        @endif


                                        <form
                                            method="POST"
                                            action="{{ route('rendezvous.destroy', $rendezVousItem) }}"
                                            class="sm:w-auto"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex w-full items-center justify-center rounded-xl border border-[#E9D8DE] bg-[#FFF9FA] px-4 py-2.5 text-sm font-semibold text-[#9A6470] transition hover:bg-[#FDF0F3] sm:w-auto"
                                            >
                                                Supprimer
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>


                {{-- ====================================================== --}}
                {{-- PRIVACY INFO --}}
                {{-- ====================================================== --}}

                <div class="mt-6 mb-10">

                    <div
                        class="overflow-hidden rounded-2xl border border-[#DED9EB] bg-[#F8F6FB]"
                    >

                        <div class="flex gap-4 p-5 md:p-6">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-[#7567A8] shadow-[0_3px_12px_rgba(52,50,74,0.04)]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="5"
                                        y="11"
                                        width="14"
                                        height="10"
                                        rx="2"
                                    />
                                    <path d="M8 11V8a4 4 0 0 1 8 0v3"/>
                                    <path d="M12 15v3"/>
                                </svg>
                            </div>

                            <div>

                                <h3 class="text-sm font-semibold text-[#655A88]">
                                    Confidentialité des rendez-vous
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-[#756D84]">
                                    Les rendez-vous affichés correspondent uniquement
                                    à vos patients associés. Les demandes en attente
                                    peuvent être planifiées par le médecin connecté.
                                    Les informations médicales restent accessibles
                                    uniquement aux utilisateurs autorisés.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</x-app-layout>