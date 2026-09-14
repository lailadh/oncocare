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
                            ♡
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Suivis médicaux
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez et gérez les suivis médicaux de vos patients.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Ajouter un suivi --}}
                @can('create', App\Models\Suivi::class)

                    <a
                        href="{{ route('suivis.create') }}"
                        class="onco-btn onco-btn-medecin"
                        style="margin-top:20px;"
                    >
                        <span>+</span>
                        <span>Ajouter un suivi</span>
                    </a>

                @endcan

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

                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#655A88;"
                        >
                            Total des suivis
                        </span>

                        <div class="onco-summary-value">
                            {{ $suivis->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            suivis médicaux enregistrés
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
                            Accès sécurisé
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Autorisé
                        </div>

                        <p class="mt-1 text-xs text-[#607467]">
                            Selon vos patients associés et vos permissions
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
            {{-- LIST --}}
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
                            Liste des suivis
                        </h2>

                        <p class="onco-card-description">
                            Retrouvez les informations principales de chaque suivi.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
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
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            ♡
                        </div>

                        <h3 class="onco-empty-title">
                            Aucun suivi trouvé
                        </h3>

                        <p class="onco-empty-text">
                            Aucun suivi médical n'est actuellement enregistré
                            pour vos patients.
                        </p>

                        @can('create', App\Models\Suivi::class)

                            <a
                                href="{{ route('suivis.create') }}"
                                class="onco-btn onco-btn-medecin"
                                style="margin-top:18px;"
                            >
                                <span>+</span>
                                <span>Ajouter un suivi</span>
                            </a>

                        @endcan

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
                                        Date du suivi
                                    </th>

                                    <th>
                                        Type de cancer
                                    </th>

                                    <th>
                                        Stade
                                    </th>

                                    <th>
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($suivis as $suivi)

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
                                                                $suivi->patient->utilisateur->prenom ?? 'P',
                                                                0,
                                                                1
                                                            )
                                                        )
                                                    }}
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">
                                                        {{ $suivi->patient->utilisateur->prenom }}
                                                        {{ $suivi->patient->utilisateur->nom }}
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
                                                    $suivi->date_suivi
                                                        ? \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y')
                                                        : 'Non renseignée'
                                                }}
                                            </span>

                                        </td>


                                        {{-- Type cancer --}}
                                        <td>

                                            <span class="onco-table-primary">
                                                {{ $suivi->type_cancer ?? 'Non renseigné' }}
                                            </span>

                                        </td>


                                        {{-- Stade --}}
                                        <td>

                                            @if($suivi->stade)

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#F1EFF8;
                                                        color:#655A88;
                                                    "
                                                >
                                                    {{ $suivi->stade }}
                                                </span>

                                            @else

                                                <span class="onco-table-secondary">
                                                    Non renseigné
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td>

                                            <div class="onco-actions">

                                                @can('view', $suivi)

                                                    <a
                                                        href="{{ route('suivis.show', $suivi) }}"
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

                                                @endcan


                                                @can('update', $suivi)

                                                    <a
                                                        href="{{ route('suivis.edit', $suivi) }}"
                                                        class="onco-btn"
                                                        style="
                                                            min-height:36px;
                                                            padding:8px 12px;
                                                            font-size:11px;
                                                            background:#F1EFF8;
                                                            color:#655A88;
                                                            border:1px solid #DED9EB;
                                                        "
                                                    >
                                                        Modifier
                                                    </a>

                                                @endcan


                                                @can('delete', $suivi)

                                                    <form
                                                        method="POST"
                                                        action="{{ route('suivis.destroy', $suivi) }}"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce suivi ?');"
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

                                                @endcan

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
                        Confidentialité des suivis
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Les suivis affichés correspondent aux patients associés
                        à votre compte. Les actions disponibles dépendent de vos
                        autorisations.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>