<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un suivi</title>
</head>
<body>

    <h1>Modifier un suivi</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST"
          action="{{ route('suivis.update', $suivi) }}">

        @csrf
        @method('PUT')


        <!-- Date -->
        <div>
            <label>Date du suivi :</label>

            <input
                type="date"
                name="date_suivi"
                value="{{ old('date_suivi', $suivi->date_suivi) }}"
                required
            >
        </div>

        <br>


        <!-- Type de cancer -->
       <!-- Type de cancer -->
<div>
    <label>Type de cancer :</label>

    @php
        $typesCancer = [
            'Cancer du sein',
            'Cancer du poumon',
            'Cancer colorectal',
            'Cancer de la prostate',
            'Cancer du foie',
            "Cancer de l'estomac",
            'Cancer du pancréas',
            'Cancer du rein',
            'Cancer de la thyroïde',
        ];

        $typeActuel = old('type_cancer', $suivi->type_cancer);

        $isAutre = !in_array($typeActuel, $typesCancer);
    @endphp

    <select id="type_cancer_select">
        <option value="">
            -- Choisir le type de cancer --
        </option>

        @foreach($typesCancer as $type)
            <option
                value="{{ $type }}"
                {{ $typeActuel == $type ? 'selected' : '' }}
            >
                {{ $type }}
            </option>
        @endforeach

        <option value="Autre" {{ $isAutre ? 'selected' : '' }}>
            Autre
        </option>
    </select>

    <!-- Valeur envoyée au Controller -->
    <input
        type="hidden"
        name="type_cancer"
        id="type_cancer"
        value="{{ $typeActuel }}"
    >
</div>

<br>

<!-- Autre type de cancer -->
<div
    id="autre_cancer_div"
    style="{{ $isAutre ? '' : 'display: none;' }}"
>
    <label>Préciser le type de cancer :</label>

    <input
        type="text"
        id="autre_cancer"
        value="{{ $isAutre ? $typeActuel : '' }}"
        placeholder="Écrire le type de cancer"
    >
</div>

        <br>


        <!-- Stade -->
        <div>
            <label>Stade :</label>

            <select name="stade" required>

                <option value="Stade I"
                    {{ $suivi->stade == 'Stade I' ? 'selected' : '' }}>
                    Stade I
                </option>

                <option value="Stade II"
                    {{ $suivi->stade == 'Stade II' ? 'selected' : '' }}>
                    Stade II
                </option>

                <option value="Stade III"
                    {{ $suivi->stade == 'Stade III' ? 'selected' : '' }}>
                    Stade III
                </option>

                <option value="Stade IV"
                    {{ $suivi->stade == 'Stade IV' ? 'selected' : '' }}>
                    Stade IV
                </option>

            </select>
        </div>

        <br>


        <!-- Observation -->
        <div>
            <label>Observation :</label>

            <textarea name="observation">{{ old('observation', $suivi->observation) }}</textarea>
        </div>

        <br>


        <!-- Évolution -->
        <div>
            <label>Évolution :</label>

            <select name="evolution">

                <option value="">-- Choisir --</option>

                <option value="Amélioration"
                    {{ $suivi->evolution == 'Amélioration' ? 'selected' : '' }}>
                    Amélioration
                </option>

                <option value="Stable"
                    {{ $suivi->evolution == 'Stable' ? 'selected' : '' }}>
                    Stable
                </option>

                <option value="Aggravation"
                    {{ $suivi->evolution == 'Aggravation' ? 'selected' : '' }}>
                    Aggravation
                </option>

                <option value="Rémission"
                    {{ $suivi->evolution == 'Rémission' ? 'selected' : '' }}>
                    Rémission
                </option>

            </select>
        </div>

        <br>


        <!-- Traitement -->
        <div>
            <label>Traitement :</label>

            <textarea name="traitement">{{ old('traitement', $suivi->traitement) }}</textarea>
        </div>

        <br>


        <button type="submit">
            Modifier le suivi
        </button>

    </form>

    <br>

    <a href="{{ route('suivis.index') }}">
        ← Retour à la liste
    </a>
<!-- js -->

<script>
    const selectCancer = document.getElementById('type_cancer_select');
    const typeCancer = document.getElementById('type_cancer');
    const autreDiv = document.getElementById('autre_cancer_div');
    const autreCancer = document.getElementById('autre_cancer');

    selectCancer.addEventListener('change', function () {

        if (this.value === 'Autre') {
            autreDiv.style.display = 'block';
            autreCancer.required = true;
            typeCancer.value = autreCancer.value;

        } else {
            autreDiv.style.display = 'none';
            autreCancer.required = false;
            typeCancer.value = this.value;
        }
    });

    autreCancer.addEventListener('input', function () {
        typeCancer.value = this.value;
    });
</script>


</body>
</html>