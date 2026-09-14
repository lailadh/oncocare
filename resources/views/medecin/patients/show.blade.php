<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('medecin.patients.index') }}"
                    class="onco-back-link"
                >
                    ← Retour à mes patients
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
                            Dossier du patient
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les informations et l'historique du patient.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- PATIENT PROFILE --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

                    {{-- Identity --}}
                    <div class="onco-user-cell">

                        <div
                            class="onco-avatar"
                            style="
                                width:64px;
                                height:64px;
                                background:#F1EFF8;
                                color:#7567A8;
                                font-size:22px;
                            "
                        >
                            {{ strtoupper(substr($patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                        </div>

                        <div>

                            <div
                                class="text-2xl font-medium text-[#293331]"
                                style="font-family:'Newsreader',serif;"
                            >
                                {{ $patient->utilisateur->prenom }}
                                {{ $patient->utilisateur->nom }}
                            </div>

                            <div class="mt-1 text-sm text-[#66706D]">
                                Patient OncoCare
                            </div>

                            <div class="mt-3">
                                <span
                                    class="onco-role-badge patient"
                                    style="
                                        background:#F1EFF8;
                                        color:#655A88;
                                    "
                                >
                                    Patient suivi
                                </span>
                            </div>

                        </div>

                    </div>


                    {{-- Security --}}
                    <div
                        class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-xs font-semibold"
                        style="
                            background:#F8F6FB;
                            color:#655A88;
                            border:1px solid #DED9EB;
                        "
                    >
                        <span>🔒</span>
                        Dossier sécurisé
                    </div>

                </div>


                {{-- Personal information --}}
                <div
                    class="mt-7 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
                >

                    <div
                        class="rounded-2xl p-4"
                        style="background:#FAF9F8;"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Email
                        </p>

                        <p class="mt-2 break-all text-sm font-medium text-[#293331]">
                            {{ $patient->utilisateur->email }}
                        </p>

                    </div>


                    <div
                        class="rounded-2xl p-4"
                        style="background:#FAF9F8;"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Téléphone
                        </p>

                        <p class="mt-2 text-sm font-medium text-[#293331]">
                            {{ $patient->utilisateur->telephone ?? 'Non renseigné' }}
                        </p>

                    </div>


                    <div
                        class="rounded-2xl p-4"
                        style="background:#FAF9F8;"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Date de naissance
                        </p>

                        <p class="mt-2 text-sm font-medium text-[#293331]">

                            {{
                                $patient->date_naissance
                                    ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y')
                                    : 'Non renseignée'
                            }}

                        </p>

                    </div>


                    <div
                        class="rounded-2xl p-4"
                        style="background:#FAF9F8;"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Adresse
                        </p>

                        <p class="mt-2 text-sm font-medium text-[#293331]">
                            {{ $patient->adresse ?? 'Non renseignée' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- FOLLOW-UP SUMMARY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-summary-grid"
                style="
                    margin-top:24px;
                    grid-template-columns:repeat(2,minmax(0,1fr));
                "
            >

                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#655A88;"
                        >
                            Suivis médicaux
                        </span>

                        <div class="onco-summary-value">
                            {{ $patient->suivis->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            suivis enregistrés
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ♡
                    </div>

                </div>


                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#63856D;"
                        >
                            Accès
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Autorisé
                        </div>

                        <p class="mt-1 text-xs text-[#607467]">
                            Dossier accessible dans le cadre du suivi
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        ✓
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- HISTORY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="
                    margin-top:24px;
                    padding:0;
                "
            >

                {{-- Header --}}
                <div
                    class="onco-card-header"
                    style="
                        padding:22px 24px;
                        margin-bottom:0;
                    "
                >

                    <div>

                        <h2 class="onco-card-title">
                            Historique des suivis
                        </h2>

                        <p class="onco-card-description">
                            Les différents suivis médicaux enregistrés pour ce patient.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
                    >
                        {{ $patient->suivis->count() }} suivi(s)
                    </span>

                </div>


                @if ($patient->suivis->count())

                    <div class="onco-table-wrapper">

                        <table class="onco-table">

                            <thead>

                                <tr>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Type de cancer
                                    </th>

                                    <th>
                                        Stade
                                    </th>

                                    <th>
                                        Évolution
                                    </th>

                                    <th>
                                        Traitement
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($patient->suivis as $suivi)

                                    <tr>

                                        {{-- Date --}}
                                        <td>

                                            <span
                                                class="font-semibold text-[#293331]"
                                            >
                                                {{
                                                    $suivi->date_suivi
                                                        ? \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y')
                                                        : 'Non renseignée'
                                                }}
                                            </span>

                                        </td>


                                        {{-- Cancer --}}
                                        <td>

                                            <span class="onco-table-primary">
                                                {{ $suivi->type_cancer ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Stade --}}
                                        <td>

                                            <span
                                                class="onco-badge"
                                                style="background:#F1EFF8;color:#655A88;"
                                            >
                                                {{ $suivi->stade ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Evolution --}}
                                        <td>

                                            @if($suivi->evolution)

                                                <span
                                                    class="onco-badge"
                                                    style="background:#EEF5F0;color:#63856D;"
                                                >
                                                    {{ $suivi->evolution }}
                                                </span>

                                            @else

                                                <span class="onco-table-secondary">
                                                    Non renseignée
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Traitement --}}
                                        <td>

                                            <span class="onco-table-secondary">
                                                {{ $suivi->traitement ?? 'Non renseigné' }}
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
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            🩺
                        </div>

                        <h3 class="onco-empty-title">
                            Aucun suivi médical
                        </h3>

                        <p class="onco-empty-text">
                            Aucun suivi médical n'est encore enregistré pour ce patient.
                        </p>

                    </div>

                @endif

            </div>


            {{-- ====================================================== --}}
            {{-- PRIVACY --}}
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
                        Confidentialité du dossier
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Les informations affichées sont réservées au médecin
                        associé à ce patient dans le cadre de son suivi médical.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>