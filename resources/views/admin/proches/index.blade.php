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
                            style="background:#EEF5F0;color:#7FA68A;"
                        >
                            ◎
                        </div>

                        <div>
                            <h1 class="onco-page-title">
                                Gestion des proches
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez les comptes des proches de la plateforme.
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Résumé --}}
            <div
                class="onco-summary-grid"
                style="margin-top:28px;"
            >

                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Proches enregistrés
                        </span>

                        <div class="onco-summary-value">
                            {{ $proches->count() }}
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        ◎
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
                            Proche
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
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
                            Autorisé
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F5F2E8;color:#C7A45B;"
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
                            Liste des proches
                        </h2>

                        <p class="onco-card-description">
                            Les comptes proches enregistrés sur OncoCare.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#EEF5F0;color:#63856D;"
                    >
                        {{ $proches->count() }} proche(s)
                    </span>

                </div>


                @if ($proches->count() > 0)

                    <div class="onco-table-wrapper">

                        <table class="onco-table">

                            <thead>
                                <tr>

                                    <th>
                                        Proche
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

                                @foreach ($proches as $proche)

                                    <tr>

                                        {{-- Proche --}}
                                        <td>

                                            <div class="onco-user-cell">

                                                <div
                                                    class="onco-avatar"
                                                    style="background:#EEF5F0;color:#63856D;"
                                                >
                                                    {{ strtoupper(substr($proche->prenom ?? 'P', 0, 1)) }}
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">
                                                        {{ $proche->prenom }}
                                                        {{ $proche->nom }}
                                                    </div>

                                                    <div class="onco-user-meta">
                                                        Compte proche
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Email --}}
                                        <td>

                                            <span class="onco-table-primary">
                                                {{ $proche->email }}
                                            </span>

                                        </td>


                                        {{-- Téléphone --}}
                                        <td>

                                            <span class="onco-table-secondary">
                                                {{ $proche->telephone ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Rôle --}}
                                        <td>

                                            <span
                                                class="onco-badge"
                                                style="background:#EEF5F0;color:#63856D;"
                                            >
                                                Proche
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

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- Aucun proche --}}
                    <div
                        class="onco-empty-state"
                        style="padding:56px 24px;"
                    >

                        <div
                            class="onco-empty-icon"
                            style="background:#EEF5F0;color:#7FA68A;"
                        >
                            ◎
                        </div>

                        <h3 class="onco-empty-title">
                            Aucun proche
                        </h3>

                        <p class="onco-empty-text">
                            Aucun compte proche n'est actuellement enregistré.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Confidentialité --}}
            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#DDE9E0;
                    background:#F8FBF8;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#EEF5F0;color:#7FA68A;"
                >
                    🔒
                </div>

                <div>

                    <h3 class="onco-info-title">
                        Accès aux informations
                    </h3>

                    <p class="onco-info-text">
                        Les proches disposent uniquement des informations
                        auxquelles le patient leur a accordé une autorisation
                        d'accès.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>