<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('suivis.index') }}"
                    class="onco-back-link"
                >
                    ← Retour à la liste des suivis
                </a>

                <div class="onco-title-wrap">

                    <div
                        class="onco-page-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        +
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Ajouter un suivi
                        </h1>

                        <p class="onco-page-subtitle">
                            Enregistrez un nouveau suivi médical pour l'un de vos patients.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- ERRORS --}}
            {{-- ====================================================== --}}

            @if ($errors->any())

                <div
                    class="onco-alert onco-alert-error"
                    style="margin-top:24px;"
                >

                    <div class="onco-alert-icon">
                        !
                    </div>

                    <div>

                        <div class="onco-alert-title">
                            Vérifiez les informations saisies
                        </div>

                        <div class="onco-alert-text">

                            <ul style="margin:6px 0 0;padding-left:18px;">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================== --}}
            {{-- FORM CARD --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div
                    class="onco-card-header"
                    style="margin-bottom:24px;"
                >

                    <div>

                        <h2 class="onco-card-title">
                            Informations du suivi
                        </h2>

                        <p class="onco-card-description">
                            Renseignez les informations médicales nécessaires au suivi du patient.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
                    >
                        Suivi médical
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('suivis.store') }}"
                    class="medecin-form"
                >

                    @csrf


                    {{-- ================================================== --}}
                    {{-- PATIENT & DATE --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Informations générales
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Sélectionnez le patient concerné et indiquez la date du suivi.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Patient --}}
                            <div class="onco-form-group">

                                <label
                                    for="id_patient"
                                    class="onco-label"
                                >
                                    Patient
                                </label>

                                <select
                                    id="id_patient"
                                    name="id_patient"
                                    class="onco-select"
                                    required
                                >

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


                            {{-- Date --}}
                            <div class="onco-form-group">

                                <label
                                    for="date_suivi"
                                    class="onco-label"
                                >
                                    Date du suivi
                                </label>

                                <input
                                    id="date_suivi"
                                    type="date"
                                    name="date_suivi"
                                    value="{{ old('date_suivi') }}"
                                    class="onco-input"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- CANCER --}}
                    {{-- ================================================== --}}

                    <div
                        class="mb-8 rounded-2xl p-5"
                        style="
                            background:#F8F6FB;
                            border:1px solid #E4E0EE;
                        "
                    >

                        <div class="mb-5">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Informations médicales
                            </h3>

                            <p class="mt-1 text-xs text-[#756D84]">
                                Renseignez le type de cancer et le stade du suivi.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Type cancer --}}
                            <div class="onco-form-group">

                                <label
                                    for="type_cancer_select"
                                    class="onco-label"
                                >
                                    Type de cancer
                                </label>

                                <select
                                    id="type_cancer_select"
                                    class="onco-select"
                                    required
                                >

                                    <option value="">
                                        -- Choisir le type de cancer --
                                    </option>

                                    <option value="Cancer du sein">
                                        Cancer du sein
                                    </option>

                                    <option value="Cancer du poumon">
                                        Cancer du poumon
                                    </option>

                                    <option value="Cancer colorectal">
                                        Cancer colorectal
                                    </option>

                                    <option value="Cancer de la prostate">
                                        Cancer de la prostate
                                    </option>

                                    <option value="Cancer du foie">
                                        Cancer du foie
                                    </option>

                                    <option value="Cancer de l'estomac">
                                        Cancer de l'estomac
                                    </option>

                                    <option value="Cancer du pancréas">
                                        Cancer du pancréas
                                    </option>

                                    <option value="Cancer du rein">
                                        Cancer du rein
                                    </option>

                                    <option value="Cancer de la thyroïde">
                                        Cancer de la thyroïde
                                    </option>

                                    <option value="Autre">
                                        Autre
                                    </option>

                                </select>


                                {{-- Valeur envoyée au controller --}}
                                <input
                                    type="hidden"
                                    name="type_cancer"
                                    id="type_cancer"
                                    value="{{ old('type_cancer') }}"
                                >


                                <p class="onco-help">
                                    Sélectionnez « Autre » si le type n'est pas présent dans la liste.
                                </p>

                            </div>


                            {{-- Stade --}}
                            <div class="onco-form-group">

                                <label
                                    for="stade"
                                    class="onco-label"
                                >
                                    Stade
                                </label>

                                <select
                                    id="stade"
                                    name="stade"
                                    class="onco-select"
                                    required
                                >

                                    <option value="">
                                        -- Choisir le stade --
                                    </option>

                                    <option
                                        value="Stade I"
                                        {{ old('stade') === 'Stade I' ? 'selected' : '' }}
                                    >
                                        Stade I
                                    </option>

                                    <option
                                        value="Stade II"
                                        {{ old('stade') === 'Stade II' ? 'selected' : '' }}
                                    >
                                        Stade II
                                    </option>

                                    <option
                                        value="Stade III"
                                        {{ old('stade') === 'Stade III' ? 'selected' : '' }}
                                    >
                                        Stade III
                                    </option>

                                    <option
                                        value="Stade IV"
                                        {{ old('stade') === 'Stade IV' ? 'selected' : '' }}
                                    >
                                        Stade IV
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Autre cancer --}}
                        <div
                            id="autre_cancer_div"
                            style="display:none;margin-top:4px;"
                        >

                            <label
                                for="autre_cancer"
                                class="onco-label"
                            >
                                Préciser le type de cancer
                            </label>

                            <input
                                type="text"
                                id="autre_cancer"
                                class="onco-input"
                                placeholder="Écrire le type de cancer"
                                value="{{ old('type_cancer') }}"
                            >

                            <p class="onco-help">
                                Indiquez le type de cancer de manière précise.
                            </p>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- OBSERVATION --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Observations
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Ajoutez les éléments utiles concernant l'état du patient.
                            </p>

                        </div>


                        <div class="onco-form-group">

                            <label
                                for="observation"
                                class="onco-label"
                            >
                                Observation
                            </label>

                            <textarea
                                id="observation"
                                name="observation"
                                class="onco-textarea"
                                placeholder="Saisir les observations du suivi..."
                            >{{ old('observation') }}</textarea>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- EVOLUTION & TRAITEMENT --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Évolution et traitement
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Complétez l'évolution observée et les informations relatives au traitement.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Evolution --}}
                            <div class="onco-form-group">

                                <label
                                    for="evolution"
                                    class="onco-label"
                                >
                                    Évolution
                                </label>

                                <select
                                    id="evolution"
                                    name="evolution"
                                    class="onco-select"
                                >

                                    <option value="">
                                        -- Choisir l'évolution --
                                    </option>

                                    <option
                                        value="Amélioration"
                                        {{ old('evolution') === 'Amélioration' ? 'selected' : '' }}
                                    >
                                        Amélioration
                                    </option>

                                    <option
                                        value="Stable"
                                        {{ old('evolution') === 'Stable' ? 'selected' : '' }}
                                    >
                                        Stable
                                    </option>

                                    <option
                                        value="Aggravation"
                                        {{ old('evolution') === 'Aggravation' ? 'selected' : '' }}
                                    >
                                        Aggravation
                                    </option>

                                    <option
                                        value="Rémission"
                                        {{ old('evolution') === 'Rémission' ? 'selected' : '' }}
                                    >
                                        Rémission
                                    </option>

                                </select>

                            </div>


                            {{-- Traitement --}}
                            <div class="onco-form-group">

                                <label
                                    for="traitement"
                                    class="onco-label"
                                >
                                    Traitement
                                </label>

                                <textarea
                                    id="traitement"
                                    name="traitement"
                                    class="onco-textarea"
                                    placeholder="Décrire le traitement..."
                                >{{ old('traitement') }}</textarea>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- FOOTER ACTIONS --}}
                    {{-- ================================================== --}}

                    <div
                        class="flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:items-center sm:justify-between"
                        style="border-color:#EEEAE6;"
                    >

                        <a
                            href="{{ route('suivis.index') }}"
                            class="onco-btn onco-btn-secondary"
                        >
                            ← Annuler
                        </a>


                        <button
                            type="submit"
                            class="onco-btn onco-btn-medecin"
                        >
                            <span>✓</span>
                            <span>Ajouter le suivi</span>
                        </button>

                    </div>

                </form>

            </div>


            {{-- ====================================================== --}}
            {{-- PRIVACY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#DED9EB;
                    background:#F8F6FB;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#F1EFF8;color:#7567A8;"
                >
                    🔒
                </div>

                <div>

                    <h3
                        class="onco-info-title"
                        style="color:#655A88;"
                    >
                        Données médicales confidentielles
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Les informations saisies dans ce formulaire sont destinées
                        au suivi du patient et sont accessibles selon les règles
                        de confidentialité de la plateforme.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================ --}}
    {{-- AUTRE CANCER SCRIPT --}}
    {{-- ================================================================ --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const selectCancer =
                document.getElementById('type_cancer_select');

            const typeCancer =
                document.getElementById('type_cancer');

            const autreDiv =
                document.getElementById('autre_cancer_div');

            const autreCancer =
                document.getElementById('autre_cancer');


            if (!selectCancer || !typeCancer || !autreDiv || !autreCancer) {
                return;
            }


            function updateCancerField() {

                if (selectCancer.value === 'Autre') {

                    autreDiv.style.display = 'block';

                    autreCancer.required = true;

                    typeCancer.value = autreCancer.value;

                } else {

                    autreDiv.style.display = 'none';

                    autreCancer.required = false;

                    typeCancer.value = selectCancer.value;

                }

            }


            selectCancer.addEventListener(
                'change',
                updateCancerField
            );


            autreCancer.addEventListener(
                'input',
                function () {

                    typeCancer.value = this.value;

                }
            );


            // Restore old value after validation
            if (typeCancer.value) {

                const predefinedOptions = [
                    'Cancer du sein',
                    'Cancer du poumon',
                    'Cancer colorectal',
                    'Cancer de la prostate',
                    'Cancer du foie',
                    "Cancer de l'estomac",
                    'Cancer du pancréas',
                    'Cancer du rein',
                    'Cancer de la thyroïde'
                ];


                if (predefinedOptions.includes(typeCancer.value)) {

                    selectCancer.value = typeCancer.value;

                } else {

                    selectCancer.value = 'Autre';

                    autreCancer.value = typeCancer.value;

                }

            }


            updateCancerField();

        });

    </script>

</x-app-layout>