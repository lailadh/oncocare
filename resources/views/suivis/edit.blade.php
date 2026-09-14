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
                        ✎
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Modifier un suivi
                        </h1>

                        <p class="onco-page-subtitle">
                            Mettez à jour les informations du suivi médical du patient.
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
            {{-- PATIENT INFO --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                    <div
                        class="onco-avatar"
                        style="
                            width:56px;
                            height:56px;
                            background:#F1EFF8;
                            color:#655A88;
                            font-size:20px;
                        "
                    >
                        {{
                            strtoupper(
                                substr(
                                    $suivi->patient->utilisateur->prenom ?? 'P',
                                    0,
                                    1
                                )
                            )
                        }}
                    </div>

                    <div>

                        <div
                            class="text-xl font-medium text-[#293331]"
                            style="font-family:'Newsreader',serif;"
                        >
                            {{ $suivi->patient->utilisateur->prenom }}
                            {{ $suivi->patient->utilisateur->nom }}
                        </div>

                        <p class="mt-1 text-sm text-[#66706D]">
                            Patient concerné par ce suivi
                        </p>

                    </div>

                    <span
                        class="onco-badge sm:ml-auto"
                        style="background:#F1EFF8;color:#655A88;"
                    >
                        Suivi médical
                    </span>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- FORM --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:24px;"
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
                            Modifiez les informations nécessaires puis enregistrez les changements.
                        </p>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('suivis.update', $suivi) }}"
                    class="medecin-form"
                >

                    @csrf
                    @method('PUT')


                    {{-- ================================================== --}}
                    {{-- GENERAL --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Informations générales
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Vérifiez la date du suivi avant de modifier les autres informations.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

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
                                    value="{{ old('date_suivi', $suivi->date_suivi) }}"
                                    class="onco-input"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- MEDICAL --}}
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
                                Mettez à jour le type de cancer et le stade du suivi.
                            </p>

                        </div>


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

                            $typeActuel = old(
                                'type_cancer',
                                $suivi->type_cancer
                            );

                            $isAutre = !in_array(
                                $typeActuel,
                                $typesCancer
                            );
                        @endphp


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

                                    @foreach($typesCancer as $type)

                                        <option
                                            value="{{ $type }}"
                                            {{ $typeActuel === $type ? 'selected' : '' }}
                                        >
                                            {{ $type }}
                                        </option>

                                    @endforeach

                                    <option
                                        value="Autre"
                                        {{ $isAutre ? 'selected' : '' }}
                                    >
                                        Autre
                                    </option>

                                </select>


                                <input
                                    type="hidden"
                                    name="type_cancer"
                                    id="type_cancer"
                                    value="{{ $typeActuel }}"
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
                                        {{ old('stade', $suivi->stade) === 'Stade I' ? 'selected' : '' }}
                                    >
                                        Stade I
                                    </option>

                                    <option
                                        value="Stade II"
                                        {{ old('stade', $suivi->stade) === 'Stade II' ? 'selected' : '' }}
                                    >
                                        Stade II
                                    </option>

                                    <option
                                        value="Stade III"
                                        {{ old('stade', $suivi->stade) === 'Stade III' ? 'selected' : '' }}
                                    >
                                        Stade III
                                    </option>

                                    <option
                                        value="Stade IV"
                                        {{ old('stade', $suivi->stade) === 'Stade IV' ? 'selected' : '' }}
                                    >
                                        Stade IV
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Autre --}}
                        <div
                            id="autre_cancer_div"
                            style="{{ $isAutre ? '' : 'display:none;' }}"
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
                                value="{{ $isAutre ? $typeActuel : '' }}"
                                placeholder="Écrire le type de cancer"
                            >

                            <p class="onco-help">
                                Indiquez le type de cancer à enregistrer.
                            </p>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- OBSERVATION --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Observation
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Mettez à jour les notes utiles concernant le suivi.
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
                            >{{ old('observation', $suivi->observation) }}</textarea>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- EVOLUTION / TRAITEMENT --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Évolution et traitement
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Actualisez l'évolution et les informations relatives au traitement.
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
                                        -- Choisir --
                                    </option>

                                    <option
                                        value="Amélioration"
                                        {{ old('evolution', $suivi->evolution) === 'Amélioration' ? 'selected' : '' }}
                                    >
                                        Amélioration
                                    </option>

                                    <option
                                        value="Stable"
                                        {{ old('evolution', $suivi->evolution) === 'Stable' ? 'selected' : '' }}
                                    >
                                        Stable
                                    </option>

                                    <option
                                        value="Aggravation"
                                        {{ old('evolution', $suivi->evolution) === 'Aggravation' ? 'selected' : '' }}
                                    >
                                        Aggravation
                                    </option>

                                    <option
                                        value="Rémission"
                                        {{ old('evolution', $suivi->evolution) === 'Rémission' ? 'selected' : '' }}
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
                                >{{ old('traitement', $suivi->traitement) }}</textarea>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- ACTIONS --}}
                    {{-- ================================================== --}}

                    <div
                        class="flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:items-center sm:justify-between"
                        style="border-color:#EEEAE6;"
                    >

                        <a
                            href="{{ route('suivis.show', $suivi) }}"
                            class="onco-btn onco-btn-secondary"
                        >
                            ← Annuler
                        </a>

                        <button
                            type="submit"
                            class="onco-btn onco-btn-medecin"
                        >
                            <span>✓</span>
                            <span>Enregistrer les modifications</span>
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
                        Les modifications sont enregistrées uniquement par un
                        utilisateur autorisé à gérer le suivi de ce patient.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================ --}}
    {{-- AUTRE CANCER --}}
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


            if (
                !selectCancer ||
                !typeCancer ||
                !autreDiv ||
                !autreCancer
            ) {
                return;
            }


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

        });

    </script>

</x-app-layout>