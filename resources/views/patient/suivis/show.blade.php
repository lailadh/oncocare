```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Détails du suivi — OncoCare</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f9fc;
            color: #263238;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e8edf3;
            padding: 28px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            font-size: 25px;
            font-weight: 700;
            color: #1976a8;
            padding: 0 14px;
            margin-bottom: 38px;
        }

        .logo span {
            color: #35a9a0;
        }

        .menu-title {
            font-size: 11px;
            color: #9aa6b2;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 14px;
            margin-bottom: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #687582;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 5px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #f1f8fb;
            color: #1976a8;
        }

        .menu a.active {
            background: #eaf6f8;
            color: #1976a8;
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
            padding: 35px 45px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .breadcrumb {
            font-size: 13px;
            color: #94a0ab;
            margin-bottom: 8px;
        }

        .breadcrumb a {
            color: #1976a8;
            text-decoration: none;
        }

        h1 {
            font-size: 28px;
            color: #263238;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7b8794;
            font-size: 14px;
        }

        .patient-badge {
            background: #ffffff;
            border: 1px solid #e6edf2;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 13px;
            color: #65727d;
        }

        .patient-badge strong {
            color: #263238;
        }

        /* CARD */
        .card {
            background: #ffffff;
            border: 1px solid #e7edf2;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(38, 50, 56, 0.04);
            max-width: 950px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 24px;
            border-bottom: 1px solid #edf1f4;
            margin-bottom: 25px;
        }

        .date-title {
            font-size: 20px;
            font-weight: 700;
            color: #263238;
        }

        .date {
            margin-top: 7px;
            color: #8a96a1;
            font-size: 13px;
        }

        .status {
            display: inline-block;
            background: #e8f6f2;
            color: #278b79;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* INFO GRID */
        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: #263238;
            margin-bottom: 18px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #edf1f4;
            border-radius: 12px;
            padding: 17px;
        }

        .label {
            font-size: 11px;
            color: #96a1ab;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 7px;
        }

        .value {
            font-size: 14px;
            font-weight: 600;
            color: #35434d;
        }

        /* DETAILS */
        .detail-section {
            margin-top: 25px;
        }

        .detail-box {
            background: #fbfcfd;
            border: 1px solid #edf1f4;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 14px;
        }

        .detail-box .label {
            margin-bottom: 9px;
        }

        .detail-text {
            font-size: 14px;
            line-height: 1.7;
            color: #5f6c76;
        }

        /* DOCTOR */
        .doctor-box {
            margin-top: 25px;
            background: #eef8fb;
            border: 1px solid #dceff4;
            border-radius: 13px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .doctor-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #d9eef5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .doctor-info small {
            display: block;
            color: #7d8b95;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .doctor-info strong {
            color: #28677e;
            font-size: 14px;
        }

        /* FOOTER */
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #edf1f4;
        }

        .back-btn {
            text-decoration: none;
            color: #1976a8;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 9px;
            transition: .2s;
        }

        .back-btn:hover {
            background: #eef7fa;
        }

        .info-note {
            font-size: 12px;
            color: #9aa5ae;
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

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .layout {
                display: block;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .topbar {
                display: block;
            }

            .patient-badge {
                margin-top: 15px;
            }

            .card {
                padding: 20px;
            }

            .card-header {
                display: block;
            }

            .status {
                margin-top: 12px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            Onco<span>Care</span>
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
                <span class="icon">♡</span>
                Mon suivi
            </a>

            <a href="{{ route('patient.rendezvous.index') }}">
                <span class="icon">▣</span>
                Mes rendez-vous
            </a>

            <a href="{{ route('patient.autorisations.index') }}">
                <span class="icon">♙</span>
                Proches autorisés
            </a>

        </nav>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <div class="topbar">

            <div>
                <div class="breadcrumb">
                    <a href="{{ route('patient.suivis.index') }}">
                        Mon suivi
                    </a>
                    &nbsp; / &nbsp; Détails
                </div>

                <h1>Détails du suivi</h1>

                <p class="subtitle">
                    Consultez les informations détaillées de votre suivi médical.
                </p>
            </div>

            <div class="patient-badge">
                Patient :
                <strong>
                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                </strong>
            </div>

        </div>


        <!-- CARD -->
        <div class="card">

            <div class="card-header">

                <div>
                    <div class="date-title">
                        Suivi du {{ $suivi->date_suivi->format('d/m/Y') }}
                    </div>

                    <div class="date">
                        Enregistré dans votre dossier de suivi
                    </div>
                </div>

                <span class="status">
                    Suivi médical
                </span>

            </div>


            <!-- INFORMATIONS PRINCIPALES -->
            <div class="section-title">
                Informations du suivi
            </div>

            <div class="info-grid">

                <div class="info-box">
                    <div class="label">
                        Type de cancer
                    </div>

                    <div class="value">
                        {{ $suivi->type_cancer }}
                    </div>
                </div>


                <div class="info-box">
                    <div class="label">
                        Stade
                    </div>

                    <div class="value">
                        {{ $suivi->stade }}
                    </div>
                </div>


                <div class="info-box">
                    <div class="label">
                        Évolution
                    </div>

                    <div class="value">
                        {{ $suivi->evolution ?: 'Non renseignée' }}
                    </div>
                </div>


                <div class="info-box">
                    <div class="label">
                        Traitement
                    </div>

                    <div class="value">
                        {{ $suivi->traitement ?: 'Non renseigné' }}
                    </div>
                </div>

            </div>


            <!-- OBSERVATION -->
            <div class="detail-section">

                <div class="section-title">
                    Observation
                </div>

                <div class="detail-box">

                    <div class="label">
                        Observation médicale
                    </div>

                    <div class="detail-text">
                        {{ $suivi->observation ?: 'Aucune observation renseignée.' }}
                    </div>

                </div>

            </div>


            <!-- EVOLUTION -->
            <div class="detail-section">

                <div class="section-title">
                    Évolution du suivi
                </div>

                <div class="detail-box">

                    <div class="label">
                        Évolution
                    </div>

                    <div class="detail-text">
                        {{ $suivi->evolution ?: 'Aucune information renseignée.' }}
                    </div>

                </div>

            </div>


            <!-- MEDECIN -->
            <div class="doctor-box">

                <div class="doctor-icon">
                    👨‍⚕️
                </div>

                <div class="doctor-info">

                    <small>
                        Médecin responsable du suivi
                    </small>

                    <strong>
                        Dr.
                        {{ $suivi->medecin->utilisateur->prenom ?? '' }}
                        {{ $suivi->medecin->utilisateur->nom ?? '' }}
                    </strong>

                </div>

            </div>


            <!-- ACTIONS -->
            <div class="actions">

                <a
                    href="{{ route('patient.suivis.index') }}"
                    class="back-btn"
                >
                    ← Retour à mes suivis
                </a>

                <div class="info-note">
                    Les informations sont fournies dans le cadre de votre suivi.
                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
```
