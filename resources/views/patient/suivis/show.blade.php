<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du suivi</title>
</head>
<body>

    <h1>Détails du suivi</h1>

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
        <strong>Observation :</strong>
        {{ $suivi->observation ?? 'Non renseignée' }}
    </p>

    <p>
        <strong>Évolution :</strong>
        {{ $suivi->evolution ?? 'Non renseignée' }}
    </p>

    <p>
        <strong>Traitement :</strong>
        {{ $suivi->traitement ?? 'Non renseigné' }}
    </p>

    <p>
        <strong>Médecin :</strong>
        Dr. {{ $suivi->medecin->utilisateur->prenom }}
        {{ $suivi->medecin->utilisateur->nom }}
    </p>

    <br>

    <a href="{{ route('patient.suivis.index') }}">
        ← Retour à mes suivis
    </a>

</body>
</html>