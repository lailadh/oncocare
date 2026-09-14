<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

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
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            ◌
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Mes patients
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez la liste des patients que vous suivez.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- SUMMARY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-summary-grid"
                style="
                    margin-top:28px;
                    grid-template-columns:repeat(2,minmax(0,1fr));
                "
            >

                {{-- Patients suivis --}}
                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Patients suivis
                        </span>

                        <div class="onco-summary-value">
                            {{ $patients->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#66706D]">
                            patients associés à votre compte
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ◌
                    </div>

                </div>


                {{-- Accès --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#655A88;"
                        >
                            Accès
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:21px;"
                        >
                            Sécurisé
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            Dossiers accessibles selon vos droits
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        🔒
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- PATIENT LIST --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;padding:0;"
            >

                {{-- Card header --}}
                <div
                    class="onco-card-header"
                    style="padding:22px 24px;margin-bottom:0;"
                >

                    <div>

                        <h2 class="onco-card-title">
                            Liste de mes patients
                        </h2>

                        <p class="onco-card-description">
                            Accédez aux informations des patients qui vous sont associés.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
                    >
                        {{ $patients->count() }} patient(s)
                    </span>

                </div>


                @if ($patients->count())

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
                                        Date de naissance
                                    </th>

                                    <th>
                                        Accès
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($patients as $patient)

                                    <tr>

                                        {{-- Patient --}}
                                        <td>

                                            <div class="onco-user-cell">

                                                <div
                                                    class="onco-avatar"
                                                    style="background:#F1EFF8;color:#655A88;"
                                                >
                                                    {{ strtoupper(substr($patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">
                                                        {{ $patient->utilisateur->prenom }}
                                                        {{ $patient->utilisateur->nom }}
                                                    </div>

                                                    <div class="onco-user-meta">
                                                        Patient OncoCare
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Email --}}
                                        <td>

                                            <span class="onco-table-primary">
                                                {{ $patient->utilisateur->email }}
                                            </span>

                                        </td>


                                        {{-- Téléphone --}}
                                        <td>

                                            <span class="onco-table-secondary">
                                                {{ $patient->utilisateur->telephone ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Date de naissance --}}
                                        <td>

                                            <span class="onco-table-secondary">

                                                {{
                                                    $patient->date_naissance
                                                        ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y')
                                                        : 'Non renseignée'
                                                }}

                                            </span>

                                        </td>


                                        {{-- Action --}}
                                        <td>

                                            <a
                                                href="{{ route('medecin.patients.show', $patient) }}"
                                                class="onco-btn onco-btn-medecin"
                                            >
                                                Voir le dossier
                                                <span>→</span>
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- Empty state --}}
                    <div
                        class="onco-empty-state"
                        style="padding:56px 24px;"
                    >

                        <div
                            class="onco-empty-icon"
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            ◌
                        </div>

                        <h2 class="onco-empty-title">
                            Aucun patient
                        </h2>

                        <p class="onco-empty-text">
                            Aucun patient n'est actuellement associé à votre compte.
                        </p>

                    </div>

                @endif

            </div>


            {{-- ====================================================== --}}
            {{-- SECURITY / PRIVACY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#DED9EB;
                    background:#F8F6FB;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#F1EFF8;color:#7567A8;"
                >
                    🔒
                </div>

                <div>

                    <h3
                        class="onco-info-title"
                        style="color:#655A88;"
                    >
                        Confidentialité des dossiers
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Vous pouvez consulter uniquement les dossiers des patients
                        qui vous sont associés dans OncoCare.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>