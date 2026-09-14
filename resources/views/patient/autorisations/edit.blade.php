<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

            <div class="onco-page-header">

                <a
                    href="{{ route('patient.autorisations.index') }}"
                    class="onco-back-link"
                >
                    ← Retour à mes autorisations
                </a>

                <div class="onco-title-wrap">

                    <div
                        class="onco-page-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        ✎
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Modifier une autorisation
                        </h1>

                        <p class="onco-page-subtitle">
                            Modifiez les accès accordés à votre proche.
                        </p>

                    </div>

                </div>

            </div>


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
            {{-- PROCHE --}}
            {{-- ====================================================== --}}

            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="flex items-center gap-4">

                    <div
                        class="onco-avatar"
                        style="
                            width:58px;
                            height:58px;
                            background:#EEF5F0;
                            color:#63856D;
                            font-size:20px;
                        "
                    >
                        {{
                            strtoupper(
                                substr(
                                    $autorisationProche->proche->prenom ?? 'P',
                                    0,
                                    1
                                )
                            )
                        }}
                    </div>

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#738177]">
                            Proche
                        </p>

                        <p
                            class="mt-1 text-xl font-semibold text-[#293331]"
                        >
                            {{ $autorisationProche->proche->prenom }}
                            {{ $autorisationProche->proche->nom }}
                        </p>

                        <p class="mt-1 text-sm text-[#66706D]">
                            {{ $autorisationProche->proche->email }}
                        </p>

                    </div>

                    <span
                        class="onco-badge sm:ml-auto"
                        style="
                            background:#EEF5F0;
                            color:#63856D;
                        "
                    >
                        Autorisation existante
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
                            Gérer les accès
                        </h2>

                        <p class="onco-card-description">
                            Choisissez à nouveau les informations que ce proche peut consulter.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#9A6470;"
                    >
                        Accès contrôlé
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('patient.autorisations.update', $autorisationProche) }}"
                    class="patient-form"
                >

                    @csrf
                    @method('PATCH')


                    {{-- ================================================== --}}
                    {{-- PERMISSIONS --}}
                    {{-- ================================================== --}}

                    <div
                        class="mb-8 rounded-2xl p-5"
                        style="
                            background:#FFF9FA;
                            border:1px solid #F0DDE1;
                        "
                    >

                        <div class="mb-5">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Permissions
                            </h3>

                            <p class="mt-1 text-xs text-[#8B6D74]">
                                Vous pouvez activer ou retirer chaque accès séparément.
                            </p>

                        </div>


                        {{-- Accès suivis --}}
                        <div
                            class="flex items-start gap-4 rounded-2xl p-4"
                            style="
                                background:#FFFFFF;
                                border:1px solid #F0DDE1;
                            "
                        >

                            <div
                                class="onco-summary-icon"
                                style="
                                    width:42px;
                                    height:42px;
                                    min-width:42px;
                                    background:#FBF1F3;
                                    color:#D99AA6;
                                "
                            >
                                ♡
                            </div>

                            <div class="flex-1">

                                <label
                                    for="acces_suivi"
                                    class="flex cursor-pointer items-start gap-3"
                                >

                                    <input
                                        type="checkbox"
                                        name="acces_suivi"
                                        id="acces_suivi"
                                        value="1"
                                        {{ old('acces_suivi', $autorisationProche->acces_suivi) ? 'checked' : '' }}
                                        class="mt-1 h-4 w-4 rounded border-[#D8C4C9] text-[#D99AA6] focus:ring-[#D99AA6]"
                                    >

                                    <span>

                                        <span class="block text-sm font-semibold text-[#293331]">
                                            Autoriser l'accès aux suivis
                                        </span>

                                        <span class="mt-1 block text-xs leading-5 text-[#8B6D74]">
                                            Le proche pourra consulter les informations
                                            de suivi médical autorisées.
                                        </span>

                                    </span>

                                </label>

                            </div>

                        </div>


                        {{-- Accès rendez-vous --}}
                        <div
                            class="mt-4 flex items-start gap-4 rounded-2xl p-4"
                            style="
                                background:#FFFFFF;
                                border:1px solid #EEEAE6;
                            "
                        >

                            <div
                                class="onco-summary-icon"
                                style="
                                    width:42px;
                                    height:42px;
                                    min-width:42px;
                                    background:#F8F1E1;
                                    color:#C7A45B;
                                "
                            >
                                ◷
                            </div>

                            <div class="flex-1">

                                <label
                                    for="acces_rendez_vous"
                                    class="flex cursor-pointer items-start gap-3"
                                >

                                    <input
                                        type="checkbox"
                                        name="acces_rendez_vous"
                                        id="acces_rendez_vous"
                                        value="1"
                                        {{ old('acces_rendez_vous', $autorisationProche->acces_rendez_vous) ? 'checked' : '' }}
                                        class="mt-1 h-4 w-4 rounded border-[#D8C4C9] text-[#C7A45B] focus:ring-[#C7A45B]"
                                    >

                                    <span>

                                        <span class="block text-sm font-semibold text-[#293331]">
                                            Autoriser l'accès aux rendez-vous
                                        </span>

                                        <span class="mt-1 block text-xs leading-5 text-[#66706D]">
                                            Le proche pourra consulter les rendez-vous
                                            auxquels il est autorisé à accéder.
                                        </span>

                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- STATUT --}}
                    {{-- ================================================== --}}

                    <div
                        class="mb-8"
                    >

                        <div class="mb-4">

                            <h3 class="text-lg font-medium text-[#293331]">
                                Statut de l'autorisation
                            </h3>

                            <p class="mt-1 text-xs text-[#66706D]">
                                Vous pouvez activer ou désactiver cette autorisation.
                            </p>

                        </div>


                        <div class="onco-form-group">

                            <label
                                for="statut"
                                class="onco-label"
                            >
                                Statut
                            </label>

                            <select
                                id="statut"
                                name="statut"
                                class="onco-select"
                                required
                            >

                                <option
                                    value="active"
                                    {{ old('statut', $autorisationProche->statut) === 'active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    {{ old('statut', $autorisationProche->statut) === 'inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- ================================================== --}}
                    {{-- INFO --}}
                    {{-- ================================================== --}}

                    <div
                        class="mb-8 rounded-2xl p-5"
                        style="
                            background:#F8FAF8;
                            border:1px solid #E0E9E2;
                        "
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="onco-info-icon"
                                style="
                                    background:#EEF5F0;
                                    color:#7FA68A;
                                "
                            >
                                🔒
                            </div>

                            <div>

                                <h3
                                    class="text-sm font-semibold"
                                    style="color:#4E755B;"
                                >
                                    Contrôle des accès
                                </h3>

                                <p
                                    class="mt-1 text-xs leading-6"
                                    style="color:#607467;"
                                >
                                    Toute modification est appliquée à ce proche
                                    uniquement. Les autres autorisations de votre
                                    espace ne sont pas affectées.
                                </p>

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
                            href="{{ route('patient.autorisations.index') }}"
                            class="onco-btn onco-btn-secondary"
                        >
                            ← Annuler
                        </a>


                        <button
                            type="submit"
                            class="onco-btn onco-btn-patient"
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
                    border-color:#EED7DC;
                    background:#FFF9FA;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#FBF1F3;color:#D99AA6;"
                >
                    🔒
                </div>

                <div>

                    <h3
                        class="onco-info-title"
                        style="color:#9A6470;"
                    >
                        Vos données restent sous votre contrôle
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#8B6D74;"
                    >
                        Vous pouvez modifier les permissions de ce proche
                        à tout moment depuis votre espace sécurisé.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>