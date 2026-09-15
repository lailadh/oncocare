<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('rendezvous.index') }}"
                    class="onco-back-link"
                >
                    ← Retour aux rendez-vous
                </a>

                <div class="onco-title-wrap">

                    <div
                        class="onco-page-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ◷
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Détails du rendez-vous
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les informations détaillées de ce rendez-vous.
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
            {{-- ERROR --}}
            {{-- ====================================================== --}}

            @if($errors->has('rendezVous'))

                <div
                    class="onco-alert"
                    style="
                        margin-top:24px;
                        border-color:#F0D7DF;
                        background:#FDF3F5;
                    "
                >

                    <div
                        class="onco-alert-icon"
                        style="color:#C9788D;"
                    >
                        !
                    </div>

                    <div>

                        <div
                            class="onco-alert-title"
                            style="color:#9A5661;"
                        >
                            Attention
                        </div>

                        <div class="onco-alert-text">
                            {{ $errors->first('rendezVous') }}
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
                {{-- PARTICIPANTS --}}
                {{-- ================================================== --}}

                <div
                    class="grid grid-cols-1 gap-4 md:grid-cols-2"
                >

                    {{-- Patient --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#F8F6FB;
                            border:1px solid #E4E0EE;
                        "
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="onco-avatar"
                                style="
                                    width:50px;
                                    height:50px;
                                    background:#F1EFF8;
                                    color:#655A88;
                                    font-size:18px;
                                "
                            >
                                {{
                                    strtoupper(
                                        substr(
                                            $rendezVous->patient->utilisateur->prenom ?? 'P',
                                            0,
                                            1
                                        )
                                    )
                                }}
                            </div>

                            <div>

                                <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#7D758C]">
                                    Patient
                                </p>

                                <p class="mt-1 text-lg font-semibold text-[#293331]">
                                    {{ $rendezVous->patient->utilisateur->prenom ?? '' }}
                                    {{ $rendezVous->patient->utilisateur->nom ?? '' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Médecin --}}
                    <div
                        class="rounded-2xl p-5"
                        style="
                            background:#F0F6F2;
                            border:1px solid #DDE9E0;
                        "
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="onco-avatar"
                                style="
                                    width:50px;
                                    height:50px;
                                    background:#EEF5F0;
                                    color:#63856D;
                                    font-size:18px;
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

                                <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#738177]">
                                    Médecin
                                </p>

                                <p class="mt-1 text-lg font-semibold text-[#293331]">
                                    Dr {{ $rendezVous->medecin->utilisateur->prenom ?? '' }}
                                    {{ $rendezVous->medecin->utilisateur->nom ?? '' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================== --}}
                {{-- DATE / HEURE / MOTIF / STATUT --}}
                {{-- ================================================== --}}

                <div
                    class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2"
                >

                    {{-- Date --}}
                    <div
                        class="rounded-2xl p-5"
                        style="background:#FAF9F8;"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Date
                        </p>

                        <div class="mt-2 flex items-center gap-3">

                            <span
                                class="onco-summary-icon"
                                style="
                                    width:40px;
                                    height:40px;
                                    min-width:40px;
                                    background:#F1EFF8;
                                    color:#7567A8;
                                "
                            >
                                ◷
                            </span>

                            <p class="text-lg font-semibold text-[#293331]">

                                @if($rendezVous->date_heure)

                                    {{ $rendezVous->date_heure->format('d/m/Y') }}

                                @else

                                    Non planifiée

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- Heure --}}
                    <div
                        class="rounded-2xl p-5"
                        style="background:#FAF9F8;"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Heure
                        </p>

                        <div class="mt-2 flex items-center gap-3">

                            <span
                                class="onco-summary-icon"
                                style="
                                    width:40px;
                                    height:40px;
                                    min-width:40px;
                                    background:#F8F1E1;
                                    color:#C7A45B;
                                "
                            >
                                ◷
                            </span>

                            <p class="text-lg font-semibold text-[#293331]">

                                @if($rendezVous->date_heure)

                                    {{ $rendezVous->date_heure->format('H:i') }}

                                @else

                                    —

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- Motif --}}
                    <div
                        class="rounded-2xl p-5"
                        style="background:#FAF9F8;"
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
                        style="background:#FAF9F8;"
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

                            @elseif($rendezVous->statut === 'terminee')

                                <span
                                    class="onco-badge"
                                    style="
                                        background:#F3F1F5;
                                        color:#6D6878;
                                        font-size:12px;
                                    "
                                >
                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:#8F8998;
                                        "
                                    ></span>

                                    Terminé
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
                {{-- DEMANDE EN ATTENTE --}}
                {{-- ================================================== --}}

                @if($rendezVous->statut === 'en_attente')

                    <div
                        class="mt-6 rounded-2xl border border-[#E5D9BD] bg-[#FCF8EF] p-5"
                    >

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <p class="text-sm font-semibold text-[#7D612E]">
                                    Cette demande est en attente de planification.
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#8A7650]">
                                    Choisissez une date et une heure pour confirmer
                                    le rendez-vous du patient.
                                </p>

                            </div>

                            <a
                                href="{{ route('rendezvous.edit', $rendezVous) }}"
                                class="onco-btn onco-btn-medecin"
                            >
                                Planifier et confirmer
                                <span>→</span>
                            </a>

                        </div>

                    </div>

                @endif


                {{-- ================================================== --}}
                {{-- ACTIONS --}}
                {{-- ================================================== --}}

                <div
                    class="mt-7 flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:items-center sm:justify-between"
                    style="border-color:#EEEAE6;"
                >

                    <a
                        href="{{ route('rendezvous.index') }}"
                        class="onco-btn onco-btn-secondary"
                    >
                        ← Retour aux rendez-vous
                    </a>


                    <div class="flex flex-col gap-3 sm:flex-row">

                        {{-- Planifier --}}
                        @if($rendezVous->statut === 'en_attente')

                            <a
                                href="{{ route('rendezvous.edit', $rendezVous) }}"
                                class="onco-btn onco-btn-medecin"
                            >
                                Planifier
                            </a>

                        @endif


                        {{-- Supprimer --}}
                        <form
                            method="POST"
                            action="{{ route('rendezvous.destroy', $rendezVous) }}"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="onco-btn onco-btn-danger"
                            >
                                Supprimer le rendez-vous
                            </button>

                        </form>

                    </div>

                </div>

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
                        Confidentialité du rendez-vous
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Les informations de ce rendez-vous sont accessibles
                        uniquement aux utilisateurs autorisés dans le cadre
                        du suivi médical.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>