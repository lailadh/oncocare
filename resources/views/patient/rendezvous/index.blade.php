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
                            ◷
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Mes rendez-vous
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez vos rendez-vous médicaux.
                            </p>

                        </div>

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
            {{-- SUMMARY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-summary-grid"
                style="
                    margin-top:28px;
                    grid-template-columns:repeat(2,minmax(0,1fr));
                "
            >

                {{-- Total --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#9A6470;"
                        >
                            Mes rendez-vous
                        </span>

                        <div class="onco-summary-value">
                            {{ $rendezVous->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#8B6D74]">
                            rendez-vous planifiés
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ◷
                    </div>

                </div>


                {{-- En attente --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#8A6B32;"
                        >
                            En attente
                        </span>

                        <div class="onco-summary-value">
                            {{ $rendezVous->where('statut', 'en_attente')->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            demandes en attente de confirmation
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F8F1E1;color:#C7A45B;"
                    >
                        !
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- TABLE --}}
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
                            Historique des rendez-vous
                        </h2>

                        <p class="onco-card-description">
                            Retrouvez les informations principales de vos rendez-vous.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#9A6470;"
                    >
                        {{ $rendezVous->count() }} rendez-vous
                    </span>

                </div>


                @if($rendezVous->isEmpty())

                    {{-- Empty state --}}
                    <div
                        class="onco-empty-state"
                        style="padding:60px 24px;"
                    >

                        <div
                            class="onco-empty-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            ◷
                        </div>

                        <h2 class="onco-empty-title">
                            Aucun rendez-vous
                        </h2>

                        <p class="onco-empty-text">
                            Vous n'avez pas encore de rendez-vous planifié.
                            Votre médecin vous informera lorsqu'un rendez-vous
                            sera disponible.
                        </p>

                    </div>

                @else

                    <div class="onco-table-wrapper">

                        <table class="onco-table">

                            <thead>

                                <tr>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Médecin
                                    </th>

                                    <th>
                                        Motif
                                    </th>

                                    <th>
                                        Statut
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($rendezVous as $rdv)

                                    <tr>

                                        {{-- Date --}}
                                        <td>

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="onco-avatar"
                                                    style="
                                                        width:42px;
                                                        height:42px;
                                                        background:#FBF1F3;
                                                        color:#B97886;
                                                        font-size:14px;
                                                    "
                                                >
                                                    ◷
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">

                                                        {{
                                                            \Carbon\Carbon::parse(
                                                                $rdv->date_heure
                                                            )->format('d/m/Y')
                                                        }}

                                                    </div>

                                                    <div class="onco-user-meta">

                                                        {{
                                                            \Carbon\Carbon::parse(
                                                                $rdv->date_heure
                                                            )->format('H:i')
                                                        }}

                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Médecin --}}
                                        <td>

                                            @if($rdv->medecin && $rdv->medecin->utilisateur)

                                                <div class="onco-user-cell">

                                                    <div
                                                        class="onco-avatar"
                                                        style="
                                                            background:#F1EFF8;
                                                            color:#655A88;
                                                        "
                                                    >
                                                        {{
                                                            strtoupper(
                                                                substr(
                                                                    $rdv->medecin->utilisateur->prenom ?? 'M',
                                                                    0,
                                                                    1
                                                                )
                                                            )
                                                        }}
                                                    </div>

                                                    <div>

                                                        <div class="onco-user-name">
                                                            Dr {{ $rdv->medecin->utilisateur->prenom }}
                                                            {{ $rdv->medecin->utilisateur->nom }}
                                                        </div>

                                                        <div class="onco-user-meta">
                                                            Médecin associé
                                                        </div>

                                                    </div>

                                                </div>

                                            @else

                                                <span class="onco-table-secondary">
                                                    Médecin non disponible
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Motif --}}
                                        <td>

                                            <span class="onco-table-secondary">
                                                {{ $rdv->motif ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Statut --}}
                                        <td>

                                            @if($rdv->statut === 'confirme')

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#EAF4EC;
                                                        color:#4B7655;
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

                                            @elseif($rdv->statut === 'refuse')

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#F7E9EB;
                                                        color:#9A5661;
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

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#F8F1E1;
                                                        color:#8A6B32;
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

                                            @endif

                                        </td>


                                        {{-- Action --}}
                                        <td>

                                            <a
                                                href="{{ route('patient.rendezvous.show', $rdv) }}"
                                                class="onco-btn"
                                                style="
                                                    min-height:36px;
                                                    padding:8px 12px;
                                                    font-size:11px;
                                                    background:#FBF1F3;
                                                    color:#9A6470;
                                                    border:1px solid #F0DDE1;
                                                "
                                            >
                                                Voir les détails
                                                <span>→</span>
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>


            {{-- ====================================================== --}}
            {{-- INFORMATION --}}
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
                    ♡
                </div>

                <div>

                    <h3
                        class="onco-info-title"
                        style="color:#9A6470;"
                    >
                        Suivi de vos rendez-vous
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#8B6D74;"
                    >
                        Consultez le statut de chaque rendez-vous. Votre médecin
                        vous informera de toute modification ou confirmation.
                    </p>

                </div>

            </div>


            {{-- Retour --}}
            <div style="margin-top:20px;">

                <a
                    href="{{ route('dashboard') }}"
                    class="onco-back-link"
                >
                    ← Retour au dashboard
                </a>

            </div>

        </div>

    </div>

</x-app-layout>