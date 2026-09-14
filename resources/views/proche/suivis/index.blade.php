<x-app-layout>

    <div class="onco-page">
        <div class="onco-container">

            {{-- Header --}}
            <div class="onco-page-header">

                <div class="onco-title-wrap">

                    <div class="onco-page-icon role-proche">
                        ♡
                    </div>

                    <div>
                        <h1 class="onco-page-title">
                            Suivis accessibles
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les informations de suivi médical auxquelles
                            vous êtes autorisé.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Résumé --}}
            <div class="onco-summary-grid">

                <div class="onco-summary-card">

                    <div class="onco-summary-label">
                        Suivis accessibles
                    </div>

                    <div class="onco-summary-value">
                        {{ $suivis->count() }}
                    </div>

                    <div class="onco-summary-icon">
                        🩺
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div class="onco-summary-label">
                        Patients concernés
                    </div>

                    <div class="onco-summary-value">
                        {{ $suivis->pluck('id_patient')->unique()->count() }}
                    </div>

                    <div class="onco-summary-icon">
                        👥
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div class="onco-summary-label">
                        Dernier suivi
                    </div>

                    <div class="onco-summary-value">
                        @if($suivis->count())
                            {{ \Carbon\Carbon::parse($suivis->first()->date_suivi)->format('d/m/Y') }}
                        @else
                            —
                        @endif
                    </div>

                    <div class="onco-summary-icon">
                        📅
                    </div>

                </div>

            </div>


            {{-- Liste --}}
            <div class="onco-card">

                <div class="onco-card-header">

                    <div>
                        <h2>
                            Historique des suivis
                        </h2>

                        <p class="onco-card-description">
                            Vous pouvez consulter uniquement les suivis
                            auxquels le patient vous a donné accès.
                        </p>
                    </div>

                </div>


                @if($suivis->count())

                    <div class="space-y-5">

                        @foreach($suivis as $suivi)

                            <div class="onco-info-card">

                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                                    {{-- Informations --}}
                                    <div class="flex items-start gap-4">

                                        <div class="onco-info-icon role-proche">
                                            🩺
                                        </div>

                                        <div>

                                            <div class="flex flex-wrap items-center gap-3">

                                                <h3 class="text-lg font-semibold text-slate-800">
                                                    Suivi du
                                                    {{ \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y') }}
                                                </h3>

                                                <span class="onco-status onco-status-success">
                                                    <span class="onco-status-dot"></span>
                                                    Accessible
                                                </span>

                                            </div>


                                            <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-sm">

                                                <div>
                                                    <span class="font-medium text-slate-500">
                                                        Patient
                                                    </span>

                                                    <p class="text-slate-800 font-medium">
                                                        {{ $suivi->patient->utilisateur->prenom ?? '' }}
                                                        {{ $suivi->patient->utilisateur->nom ?? '' }}
                                                    </p>
                                                </div>


                                                <div>
                                                    <span class="font-medium text-slate-500">
                                                        Type de cancer
                                                    </span>

                                                    <p class="text-slate-800">
                                                        {{ $suivi->type_cancer }}
                                                    </p>
                                                </div>


                                                <div>
                                                    <span class="font-medium text-slate-500">
                                                        Stade
                                                    </span>

                                                    <p class="text-slate-800">
                                                        {{ $suivi->stade }}
                                                    </p>
                                                </div>


                                                @if($suivi->medecin && $suivi->medecin->utilisateur)

                                                    <div>
                                                        <span class="font-medium text-slate-500">
                                                            Médecin
                                                        </span>

                                                        <p class="text-slate-800">
                                                            Dr.
                                                            {{ $suivi->medecin->utilisateur->prenom }}
                                                            {{ $suivi->medecin->utilisateur->nom }}
                                                        </p>
                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    {{-- Action --}}
                                    <div class="lg:flex-shrink-0">

                                        <a href="{{ route('proche.suivis.show', $suivi) }}"
                                           class="onco-btn onco-btn-proche">

                                            Consulter le suivi

                                            <span class="ml-2">
                                                →
                                            </span>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="onco-empty-state">

                        <div class="onco-empty-icon">
                            🩺
                        </div>

                        <h3>
                            Aucun suivi disponible
                        </h3>

                        <p>
                            Aucun suivi médical n'est actuellement disponible
                            pour les patients auxquels vous avez accès.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Confidentialité --}}
            <div class="onco-info-card role-proche">

                <div class="onco-info-icon">
                    🔒
                </div>

                <div>

                    <div class="onco-info-title">
                        Accès protégé
                    </div>

                    <div class="onco-info-text">
                        Les données affichées sont accessibles uniquement grâce
                        à une autorisation active accordée par le patient.
                        Vous ne pouvez consulter aucune information supplémentaire
                        sans autorisation.
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>