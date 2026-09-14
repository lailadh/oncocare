<x-app-layout>

    <div class="onco-page">
        <div class="onco-container">

            {{-- Header --}}
            <div class="onco-page-header">

                <div class="onco-title-wrap">

                    <div class="onco-page-icon role-proche">
                        📅
                    </div>

                    <div>
                        <h1 class="onco-page-title">
                            Rendez-vous accessibles
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les rendez-vous des patients que vous accompagnez,
                            selon les autorisations qui vous ont été accordées.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Résumé --}}
            @php
                $total = $rendezVous->count();
                $enAttente = $rendezVous->where('statut', 'en_attente')->count();
                $confirmes = $rendezVous->where('statut', 'confirme')->count();
            @endphp

            <div class="onco-summary-grid">

                <div class="onco-summary-card">

                    <div class="onco-summary-label">
                        Rendez-vous accessibles
                    </div>

                    <div class="onco-summary-value">
                        {{ $total }}
                    </div>

                    <div class="onco-summary-icon">
                        📅
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div class="onco-summary-label">
                        En attente
                    </div>

                    <div class="onco-summary-value">
                        {{ $enAttente }}
                    </div>

                    <div class="onco-summary-icon">
                        ⏳
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div class="onco-summary-label">
                        Confirmés
                    </div>

                    <div class="onco-summary-value">
                        {{ $confirmes }}
                    </div>

                    <div class="onco-summary-icon">
                        ✓
                    </div>

                </div>

            </div>


            {{-- Message succès --}}
            @if(session('success'))

                <div class="onco-alert onco-alert-success">

                    <div class="onco-alert-icon">
                        ✓
                    </div>

                    <div>
                        <div class="onco-alert-title">
                            Opération réussie
                        </div>

                        <div class="onco-alert-text">
                            {{ session('success') }}
                        </div>
                    </div>

                </div>

            @endif


            {{-- Liste --}}
            <div class="onco-card">

                <div class="onco-card-header">

                    <div>
                        <h2>
                            Liste des rendez-vous
                        </h2>

                        <p class="onco-card-description">
                            Vous pouvez consulter uniquement les rendez-vous
                            autorisés par le patient.
                        </p>
                    </div>

                </div>


                @if($rendezVous->count())

                    <div class="onco-table-wrapper">

                        <table class="onco-table">

                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Date & heure</th>
                                    <th>Médecin</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($rendezVous as $rdv)

                                    @php
                                        $statutClass = match($rdv->statut) {
                                            'confirme' => 'onco-status-success',
                                            'refuse' => 'onco-status-error',
                                            default => 'onco-status-warning',
                                        };

                                        $statutLabel = match($rdv->statut) {
                                            'confirme' => 'Confirmé',
                                            'refuse' => 'Refusé',
                                            'en_attente' => 'En attente',
                                            default => ucfirst($rdv->statut ?? 'Inconnu'),
                                        };
                                    @endphp

                                    <tr>

                                        {{-- Patient --}}
                                        <td>

                                            <div class="onco-user-cell">

                                                <div class="onco-avatar role-proche">
                                                    {{ strtoupper(substr($rdv->patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">
                                                        {{ $rdv->patient->utilisateur->prenom ?? '' }}
                                                        {{ $rdv->patient->utilisateur->nom ?? '' }}
                                                    </div>

                                                    <div class="onco-user-meta">
                                                        Patient accompagné
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Date & heure --}}
                                        <td>

                                            <span class="onco-table-primary">
                                                {{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y') }}
                                            </span>

                                            <span class="onco-table-secondary">
                                                {{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}
                                            </span>

                                        </td>


                                        {{-- Médecin --}}
                                        <td>

                                            @if($rdv->medecin && $rdv->medecin->utilisateur)

                                                <span class="onco-table-primary">
                                                    Dr.
                                                    {{ $rdv->medecin->utilisateur->prenom }}
                                                    {{ $rdv->medecin->utilisateur->nom }}
                                                </span>

                                                @if($rdv->medecin->specialite)
                                                    <span class="onco-table-secondary">
                                                        {{ $rdv->medecin->specialite }}
                                                    </span>
                                                @endif

                                            @else

                                                <span class="onco-table-secondary">
                                                    Non renseigné
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Statut --}}
                                        <td>

                                            <span class="onco-status {{ $statutClass }}">

                                                <span class="onco-status-dot"></span>

                                                {{ $statutLabel }}

                                            </span>

                                        </td>


                                        {{-- Action --}}
                                        <td>

                                            <a href="{{ route('proche.rendezvous.show', $rdv) }}"
                                               class="onco-btn onco-btn-proche">

                                                Consulter

                                                <span class="ml-2">
                                                    →
                                                </span>

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="onco-empty-state">

                        <div class="onco-empty-icon">
                            📅
                        </div>

                        <h3>
                            Aucun rendez-vous
                        </h3>

                        <p>
                            Aucun rendez-vous n'est actuellement disponible
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
                        Accès confidentiel
                    </div>

                    <div class="onco-info-text">
                        Les rendez-vous affichés sont visibles uniquement lorsque
                        le patient vous a accordé l'autorisation correspondante.
                        Vous ne pouvez pas accéder aux autres informations du patient.
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>