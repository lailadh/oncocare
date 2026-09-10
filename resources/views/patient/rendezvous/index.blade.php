<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OncoCare — Mes rendez-vous</title>

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

        /* SIDEBAR */
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

        /* MAIN */
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

        /* CARD */
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

        /* TABLE */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px 24px;
            background: #fafcfd;
            color: #8a98a5;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: 600;
        }

        td {
            padding: 19px 24px;
            border-top: 1px solid #edf1f4;
            font-size: 14px;
            color: #536574;
        }

        tr:hover td {
            background: #fbfdfd;
        }

        .date {
            font-weight: 600;
            color: #344b5b;
        }

        .time {
            color: #278b83;
            font-size: 13px;
            margin-top: 4px;
        }

        .doctor {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .doctor-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eef3f7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #527286;
            font-weight: 600;
            font-size: 13px;
        }

        .doctor-name {
            color: #344b5b;
            font-weight: 600;
        }

        .doctor-role {
            color: #9aa7b2;
            font-size: 12px;
            margin-top: 2px;
        }

        .motif {
            color: #536574;
        }

        /* STATUT */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-confirmed {
            background: #e5f6ef;
            color: #24815d;
        }

        .status-pending {
            background: #fff5df;
            color: #a47720;
        }

        .status-cancelled {
            background: #fdecec;
            color: #b85454;
        }

        .status-default {
            background: #edf1f4;
            color: #687785;
        }

        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* EMPTY */
        .empty {
            padding: 70px 20px;
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

        /* RESPONSIVE */
        @media (max-width: 850px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
                padding: 25px;
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

            .topbar {
                align-items: flex-start;
            }

            .profile {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">♥</div>
            OncoCare
        </div>

        <div class="menu-title">Mon espace</div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}">
                <span class="icon">⌂</span>
                Tableau de bord
            </a>

            <a href="{{ route('patient.suivis.index') }}">
                <span class="icon">♥</span>
                Mon suivi
            </a>

            <a href="{{ route('patient.rendezvous.index') }}" class="active">
                <span class="icon">▣</span>
                Mes rendez-vous
            </a>

            <a href="{{ route('patient.autorisations.index') }}">
                <span class="icon">♧</span>
                Proches autorisés
            </a>

        </nav>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="page-title">
                <h1>Mes rendez-vous</h1>
                <p>Consultez vos prochains rendez-vous médicaux.</p>
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


        <!-- RENDEZ-VOUS CARD -->
        <div class="card">

            <div class="card-header">

                <h2>Liste de mes rendez-vous</h2>

                <span class="count">
                    {{ $rendezVous->count() }}
                    {{ $rendezVous->count() > 1 ? 'rendez-vous' : 'rendez-vous' }}
                </span>

            </div>


            @if($rendezVous->isEmpty())

                <!-- EMPTY STATE -->

                <div class="empty">

                    <div class="empty-icon">
                        ▣
                    </div>

                    <h3>Aucun rendez-vous</h3>

                    <p>
                        Vous n'avez actuellement aucun rendez-vous enregistré.
                    </p>

                </div>

            @else

                <div class="table-container">

                    <table>

                        <thead>

                            <tr>
                                <th>Date & heure</th>
                                <th>Médecin</th>
                                <th>Motif</th>
                                <th>Statut</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($rendezVous as $rendez)

                                @php
                                    $statut = strtolower($rendez->statut ?? '');

                                    if (in_array($statut, ['confirme', 'confirmé', 'confirmed'])) {
                                        $statusClass = 'status-confirmed';
                                        $statusLabel = 'Confirmé';
                                    } elseif (in_array($statut, ['en_attente', 'attente', 'pending'])) {
                                        $statusClass = 'status-pending';
                                        $statusLabel = 'En attente';
                                    } elseif (in_array($statut, ['annule', 'annulé', 'cancelled'])) {
                                        $statusClass = 'status-cancelled';
                                        $statusLabel = 'Annulé';
                                    } else {
                                        $statusClass = 'status-default';
                                        $statusLabel = ucfirst($rendez->statut ?? 'Non défini');
                                    }
                                @endphp

                                <tr>

                                    <!-- DATE -->
                                    <td>

                                        <div class="date">
                                            {{ $rendez->date_heure?->format('d/m/Y') }}
                                        </div>

                                        <div class="time">
                                            {{ $rendez->date_heure?->format('H:i') }}
                                        </div>

                                    </td>


                                    <!-- MEDECIN -->
                                    <td>

                                        @if($rendez->medecin && $rendez->medecin->utilisateur)

                                            @php
                                                $medecin = $rendez->medecin->utilisateur;
                                            @endphp

                                            <div class="doctor">

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

                                            <span style="color:#9aa7b2;">
                                                Médecin non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    <!-- MOTIF -->
                                    <td>

                                        <span class="motif">
                                            {{ $rendez->motif ?? 'Non précisé' }}
                                        </span>

                                    </td>


                                    <!-- STATUT -->
                                    <td>

                                        <span class="status {{ $statusClass }}">

                                            <span class="dot"></span>

                                            {{ $statusLabel }}

                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>
