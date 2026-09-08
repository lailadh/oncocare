<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du suivi</title>
</head>
<body>

    <h1>Détails du suivi</h1>

    <h3>
        Patient :
        {{ $suivi->patient->utilisateur->prenom }}
        {{ $suivi->patient->utilisateur->nom }}
    </h3>

    <p>
        <strong>Date du suivi :</strong>
        {{ $suivi->date_suivi }}
    </p>

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
        {{ $suivi->observation ?? 'Aucune observation' }}
    </p>

    <p>
        <strong>Évolution :</strong>
        {{ $suivi->evolution ?? 'Non renseignée' }}
    </p>

    <p>
        <strong>Traitement :</strong>
        {{ $suivi->traitement ?? 'Non renseigné' }}
    </p>

    <br>

    <a href="{{ route('suivis.edit', $suivi) }}">
        Modifier
    </a>

    <br><br>

    <a href="{{ route('suivis.index') }}">
        ← Retour à la liste
    </a>

</body>
</html>