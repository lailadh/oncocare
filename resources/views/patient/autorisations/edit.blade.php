<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier l'autorisation — OncoCare</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=Newsreader:opsz,wght@6..72,400;6..72,500&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --ink: #16423C;
            --ink-soft: #1F5149;
            --paper: #EFEDE2;
            --paper-raised: #F7F5EE;
            --text: #28312F;
            --text-mute: #68716D;
            --line: #DAD5C4;
            --accent: #C49A5A;
            --sage: #7FA68A;
            --sage-soft: #E4EFE8;
            --rose: #E7B8AD;
            --rose-soft: #F2DED9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--text);
            font-family: "IBM Plex Sans", sans-serif;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

        /* =========================
           SIDEBAR
        ========================== */

        .sidebar {
            width: 236px;
            min-height: 100vh;
            background: var(--ink);
            color: white;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-family: "Newsreader", serif;
            font-size: 27px;
            margin-bottom: 42px;
            padding-left: 10px;
        }

        .logo span {
            color: var(--accent);
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav a {
            color: rgba(255, 255, 255, .78);
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 4px;
            font-size: 14px;
        }

        .nav a:hover {
            background: rgba(255, 255, 255, .08);
            color: white;
        }

        .nav a.active {
            background: rgba(255, 255, 255, .12);
            color: white;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 18px 10px 0;
            color: rgba(255, 255, 255, .55);
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================
           MAIN
        ========================== */

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            height: 72px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 32px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--sage-soft);
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
        }

        .content {
            padding: 42px 46px 70px;
            max-width: 1100px;
        }

        .back {
            display: inline-block;
            color: var(--text-mute);
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .back:hover {
            color: var(--ink);
        }

        h1 {
            font-family: "Newsreader", serif;
            font-size: 42px;
            font-weight: 400;
            margin: 0 0 8px;
            color: var(--ink);
        }

        .subtitle {
            color: var(--text-mute);
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* =========================
           CARD
        ========================== */

        .card {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: 4px;
            padding: 30px;
            max-width: 760px;
        }

        .card-title {
            font-family: "Newsreader", serif;
            font-size: 25px;
            color: var(--ink);
            margin: 0 0 6px;
        }

        .card-description {
            font-size: 13px;
            color: var(--text-mute);
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        select {
            width: 100%;
            height: 44px;
            border: 1px solid var(--line);
            border-radius: 4px;
            background: white;
            padding: 0 12px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text);
            outline: none;
        }

        select:focus {
            border-color: var(--sage);
        }

        .help {
            font-size: 12px;
            color: var(--text-mute);
            margin-top: 7px;
        }

        /* =========================
           ACCESS
        ========================== */

        .access-box {
            border: 1px solid var(--line);
            background: #FBFAF4;
            padding: 18px;
            margin-top: 8px;
        }

        .access-title {
            font-family: "Newsreader", serif;
            color: var(--ink);
            font-size: 20px;
            margin-bottom: 14px;
        }

        .check-row {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 12px 0;
            border-bottom: 1px solid var(--line);
        }

        .check-row:last-child {
            border-bottom: none;
        }

        .check-row > input[type="checkbox"] {
            margin-top: 3px;
            width: 16px;
            height: 16px;
            accent-color: var(--ink);
        }

        .check-content {
            flex: 1;
        }

        .check-content label {
            margin-bottom: 3px;
            cursor: pointer;
        }

        .check-content span {
            display: block;
            font-size: 12px;
            color: var(--text-mute);
        }

        /* =========================
           STATUS
        ========================== */

        .status-box {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 12px 14px;
            background: var(--sage-soft);
            border-left: 3px solid var(--sage);
            font-size: 12px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--sage);
        }

        /* =========================
           NOTICE
        ========================== */

        .notice {
            background: var(--rose-soft);
            border-left: 3px solid var(--rose);
            padding: 13px 15px;
            margin-top: 24px;
            font-size: 12px;
            line-height: 1.5;
            color: var(--text);
        }

        /* =========================
           BUTTONS
        ========================== */

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 28px;
        }

        .btn {
            border-radius: 4px;
            padding: 11px 18px;
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--ink);
            color: white;
            border: 1px solid var(--ink);
        }

        .btn-primary:hover {
            background: var(--ink-soft);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: white;
        }

        /* =========================
           ERRORS
        ========================== */

        .error {
            background: var(--rose-soft);
            border: 1px solid var(--rose);
            color: #7A4035;
            padding: 13px 15px;
            border-radius: 4px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .error ul {
            margin: 7px 0 0;
            padding-left: 18px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 800px) {

            .sidebar {
                width: 190px;
            }

            .content {
                padding: 30px 22px;
            }

            h1 {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">

        <div class="logo">
            Onco<span>•</span>Care
        </div>

        <nav class="nav">

            <a href="{{ route('dashboard') }}">
                Tableau de bord
            </a>

            <a href="{{ route('patient.rendezvous.index') }}">
                Rendez-vous
            </a>

            <a href="{{ route('patient.suivis.index') }}">
                Suivi médical
            </a>

            <a
                href="{{ route('patient.autorisations.index') }}"
                class="active"
            >
                Proches autorisés
            </a>

            <a href="#">
                Notifications
            </a>

            <a href="{{ route('profile.edit') }}">
                Profil
            </a>

            <a href="#">
                Paramètres
            </a>

        </nav>

        <div class="sidebar-footer">
            Suivi & accompagnement<br>
            — hors diagnostic médical.
        </div>

    </aside>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            @php
                $user = auth()->user();

                $initiales = strtoupper(
                    substr($user->prenom ?? '', 0, 1) .
                    substr($user->nom ?? '', 0, 1)
                );
            @endphp

            <div class="user-info">

                <div class="avatar">
                    {{ $initiales ?: 'PT' }}
                </div>

                <span>
                    {{ $user->prenom }} {{ $user->nom }}
                </span>

            </div>

        </div>


        <!-- CONTENT -->

        <div class="content">

            <a
                href="{{ route('patient.autorisations.index') }}"
                class="back"
            >
                ← Retour aux autorisations
            </a>

            <h1>
                Modifier l'autorisation
            </h1>

            <div class="subtitle">
                Modifiez les informations auxquelles votre proche est autorisé à accéder.
            </div>


            <!-- ERRORS -->

            @if ($errors->any())

                <div class="error">

                    <strong>
                        Veuillez corriger les erreurs suivantes :
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- CARD -->

            <div class="card">

                <h2 class="card-title">
                    Autorisation du proche
                </h2>

                <div class="card-description">
                    Vous pouvez modifier les accès accordés à votre proche.
                </div>


                <!-- FORM -->

                <form
                    method="POST"
                    action="{{ route(
                        'patient.autorisations.update',
                        $autorisationProche->id_autorisation
                    ) }}"
                >

                    @csrf

                    @method('PATCH')


                    <!--
                        ID DU PROCHE
                    -->

                    <input
                        type="hidden"
                        name="id_proche"
                        value="{{ $autorisationProche->id_proche }}"
                    >


                    <!--
                        STATUT
                    -->

                    <input
                        type="hidden"
                        name="statut"
                        value="{{ old(
                            'statut',
                            $autorisationProche->statut
                        ) }}"
                    >


                    <!-- =========================
                         PROCHE
                    ========================== -->

                    <div class="form-group">

                        <label for="id_proche">
                            Proche autorisé
                        </label>

                        <select
                            id="id_proche"
                            disabled
                        >

                            @php
                                $proche = $autorisationProche->proche ?? null;
                            @endphp

                            @if ($proche)

                                <option value="{{ $proche->id }}">

                                    {{ $proche->prenom }}
                                    {{ $proche->nom }}
                                    — {{ $proche->email }}

                                </option>

                            @else

                                <option value="{{ $autorisationProche->id_proche }}">

                                    Proche #{{ $autorisationProche->id_proche }}

                                </option>

                            @endif

                        </select>

                        <div class="help">

                            Le proche associé à cette autorisation
                            ne peut pas être modifié.

                        </div>

                    </div>


                    <!-- =========================
                         ACCESS
                    ========================== -->

                    <div class="form-group">

                        <label>
                            Informations accessibles
                        </label>

                        <div class="access-box">

                            <div class="access-title">
                                Choisissez les accès autorisés
                            </div>


                            <!-- =====================
                                 ACCÈS SUIVI
                            ====================== -->

                            <div class="check-row">

                                <!--
                                    Si la checkbox est décochée,
                                    Laravel recevra 0.
                                -->

                                <input
                                    type="hidden"
                                    name="acces_suivi"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="acces_suivi"
                                    id="acces_suivi"
                                    value="1"
                                    {{ old(
                                        'acces_suivi',
                                        $autorisationProche->acces_suivi
                                    ) ? 'checked' : '' }}
                                >

                                <div class="check-content">

                                    <label for="acces_suivi">
                                        Accès au suivi médical
                                    </label>

                                    <span>
                                        Permet de consulter les informations
                                        de suivi que vous avez autorisées.
                                    </span>

                                </div>

                            </div>


                            <!-- =====================
                                 ACCÈS RENDEZ-VOUS
                            ====================== -->

                            <div class="check-row">

                                <input
                                    type="hidden"
                                    name="acces_rendez_vous"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="acces_rendez_vous"
                                    id="acces_rendez_vous"
                                    value="1"
                                    {{ old(
                                        'acces_rendez_vous',
                                        $autorisationProche->acces_rendez_vous
                                    ) ? 'checked' : '' }}
                                >

                                <div class="check-content">

                                    <label for="acces_rendez_vous">
                                        Accès aux rendez-vous
                                    </label>

                                    <span>
                                        Permet de consulter vos rendez-vous
                                        autorisés.
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =========================
                         STATUS
                    ========================== -->

                    <div class="status-box">

                        <span class="status-dot"></span>

                        <span>

                            Statut actuel :

                            <strong>
                                {{ ucfirst(
                                    $autorisationProche->statut ?? 'active'
                                ) }}
                            </strong>

                        </span>

                    </div>


                    <!-- =========================
                         NOTICE
                    ========================== -->

                    <div class="notice">

                        <strong>
                            Votre confidentialité reste prioritaire.
                        </strong>

                        <br>

                        Vous pouvez modifier les accès de votre proche
                        à tout moment. Les modifications seront appliquées
                        après l'enregistrement.

                    </div>


                    <!-- =========================
                         ACTIONS
                    ========================== -->

                    <div class="actions">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Enregistrer les modifications
                        </button>

                        <a
                            href="{{ route('patient.autorisations.index') }}"
                            class="btn btn-secondary"
                        >
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

</body>
</html>