```blade
<x-app-layout>

    <style>
        .proche-page {
            min-height: 100vh;
            background: #f7f9fc;
            padding: 35px 45px;
        }

        .proche-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-size: 28px;
            font-weight: 700;
            color: #263238;
            margin: 0 0 8px;
        }

        .welcome p {
            color: #7b8794;
            font-size: 14px;
            margin: 0;
        }

        .profile-badge {
            background: white;
            border: 1px solid #e5edf2;
            border-radius: 12px;
            padding: 11px 17px;
            color: #687782;
            font-size: 13px;
        }

        .profile-badge strong {
            color: #263238;
        }

        .access-banner {
            background: #eef8f5;
            border: 1px solid #d7eee7;
            border-radius: 16px;
            padding: 20px 22px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .access-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #d9eee7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .access-content h2 {
            font-size: 15px;
            color: #287765;
            margin: 0 0 5px;
        }

        .access-content p {
            color: #648078;
            font-size: 13px;
            margin: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #263238;
            margin-bottom: 15px;
        }

        .patient-card {
            background: white;
            border: 1px solid #e6edf2;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 25px;
            box-shadow: 0 4px 18px rgba(38, 50, 56, .04);
        }

        .patient-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .patient-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #e5f3f7;
            color: #1976a8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            font-weight: 700;
        }

        .patient-info h3 {
            margin: 0 0 5px;
            font-size: 16px;
            color: #263238;
        }

        .patient-info p {
            margin: 0;
            font-size: 13px;
            color: #89949d;
        }

        .access-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .tag {
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .tag-active {
            background: #e9f7f3;
            color: #27816f;
        }

        .tag-disabled {
            background: #f1f3f5;
            color: #8a959d;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .feature-card {
            background: white;
            border: 1px solid #e6edf2;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(38, 50, 56, .04);
        }

        .feature-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #edf7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            font-size: 16px;
            color: #263238;
            margin: 0 0 8px;
        }

        .feature-card p {
            font-size: 13px;
            color: #7b8794;
            line-height: 1.6;
            margin: 0 0 18px;
        }

        .feature-link {
            display: inline-block;
            text-decoration: none;
            color: #1976a8;
            font-size: 13px;
            font-weight: 600;
        }

        .feature-link:hover {
            text-decoration: underline;
        }

        .empty-card {
            background: white;
            border: 1px dashed #d8e2e8;
            border-radius: 16px;
            padding: 35px;
            text-align: center;
            color: #89949d;
        }

        @media (max-width: 750px) {
            .proche-page {
                padding: 25px 20px;
            }

            .proche-header {
                display: block;
            }

            .profile-badge {
                display: inline-block;
                margin-top: 15px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>


    <div class="proche-page">

        <!-- HEADER -->
        <div class="proche-header">

            <div class="welcome">
                <h1>
                    Bonjour {{ auth()->user()->prenom }}
                </h1>

                <p>
                    Bienvenue dans votre espace proche autorisé.
                </p>
            </div>

            <div class="profile-badge">
                Profil :
                <strong>Proche</strong>
            </div>

        </div>


        <!-- ACCES LIMITE -->
        <div class="access-banner">

            <div class="access-icon">
                🔒
            </div>

            <div class="access-content">

                <h2>
                    Accès limité et sécurisé
                </h2>

                <p>
                    Vous pouvez uniquement consulter les informations
                    que le patient a choisi de partager avec vous.
                </p>

            </div>

        </div>


        <!-- PATIENT -->
        <div class="section-title">
            Patient suivi
        </div>

        @if(isset($autorisations) && $autorisations->count())

            @foreach($autorisations as $autorisation)

                <div class="patient-card">

                    <div class="patient-card-header">

                        <div class="patient-avatar">
                            {{ strtoupper(substr($autorisation->patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                        </div>

                        <div class="patient-info">

                            <h3>
                                {{ $autorisation->patient->utilisateur->prenom ?? '' }}
                                {{ $autorisation->patient->utilisateur->nom ?? '' }}
                            </h3>

                            <p>
                                Autorisation :
                                {{ $autorisation->statut }}
                            </p>

                        </div>

                    </div>


                    <div class="access-tags">

                        @if($autorisation->acces_suivi)
                            <span class="tag tag-active">
                                ✓ Suivi médical
                            </span>
                        @else
                            <span class="tag tag-disabled">
                                Suivi non accessible
                            </span>
                        @endif


                        @if($autorisation->acces_rendez_vous)
                            <span class="tag tag-active">
                                ✓ Rendez-vous
                            </span>
                        @else
                            <span class="tag tag-disabled">
                                Rendez-vous non accessible
                            </span>
                        @endif

                    </div>

                </div>

            @endforeach

        @else

            <div class="empty-card">
                <div style="font-size: 30px; margin-bottom: 10px;">
                    👤
                </div>

                <strong>
                    Aucun patient autorisé
                </strong>

                <p style="margin-top: 7px;">
                    Aucun patient ne vous a encore donné accès à ses informations.
                </p>
            </div>

        @endif


        <!-- SERVICES -->
        <div class="section-title">
            Mes accès
        </div>

        <div class="cards-grid">

            <div class="feature-card">

                <div class="feature-icon">
                    🩺
                </div>

                <h3>
                    Suivi médical
                </h3>

                <p>
                    Consultez les informations de suivi médical
                    uniquement lorsqu'un accès vous a été accordé.
                </p>

                <a href="#" class="feature-link">
                    Consulter le suivi →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    📅
                </div>

                <h3>
                    Rendez-vous
                </h3>

                <p>
                    Consultez les rendez-vous du patient lorsque
                    cette information vous est accessible.
                </p>

                <a href="#" class="feature-link">
                    Voir les rendez-vous →
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
```
