<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivis</title>
</head>
<body>

    <h1>Liste des suivis</h1>

    <a href="{{ route('suivis.create') }}">
        + Ajouter un suivi
    </a>

    <br><br>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($suivis->isEmpty())

        <p>Aucun suivi trouvé.</p>

    @else

        @foreach($suivis as $suivi)

            <div>

                <h3>
                    Patient :
                    {{ $suivi->patient->utilisateur->prenom }}
                    {{ $suivi->patient->utilisateur->nom }}
                </h3>

                <p>
                    Date du suivi :
                    {{ $suivi->date_suivi }}
                </p>

                <p>
                    Type de cancer :
                    {{ $suivi->type_cancer }}
                </p>

                <p>
                    Stade :
                    {{ $suivi->stade }}
                </p>


<a href="{{ route('suivis.show', $suivi) }}">
    Voir
</a>

<a href="{{ route('suivis.edit', $suivi) }}">
    Modifier
</a>

<form method="POST"
      action="{{ route('suivis.destroy', $suivi) }}"
      style="display: inline;">

    @csrf
    @method('DELETE')

    <button type="submit">
        Supprimer
    </button>
</form>


            </div>

            <hr>

        @endforeach

    @endif

</body>
</html>