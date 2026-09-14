<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- En-tête --}}
            <div class="onco-page-header">

                <div>
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="onco-back-link"
                    >
                        ← Retour au dashboard
                    </a>

                    <div class="onco-title-wrap">
                        <div
                            class="onco-page-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            ♡
                        </div>

                        <div>
                            <h1 class="onco-page-title">
                                Gestion des patients
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez les comptes des patients de la plateforme.
                            </p>
                        </div>
                    </div>
                </div>

            </div>


            {{-- Messages --}}
            @if(session('success'))
                <div
                    class="onco-alert onco-alert-success"
                    style="margin-top:24px;"
                >
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


            @if(session('error'))
                <div
                    class="onco-alert onco-alert-error"
                    style="margin-top:24px;"
                >
                    <div class="onco-alert-icon">
                        !
                    </div>

                    <div>
                        <div class="onco-alert-title">
                            Une erreur est survenue
                        </div>

                        <div class="onco-alert-text">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif


            {{-- Résumé --}}
            <div
                class="onco-summary-grid"
                style="margin-top:28px;"
            >

                <div class="onco-summary-card">

                    <div>
                        <span class="onco-summary-label">
                            Patients enregistrés
                        </span>

                        <div class="onco-summary-value">
                            {{ $patients->count() }}
                        </div>
                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ♡
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div>
                        <span class="onco-summary-label">
                            Rôle
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Patient
                        </div>
                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        P
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div>
                        <span class="onco-summary-label">
                            Accès
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Sécurisé
                        </div>
                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF6F1;color:#7FA68A;"
                    >
                        ✓
                    </div>

                </div>

            </div>


            {{-- Tableau --}}
            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="onco-card-header">

                    <div>
                        <h2 class="onco-card-title">
                            Liste des patients
                        </h2>

                        <p class="onco-card-description">
                            Les comptes patients enregistrés sur OncoCare.
                        </p>
                    </div>

                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#B97886;"
                    >
                        {{ $patients->count() }} patient(s)
                    </span>

                </div>


                <div class="onco-table-wrapper">

                    <table class="onco-table">

                        <thead>
                            <tr>

                                <th>
                                    Patient
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Téléphone
                                </th>

                                <th>
                                    Rôle
                                </th>

                                <th>
                                    Statut
                                </th>

                            </tr>
                        </thead>


                        <tbody>

                            @forelse($patients as $patient)

                                <tr>

                                    {{-- Patient --}}
                                    <td>

                                        <div class="onco-user-cell">

                                            <div
                                                class="onco-avatar"
                                                style="background:#FBF1F3;color:#B97886;"
                                            >
                                                {{ strtoupper(substr($patient->prenom ?? 'P', 0, 1)) }}
                                            </div>

                                            <div>

                                                <div class="onco-user-name">
                                                    {{ $patient->prenom }}
                                                    {{ $patient->nom }}
                                                </div>

                                                <div class="onco-user-meta">
                                                    Compte patient
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Email --}}
                                    <td>
                                        <span class="onco-table-primary">
                                            {{ $patient->email }}
                                        </span>
                                    </td>


                                    {{-- Téléphone --}}
                                    <td>

                                        <span class="onco-table-secondary">
                                            {{ $patient->telephone ?? 'Non renseigné' }}
                                        </span>

                                    </td>


                                    {{-- Rôle --}}
                                    <td>

                                        <span
                                            class="onco-badge"
                                            style="background:#FBF1F3;color:#B97886;"
                                        >
                                            Patient
                                        </span>

                                    </td>


                                    {{-- Statut --}}
                                    <td>

                                        <span
                                            class="onco-status"
                                            style="color:#5D806A;"
                                        >
                                            <span
                                                class="onco-status-dot"
                                                style="background:#7FA68A;"
                                            ></span>

                                            Actif
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        style="padding:56px 24px;"
                                    >

                                        <div class="onco-empty-state">

                                            <div
                                                class="onco-empty-icon"
                                                style="background:#FBF1F3;color:#D99AA6;"
                                            >
                                                ♡
                                            </div>

                                            <h3 class="onco-empty-title">
                                                Aucun patient enregistré
                                            </h3>

                                            <p class="onco-empty-text">
                                                Aucun compte patient n'est actuellement disponible.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Confidentialité --}}
            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#EED7DC;
                    background:#FFF9FA;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#FBF1F3;color:#D99AA6;"
                >
                    🔒
                </div>

                <div>

                    <h3 class="onco-info-title">
                        Confidentialité des données
                    </h3>

                    <p class="onco-info-text">
                        Les informations personnelles des patients sont
                        accessibles uniquement dans le cadre des droits
                        d'administration de la plateforme.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>