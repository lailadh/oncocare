<x-app-layout>

<div class="onco-page">
    <div class="onco-container">

        {{-- Header --}}
        <div class="onco-page-header flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div class="flex items-start gap-4">
                <div class="onco-page-icon role-patient">
                    ◷
                </div>

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800">
                        Mes rendez-vous
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Consultez vos rendez-vous médicaux.
                    </p>
                </div>
            </div>

            {{-- Bouton demande de rendez-vous --}}
            <a
                href="{{ route('patient.rendezvous.demande') }}"
                class="onco-btn"
            >
                + Demander un rendez-vous
            </a>

        </div>


        {{-- Retour dashboard --}}
        <div class="mb-6">
            <a
                href="{{ route('dashboard') }}"
                class="text-sm font-medium text-slate-600 hover:text-green-700"
            >
                ← Retour au dashboard
            </a>
        </div>


        {{-- Résumé --}}
        @php
            $totalRendezVous = $rendezVous->count();

            $enAttente = $rendezVous
                ->where('statut', 'en_attente')
                ->count();

            $planifies = $rendezVous
                ->whereIn('statut', ['confirme', 'terminee'])
                ->count();
        @endphp

        <div class="onco-summary-grid mb-8">

            <div class="onco-summary-card">
                <div class="text-sm text-slate-500">
                    Mes rendez-vous
                </div>

                <div class="mt-2 text-3xl font-bold text-slate-800">
                    {{ $planifies }}
                </div>

                <div class="mt-1 text-sm text-slate-500">
                    rendez-vous planifiés
                </div>
            </div>


            <div class="onco-summary-card">
                <div class="onco-page-icon role-patient mb-3">
                    ◷
                </div>

                <div class="text-sm text-slate-500">
                    En attente
                </div>

                <div class="mt-2 text-3xl font-bold text-slate-800">
                    {{ $enAttente }}
                </div>

                <div class="mt-1 text-sm text-slate-500">
                    demandes en attente de confirmation
                </div>
            </div>

        </div>


        {{-- Liste --}}
        <div class="onco-card">

            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800">
                    Historique des rendez-vous
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Retrouvez les informations principales de vos rendez-vous.
                </p>
            </div>


            @if($rendezVous->count())

                <div class="mb-4 text-sm text-slate-500">
                    {{ $rendezVous->count() }}
                    rendez-vous
                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead>
                            <tr class="border-b border-slate-200 text-left">
                                <th class="px-4 py-3 font-semibold text-slate-600">
                                    Date
                                </th>

                                <th class="px-4 py-3 font-semibold text-slate-600">
                                    Médecin
                                </th>

                                <th class="px-4 py-3 font-semibold text-slate-600">
                                    Motif
                                </th>

                                <th class="px-4 py-3 font-semibold text-slate-600">
                                    Statut
                                </th>

                                <th class="px-4 py-3 font-semibold text-slate-600">
                                    Action
                                </th>
                            </tr>
                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach($rendezVous as $rdv)

                                <tr class="hover:bg-slate-50">

                                    {{-- Date --}}
                                    <td class="px-4 py-4">

                                        @if($rdv->date_heure)

                                            <div class="font-semibold text-slate-800">
                                                {{ $rdv->date_heure->format('d/m/Y') }}
                                            </div>

                                            <div class="text-xs text-slate-500">
                                                {{ $rdv->date_heure->format('H:i') }}
                                            </div>

                                        @else

                                            <div class="font-semibold text-slate-500">
                                                Non planifié
                                            </div>

                                            <div class="text-xs text-slate-400">
                                                En attente d’une date
                                            </div>

                                        @endif

                                    </td>


                                    {{-- Médecin --}}
                                    <td class="px-4 py-4">

                                        @if($rdv->medecin && $rdv->medecin->utilisateur)

                                            <div class="font-semibold text-slate-800">
                                                Dr
                                                {{ $rdv->medecin->utilisateur->prenom }}
                                                {{ $rdv->medecin->utilisateur->nom }}
                                            </div>

                                            <div class="text-xs text-slate-500">
                                                Médecin associé
                                            </div>

                                        @else

                                            <span class="text-slate-400">
                                                Médecin non disponible
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Motif --}}
                                    <td class="px-4 py-4 text-slate-700">
                                        {{ $rdv->motif ?? 'Non précisé' }}
                                    </td>


                                    {{-- Statut --}}
                                    <td class="px-4 py-4">

                                        @if($rdv->statut === 'confirme')

                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Confirmé
                                            </span>

                                        @elseif($rdv->statut === 'en_attente')

                                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                En attente
                                            </span>

                                        @elseif($rdv->statut === 'terminee')

                                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                Terminée
                                            </span>

                                        @else

                                            <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                                {{ ucfirst($rdv->statut) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td class="px-4 py-4">

                                        <a
                                            href="{{ route('patient.rendezvous.show', $rdv) }}"
                                            class="font-semibold text-green-700 hover:text-green-900"
                                        >
                                            Voir les détails →
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="py-12 text-center">

                    <div class="text-4xl mb-4">
                        ◷
                    </div>

                    <h3 class="text-lg font-semibold text-slate-800">
                        Aucun rendez-vous
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Vous n’avez encore aucun rendez-vous.
                    </p>

                    <div class="mt-6">

                        <a
                            href="{{ route('patient.rendezvous.demande') }}"
                            class="onco-btn"
                        >
                            + Demander un rendez-vous
                        </a>

                    </div>

                </div>

            @endif

        </div>


        {{-- Information --}}
        <div class="onco-info-card mt-6">

            <div class="flex gap-3">

                <div class="text-lg">
                    ♡
                </div>

                <div>

                    <h3 class="font-semibold text-slate-800">
                        Suivi de vos rendez-vous
                    </h3>

                    <p class="mt-1 text-sm text-slate-600">
                        Consultez le statut de chaque rendez-vous.
                        Votre médecin vous informera de toute modification ou confirmation.
                    </p>

                </div>

            </div>

        </div>

    </div>
</div>

</x-app-layout>
