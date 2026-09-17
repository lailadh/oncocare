<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ========================================================= --}}
            {{-- EN-TÊTE --}}
            {{-- ========================================================= --}}

            <div class="onco-page-header">

                <div>

                    <a
                        href="{{ route('admin.dashboard') }}"
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
                                Gestion des patients
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez les comptes des patients de la plateforme.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- MESSAGES --}}
            {{-- ========================================================= --}}

            @if(session('success'))

                <div
                    class="onco-alert onco-alert-success"
                    style="margin-top:24px;"
                >

                    <div class="onco-alert-icon">
                        ✓
                    </div>

                    <div>

                        <div class="onco-alert-title">
                            Opération réussie
                        </div>

                        <div class="onco-alert-text">
                            {{ session('success') }}
                        </div>

                    </div>

                </div>

            @endif


            @if(session('error'))

                <div
                    class="onco-alert onco-alert-error"
                    style="margin-top:24px;"
                >

                    <div class="onco-alert-icon">
                        !
                    </div>

                    <div>

                        <div class="onco-alert-title">
                            Une erreur est survenue
                        </div>

                        <div class="onco-alert-text">
                            {{ session('error') }}
                        </div>

                    </div>

                </div>

            @endif


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
                            Vérifiez les informations
                        </div>

                        <div class="onco-alert-text">

                            @foreach($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- RÉSUMÉ --}}
            {{-- ========================================================= --}}

            <div
                class="onco-summary-grid"
                style="margin-top:28px;"
            >

                {{-- Patients --}}
                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Patients enregistrés
                        </span>

                        <div class="onco-summary-value">
                            {{ $patients->count() }}
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ♡
                    </div>

                </div>


                {{-- Rôle --}}
                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Rôle
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Patient
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        P
                    </div>

                </div>


                {{-- Sécurité --}}
                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Accès
                        </span>

                        <div
                            class="onco-summary-value"
                            style="font-size:20px;"
                        >
                            Sécurisé
                        </div>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF6F1;color:#7FA68A;"
                    >
                        ✓
                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- LISTE DES PATIENTS --}}
            {{-- ========================================================= --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="onco-card-header">

                    <div>

                        <h2 class="onco-card-title">
                            Liste des patients
                        </h2>

                        <p class="onco-card-description">
                            Les comptes patients enregistrés sur OncoCare.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#B97886;"
                    >
                        {{ $patients->count() }} patient(s)
                    </span>

                </div>


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
                                    Rôle
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th>
                                    Médecins suivis
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($patients as $patient)

                                <tr>

                                    {{-- ================================================= --}}
                                    {{-- PATIENT --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        <div class="onco-user-cell">

                                            <div
                                                class="onco-avatar"
                                                style="background:#FBF1F3;color:#B97886;"
                                            >
                                                {{ strtoupper(
                                                    substr($patient->prenom ?? 'P', 0, 1)
                                                ) }}
                                            </div>

                                            <div>

                                                <div class="onco-user-name">

                                                    {{ $patient->prenom }}
                                                    {{ $patient->nom }}

                                                </div>

                                                <div class="onco-user-meta">
                                                    Compte patient
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- EMAIL --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        <span class="onco-table-primary">
                                            {{ $patient->email }}
                                        </span>

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- TÉLÉPHONE --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        <span class="onco-table-secondary">

                                            {{ $patient->telephone ?? 'Non renseigné' }}

                                        </span>

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- RÔLE --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        <span
                                            class="onco-badge"
                                            style="background:#FBF1F3;color:#B97886;"
                                        >
                                            Patient
                                        </span>

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- STATUT --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        @if($patient->statut === 'active')

                                            <span
                                                class="onco-status"
                                                style="color:#5D806A;"
                                            >

                                                <span
                                                    class="onco-status-dot"
                                                    style="background:#7FA68A;"
                                                ></span>

                                                Actif

                                            </span>

                                        @else

                                            <span
                                                class="onco-status"
                                                style="color:#8A8F8C;"
                                            >

                                                <span
                                                    class="onco-status-dot"
                                                    style="background:#B8BCB9;"
                                                ></span>

                                                {{ ucfirst($patient->statut ?? 'Actif') }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                            {{-- MÉDECINS SUIVIS --}}
                            {{-- ================================================= --}}

                            <td>

                                <div class="space-y-3">

                                    {{-- Médecins associés --}}
                                    @forelse(
                                        $patient->patient?->medecins ?? []
                                        as $medecin
                                    )

                                        <div
                                            class="rounded-xl border border-[#E7E3D8] bg-[#FAF9F7] p-3"
                                        >

                                            <div
                                                class="flex items-center justify-between gap-3"
                                            >

                                                {{-- Médecin --}}
                                                <div class="min-w-0">

                                                    <div
                                                        class="flex items-center gap-2"
                                                    >

                                                        <div
                                                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#EEF6F1] text-[9px] font-bold text-[#5D806A]"
                                                        >
                                                            DR
                                                        </div>

                                                        <div class="min-w-0">

                                                            <p
                                                                class="truncate text-[11px] font-semibold text-[#293331]"
                                                            >

                                                                Dr
                                                                {{ $medecin->utilisateur?->prenom }}
                                                                {{ $medecin->utilisateur?->nom }}

                                                            </p>

                                                            <p
                                                                class="text-[10px] text-[#8A8F8C]"
                                                            >

                                                                {{ $medecin->specialite ?? 'Spécialité non renseignée' }}

                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>


                                                {{-- Statut --}}
                                                <span
                                                    class="inline-flex shrink-0 items-center gap-1 rounded-full bg-[#EEF6F1] px-2 py-1 text-[9px] font-semibold text-[#5D806A]"
                                                >

                                                    <span
                                                        class="h-1.5 w-1.5 rounded-full bg-[#7FA68A]"
                                                    ></span>

                                                    Actif

                                                </span>

                                            </div>

                                        </div>

                                    @empty

                                        <div
                                            class="rounded-xl border border-dashed border-[#E3DDD8] bg-[#F8F7F5] px-3 py-3 text-center text-[11px] text-[#8A8F8C]"
                                        >

                                            Aucun médecin associé à ce patient.

                                        </div>

                                    @endforelse

                                </div>

                            </td>

                                </tr>


                            @empty

                                {{-- ================================================ --}}
                                {{-- AUCUN PATIENT --}}
                                {{-- ================================================ --}}

                                <tr>

                                    <td
                                        colspan="6"
                                        style="padding:56px 24px;"
                                    >

                                        <div class="onco-empty-state">

                                            <div
                                                class="onco-empty-icon"
                                                style="background:#FBF1F3;color:#D99AA6;"
                                            >
                                                ♡
                                            </div>

                                            <h3 class="onco-empty-title">
                                                Aucun patient enregistré
                                            </h3>

                                            <p class="onco-empty-text">
                                                Aucun compte patient n'est actuellement disponible.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- CONFIDENTIALITÉ --}}
            {{-- ========================================================= --}}

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

                    <h3 class="onco-info-title">
                        Confidentialité des données
                    </h3>

                    <p class="onco-info-text">
                        Les informations personnelles des patients sont
                        accessibles uniquement dans le cadre des droits
                        d'administration de la plateforme.
                    </p>

                    <p
                        class="mt-2 text-xs text-[#8A8F8C]"
                    >
                        L'association entre un patient et un médecin ne
                        donne pas automatiquement accès aux données à un
                        autre utilisateur.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>