<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes suivis</title>
</head>
<body>

    <h1>Mes suivis médicaux</h1>

    @if($suivis->isEmpty())

        <p>Aucun suivi trouvé.</p>

    @else

        @foreach($suivis as $suivi)

            <div>

                <h3>
                    Suivi du {{ $suivi->date_suivi }}
                </h3>

                <p>
                    <strong>Type de cancer :</strong>
                    {{ $suivi->type_cancer }}
                </p>

                <p>
                    <strong>Stade :</strong>
                    {{ $suivi->stade }}
                </p>

                <p>
                    <strong>Médecin :</strong>
                    Dr.
                    {{ $suivi->medecin->utilisateur->prenom }}
                    {{ $suivi->medecin->utilisateur->nom }}
                </p>

                <a href="{{ route('patient.suivis.show', $suivi) }}">
                    Voir les détails
                </a>

            </div>

            <hr>

        @endforeach

    @endif

    <br>

    <a href="{{ route('dashboard') }}">
        ← Retour au dashboard
    </a>

</body>
</html>
