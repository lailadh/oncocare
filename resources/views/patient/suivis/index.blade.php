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
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            ♡
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Mes suivis médicaux
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez l'historique de vos suivis médicaux.
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

                {{-- Total suivis --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#9A6470;"
                        >
                            Mes suivis
                        </span>

                        <div class="onco-summary-value">
                            {{ $suivis->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#8B6D74]">
                            suivis médicaux enregistrés
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ♡
                    </div>

                </div>


                {{-- Confidentialité --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#63856D;"
                        >
                            Confidentialité
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Protégée
                        </div>

                        <p class="mt-1 text-xs text-[#607467]">
                            Vos informations sont accessibles de manière sécurisée
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        🔒
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- LISTE DES SUIVIS --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="
                    margin-top:28px;
                    padding:0;
                "
            >

                <div
                    class="onco-card-header"
                    style="
                        padding:22px 24px;
                        margin-bottom:0;
                    "
                >

                    <div>

                        <h2 class="onco-card-title">
                            Historique de mes suivis
                        </h2>

                        <p class="onco-card-description">
                            Retrouvez les informations enregistrées lors de vos suivis médicaux.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#9A6470;"
                    >
                        {{ $suivis->count() }} suivi(s)
                    </span>

                </div>


                @if($suivis->isEmpty())

                    {{-- Empty state --}}
                    <div
                        class="onco-empty-state"
                        style="padding:60px 24px;"
                    >

                        <div
                            class="onco-empty-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            🩺
                        </div>

                        <h2 class="onco-empty-title">
                            Aucun suivi trouvé
                        </h2>

                        <p class="onco-empty-text">
                            Aucun suivi médical n'a encore été enregistré pour votre dossier.
                        </p>

                    </div>

                @else

                    <div class="space-y-5 p-5 sm:p-6">

                        @foreach($suivis as $suivi)

                            <div
                                class="rounded-[20px] border border-[#E3DDD8] bg-white p-5 shadow-[0_4px_18px_rgba(41,51,49,0.035)] transition hover:-translate-y-0.5 hover:border-[#E8BBC4] hover:shadow-[0_8px_26px_rgba(217,154,166,0.08)]"
                            >

                                {{-- ================================================== --}}
                                {{-- MAIN INFO --}}
                                {{-- ================================================== --}}

                                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                                    {{-- Date --}}
                                    <div>

                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                                            Date du suivi
                                        </p>

                                        <p
                                            class="mt-2 text-xl font-medium text-[#293331]"
                                            style="font-family:'Newsreader',serif;"
                                        >
                                            {{
                                                \Carbon\Carbon::parse(
                                                    $suivi->date_suivi
                                                )->format('d/m/Y')
                                            }}
                                        </p>

                                    </div>


                                    {{-- Cancer --}}
                                    <div class="lg:flex-1 lg:px-6">

                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                                            Type de cancer
                                        </p>

                                        <p class="mt-2 text-sm font-semibold text-[#293331]">
                                            {{ $suivi->type_cancer ?? 'Non renseigné' }}
                                        </p>

                                    </div>


                                    {{-- Stade --}}
                                    <div>

                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                                            Stade
                                        </p>

                                        <div style="margin-top:8px;">

                                            <span
                                                class="onco-badge"
                                                style="
                                                    background:#FBF1F3;
                                                    color:#9A6470;
                                                    font-size:11px;
                                                "
                                            >
                                                {{ $suivi->stade ?? 'Non renseigné' }}
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- ================================================== --}}
                                {{-- MEDECIN --}}
                                {{-- ================================================== --}}

                                @if($suivi->medecin && $suivi->medecin->utilisateur)

                                    <div
                                        class="mt-5 flex items-center gap-3 rounded-2xl p-4"
                                        style="
                                            background:#F8F6FB;
                                            border:1px solid #E4E0EE;
                                        "
                                    >

                                        <div
                                            class="onco-avatar"
                                            style="
                                                width:42px;
                                                height:42px;
                                                background:#F1EFF8;
                                                color:#655A88;
                                                font-size:15px;
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

                                            <p class="mt-1 text-sm font-semibold text-[#293331]">
                                                Dr.
                                                {{ $suivi->medecin->utilisateur->prenom }}
                                                {{ $suivi->medecin->utilisateur->nom }}
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                {{-- ================================================== --}}
                                {{-- DETAILS --}}
                                {{-- ================================================== --}}

                                <div
                                    class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-3"
                                >

                                    {{-- Observation --}}
                                    <div
                                        class="rounded-2xl p-4"
                                        style="
                                            background:#FAF9F8;
                                            border:1px solid #EEEAE6;
                                        "
                                    >

                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                                            Observation
                                        </p>

                                        <p class="mt-2 text-sm leading-6 text-[#66706D]">
                                            {{ $suivi->observation ?: 'Aucune observation.' }}
                                        </p>

                                    </div>


                                    {{-- Evolution --}}
                                    <div
                                        class="rounded-2xl p-4"
                                        style="
                                            background:#F8FAF8;
                                            border:1px solid #E0E9E2;
                                        "
                                    >

                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#738177]">
                                            Évolution
                                        </p>

                                        <div style="margin-top:9px;">

                                            @if($suivi->evolution)

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#EEF5F0;
                                                        color:#63856D;
                                                        font-size:11px;
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


                                    {{-- Traitement --}}
                                    <div
                                        class="rounded-2xl p-4"
                                        style="
                                            background:#FBF1F3;
                                            border:1px solid #F0DDE1;
                                        "
                                    >

                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#9A6470]">
                                            Traitement
                                        </p>

                                        <p class="mt-2 text-sm leading-6 text-[#66706D]">
                                            {{ $suivi->traitement ?: 'Non renseigné.' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endforeach

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
                        Vos données médicales restent confidentielles
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#8B6D74;"
                    >
                        Votre historique de suivi est accessible uniquement
                        dans le cadre prévu par les règles de confidentialité
                        et d'autorisation de la plateforme.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>