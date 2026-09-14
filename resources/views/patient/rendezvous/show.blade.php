<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('patient.rendezvous.index') }}"
                    class="onco-back-link"
                >
                    ← Retour à mes rendez-vous
                </a>

                <div class="onco-title-wrap">

                    <div
                        class="onco-page-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ◷
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Détails de mon rendez-vous
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les informations de votre rendez-vous.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- SUCCESS --}}
            {{-- ====================================================== --}}

            @if(session('success'))

                <div
                    class="onco-alert"
                    style="
                        margin-top:24px;
                        border-color:#D5E5D9;
                        background:#F0F7F1;
                    "
                >

                    <div
                        class="onco-alert-icon"
                        style="color:#7FA68A;"
                    >
                        ✓
                    </div>

                    <div>

                        <div
                            class="onco-alert-title"
                            style="color:#4D7257;"
                        >
                            Opération réussie
                        </div>

                        <div class="onco-alert-text">
                            {{ session('success') }}
                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================== --}}
            {{-- MAIN CARD --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                {{-- ================================================== --}}
                {{-- MEDECIN --}}
                {{-- ================================================== --}}

                <div
                    class="rounded-2xl p-5"
                    style="
                        background:#F8F6FB;
                        border:1px solid #E4E0EE;
                    "
                >

                    <div class="flex items-center gap-4">

                        <div
                            class="onco-avatar"
                            style="
                                width:58px;
                                height:58px;
                                background:#F1EFF8;
                                color:#655A88;
                                font-size:20px;
                            "
                        >
                            {{
                                strtoupper(
                                    substr(
                                        $rendezVous->medecin->utilisateur->prenom ?? 'M',
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
                                class="mt-1 text-xl font-semibold text-[#293331]"
                            >
                                Dr {{ $rendezVous->medecin->utilisateur->prenom }}
                                {{ $rendezVous->medecin->utilisateur->nom }}
                            </p>

                            @if($rendezVous->medecin->specialite)

                                <p class="mt-1 text-sm text-[#66706D]">
                                    {{ $rendezVous->medecin->specialite }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- ================================================== --}}
                {{-- DATE / HEURE --}}
                {{-- ================================================== --}}

                <div
                    class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2"
                >

                    {{-- Date --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#FFF9FA;
                            border:1px solid #F0DDE1;
                        "
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#9A6470]">
                            Date
                        </p>

                        <div class="mt-3 flex items-center gap-3">

                            <div
                                class="onco-summary-icon"
                                style="
                                    width:42px;
                                    height:42px;
                                    min-width:42px;
                                    background:#FBF1F3;
                                    color:#D99AA6;
                                "
                            >
                                ◷
                            </div>

                            <p
                                class="text-xl font-medium text-[#293331]"
                                style="font-family:'Newsreader',serif;"
                            >
                                {{
                                    \Carbon\Carbon::parse(
                                        $rendezVous->date_heure
                                    )->format('d/m/Y')
                                }}
                            </p>

                        </div>

                    </div>


                    {{-- Heure --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#FAF9F8;
                            border:1px solid #EEEAE6;
                        "
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Heure
                        </p>

                        <div class="mt-3 flex items-center gap-3">

                            <div
                                class="onco-summary-icon"
                                style="
                                    width:42px;
                                    height:42px;
                                    min-width:42px;
                                    background:#F8F1E1;
                                    color:#C7A45B;
                                "
                            >
                                ◷
                            </div>

                            <p
                                class="text-xl font-medium text-[#293331]"
                                style="font-family:'Newsreader',serif;"
                            >
                                {{
                                    \Carbon\Carbon::parse(
                                        $rendezVous->date_heure
                                    )->format('H:i')
                                }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================== --}}
                {{-- MOTIF / STATUT --}}
                {{-- ================================================== --}}

                <div
                    class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2"
                >

                    {{-- Motif --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#FAF9F8;
                            border:1px solid #EEEAE6;
                        "
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Motif
                        </p>

                        <p class="mt-3 text-sm font-semibold text-[#293331]">
                            {{ $rendezVous->motif ?? 'Non renseigné' }}
                        </p>

                    </div>


                    {{-- Statut --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#FAF9F8;
                            border:1px solid #EEEAE6;
                        "
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Statut
                        </p>

                        <div class="mt-3">

                            @if($rendezVous->statut === 'en_attente')

                                <span
                                    class="onco-badge"
                                    style="
                                        background:#F8F1E1;
                                        color:#8A6B32;
                                        font-size:12px;
                                    "
                                >
                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:#C7A45B;
                                        "
                                    ></span>

                                    En attente
                                </span>

                            @elseif($rendezVous->statut === 'confirme')

                                <span
                                    class="onco-badge"
                                    style="
                                        background:#EAF4EC;
                                        color:#4B7655;
                                        font-size:12px;
                                    "
                                >
                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:#7FA68A;
                                        "
                                    ></span>

                                    Confirmé
                                </span>

                            @elseif($rendezVous->statut === 'refuse')

                                <span
                                    class="onco-badge"
                                    style="
                                        background:#F7E9EB;
                                        color:#9A5661;
                                        font-size:12px;
                                    "
                                >
                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:#D99AA6;
                                        "
                                    ></span>

                                    Refusé
                                </span>

                            @else

                                <span class="onco-badge onco-badge-neutral">
                                    {{ $rendezVous->statut }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- ================================================== --}}
                {{-- INFORMATION --}}
                {{-- ================================================== --}}

                <div
                    class="mt-6 rounded-2xl p-5"
                    style="
                        background:#FFF9FA;
                        border:1px solid #F0DDE1;
                    "
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="onco-info-icon"
                            style="
                                width:40px;
                                height:40px;
                                min-width:40px;
                                background:#FBF1F3;
                                color:#D99AA6;
                            "
                        >
                            ♡
                        </div>

                        <div>

                            <h3
                                class="text-sm font-semibold text-[#9A6470]"
                            >
                                À propos de votre rendez-vous
                            </h3>

                            <p
                                class="mt-1 text-xs leading-6 text-[#8B6D74]"
                            >
                                Consultez régulièrement le statut de votre rendez-vous.
                                Votre médecin vous informera de toute modification ou
                                confirmation.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================== --}}
                {{-- ACTION --}}
                {{-- ================================================== --}}

                <div
                    class="mt-7 border-t pt-6"
                    style="border-color:#EEEAE6;"
                >

                    <a
                        href="{{ route('patient.rendezvous.index') }}"
                        class="onco-btn onco-btn-secondary"
                    >
                        ← Retour à mes rendez-vous
                    </a>

                </div>

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
                        Confidentialité de votre rendez-vous
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#8B6D74;"
                    >
                        Les informations de votre rendez-vous sont personnelles
                        et accessibles uniquement dans votre espace sécurisé OncoCare.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>