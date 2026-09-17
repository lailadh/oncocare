<x-app-layout>

    <div class="onco-page">
        <div class="onco-container">

            <div class="onco-page-header">
                <div class="onco-title-wrap">
                    <div class="onco-page-icon role-proche">
                        ♡
                    </div>

                    <div>
                        <h1 class="onco-page-title">
                            Mes autorisations
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les patients qui vous ont accordé un accès à leurs informations.
                        </p>
                    </div>
                </div>
            </div>

            @php
                $total = $autorisations->count();
                $suivi = $autorisations->where('acces_suivi', true)->count();
                $rendezVous = $autorisations->where('acces_rendez_vous', true)->count();
            @endphp

            <div class="onco-summary-grid">
                <div class="onco-summary-card">
                    <div class="onco-summary-label">Patients autorisés</div>
                    <div class="onco-summary-value">{{ $total }}</div>
                    <div class="onco-summary-icon">👥</div>
                </div>

                <div class="onco-summary-card">
                    <div class="onco-summary-label">Accès aux suivis</div>
                    <div class="onco-summary-value">{{ $suivi }}</div>
                    <div class="onco-summary-icon">🩺</div>
                </div>

                <div class="onco-summary-card">
                    <div class="onco-summary-label">Accès aux rendez-vous</div>
                    <div class="onco-summary-value">{{ $rendezVous }}</div>
                    <div class="onco-summary-icon">📅</div>
                </div>
            </div>

            @if(session('success'))
                <div class="onco-alert onco-alert-success">
                    <div class="onco-alert-icon">✓</div>
                    <div>
                        <div class="onco-alert-title">Opération réussie</div>
                        <div class="onco-alert-text">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <div class="onco-card">
                <div class="onco-card-header">
                    <div>
                        <h2>Patients qui vous ont autorisé</h2>
                        <p class="onco-card-description">
                            Vous pouvez consulter uniquement les informations pour lesquelles le patient vous a donné
                            l'autorisation.
                        </p>
                    </div>
                </div>

                @if($autorisations->count())
                    <div class="onco-table-wrapper">
                        <table class="onco-table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Accès au suivi</th>
                                    <th>Accès aux rendez-vous</th>
                                    <th>Date d'autorisation</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($autorisations as $autorisation)
                                    <tr>
                                        <td>
                                            <div class="onco-user-cell">
                                                <div class="onco-avatar role-proche">
                                                    {{ strtoupper(substr($autorisation->patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                                                </div>

                                                <div>
                                                    <div class="onco-user-name">
                                                        {{ $autorisation->patient->utilisateur->prenom ?? '' }}
                                                        {{ $autorisation->patient->utilisateur->nom ?? '' }}
                                                    </div>

                                                    <div class="onco-user-meta">
                                                        {{ $autorisation->patient->utilisateur->email ?? 'Email non disponible' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @if($autorisation->acces_suivi)
                                                <span class="onco-status onco-status-success">
                                                    <span class="onco-status-dot"></span>
                                                    Autorisé
                                                </span>
                                            @else
                                                <span class="onco-status onco-status-neutral">
                                                    <span class="onco-status-dot"></span>
                                                    Non autorisé
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($autorisation->acces_rendez_vous)
                                                <span class="onco-status onco-status-success">
                                                    <span class="onco-status-dot"></span>
                                                    Autorisé
                                                </span>
                                            @else
                                                <span class="onco-status onco-status-neutral">
                                                    <span class="onco-status-dot"></span>
                                                    Non autorisé
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="onco-table-primary">
                                                {{ \Carbon\Carbon::parse($autorisation->date_autorisation)->format('d/m/Y') }}
                                            </span>
                                            <span class="onco-table-secondary">
                                                {{ \Carbon\Carbon::parse($autorisation->date_autorisation)->format('H:i') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="onco-status onco-status-success">
                                                <span class="onco-status-dot"></span>
                                                Active
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="onco-empty-state">
                        <div class="onco-empty-icon">♡</div>
                        <h3>Aucune autorisation</h3>
                        <p>
                            Aucun patient ne vous a actuellement accordé d'autorisation pour consulter ses informations.
                        </p>
                    </div>
                @endif
            </div>

            <div class="onco-info-card role-proche">
                <div class="onco-info-icon">🔒</div>
                <div>
                    <div class="onco-info-title">Accès confidentiel</div>
                    <div class="onco-info-text">
                        Les informations médicales restent confidentielles. Vous pouvez accéder uniquement aux données
                        explicitement autorisées par le patient.
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>