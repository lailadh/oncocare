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


                {{-- ========================================================= --}}
                {{-- HEADER --}}
                {{-- ========================================================= --}}

                <div class="pt-8 md:pt-10">

                    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

                        <div class="flex items-start gap-4">

                            {{-- Icon --}}
                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-[#DCE4DD] bg-[#EEF5EF] text-[#16423C]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M7 2v4M17 2v4"/>
                                    <rect x="3" y="4" width="18" height="17" rx="3"/>
                                    <path d="M3 10h18"/>
                                    <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                                </svg>
                            </div>

                            <div>
                                <div class="mb-2 flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.16em] text-[#7FA68A]">
                                    <span>Mon espace patient</span>
                                </div>

                                <h1 class="text-3xl font-semibold tracking-tight text-[#263330] md:text-4xl">
                                    Mes rendez-vous
                                </h1>

                                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#667085] md:text-[15px]">
                                    Retrouvez vos rendez-vous médicaux et suivez facilement leur statut.
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- Retour --}}
                    <div class="mt-5">

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-2 text-sm font-medium text-[#667085] transition hover:text-[#16423C]"
                        >
                            <span>←</span>
                            <span>Retour au dashboard</span>
                        </a>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- SUMMARY --}}
                {{-- ========================================================= --}}

                <div class="mt-8 grid gap-4 md:grid-cols-3">

                    {{-- Total --}}
                    <div
                        class="rounded-2xl border border-[#E3DDD8] bg-white p-5 shadow-[0_5px_22px_rgba(38,51,48,0.045)]"
                    >
                        <div class="flex items-start justify-between gap-4">

                            <div>
                                <p class="text-sm font-medium text-[#667085]">
                                    Total des rendez-vous
                                </p>

                                <div class="mt-3 text-3xl font-semibold text-[#263330]">
                                    {{ $totalRendezVous }}
                                </div>

                                <p class="mt-1 text-xs text-[#8A9490]">
                                    dans votre historique
                                </p>
                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#EEF5EF] text-[#16423C]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect x="3" y="4" width="18" height="17" rx="3"/>
                                    <path d="M7 2v4M17 2v4M3 10h18"/>
                                </svg>
                            </div>

                        </div>
                    </div>


                    {{-- Confirmés --}}
                    <div
                        class="rounded-2xl border border-[#DCE7DE] bg-white p-5 shadow-[0_5px_22px_rgba(38,51,48,0.045)]"
                    >
                        <div class="flex items-start justify-between gap-4">

                            <div>
                                <p class="text-sm font-medium text-[#667085]">
                                    Confirmés
                                </p>

                                <div class="mt-3 text-3xl font-semibold text-[#4D7257]">
                                    {{ $confirme }}
                                </div>

                                <p class="mt-1 text-xs text-[#8A9490]">
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
                        class="rounded-2xl border border-[#EEE4CE] bg-white p-5 shadow-[0_5px_22px_rgba(38,51,48,0.045)]"
                    >
                        <div class="flex items-start justify-between gap-4">

                            <div>
                                <p class="text-sm font-medium text-[#667085]">
                                    En attente
                                </p>

                                <div class="mt-3 text-3xl font-semibold text-[#8A6B32]">
                                    {{ $enAttente }}
                                </div>

                                <p class="mt-1 text-xs text-[#8A9490]">
                                    demandes à confirmer
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


                {{-- ========================================================= --}}
                {{-- MAIN CARD --}}
                {{-- ========================================================= --}}

                <div
                    class="mt-8 overflow-hidden rounded-[22px] border border-[#E3DDD8] bg-white shadow-[0_8px_30px_rgba(38,51,48,0.05)]"
                >

                    {{-- Card header --}}
                    <div
                        class="border-b border-[#EEE9E4] px-6 py-6 md:px-7"
                    >

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBF1F3] text-[#B98591]"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="M6 2v4M18 2v4"/>
                                            <rect x="3" y="4" width="18" height="17" rx="3"/>
                                            <path d="M3 10h18"/>
                                            <path d="M8 14h.01M12 14h.01M16 14h.01"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <h2 class="text-xl font-semibold text-[#263330]">
                                            Historique des rendez-vous
                                        </h2>

                                        <p class="mt-1 text-sm text-[#667085]">
                                            Consultez les informations et le statut de chaque rendez-vous.
                                        </p>
                                    </div>

                                </div>

                            </div>


                            <div
                                class="inline-flex w-fit items-center rounded-full bg-[#F3F4F1] px-3 py-1.5 text-xs font-semibold text-[#667085]"
                            >
                                {{ $totalRendezVous }}
                                {{ $totalRendezVous > 1 ? 'rendez-vous' : 'rendez-vous' }}
                            </div>

                        </div>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- APPOINTMENTS --}}
                    {{-- ===================================================== --}}

                    @if($rendezVous->count())

                        <div class="divide-y divide-[#EEE9E4]">

                            @foreach($rendezVous as $rdv)

                                @php
                                    $medecin = $rdv->medecin?->utilisateur;
                                @endphp

                                <div
                                    class="group px-6 py-6 transition duration-200 hover:bg-[#FCFBF8] md:px-7"
                                >

                                    <div class="grid gap-6 lg:grid-cols-[1.1fr_1.2fr_1.3fr_auto] lg:items-center">

                                        {{-- DATE --}}
                                        <div>

                                            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-[#8A9490]">
                                                Date
                                            </p>

                                            @if($rdv->date_heure)

                                                <div class="mt-2">

                                                    <div class="text-lg font-semibold text-[#263330]">
                                                        {{ $rdv->date_heure->format('d/m/Y') }}
                                                    </div>

                                                    <div class="mt-1 inline-flex items-center gap-1.5 text-sm font-medium text-[#16423C]">

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                        >
                                                            <circle cx="12" cy="12" r="9"/>
                                                            <path d="M12 7v5l3 2"/>
                                                        </svg>

                                                        {{ $rdv->date_heure->format('H:i') }}

                                                    </div>

                                                </div>

                                            @else

                                                <div class="mt-2">
                                                    <div class="text-base font-semibold text-[#8A9490]">
                                                        Date non planifiée
                                                    </div>

                                                    <div class="mt-1 text-xs text-[#B0B7B3]">
                                                        En attente d'une confirmation
                                                    </div>
                                                </div>

                                            @endif

                                        </div>


                                        {{-- MEDECIN --}}
                                        <div>

                                            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-[#8A9490]">
                                                Médecin
                                            </p>

                                            @if($medecin)

                                                <div class="mt-2 flex items-center gap-3">

                                                    <div
                                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#EEF5EF] text-sm font-semibold text-[#16423C]"
                                                    >
                                                        {{ strtoupper(substr($medecin->prenom, 0, 1)) }}
                                                    </div>

                                                    <div>
                                                        <p class="text-sm font-semibold text-[#263330]">
                                                            Dr {{ $medecin->prenom }} {{ $medecin->nom }}
                                                        </p>

                                                        <p class="mt-0.5 text-xs text-[#8A9490]">
                                                            Médecin associé
                                                        </p>
                                                    </div>

                                                </div>

                                            @else

                                                <p class="mt-2 text-sm text-[#9AA39F]">
                                                    Médecin non disponible
                                                </p>

                                            @endif

                                        </div>


                                        {{-- MOTIF --}}
                                        <div>

                                            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-[#8A9490]">
                                                Motif
                                            </p>

                                            <p class="mt-2 max-w-sm text-sm font-medium leading-6 text-[#3D4945]">
                                                {{ $rdv->motif ?? 'Non précisé' }}
                                            </p>

                                        </div>


                                        {{-- STATUS + ACTION --}}
                                        <div class="flex flex-col items-start gap-3 lg:items-end">

                                            @if($rdv->statut === 'confirme')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#EEF5EF] px-3 py-1.5 text-xs font-semibold text-[#4D7257]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#7FA68A]"></span>
                                                    Confirmé
                                                </span>

                                            @elseif($rdv->statut === 'en_attente')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#F8F1E1] px-3 py-1.5 text-xs font-semibold text-[#8A6B32]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#C49A5A]"></span>
                                                    En attente
                                                </span>

                                            @elseif($rdv->statut === 'terminee')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#F1F3F2] px-3 py-1.5 text-xs font-semibold text-[#66736E]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#98A39E]"></span>
                                                    Terminée
                                                </span>

                                            @elseif($rdv->statut === 'refuse')

                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-[#FBF1F3] px-3 py-1.5 text-xs font-semibold text-[#9A6470]"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#D99AA6]"></span>
                                                    Refusée
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex items-center rounded-full bg-[#F1F3F2] px-3 py-1.5 text-xs font-semibold text-[#66736E]"
                                                >
                                                    {{ ucfirst($rdv->statut) }}
                                                </span>

                                            @endif


                                            <a
                                                href="{{ route('patient.rendezvous.show', $rdv) }}"
                                                class="inline-flex items-center gap-1 text-sm font-semibold text-[#16423C] transition hover:gap-2 hover:text-[#0F302C]"
                                            >
                                                <span>Voir les détails</span>
                                                <span>→</span>
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        {{-- ================================================= --}}
                        {{-- EMPTY STATE --}}
                        {{-- ================================================= --}}

                        <div class="px-6 py-16 text-center md:px-10">

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#EEF5EF] text-[#16423C]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-7 w-7"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <rect x="3" y="4" width="18" height="17" rx="3"/>
                                    <path d="M7 2v4M17 2v4M3 10h18"/>
                                    <path d="M12 14v3"/>
                                    <path d="M12 19h.01"/>
                                </svg>
                            </div>

                            <h3 class="mt-5 text-lg font-semibold text-[#263330]">
                                Aucun rendez-vous
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#667085]">
                                Vous n'avez encore aucun rendez-vous enregistré.
                                Votre médecin planifiera vos rendez-vous dans votre espace.
                            </p>

                        </div>

                    @endif

                </div>


                {{-- ========================================================= --}}
                {{-- INFORMATION CARD --}}
                {{-- ========================================================= --}}

                <div
                    class="mt-6 mb-10 overflow-hidden rounded-2xl border border-[#E8E0D1] bg-[#FBF8EF]"
                >

                    <div class="flex gap-4 p-5 md:p-6">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-[#C49A5A] shadow-[0_3px_12px_rgba(38,51,48,0.04)]"
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
                                <path d="M12 10v6"/>
                                <path d="M12 7h.01"/>
                            </svg>
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-[#3B403D]">
                                Suivi de vos rendez-vous
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-[#6F7773]">
                                Vos rendez-vous sont planifiés par votre médecin.
                                Vous recevrez une notification dès qu'un rendez-vous
                                est programmé ou modifié.
                            </p>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>