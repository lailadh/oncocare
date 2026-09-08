<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un suivi</title>
</head>
<body>

    <h1>Ajouter un suivi</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('suivis.store') }}">

        @csrf


        <!-- Patient -->
        <div>
            <label>Patient :</label>

            <select name="id_patient" required>

                <option value="">
                    -- Choisir un patient --
                </option>

                @foreach($patients as $patient)

                    <option
                        value="{{ $patient->id_patient }}"
                        {{ old('id_patient') == $patient->id_patient ? 'selected' : '' }}
                    >
                        {{ $patient->utilisateur->prenom }}
                        {{ $patient->utilisateur->nom }}
                    </option>

                @endforeach

            </select>
        </div>

        <br>


        <!-- Date -->
        <div>
            <label>Date du suivi :</label>

            <input
                type="date"
                name="date_suivi"
                value="{{ old('date_suivi') }}"
                required
            >
        </div>

        <br>


        <!-- Type de cancer -->
        <div>
            <label>Type de cancer :</label>

            <select id="type_cancer_select" required>

                <option value="">
                    -- Choisir le type de cancer --
                </option>

                <option value="Cancer du sein">Cancer du sein</option>
                <option value="Cancer du poumon">Cancer du poumon</option>
                <option value="Cancer colorectal">Cancer colorectal</option>
                <option value="Cancer de la prostate">Cancer de la prostate</option>
                <option value="Cancer du foie">Cancer du foie</option>
                <option value="Cancer de l'estomac">Cancer de l'estomac</option>
                <option value="Cancer du pancréas">Cancer du pancréas</option>
                <option value="Cancer du rein">Cancer du rein</option>
                <option value="Cancer de la thyroïde">Cancer de la thyroïde</option>

                <option value="Autre">Autre</option>

            </select>

            <!-- القيمة الحقيقية اللي غادي تمشي للـ Controller -->
            <input
                type="hidden"
                name="type_cancer"
                id="type_cancer"
                value="{{ old('type_cancer') }}"
            >
        </div>


        <br>


        <!-- Autre cancer -->
        <div id="autre_cancer_div" style="display: none;">

            <label>Préciser le type de cancer :</label>

            <input
                type="text"
                id="autre_cancer"
                placeholder="Écrire le type de cancer"
            >

        </div>


        <br>


        <!-- Stade -->
        <div>
            <label>Stade :</label>

            <select name="stade" required>

                <option value="">
                    -- Choisir le stade --
                </option>

                <option value="Stade I">Stade I</option>
                <option value="Stade II">Stade II</option>
                <option value="Stade III">Stade III</option>
                <option value="Stade IV">Stade IV</option>

            </select>
        </div>

        <br>


        <!-- Observation -->
        <div>
            <label>Observation :</label>

            <textarea name="observation">{{ old('observation') }}</textarea>
        </div>

        <br>


        <!-- Évolution -->
        <div>
            <label>Évolution :</label>

            <select name="evolution">

                <option value="">-- Choisir l'évolution --</option>

                <option value="Amélioration">Amélioration</option>
                <option value="Stable">Stable</option>
                <option value="Aggravation">Aggravation</option>
                <option value="Rémission">Rémission</option>

            </select>
        </div>

        <br>


        <!-- Traitement -->
        <div>
            <label>Traitement :</label>

            <textarea name="traitement">{{ old('traitement') }}</textarea>
        </div>

        <br>


        <button type="submit">
            Ajouter le suivi
        </button>

    </form>


    <br>

    <a href="{{ route('suivis.index') }}">
        ← Retour à la liste
    </a>


    <script>

        const selectCancer = document.getElementById('type_cancer_select');

        const typeCancer = document.getElementById('type_cancer');

        const autreDiv = document.getElementById('autre_cancer_div');

        const autreCancer = document.getElementById('autre_cancer');


        selectCancer.addEventListener('change', function () {

            if (this.value === 'Autre') {

                autreDiv.style.display = 'block';

                autreCancer.required = true;

                typeCancer.value = '';

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