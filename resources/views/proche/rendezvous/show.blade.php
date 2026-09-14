<x-app-layout>

    <div class="onco-page">
        <div class="onco-container">

            {{-- Retour --}}
            <div class="mb-6">
                <a href="{{ route('proche.rendezvous.index') }}"
                   class="onco-back-link">
                    ← Retour aux rendez-vous
                </a>
            </div>


            {{-- Header --}}
            <div class="onco-page-header">

                <div class="onco-title-wrap">

                    <div class="onco-page-icon role-proche">
                        📅
                    </div>

                    <div>
                        <h1 class="onco-page-title">
                            Détail du rendez-vous
                        </h1>

                        <p class="onco-page-subtitle">
                            Informations sur le rendez-vous du patient que vous accompagnez.
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
                            Patient concerné par ce rendez-vous.
                        </p>
                    </div>

                </div>


                <div class="onco-info-card">

                    <div class="onco-info-icon role-proche">
                        👤
                    </div>

                    <div>

                        <div class="onco-info-title">
                            Nom complet
                        </div>

                        <div class="text-base font-semibold text-slate-800 mt-1">
                            {{ $rendezVous->patient->utilisateur->prenom }}
                            {{ $rendezVous->patient->utilisateur->nom }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- Informations du rendez-vous --}}
            <div class="onco-card mb-6">

                <div class="onco-card-header">

                    <div>
                        <h2>
                            📅 Informations du rendez-vous
                        </h2>

                        <p class="onco-card-description">
                            Les informations accessibles concernant ce rendez-vous.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Date --}}
                    <div class="onco-info-card">

                        <div class="onco-info-icon role-proche">
                            📅
                        </div>

                        <div>
                            <div class="onco-info-title">
                                Date et heure
                            </div>

                            <div class="text-base font-semibold text-slate-800 mt-1">
                                {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('d/m/Y') }}
                            </div>

                            <div class="onco-info-text mt-1">
                                {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('H:i') }}
                            </div>
                        </div>

                    </div>


                    {{-- Médecin --}}
                    <div class="onco-info-card">

                        <div class="onco-info-icon role-medecin">
                            👨‍⚕️
                        </div>

                        <div>

                            <div class="onco-info-title">
                                Médecin
                            </div>

                            <div class="text-base font-semibold text-slate-800 mt-1">

                                @if($rendezVous->medecin && $rendezVous->medecin->utilisateur)

                                    Dr.
                                    {{ $rendezVous->medecin->utilisateur->prenom }}
                                    {{ $rendezVous->medecin->utilisateur->nom }}

                                @else

                                    Non renseigné

                                @endif

                            </div>

                            @if($rendezVous->medecin && $rendezVous->medecin->specialite)

                                <div class="onco-info-text mt-1">
                                    {{ $rendezVous->medecin->specialite }}
                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- Motif --}}
                    <div class="onco-info-card md:col-span-2">

                        <div class="onco-info-icon role-proche">
                            ◌
                        </div>

                        <div>

                            <div class="onco-info-title">
                                Motif
                            </div>

                            <div class="onco-info-text mt-1">
                                {{ $rendezVous->motif ?: 'Aucun motif renseigné.' }}
                            </div>

                        </div>

                    </div>


                    {{-- Statut --}}
                    <div class="onco-info-card md:col-span-2">

                        @php
                            $statutClass = match($rendezVous->statut) {
                                'confirme' => 'onco-status-success',
                                'refuse' => 'onco-status-error',
                                default => 'onco-status-warning',
                            };

                            $statutLabel = match($rendezVous->statut) {
                                'confirme' => 'Confirmé',
                                'refuse' => 'Refusé',
                                'en_attente' => 'En attente',
                                default => ucfirst($rendezVous->statut ?? 'Inconnu'),
                            };
                        @endphp

                        <div class="onco-info-icon role-proche">
                            ◎
                        </div>

                        <div>

                            <div class="onco-info-title">
                                Statut
                            </div>

                            <div class="mt-2">
                                <span class="onco-status {{ $statutClass }}">
                                    <span class="onco-status-dot"></span>
                                    {{ $statutLabel }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Confidentialité --}}
            <div class="onco-info-card role-proche">

                <div class="onco-info-icon">
                    🔒
                </div>

                <div>

                    <div class="onco-info-title">
                        Accès confidentiel
                    </div>

                    <div class="onco-info-text">
                        Les informations de ce rendez-vous sont accessibles uniquement
                        grâce à l'autorisation accordée par le patient.
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>