<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            <div class="onco-page-header">

                <div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="onco-back-link"
                    >
                        ← Retour au dashboard
                    </a>

                    <div class="onco-title-wrap">

                        <div
                            class="onco-page-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            📩
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Mes demandes de suivi
                            </h1>

                            <p class="onco-page-subtitle">
                                Suivez l'état de vos demandes de suivi envoyées aux médecins.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            @if(session('success'))

                <div
                    class="onco-alert onco-alert-success"
                    style="margin-top:24px;"
                >
                    <div class="onco-alert-icon">✓</div>
                    <div>
                        <div class="onco-alert-title">Opération réussie</div>
                        <div class="onco-alert-text">{{ session('success') }}</div>
                    </div>
                </div>

            @endif


            {{-- Résumé --}}
            @php
                $enAttente = $demandes->where('statut', 'en_attente')->count();
                $acceptees = $demandes->where('statut', 'acceptee')->count();
                $refusees = $demandes->where('statut', 'refusee')->count();
            @endphp

            <div
                class="onco-summary-grid"
                style="margin-top:28px;grid-template-columns:repeat(3,minmax(0,1fr));"
            >

                <div class="onco-summary-card">
                    <div>
                        <span class="onco-summary-label" style="color:#8A6B32;">
                            En attente
                        </span>
                        <div class="onco-summary-value" style="color:#8A6B32;">
                            {{ $enAttente }}
                        </div>
                    </div>
                    <div
                        class="onco-summary-icon"
                        style="background:#F8F1E1;color:#C49A5A;"
                    >
                        ⏳
                    </div>
                </div>

                <div class="onco-summary-card">
                    <div>
                        <span class="onco-summary-label" style="color:#4B7655;">
                            Acceptées
                        </span>
                        <div class="onco-summary-value" style="color:#4B7655;">
                            {{ $acceptees }}
                        </div>
                    </div>
                    <div
                        class="onco-summary-icon"
                        style="background:#EAF4EC;color:#7FA68A;"
                    >
                        ✓
                    </div>
                </div>

                <div class="onco-summary-card">
                    <div>
                        <span class="onco-summary-label" style="color:#9A5661;">
                            Refusées
                        </span>
                        <div class="onco-summary-value" style="color:#9A5661;">
                            {{ $refusees }}
                        </div>
                    </div>
                    <div
                        class="onco-summary-icon"
                        style="background:#F7E9EB;color:#D99AA6;"
                    >
                        ✗
                    </div>
                </div>

            </div>


            {{-- Liste --}}
            <div
                class="onco-card"
                style="margin-top:28px;padding:0;"
            >

                <div
                    class="onco-card-header"
                    style="padding:22px 24px;margin-bottom:0;"
                >
                    <div>
                        <h2 class="onco-card-title">Historique des demandes</h2>
                        <p class="onco-card-description">
                            Toutes vos demandes de suivi envoyées aux médecins.
                        </p>
                    </div>
                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#9A6470;"
                    >
                        {{ $demandes->count() }} demande(s)
                    </span>
                </div>

                @if($demandes->count())

                    <div class="onco-table-wrapper" style="border:0;border-radius:0;box-shadow:none;">

                        <table class="onco-table">

                            <thead>
                                <tr>
                                    <th>Médecin</th>
                                    <th>Date de la demande</th>
                                    <th>Statut</th>
                                    <th>Traité le</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($demandes as $demande)

                                    <tr>
                                        <td>
                                            <div class="onco-user-cell">
                                                <div
                                                    class="onco-avatar"
                                                    style="background:#F1EFF8;color:#655A88;"
                                                >
                                                    {{ strtoupper(substr($demande->medecin->utilisateur->prenom ?? 'M', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="onco-user-name">
                                                        Dr {{ $demande->medecin->utilisateur->prenom }}
                                                        {{ $demande->medecin->utilisateur->nom }}
                                                    </div>
                                                    <div class="onco-user-meta">
                                                        {{ $demande->medecin->specialite ?? 'Spécialité non renseignée' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="onco-table-primary">
                                                {{ \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y') }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($demande->statut === 'en_attente')
                                                <span
                                                    class="onco-badge"
                                                    style="background:#F8F1E1;color:#8A6B32;"
                                                >
                                                    <span
                                                        style="width:6px;height:6px;border-radius:50%;background:#C49A5A;"
                                                    ></span>
                                                    En attente
                                                </span>
                                            @elseif($demande->statut === 'acceptee')
                                                <span
                                                    class="onco-badge"
                                                    style="background:#EAF4EC;color:#4B7655;"
                                                >
                                                    <span
                                                        style="width:6px;height:6px;border-radius:50%;background:#7FA68A;"
                                                    ></span>
                                                    Acceptée
                                                </span>
                                            @elseif($demande->statut === 'refusee')
                                                <span
                                                    class="onco-badge"
                                                    style="background:#F7E9EB;color:#9A5661;"
                                                >
                                                    <span
                                                        style="width:6px;height:6px;border-radius:50%;background:#D99AA6;"
                                                    ></span>
                                                    Refusée
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="onco-table-secondary">
                                                @if($demande->date_traitement)
                                                    {{ \Carbon\Carbon::parse($demande->date_traitement)->format('d/m/Y à H:i') }}
                                                @else
                                                    —
                                                @endif
                                            </span>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div
                        class="onco-empty-state"
                        style="padding:56px 24px;"
                    >
                        <div
                            class="onco-empty-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            📩
                        </div>
                        <h3 class="onco-empty-title">
                            Aucune demande envoyée
                        </h3>
                        <p class="onco-empty-text">
                            Vous n'avez pas encore envoyé de demande de suivi.
                            Recherchez un médecin pour commencer.
                        </p>
                        <a
                            href="{{ route('patient.medecins.index') }}"
                            class="onco-btn onco-btn-patient"
                            style="margin-top:16px;"
                        >
                            Rechercher un médecin →
                        </a>
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
