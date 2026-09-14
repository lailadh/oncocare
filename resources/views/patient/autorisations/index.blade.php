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
                                style="background:#FBF1F3;color:#D99AA6;"
                            >
                                ◎
                            </div>

                            <div>

                                <h1 class="onco-page-title">
                                    Mes autorisations
                                </h1>

                                <p class="onco-page-subtitle">
                                    Gérez les autorisations accordées à vos proches.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Ajouter --}}
                    <a
                        href="{{ route('patient.autorisations.create') }}"
                        class="onco-btn onco-btn-patient"
                    >
                        <span>+</span>
                        <span>Ajouter un proche</span>
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
            {{-- ERRORS --}}
            {{-- ====================================================== --}}

            @if($errors->any())

                <div
                    class="onco-alert onco-alert-error"
                    style="margin-top:24px;"
                >

                    <div class="onco-alert-icon">
                        !
                    </div>

                    <div>

                        <div class="onco-alert-title">
                            Vérifiez les informations saisies
                        </div>

                        <div class="onco-alert-text">

                            <ul style="margin:6px 0 0;padding-left:18px;">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

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
                    grid-template-columns:repeat(3,minmax(0,1fr));
                "
            >

                {{-- Total proches --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#9A6470;"
                        >
                            Proches autorisés
                        </span>

                        <div class="onco-summary-value">
                            {{ $autorisations->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#8B6D74]">
                            personnes ayant une autorisation
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ◎
                    </div>

                </div>


                {{-- Accès suivis --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#63856D;"
                        >
                            Accès aux suivis
                        </span>

                        <div class="onco-summary-value">
                            {{ $autorisations->where('acces_suivi', true)->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#607467]">
                            autorisations actives pour les suivis
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        ✓
                    </div>

                </div>


                {{-- Accès RDV --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#8A6B32;"
                        >
                            Accès aux rendez-vous
                        </span>

                        <div class="onco-summary-value">
                            {{ $autorisations->where('acces_rendez_vous', true)->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            autorisations pour les rendez-vous
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F8F1E1;color:#C7A45B;"
                    >
                        ◷
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- LISTE --}}
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
                            Proches et autorisations
                        </h2>

                        <p class="onco-card-description">
                            Contrôlez les informations auxquelles chaque proche peut accéder.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#9A6470;"
                    >
                        {{ $autorisations->count() }} autorisation(s)
                    </span>

                </div>


                @if($autorisations->isEmpty())

                    {{-- Empty state --}}
                    <div
                        class="onco-empty-state"
                        style="padding:60px 24px;"
                    >

                        <div
                            class="onco-empty-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            ◎
                        </div>

                        <h2 class="onco-empty-title">
                            Aucune autorisation
                        </h2>

                        <p class="onco-empty-text">
                            Vous n'avez encore accordé aucune autorisation à un proche.
                        </p>

                        <a
                            href="{{ route('patient.autorisations.create') }}"
                            class="onco-btn onco-btn-patient"
                            style="margin-top:18px;"
                        >
                            <span>+</span>
                            <span>Ajouter un proche</span>
                        </a>

                    </div>

                @else

                    <div class="onco-table-wrapper">

                        <table class="onco-table">

                            <thead>

                                <tr>

                                    <th>
                                        Proche
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Suivis
                                    </th>

                                    <th>
                                        Rendez-vous
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

                                @foreach($autorisations as $autorisation)

                                    <tr>

                                        {{-- Proche --}}
                                        <td>

                                            <div class="onco-user-cell">

                                                <div
                                                    class="onco-avatar"
                                                    style="
                                                        background:#EEF5F0;
                                                        color:#63856D;
                                                    "
                                                >
                                                    {{
                                                        strtoupper(
                                                            substr(
                                                                $autorisation->proche->prenom ?? 'P',
                                                                0,
                                                                1
                                                            )
                                                        )
                                                    }}
                                                </div>

                                                <div>

                                                    <div class="onco-user-name">
                                                        {{ $autorisation->proche->prenom }}
                                                        {{ $autorisation->proche->nom }}
                                                    </div>

                                                    <div class="onco-user-meta">
                                                        {{ $autorisation->proche->email }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Date --}}
                                        <td>

                                            <span class="onco-table-secondary">
                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $autorisation->date_autorisation
                                                    )->format('d/m/Y')
                                                }}
                                            </span>

                                        </td>


                                        {{-- Accès suivis --}}
                                        <td>

                                            @if($autorisation->acces_suivi)

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#EEF5F0;
                                                        color:#63856D;
                                                    "
                                                >
                                                    ✓ Autorisé
                                                </span>

                                            @else

                                                <span
                                                    class="onco-badge onco-badge-neutral"
                                                >
                                                    Non autorisé
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Accès rendez-vous --}}
                                        <td>

                                            @if($autorisation->acces_rendez_vous)

                                                <span
                                                    class="onco-badge"
                                                    style="
                                                        background:#EEF5F0;
                                                        color:#63856D;
                                                    "
                                                >
                                                    ✓ Autorisé
                                                </span>

                                            @else

                                                <span
                                                    class="onco-badge onco-badge-neutral"
                                                >
                                                    Non autorisé
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Statut --}}
                                        <td>

                                            @if($autorisation->statut === 'active')

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

                                                    Active
                                                </span>

                                            @else

                                                <span class="onco-badge onco-badge-neutral">
                                                    {{ ucfirst($autorisation->statut) }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td>

                                            <div class="onco-actions">

                                                <a
                                                    href="{{ route('patient.autorisations.edit', $autorisation) }}"
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
                                                    Modifier
                                                </a>


                                                <form
                                                    method="POST"
                                                    action="{{ route('patient.autorisations.destroy', $autorisation) }}"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette autorisation ?');"
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
            {{-- SECURITY / ACCESS EXPLANATION --}}
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
                        Vous gardez le contrôle de vos accès
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#8B6D74;"
                    >
                        Chaque proche reçoit uniquement les autorisations que
                        vous lui accordez. Vous pouvez modifier ou supprimer
                        une autorisation à tout moment.
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