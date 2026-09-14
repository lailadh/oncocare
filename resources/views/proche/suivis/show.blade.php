<x-app-layout>

    <div class="onco-page">
        <div class="onco-container">

            {{-- Retour --}}
            <div class="mb-6">
                <a href="{{ route('proche.suivis.index') }}"
                   class="onco-back-link">
                    ← Retour aux suivis
                </a>
            </div>


            {{-- Header --}}
            <div class="onco-page-header">

                <div class="onco-title-wrap">

                    <div class="onco-page-icon role-proche">
                        🩺
                    </div>

                    <div>
                        <h1 class="onco-page-title">
                            Détail du suivi médical
                        </h1>

                        <p class="onco-page-subtitle">
                            Informations médicales accessibles selon votre autorisation.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Patient --}}
            <div class="onco-card mb-6">

                <div class="onco-card-header">
                    <div>
                        <h2>
                            👤 Patient
                        </h2>

                        <p class="onco-card-description">
                            Informations générales du patient concerné par ce suivi.
                        </p>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="onco-info-card">

                        <div class="onco-info-icon role-proche">
                            👤
                        </div>

                        <div>
                            <div class="onco-info-title">
                                Nom complet
                            </div>

                            <div class="onco-info-text">
                                <span class="font-semibold text-slate-800">
                                    {{ $suivi->patient->utilisateur->prenom ?? '' }}
                                    {{ $suivi->patient->utilisateur->nom ?? '' }}
                                </span>
                            </div>
                        </div>

                    </div>


                    <div class="onco-info-card">

                        <div class="onco-info-icon role-proche">
                            📅
                        </div>

                        <div>
                            <div class="onco-info-title">
                                Date du suivi
                            </div>

                            <div class="onco-info-text">
                                <span class="font-semibold text-slate-800">
                                    {{ \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Informations médicales --}}
            <div class="onco-card mb-6">

                <div class="onco-card-header">

                    <div>
                        <h2>
                            🩺 Informations médicales
                        </h2>

                        <p class="onco-card-description">
                            Données du suivi médical accessibles à votre profil.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Type cancer --}}
                    <div class="onco-info-card">

                        <div class="onco-info-icon role-proche">
                            ✚
                        </div>

                        <div>
                            <div class="onco-info-title">
                                Type de cancer
                            </div>

                            <div class="onco-info-text">
                                <span class="font-semibold text-slate-800">
                                    {{ $suivi->type_cancer }}
                                </span>
                            </div>
                        </div>

                    </div>


                    {{-- Stade --}}
                    <div class="onco-info-card">

                        <div class="onco-info-icon role-proche">
                            ◎
                        </div>

                        <div>
                            <div class="onco-info-title">
                                Stade
                            </div>

                            <div class="onco-info-text">
                                <span class="font-semibold text-slate-800">
                                    {{ $suivi->stade }}
                                </span>
                            </div>
                        </div>

                    </div>


                    {{-- Evolution --}}
                    @if($suivi->evolution)

                        <div class="onco-info-card">

                            <div class="onco-info-icon role-proche">
                                ↗
                            </div>

                            <div>
                                <div class="onco-info-title">
                                    Évolution
                                </div>

                                <div class="onco-info-text">
                                    {{ $suivi->evolution }}
                                </div>
                            </div>

                        </div>

                    @endif


                    {{-- Observation --}}
                    @if($suivi->observation)

                        <div class="onco-info-card">

                            <div class="onco-info-icon role-proche">
                                ◌
                            </div>

                            <div>
                                <div class="onco-info-title">
                                    Observation
                                </div>

                                <div class="onco-info-text">
                                    {{ $suivi->observation }}
                                </div>
                            </div>

                        </div>

                    @endif


                    {{-- Traitement --}}
                    @if($suivi->traitement)

                        <div class="onco-info-card md:col-span-2">

                            <div class="onco-info-icon role-proche">
                                💊
                            </div>

                            <div>
                                <div class="onco-info-title">
                                    Traitement
                                </div>

                                <div class="onco-info-text">
                                    {{ $suivi->traitement }}
                                </div>
                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Médecin --}}
            @if($suivi->medecin && $suivi->medecin->utilisateur)

                <div class="onco-card mb-6">

                    <div class="onco-card-header">

                        <div>
                            <h2>
                                👨‍⚕️ Médecin
                            </h2>

                            <p class="onco-card-description">
                                Professionnel de santé associé à ce suivi.
                            </p>
                        </div>

                    </div>


                    <div class="onco-info-card">

                        <div class="onco-info-icon role-medecin">
                            👨‍⚕️
                        </div>

                        <div>

                            <div class="onco-info-title">
                                Médecin traitant
                            </div>

                            <div class="text-base font-semibold text-slate-800 mt-1">
                                Dr.
                                {{ $suivi->medecin->utilisateur->prenom }}
                                {{ $suivi->medecin->utilisateur->nom }}
                            </div>

                            @if($suivi->medecin->specialite)
                                <div class="onco-info-text mt-1">
                                    {{ $suivi->medecin->specialite }}
                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            @endif


            {{-- Confidentialité --}}
            <div class="onco-info-card role-proche">

                <div class="onco-info-icon">
                    🔒
                </div>

                <div>

                    <div class="onco-info-title">
                        Informations protégées
                    </div>

                    <div class="onco-info-text">
                        Ces informations médicales sont affichées uniquement
                        parce qu'une autorisation active vous a été accordée
                        par le patient.
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>