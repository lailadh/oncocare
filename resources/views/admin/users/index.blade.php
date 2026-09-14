<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

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
                            style="background:#F4EFF5;color:#6B4C6F;"
                        >
                            ◌
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Gestion des utilisateurs
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez les comptes utilisateurs de la plateforme
                                et leurs rôles.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- FLASH SUCCESS --}}
            {{-- ====================================================== --}}

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


            {{-- ====================================================== --}}
            {{-- FLASH ERROR --}}
            {{-- ====================================================== --}}

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
                            Une action n'a pas pu être effectuée
                        </div>

                        <div class="onco-alert-text">
                            {{ session('error') }}
                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================== --}}
            {{-- SUMMARY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-summary-grid"
                style="margin-top:28px;"
            >

                {{-- Total --}}
                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Total
                        </span>

                        <div class="onco-summary-value">
                            {{ $users->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#66706D]">
                            comptes enregistrés
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F4EFF5;color:#6B4C6F;"
                    >
                        ◌
                    </div>

                </div>


                {{-- Patients --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#9A6470;"
                        >
                            Patients
                        </span>

                        <div class="onco-summary-value">
                            {{ $users->where('role', 'patient')->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#8B6D74]">
                            comptes patients
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ♡
                    </div>

                </div>


                {{-- Médecins --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#655A88;"
                        >
                            Médecins
                        </span>

                        <div class="onco-summary-value">
                            {{ $users->where('role', 'medecin')->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            professionnels enregistrés
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ✚
                    </div>

                </div>


                {{-- Proches --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#63856D;"
                        >
                            Proches
                        </span>

                        <div class="onco-summary-value">
                            {{ $users->where('role', 'proche')->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#607467]">
                            comptes proches
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        ◎
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- TABLE --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                {{-- Header --}}
                <div class="onco-card-header">

                    <div>

                        <h2 class="onco-card-title">
                            Liste des utilisateurs
                        </h2>

                        <p class="onco-card-description">
                            Comptes présents sur la plateforme OncoCare.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F4EFF5;color:#6B4C6F;"
                    >
                        {{ $users->count() }} utilisateur(s)
                    </span>

                </div>


                {{-- Table --}}
                <div class="onco-table-wrapper">

                    <table class="onco-table">

                        <thead>

                            <tr>

                                <th>
                                    Utilisateur
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
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($users as $user)

                                <tr>

                                    {{-- Utilisateur --}}
                                    <td>

                                        <div class="onco-user-cell">

                                            <div
                                                class="onco-avatar"
                                                @style([
                                                    'background:#FBF1F3;color:#B97886;' => $user->role === 'patient',
                                                    'background:#F1EFF8;color:#655A88;' => $user->role === 'medecin',
                                                    'background:#EEF5F0;color:#63856D;' => $user->role === 'proche',
                                                    'background:#F4EFF5;color:#6B4C6F;' => $user->role === 'admin',
                                                ])
                                            >
                                                {{ strtoupper(substr($user->prenom ?? 'U', 0, 1)) }}
                                            </div>

                                            <div>

                                                <div class="onco-user-name">
                                                    {{ $user->prenom }}
                                                    {{ $user->nom }}
                                                </div>

                                                @if($user->id === auth()->id())

                                                    <div class="onco-user-meta">
                                                        Compte actuel
                                                    </div>

                                                @else

                                                    <div class="onco-user-meta">
                                                        Compte OncoCare
                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Email --}}
                                    <td>
                                        <span class="onco-table-primary">
                                            {{ $user->email }}
                                        </span>
                                    </td>


                                    {{-- Téléphone --}}
                                    <td>
                                        <span class="onco-table-secondary">
                                            {{ $user->telephone ?? 'Non renseigné' }}
                                        </span>
                                    </td>


                                    {{-- Rôle --}}
                                    <td>

                                        @if($user->role === 'patient')

                                            <span class="onco-role-badge patient">
                                                Patient
                                            </span>

                                        @elseif($user->role === 'medecin')

                                            <span class="onco-role-badge medecin">
                                                Médecin
                                            </span>

                                        @elseif($user->role === 'proche')

                                            <span class="onco-role-badge proche">
                                                Proche
                                            </span>

                                        @elseif($user->role === 'admin')

                                            <span class="onco-role-badge admin">
                                                Administrateur
                                            </span>

                                        @else

                                            <span class="onco-role-badge">
                                                {{ ucfirst($user->role) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td>

                                        @if($user->id !== auth()->id())

                                            <a
                                                href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center gap-2 rounded-xl border border-[#E3DDD8] bg-white px-3.5 py-2 text-xs font-semibold text-[#6B4C6F] transition hover:border-[#CDB8D0] hover:bg-[#F4EFF5]"
                                            >
                                                Modifier
                                                <span>→</span>
                                            </a>

                                        @else

                                            <span
                                                class="inline-flex items-center rounded-xl bg-[#F1EEEB] px-3.5 py-2 text-xs font-medium text-[#8B918E]"
                                            >
                                                Compte actuel
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        style="padding:56px 24px;"
                                    >

                                        <div class="onco-empty-state">

                                            <div
                                                class="onco-empty-icon"
                                                style="background:#F4EFF5;color:#6B4C6F;"
                                            >
                                                ◌
                                            </div>

                                            <h3 class="onco-empty-title">
                                                Aucun utilisateur
                                            </h3>

                                            <p class="onco-empty-text">
                                                Aucun compte utilisateur n'est
                                                actuellement enregistré sur la plateforme.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- PRIVACY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#D8E6DC;
                    background:#F8FBF8;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#EEF5F0;color:#7FA68A;"
                >
                    🔒
                </div>

                <div>

                    <h3 class="onco-info-title">
                        Confidentialité et contrôle des accès
                    </h3>

                    <p class="onco-info-text">
                        Les accès aux fonctionnalités OncoCare sont déterminés
                        par le rôle de chaque utilisateur et les règles de sécurité
                        de la plateforme.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>