```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OncoCare — Proches autorisés</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,0..72,400&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #16302B;
            --ink-soft: #1F433C;
            --paper: #EFEDE2;
            --paper-raised: #F7F5EC;
            --text: #262420;
            --text-mute: #5B5A52;
            --line: #DAD5C4;
            --accent: #B8863E;
            --accent-soft: #E9D7B8;
            --sage: #6E8F76;
            --sage-soft: #D9E3D6;
            --rose: #C98978;
            --rose-soft: #EFDAD2;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'IBM Plex Sans', sans-serif;
            background: var(--paper);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        h1, h2, h3 {
            font-family: 'Newsreader', serif;
        }

        /* SIDEBAR */

        .sidebar {
            width: 236px;
            flex-shrink: 0;
            background: var(--ink);
            color: #EFEAE0;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .brand {
            font-family: 'Newsreader', serif;
            font-size: 22px;
            font-weight: 500;
            color: #F7F5EC;
            margin-bottom: 36px;
        }

        .brand .dot {
            color: var(--accent);
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-group-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #83958A;
            margin: 2px 0 4px 10px;
        }

        .nav a {
            color: #C9D3C9;
            text-decoration: none;
            font-size: 14.5px;
            padding: 9px 10px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav a:hover,
        .nav a.active {
            color: #F7F5EC;
            background: rgba(247,245,236,.08);
        }

        .nav svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .sidebar-foot {
            margin-top: auto;
            border-top: 1px solid rgba(247,245,236,.12);
            padding-top: 16px;
            font-size: 12.5px;
            color: #8FA097;
            line-height: 1.5;
        }

        /* MAIN */

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 22px 40px 0;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: var(--text-mute);
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--sage-soft);
            color: var(--ink-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Newsreader', serif;
        }

        .content {
            padding: 30px 40px 50px;
            max-width: 1200px;
        }

        .page-head {
            margin-bottom: 26px;
        }

        .page-head h1 {
            font-size: 30px;
            font-weight: 500;
            margin: 0 0 7px;
            color: var(--ink);
        }

        .page-head p {
            margin: 0;
            color: var(--text-mute);
            font-size: 14.5px;
        }

        /* SUCCESS */

        .success {
            background: var(--sage-soft);
            color: var(--ink-soft);
            padding: 12px 16px;
            border-radius: 3px;
            margin-bottom: 20px;
            font-size: 13.5px;
        }

        /* CARD */

        .card {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: 4px;
            padding: 22px;
        }

        .card-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 18px;
        }

        .card h3 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 4px;
            color: var(--ink);
        }

        .sub {
            color: var(--text-mute);
            font-size: 13px;
            margin: 0;
        }

        /* BUTTON */

        .btn {
            border: none;
            background: var(--ink);
            color: #F7F5EC;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 3px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn:hover {
            background: var(--ink-soft);
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 10px 12px;
            color: var(--text-mute);
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: .04em;
            font-weight: 500;
            border-bottom: 1px solid var(--line);
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid var(--line);
            font-size: 13.5px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .proche-name {
            color: var(--ink);
            font-weight: 500;
        }

        .proche-email {
            color: var(--text-mute);
            font-size: 12.5px;
            margin-top: 3px;
        }

        /* TAGS */

        .tag {
            display: inline-block;
            font-size: 11px;
            padding: 4px 9px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .tag-active {
            background: var(--sage-soft);
            color: var(--ink-soft);
        }

        .tag-inactive {
            background: var(--rose-soft);
            color: #7C4433;
        }

        .tag-gold {
            background: var(--accent-soft);
            color: #6E4E1D;
        }

        /* ACCESS */

        .access-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            border: 1px solid var(--line);
            background: transparent;
            color: var(--ink-soft);
            padding: 6px 11px;
            border-radius: 3px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer;
        }

        .action-btn:hover {
            border-color: var(--ink-soft);
        }

        .action-delete {
            color: #7C4433;
        }

        /* EMPTY */

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: var(--text-mute);
        }

        .empty-icon {
            width: 46px;
            height: 46px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: var(--rose-soft);
            color: #7C4433;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty h3 {
            margin: 0 0 6px;
            font-family: 'Newsreader', serif;
            font-size: 21px;
            color: var(--ink);
        }

        .empty p {
            margin: 0 0 18px;
            font-size: 13.5px;
        }

        @media (max-width: 900px) {
            .sidebar {
                display: none;
            }

            .topbar {
                padding: 20px;
            }

            .content {
                padding: 20px;
            }

            .card-head {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">

    <div class="brand">
        Onco<span class="dot">•</span>Care
    </div>

    <nav class="nav">

        <div class="nav-group-label">Espace</div>

        <a href="{{ url('/dashboard') }}">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
            </svg>
            Tableau de bord
        </a>

        <a href="{{ route('patient.rendezvous.index') }}">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <path d="M9 2v4M15 2v4M4 8h16"/>
                <path d="M5 5h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/>
            </svg>
            Rendez-vous
        </a>

        <a href="{{ route('patient.suivis.index') }}">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <path d="M4 19.5V6a2 2 0 0 1 2-2h9l5 5v10.5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/>
                <path d="M8 12h8M8 16h5"/>
            </svg>
            Suivi médical
        </a>

        <a href="{{ route('patient.autorisations.index') }}" class="active">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                <circle cx="10" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            Proches autorisés
        </a>

        <a href="#">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            Notifications
        </a>

        <div class="nav-group-label" style="margin-top:18px;">
            Compte
        </div>

        <a href="{{ route('profile.edit') }}">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21v-1a7 7 0 0 1 16 0v1"/>
            </svg>
            Profil
        </a>

    </nav>

    <div class="sidebar-foot">
        Suivi &amp; accompagnement<br>
        — hors diagnostic médical.
    </div>

</aside>


<main class="main">

    <div class="topbar">

        <div class="user-chip">

            @php
                $user = auth()->user();
                $initials = strtoupper(
                    substr($user->prenom ?? '', 0, 1) .
                    substr($user->nom ?? '', 0, 1)
                );
            @endphp

            <div class="avatar">
                {{ $initials ?: 'U' }}
            </div>

            <span>
                {{ $user->prenom }} {{ $user->nom }}
            </span>

        </div>

    </div>


    <div class="content">

        <div class="page-head">

            <h1>Proches autorisés</h1>

            <p>
                Gérez les personnes qui peuvent accéder aux informations
                que vous souhaitez partager.
            </p>

        </div>


        @if(session('success'))

            <div class="success">
                ✓ {{ session('success') }}
            </div>

        @endif


        <div class="card">

            <div class="card-head">

                <div>
                    <h3>Mes autorisations</h3>

                    <p class="sub">
                        Contrôlez les informations accessibles à vos proches.
                    </p>
                </div>

                <a href="{{ route('patient.autorisations.create') }}"
                   class="btn">

                    <span>+</span>
                    Ajouter un proche

                </a>

            </div>


            @if($autorisations->count())

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>Proche</th>
                                <th>Suivi médical</th>
                                <th>Rendez-vous</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($autorisations as $autorisation)

                            <tr>

                                <td>

                                    <div class="proche-name">
                                        {{ $autorisation->proche->prenom ?? '' }}
                                        {{ $autorisation->proche->nom ?? '' }}
                                    </div>

                                    @if($autorisation->proche->email ?? false)
                                        <div class="proche-email">
                                            {{ $autorisation->proche->email }}
                                        </div>
                                    @endif

                                </td>


                                <td>

                                    @if($autorisation->acces_suivi)

                                        <span class="tag tag-active">
                                            Autorisé
                                        </span>

                                    @else

                                        <span class="tag tag-inactive">
                                            Restreint
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($autorisation->acces_rendez_vous)

                                        <span class="tag tag-active">
                                            Autorisé
                                        </span>

                                    @else

                                        <span class="tag tag-inactive">
                                            Restreint
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($autorisation->statut === 'active')

                                        <span class="tag tag-active">
                                            Active
                                        </span>

                                    @else

                                        <span class="tag tag-inactive">
                                            {{ ucfirst($autorisation->statut) }}
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <span style="color:var(--text-mute);">
                                        {{ \Carbon\Carbon::parse($autorisation->date_autorisation)->format('d/m/Y') }}
                                    </span>

                                </td>


                                <td>

                                    <div class="actions">

                                        <a href="{{ route('patient.autorisations.edit', $autorisation) }}"
                                           class="action-btn">
                                            Modifier
                                        </a>


                                        <form action="{{ route('patient.autorisations.destroy', $autorisation) }}"
                                              method="POST"
                                              onsubmit="return confirm('Voulez-vous vraiment supprimer cette autorisation ?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-btn action-delete">
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

            @else

                <div class="empty">

                    <div class="empty-icon">

                        <svg width="22"
                             height="22"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.7">

                            <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                            <circle cx="10" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                        </svg>

                    </div>

                    <h3>Aucun proche autorisé</h3>

                    <p>
                        Vous n'avez encore donné accès à aucun proche.
                    </p>

                    <a href="{{ route('patient.autorisations.create') }}"
                       class="btn">

                        + Ajouter un proche

                    </a>

                </div>

            @endif

        </div>

    </div>

</main>

</body>
</html>

