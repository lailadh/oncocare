<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('patient.suivis.index') }}"
                    class="onco-back-link"
                >
                    ← Retour à mes suivis
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
                            Détails du suivi
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les informations enregistrées lors de votre suivi médical.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- PATIENT --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="onco-user-cell">

                        <div
                            class="onco-avatar"
                            style="
                                width:60px;
                                height:60px;
                                background:#FBF1F3;
                                color:#B97886;
                                font-size:21px;
                            "
                        >
                            {{
                                strtoupper(
                                    substr(
                                        $suivi->patient->utilisateur->prenom ?? 'P',
                                        0,
                                        1
                                    )
                                )
                            }}
                        </div>

                        <div>

                            <div
                                class="text-2xl font-medium text-[#293331]"
                                style="font-family:'Newsreader',serif;"
                            >
                                {{ $suivi->patient->utilisateur->prenom }}
                                {{ $suivi->patient->utilisateur->nom }}
                            </div>

                            <div class="mt-1 text-sm text-[#66706D]">
                                Mon dossier OncoCare
                            </div>

                        </div>

                    </div>


                    <div
                        class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-xs font-semibold"
                        style="
                            background:#FFF9FA;
                            color:#9A6470;
                            border:1px solid #EED7DC;
                        "
                    >
                        🔒 Données protégées
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- RESUME --}}
            {{-- ====================================================== --}}

            <div
                class="onco-summary-grid"
                style="
                    margin-top:24px;
                    grid-template-columns:repeat(2,minmax(0,1fr));
                "
            >

                {{-- Date --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#9A6470;"
                        >
                            Date du suivi
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:23px;"
                        >
                            {{
                                $suivi->date_suivi
                                    ? \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y')
                                    : 'Non renseignée'
                            }}
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ◷
                    </div>

                </div>


                {{-- Stade --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#9A6470;"
                        >
                            Stade
                        </span>

                        <div style="margin-top:8px;">

                            <span
                                class="onco-badge"
                                style="
                                    background:#FBF1F3;
                                    color:#9A6470;
                                    font-size:12px;
                                "
                            >
                                {{ $suivi->stade ?? 'Non renseigné' }}
                            </span>

                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ◎
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- INFORMATIONS MEDICALES --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:24px;"
            >

                <div class="onco-card-header">

                    <div>

                        <h2 class="onco-card-title">
                            Informations médicales
                        </h2>

                        <p class="onco-card-description">
                            Les informations principales enregistrées lors de ce suivi.
                        </p>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Type cancer --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#FFF9FA;
                            border:1px solid #F0DDE1;
                        "
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#9A6470]">
                            Type de cancer
                        </p>

                        <p class="mt-2 text-base font-semibold text-[#293331]">
                            {{ $suivi->type_cancer ?? 'Non renseigné' }}
                        </p>

                    </div>


                    {{-- Evolution --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#F8FAF8;
                            border:1px solid #E0E9E2;
                        "
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#738177]">
                            Évolution
                        </p>

                        <div style="margin-top:10px;">

                            @if($suivi->evolution)

                                <span
                                    class="onco-badge"
                                    style="
                                        background:#EEF5F0;
                                        color:#63856D;
                                        font-size:12px;
                                    "
                                >
                                    {{ $suivi->evolution }}
                                </span>

                            @else

                                <span class="text-sm text-[#66706D]">
                                    Non renseignée
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- MEDECIN --}}
            {{-- ====================================================== --}}

            @if($suivi->medecin && $suivi->medecin->utilisateur)

                <div
                    class="onco-card"
                    style="margin-top:24px;"
                >

                    <div class="flex items-center gap-4">

                        <div
                            class="onco-avatar"
                            style="
                                width:52px;
                                height:52px;
                                background:#F1EFF8;
                                color:#655A88;
                                font-size:18px;
                            "
                        >
                            {{
                                strtoupper(
                                    substr(
                                        $suivi->medecin->utilisateur->prenom ?? 'M',
                                        0,
                                        1
                                    )
                                )
                            }}
                        </div>

                        <div>

                            <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#7D758C]">
                                Médecin
                            </p>

                            <p
                                class="mt-1 text-lg font-semibold text-[#293331]"
                            >
                                Dr.
                                {{ $suivi->medecin->utilisateur->prenom }}
                                {{ $suivi->medecin->utilisateur->nom }}
                            </p>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Médecin associé à votre suivi
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================== --}}
            {{-- OBSERVATION --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:24px;"
            >

                <div class="onco-card-header">

                    <div>

                        <h2 class="onco-card-title">
                            Observation
                        </h2>

                        <p class="onco-card-description">
                            Notes enregistrées lors du suivi médical.
                        </p>

                    </div>

                </div>


                <div
                    class="rounded-2xl p-5"
                    style="
                        background:#FAF9F8;
                        border:1px solid #EEEAE6;
                    "
                >

                    @if($suivi->observation)

                        <p
                            class="text-sm leading-7 text-[#293331]"
                            style="white-space:pre-line;"
                        >
                            {{ $suivi->observation }}
                        </p>

                    @else

                        <p class="text-sm italic text-[#8B918E]">
                            Aucune observation enregistrée.
                        </p>

                    @endif

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- TRAITEMENT --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:24px;"
            >

                <div class="onco-card-header">

                    <div>

                        <h2 class="onco-card-title">
                            Traitement
                        </h2>

                        <p class="onco-card-description">
                            Informations relatives au traitement enregistré.
                        </p>

                    </div>

                </div>


                <div
                    class="rounded-2xl p-5"
                    style="
                        background:#FFF9FA;
                        border:1px solid #F0DDE1;
                    "
                >

                    @if($suivi->traitement)

                        <p
                            class="text-sm leading-7 text-[#293331]"
                            style="white-space:pre-line;"
                        >
                            {{ $suivi->traitement }}
                        </p>

                    @else

                        <p class="text-sm italic text-[#8B918E]">
                            Aucun traitement renseigné.
                        </p>

                    @endif

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- ACTION --}}
            {{-- ====================================================== --}}

            <div
                class="pt-6"
                style="margin-top:4px;"
            >

                <a
                    href="{{ route('patient.suivis.index') }}"
                    class="onco-btn onco-btn-secondary"
                >
                    ← Retour à mes suivis
                </a>

            </div>


            {{-- ====================================================== --}}
            {{-- PRIVACY --}}
            {{-- ====================================================== --}}

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

                    <h3
                        class="onco-info-title"
                        style="color:#9A6470;"
                    >
                        Confidentialité de vos données
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#8B6D74;"
                    >
                        Ces informations sont personnelles et sont affichées
                        uniquement dans votre espace sécurisé OncoCare.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>