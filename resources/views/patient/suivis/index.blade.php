
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OncoCare — Mon suivi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f5f8fc;
            color: #243447;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================== */

        .sidebar {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e5eaf0;
            padding: 28px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px 30px;
            color: #315c72;
            font-size: 22px;
            font-weight: 700;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #dff3f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #278b83;
            font-size: 20px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            color: #9aa8b5;
            font-weight: 600;
            padding: 0 12px;
            margin-bottom: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #687785;
            padding: 13px 14px;
            border-radius: 10px;
            margin-bottom: 5px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #f0f7f7;
            color: #278b83;
        }

        .menu a.active {
            background: #e5f5f3;
            color: #278b83;
            font-weight: 600;
        }

        .icon {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        /* =========================
           MAIN
        ========================== */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 35px 42px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .page-title h1 {
            font-size: 28px;
            color: #263d4d;
            margin-bottom: 7px;
        }

        .page-title p {
            color: #8795a3;
            font-size: 14px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dff3f0;
            color: #278b83;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* =========================
           CARD
        ========================== */

        .card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e7edf2;
            box-shadow: 0 5px 20px rgba(38, 61, 77, 0.04);
            overflow: hidden;
        }

        .card-header {
            padding: 23px 26px;
            border-bottom: 1px solid #edf1f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 17px;
            color: #344b5b;
        }

        .count {
            background: #edf7f6;
            color: #278b83;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* =========================
           SUIVI ITEM
        ========================== */

        .suivi-item {
            padding: 25px 26px;
            border-bottom: 1px solid #edf1f4;
            transition: 0.2s;
        }

        .suivi-item:last-child {
            border-bottom: none;
        }

        .suivi-item:hover {
            background: #fbfdfd;
        }

        .suivi-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 22px;
        }

        .date-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #e5f5f3;
            color: #278b83;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .date-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #9aa7b2;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .date-value {
            color: #344b5b;
            font-size: 15px;
            font-weight: 700;
        }

        .doctor-mini {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #657583;
            font-size: 13px;
        }

        .doctor-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #eef3f7;
            color: #527286;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .doctor-name {
            color: #344b5b;
            font-weight: 600;
        }

        .doctor-role {
            color: #9aa7b2;
            font-size: 11px;
            margin-top: 2px;
        }

        /* =========================
           INFO GRID
        ========================== */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #edf1f4;
            border-radius: 11px;
            padding: 15px;
        }

        .info-label {
            color: #98a5af;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .info-value {
            color: #405665;
            font-size: 14px;
            font-weight: 600;
        }

        .stage {
            display: inline-block;
            background: #edf2f7;
            color: #527286;
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        /* =========================
           EVOLUTION
        ========================== */

        .evolution-box {
            margin-top: 14px;
            background: #f5fbfa;
            border: 1px solid #e2f1ef;
            border-radius: 11px;
            padding: 15px;
        }

        .evolution-label {
            color: #278b83;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .evolution-value {
            color: #526b78;
            font-size: 13px;
        }

        /* =========================
           BOTTOM
        ========================== */

        .suivi-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
        }

        .treatment {
            color: #687785;
            font-size: 13px;
        }

        .treatment strong {
            color: #344b5b;
        }

        .details-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            background: #278b83;
            color: #ffffff;
            padding: 9px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            transition: 0.2s;
        }

        .details-btn:hover {
            background: #21776f;
        }

        /* =========================
           EMPTY STATE
        ========================== */

        .empty {
            padding: 75px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: #edf7f6;
            color: #278b83;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .empty h3 {
            color: #344b5b;
            font-size: 17px;
            margin-bottom: 7px;
        }

        .empty p {
            color: #98a5af;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 1050px) {

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 850px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
                padding: 25px;
            }

            .suivi-top {
                flex-direction: column;
                gap: 15px;
            }

        }

        @media (max-width: 650px) {

            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .profile {
                display: none;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .suivi-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .details-btn {
                width: 100%;
                justify-content: center;
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
            <div class="logo-icon">♥</div>
            OncoCare
        </div>

        <div class="menu-title">
            Mon espace
        </div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}">
                <span class="icon">⌂</span>
                Tableau de bord
            </a>

            <a href="{{ route('patient.suivis.index') }}" class="active">
                <span class="icon">♥</span>
                Mon suivi
            </a>

            <a href="{{ route('patient.rendezvous.index') }}">
                <span class="icon">▣</span>
                Mes rendez-vous
            </a>

            <a href="{{ route('patient.autorisations.index') }}">
                <span class="icon">♧</span>
                Proches autorisés
            </a>

        </nav>

    </aside>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <div class="page-title">

                <h1>Mon suivi</h1>

                <p>
                    Consultez votre historique de suivi médical.
                </p>

            </div>


            <div class="profile">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->prenom ?? 'P', 0, 1)) }}
                </div>

                <div>

                    <strong>
                        {{ auth()->user()->prenom }}
                        {{ auth()->user()->nom }}
                    </strong>

                    <div style="font-size:12px;color:#9aa7b2;">
                        Patient
                    </div>

                </div>

            </div>

        </div>


        <!-- SUIVIS CARD -->

        <div class="card">

            <div class="card-header">

                <h2>
                    Historique de mes suivis
                </h2>

                <span class="count">
                    {{ $suivis->count() }}
                    {{ $suivis->count() > 1 ? 'suivis' : 'suivi' }}
                </span>

            </div>


            @if($suivis->isEmpty())

                <!-- EMPTY STATE -->

                <div class="empty">

                    <div class="empty-icon">
                        ♥
                    </div>

                    <h3>
                        Aucun suivi médical
                    </h3>

                    <p>
                        Aucun suivi médical n'est actuellement enregistré dans votre dossier.
                    </p>

                </div>

            @else

                @foreach($suivis as $suivi)

                    <!-- SUIVI -->

                    <div class="suivi-item">

                        <!-- TOP -->

                        <div class="suivi-top">

                            <div class="date-box">

                                <div class="date-icon">
                                    ▣
                                </div>

                                <div>

                                    <div class="date-label">
                                        Date du suivi
                                    </div>

                                    <div class="date-value">

                                        {{ \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y') }}

                                    </div>

                                </div>

                            </div>


                            <!-- MEDECIN -->

                            @if($suivi->medecin && $suivi->medecin->utilisateur)

                                @php
                                    $medecin = $suivi->medecin->utilisateur;
                                @endphp

                                <div class="doctor-mini">

                                    <div class="doctor-avatar">
                                        {{ strtoupper(substr($medecin->prenom ?? 'M', 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="doctor-name">
                                            Dr.
                                            {{ $medecin->prenom }}
                                            {{ $medecin->nom }}
                                        </div>

                                        <div class="doctor-role">
                                            Médecin
                                        </div>

                                    </div>

                                </div>

                            @else

                                <div class="doctor-mini">

                                    <div class="doctor-avatar">
                                        M
                                    </div>

                                    <div>

                                        <div class="doctor-name">
                                            Médecin non renseigné
                                        </div>

                                    </div>

                                </div>

                            @endif

                        </div>


                        <!-- INFORMATION -->

                        <div class="info-grid">

                            <div class="info-box">

                                <div class="info-label">
                                    Type de cancer
                                </div>

                                <div class="info-value">
                                    {{ $suivi->type_cancer ?: 'Non renseigné' }}
                                </div>

                            </div>


                            <div class="info-box">

                                <div class="info-label">
                                    Stade
                                </div>

                                <div class="info-value">

                                    <span class="stage">
                                        {{ $suivi->stade ?: 'Non renseigné' }}
                                    </span>

                                </div>

                            </div>


                            <div class="info-box">

                                <div class="info-label">
                                    Évolution
                                </div>

                                <div class="info-value">
                                    {{ $suivi->evolution ?: 'Non renseignée' }}
                                </div>

                            </div>


                            <div class="info-box">

                                <div class="info-label">
                                    Observation
                                </div>

                                <div class="info-value">
                                    {{ $suivi->observation ?: 'Aucune observation' }}
                                </div>

                            </div>

                        </div>


                        <!-- EVOLUTION -->

                        @if($suivi->evolution)

                            <div class="evolution-box">

                                <div class="evolution-label">
                                    Évolution du suivi
                                </div>

                                <div class="evolution-value">
                                    {{ $suivi->evolution }}
                                </div>

                            </div>

                        @endif


                        <!-- BOTTOM -->

                        <div class="suivi-bottom">

                            <div class="treatment">

                                <strong>Traitement :</strong>

                                {{ $suivi->traitement ?: 'Non renseigné' }}

                            </div>


                            <a
                                href="{{ route('patient.suivis.show', $suivi->id_suivi) }}"
                                class="details-btn"
                            >
                                Voir les détails
                                →
                            </a>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>

    </main>

</div>

</body>
</html>
