<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

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
                                ◷
                            </div>

                            <div>

                                <h1 class="onco-page-title">
                                    Mes rendez-vous
                                </h1>

                                <p class="onco-page-subtitle">
                                    Consultez les rendez-vous planifiés pour vos patients.
                                </p>

                            </div>

                        </div>

                    </div>


                    <a
                        href="{{ route('rendezvous.create') }}"
                        class="onco-btn onco-btn-medecin"
                    >
                        <span>+</span>
                        <span>Créer un rendez-vous</span>
                    </a>

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
                            style="color:#655A88;"
                        >
                            Total des rendez-vous
                        </span>

                        <div class="onco-summary-value">
                            {{ $rendezVous->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            rendez-vous planifiés
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ◷
                    </div>

                </div>


                {{-- Pending --}}
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
                            demandes à traiter
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
            {{-- APPOINTMENTS TABLE --}}
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
                            Liste des rendez-vous
                        </h2>

                        <p class="onco-card-description">
                            Retrouvez les rendez-vous de vos patients et leur statut.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
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
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            ◷
                        </div>

                        <h3 class="onco-empty-title">
                            Aucun rendez-vous trouvé
                        </h3>

                        <p class="onco-empty-text">
                            Aucun rendez-vous n'est actuellement planifié
                            pour vos patients.
                        </p>

                        <a
                            href="{{ route('rendezvous.create') }}"
                            class="onco-btn onco-btn-medecin"
                            style="margin-top:18px;"
                        >
                            <span>+</span>
                            <span>Créer un rendez-vous</span>
                        </a>

                    </div>

                @else

                    <div class="onco-table-wrapper">

                        <table class="onco-table">

                            <thead>

                                <tr>

                                    <th>
                                        Patient
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Heure
                                    </th>

                                    <th>
                                        Motif
                                    </th>

                                    <th>
                                        Statut
                                    </th>

                                    <th>
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($rendezVous as $rendezVousItem)

                                    <tr>

                                        {{-- Patient --}}
                                        <td>

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
                                                                $rendezVousItem->patient->utilisateur->prenom ?? 'P',
                                                                0,
                                                                1
                                                            )
                                                        )
                                                    }}
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">
                                                        {{ $rendezVousItem->patient->utilisateur->prenom }}
                                                        {{ $rendezVousItem->patient->utilisateur->nom }}
                                                    </div>

                                                    <div class="onco-user-meta">
                                                        Patient OncoCare
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Date --}}
                                        <td>

                                            <span class="onco-table-primary">

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $rendezVousItem->date_heure
                                                    )->format('d/m/Y')
                                                }}

                                            </span>

                                        </td>


                                        {{-- Heure --}}
                                        <td>

                                            <span
                                                class="onco-badge"
                                                style="
                                                    background:#F8F6FB;
                                                    color:#655A88;
                                                "
                                            >

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $rendezVousItem->date_heure
                                                    )->format('H:i')
                                                }}

                                            </span>

                                        </td>


                                        {{-- Motif --}}
                                        <td>

                                            <span class="onco-table-secondary">
                                                {{ $rendezVousItem->motif ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Statut --}}
                                        <td>

                                            @if($rendezVousItem->statut === 'en_attente')

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#F8F1E1;
                                                        color:#8A6B32;
                                                    "
                                                >
                                                    <span
                                                        style="
                                                            width:6px;
                                                            height:6px;
                                                            border-radius:50%;
                                                            background:#C7A45B;
                                                        "
                                                    ></span>
                                                    En attente
                                                </span>

                                            @elseif($rendezVousItem->statut === 'confirme')

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#EAF4EC;
                                                        color:#4B7655;
                                                    "
                                                >
                                                    <span
                                                        style="
                                                            width:6px;
                                                            height:6px;
                                                            border-radius:50%;
                                                            background:#7FA68A;
                                                        "
                                                    ></span>
                                                    Confirmé
                                                </span>

                                            @elseif($rendezVousItem->statut === 'refuse')

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#F7E9EB;
                                                        color:#9A5661;
                                                    "
                                                >
                                                    <span
                                                        style="
                                                            width:6px;
                                                            height:6px;
                                                            border-radius:50%;
                                                            background:#D99AA6;
                                                        "
                                                    ></span>
                                                    Refusé
                                                </span>

                                            @else

                                                <span
                                                    class="onco-badge onco-badge-neutral"
                                                >
                                                    {{ $rendezVousItem->statut }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td>

                                            <div class="onco-actions">

                                                <a
                                                    href="{{ route('rendezvous.show', $rendezVousItem) }}"
                                                    class="onco-btn onco-btn-secondary"
                                                    style="
                                                        min-height:36px;
                                                        padding:8px 12px;
                                                        font-size:11px;
                                                    "
                                                >
                                                    Voir
                                                    <span>→</span>
                                                </a>


                                                <form
                                                    method="POST"
                                                    action="{{ route('rendezvous.destroy', $rendezVousItem) }}"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="onco-btn onco-btn-danger"
                                                        style="
                                                            min-height:36px;
                                                            padding:8px 12px;
                                                            font-size:11px;
                                                        "
                                                    >
                                                        Supprimer
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

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
                        Confidentialité des rendez-vous
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Les rendez-vous affichés correspondent uniquement à vos
                        patients associés. Leur gestion est réservée aux utilisateurs
                        autorisés de la plateforme.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>