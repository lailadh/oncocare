<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('rendezvous.index') }}"
                    class="onco-back-link"
                >
                    ← Retour aux rendez-vous
                </a>

                <div class="onco-title-wrap">

                    <div
                        class="onco-page-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ◷
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Créer un rendez-vous
                        </h1>

                        <p class="onco-page-subtitle">
                            Planifiez un rendez-vous pour l'un de vos patients.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- SUCCESS --}}
            {{-- ====================================================== --}}

            @if(session('success'))

                <div
                    class="onco-alert"
                    style="
                        margin-top:24px;
                        border-color:#D5E5D9;
                        background:#F0F7F1;
                    "
                >

                    <div
                        class="onco-alert-icon"
                        style="color:#7FA68A;"
                    >
                        ✓
                    </div>

                    <div>

                        <div
                            class="onco-alert-title"
                            style="color:#4D7257;"
                        >
                            Opération réussie
                        </div>

                        <div class="onco-alert-text">
                            {{ session('success') }}
                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================== --}}
            {{-- ERRORS --}}
            {{-- ====================================================== --}}

            @if($errors->any())

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

                                @foreach($errors->all() as $error)

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
                            Informations du rendez-vous
                        </h2>

                        <p class="onco-card-description">
                            Renseignez le patient, la date et le motif du rendez-vous.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
                    >
                        Rendez-vous médical
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('rendezvous.store') }}"
                    class="medecin-form"
                >

                    @csrf


                    {{-- ================================================== --}}
                    {{-- PATIENT --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Patient concerné
                            </h3>

                            <p class="mt-1 text-xs text-[#756D84]">
                                Sélectionnez le patient pour lequel le rendez-vous est planifié.
                            </p>

                        </div>


                        <div class="onco-form-group">

                            <label
                                for="id_patient"
                                class="onco-label"
                            >
                                Patient
                            </label>

                            <select
                                name="id_patient"
                                id="id_patient"
                                required
                                class="onco-select"
                            >

                                <option value="">
                                    -- Sélectionnez un patient --
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

                    </div>


                    {{-- ================================================== --}}
                    {{-- DATE / HEURE --}}
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
                                Date et heure
                            </h3>

                            <p class="mt-1 text-xs text-[#756D84]">
                                Choisissez une date et une heure à partir de maintenant.
                            </p>

                        </div>


                        <div class="onco-form-group">

                            <label
                                for="date_heure"
                                class="onco-label"
                            >
                                Date et heure du rendez-vous
                            </label>

                            <input
                                type="datetime-local"
                                name="date_heure"
                                id="date_heure"
                                value="{{ old('date_heure') }}"
                                required
                                min="{{ now()->format('Y-m-d\TH:i') }}"
                                class="onco-input"
                            >

                            <p class="onco-help">
                                Le rendez-vous doit être planifié à une date et une heure futures.
                            </p>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- MOTIF --}}
                    {{-- ================================================== --}}

                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Motif du rendez-vous
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Indiquez la raison principale du rendez-vous.
                            </p>

                        </div>


                        <div class="onco-form-group">

                            <label
                                for="motif"
                                class="onco-label"
                            >
                                Motif
                            </label>

                            <select
                                name="motif"
                                id="motif"
                                required
                                class="onco-select"
                            >

                                <option value="">
                                    -- Sélectionnez un motif --
                                </option>

                                <option
                                    value="Consultation de suivi"
                                    {{ old('motif') === 'Consultation de suivi' ? 'selected' : '' }}
                                >
                                    Consultation de suivi
                                </option>

                                <option
                                    value="Contrôle de suivi"
                                    {{ old('motif') === 'Contrôle de suivi' ? 'selected' : '' }}
                                >
                                    Contrôle de suivi
                                </option>

                                <option
                                    value="Consultation médicale"
                                    {{ old('motif') === 'Consultation médicale' ? 'selected' : '' }}
                                >
                                    Consultation médicale
                                </option>

                                <option
                                    value="Autre"
                                    {{ old('motif') === 'Autre' ? 'selected' : '' }}
                                >
                                    Autre
                                </option>

                            </select>

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
                            href="{{ route('rendezvous.index') }}"
                            class="onco-btn onco-btn-secondary"
                        >
                            ← Annuler
                        </a>


                        <button
                            type="submit"
                            class="onco-btn onco-btn-medecin"
                        >
                            <span>✓</span>
                            <span>Créer le rendez-vous</span>
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
                        Confidentialité des rendez-vous
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
                    >
                        Les rendez-vous sont associés uniquement à vos patients
                        autorisés et restent soumis aux règles de confidentialité
                        de la plateforme.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>