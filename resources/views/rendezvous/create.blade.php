<x-app-layout>

    <div class="min-h-screen bg-[#F7F6F1]">

        <div class="onco-page">
            <div class="onco-container">

                {{-- ===================================================== --}}
                {{-- HEADER --}}
                {{-- ===================================================== --}}

                <div class="pt-8 md:pt-10">

                    <a
                        href="{{ route('rendezvous.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-medium text-[#667085] transition hover:text-[#514B70]"
                    >
                        <span>←</span>
                        <span>Retour aux rendez-vous</span>
                    </a>


                    <div class="mt-5 flex items-start gap-4">

                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-[#DED9EB] bg-[#F1EFF8] text-[#7567A8]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="3"
                                    y="4"
                                    width="18"
                                    height="17"
                                    rx="3"
                                />
                                <path d="M7 2v4M17 2v4M3 10h18"/>
                                <path d="M12 14v3"/>
                                <path d="M12 19h.01"/>
                            </svg>
                        </div>


                        <div>

                            <div class="mb-2 text-xs font-semibold uppercase tracking-[0.16em] text-[#7567A8]">
                                Espace médecin
                            </div>

                            <h1 class="text-3xl font-semibold tracking-tight text-[#34324A] md:text-4xl">
                                Créer un rendez-vous
                            </h1>

                            <p class="mt-2 max-w-2xl text-sm leading-6 text-[#667085] md:text-[15px]">
                                Planifiez un rendez-vous pour l'un de vos patients en quelques étapes.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- SUCCESS --}}
                {{-- ===================================================== --}}

                @if(session('success'))

                    <div
                        class="mt-7 rounded-2xl border border-[#D5E5D9] bg-[#F0F7F1] px-5 py-4"
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[#7FA68A] shadow-sm"
                            >
                                ✓
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#4D7257]">
                                    Opération réussie
                                </p>

                                <p class="mt-1 text-sm leading-6 text-[#66736E]">
                                    {{ session('success') }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ===================================================== --}}
                {{-- ERRORS --}}
                {{-- ===================================================== --}}

                @if($errors->any())

                    <div
                        class="mt-5 rounded-2xl border border-[#F0D7DF] bg-[#FDF3F5] px-5 py-4"
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white font-semibold text-[#C9788D] shadow-sm"
                            >
                                !
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#9A5661]">
                                    Vérifiez les informations saisies
                                </p>

                                <ul class="mt-2 space-y-1 text-sm leading-6 text-[#756D84]">

                                    @foreach($errors->all() as $error)
                                        <li>
                                            • {{ $error }}
                                        </li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ===================================================== --}}
                {{-- FORM LAYOUT --}}
                {{-- ===================================================== --}}

                <div class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,1fr)_300px]">

                    {{-- ================================================= --}}
                    {{-- FORM --}}
                    {{-- ================================================= --}}

                    <div
                        class="overflow-hidden rounded-[22px] border border-[#E3DDD8] bg-white shadow-[0_8px_30px_rgba(52,50,74,0.05)]"
                    >

                        {{-- Form header --}}
                        <div
                            class="border-b border-[#EEE9E4] px-6 py-6 md:px-7"
                        >

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#F1EFF8] text-[#7567A8]"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M12 3v18"/>
                                                <path d="M3 12h18"/>
                                            </svg>
                                        </div>

                                        <div>

                                            <h2 class="text-xl font-semibold text-[#34324A]">
                                                Informations du rendez-vous
                                            </h2>

                                            <p class="mt-1 text-sm text-[#667085]">
                                                Renseignez les informations principales du rendez-vous.
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                <span
                                    class="inline-flex w-fit items-center rounded-full bg-[#F1EFF8] px-3 py-1.5 text-xs font-semibold text-[#655A88]"
                                >
                                    Nouveau rendez-vous
                                </span>

                            </div>

                        </div>


                        {{-- Form --}}
                        <div class="px-6 py-7 md:px-7">

                            <form
                                method="POST"
                                action="{{ route('rendezvous.store') }}"
                            >

                                @csrf


                                {{-- ===================================== --}}
                                {{-- PATIENT --}}
                                {{-- ===================================== --}}

                                <div>

                                    <div class="mb-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FBF1F3] text-[#B98591]"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <circle cx="9" cy="8" r="3"/>
                                                    <path d="M3.5 20a5.5 5.5 0 0 1 11 0"/>
                                                    <path d="M16 11a3 3 0 1 0 0-6"/>
                                                    <path d="M16 14a5 5 0 0 1 4.5 5"/>
                                                </svg>
                                            </div>

                                            <div>

                                                <h3 class="text-base font-semibold text-[#34324A]">
                                                    Patient concerné
                                                </h3>

                                                <p class="mt-0.5 text-xs text-[#8A8894]">
                                                    Sélectionnez un patient suivi par votre compte.
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <label
                                        for="id_patient"
                                        class="mb-2 block text-sm font-semibold text-[#4A5350]"
                                    >
                                        Patient
                                    </label>

                                    <select
                                        name="id_patient"
                                        id="id_patient"
                                        required
                                        class="w-full rounded-xl border border-[#DCDAD6] bg-white px-4 py-3 text-sm text-[#34324A] outline-none transition focus:border-[#7567A8] focus:ring-4 focus:ring-[#F1EFF8]"
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

                                    <p class="mt-2 text-xs leading-5 text-[#8A8894]">
                                        Seuls les patients associés à votre suivi médical sont proposés.
                                    </p>

                                </div>


                                <div class="my-8 h-px bg-[#EEE9E4]"></div>


                                {{-- ===================================== --}}
                                {{-- DATE / HEURE --}}
                                {{-- ===================================== --}}

                                <div>

                                    <div class="mb-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#F8F1E1] text-[#C49A5A]"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="4"
                                                        width="18"
                                                        height="17"
                                                        rx="3"
                                                    />
                                                    <path d="M7 2v4M17 2v4M3 10h18"/>
                                                    <path d="M12 7v5l3 2"/>
                                                </svg>
                                            </div>

                                            <div>

                                                <h3 class="text-base font-semibold text-[#34324A]">
                                                    Date et heure
                                                </h3>

                                                <p class="mt-0.5 text-xs text-[#8A8894]">
                                                    Définissez le créneau du rendez-vous.
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <div class="rounded-2xl border border-[#E8E0D1] bg-[#FBF8EF] p-5">

                                        <label
                                            for="date_heure"
                                            class="mb-2 block text-sm font-semibold text-[#4A5350]"
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
                                            class="w-full rounded-xl border border-[#DDD8CC] bg-white px-4 py-3 text-sm text-[#34324A] outline-none transition focus:border-[#C49A5A] focus:ring-4 focus:ring-[#F8F1E1]"
                                        >

                                        <div class="mt-3 flex items-start gap-2">

                                            <div class="mt-0.5 text-[#C49A5A]">
                                                ⓘ
                                            </div>

                                            <p class="text-xs leading-5 text-[#756D84]">
                                                Le rendez-vous doit être planifié à une date et une heure futures.
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                <div class="my-8 h-px bg-[#EEE9E4]"></div>


                                {{-- ===================================== --}}
                                {{-- MOTIF --}}
                                {{-- ===================================== --}}

                                <div>

                                    <div class="mb-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#EEF5EF] text-[#7FA68A]"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path d="M6 3h12v18H6z"/>
                                                    <path d="M9 7h6M9 11h6M9 15h4"/>
                                                </svg>
                                            </div>

                                            <div>

                                                <h3 class="text-base font-semibold text-[#34324A]">
                                                    Motif du rendez-vous
                                                </h3>

                                                <p class="mt-0.5 text-xs text-[#8A8894]">
                                                    Indiquez la raison principale du rendez-vous.
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <label
                                        for="motif"
                                        class="mb-2 block text-sm font-semibold text-[#4A5350]"
                                    >
                                        Motif
                                    </label>

                                    <select
                                        name="motif"
                                        id="motif"
                                        required
                                        class="w-full rounded-xl border border-[#DCDAD6] bg-white px-4 py-3 text-sm text-[#34324A] outline-none transition focus:border-[#7567A8] focus:ring-4 focus:ring-[#F1EFF8]"
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


                                {{-- ===================================== --}}
                                {{-- ACTIONS --}}
                                {{-- ===================================== --}}

                                <div class="mt-9 flex flex-col-reverse gap-3 border-t border-[#EEE9E4] pt-6 sm:flex-row sm:items-center sm:justify-between">

                                    <a
                                        href="{{ route('rendezvous.index') }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#DDD9E7] bg-white px-5 py-3 text-sm font-semibold text-[#5E5877] transition hover:bg-[#F8F6FB]"
                                    >
                                        <span>←</span>
                                        <span>Annuler</span>
                                    </a>


                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#514B70] px-5 py-3 text-sm font-semibold text-white shadow-[0_8px_22px_rgba(81,75,112,0.15)] transition hover:-translate-y-0.5 hover:bg-[#45405F]"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>

                                        <span>Créer le rendez-vous</span>
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SIDE INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="space-y-5">


                        {{-- Workflow --}}
                        <div
                            class="rounded-[22px] border border-[#DED9EB] bg-white p-5 shadow-[0_8px_24px_rgba(52,50,74,0.045)]"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#F1EFF8] text-[#7567A8]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>
                                </div>

                                <div>

                                    <h3 class="text-sm font-semibold text-[#34324A]">
                                        Processus
                                    </h3>

                                    <p class="mt-0.5 text-xs text-[#8A8894]">
                                        Création du rendez-vous
                                    </p>

                                </div>

                            </div>


                            <div class="mt-5 space-y-4">

                                <div class="flex gap-3">

                                    <div
                                        class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#F1EFF8] text-xs font-semibold text-[#655A88]"
                                    >
                                        1
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-[#34324A]">
                                            Choisir le patient
                                        </p>
                                        <p class="mt-0.5 text-xs leading-5 text-[#8A8894]">
                                            Sélectionnez un patient suivi.
                                        </p>
                                    </div>

                                </div>


                                <div class="ml-3.5 h-4 w-px bg-[#E4E0EE]"></div>


                                <div class="flex gap-3">

                                    <div
                                        class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#F8F1E1] text-xs font-semibold text-[#8A6B32]"
                                    >
                                        2
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-[#34324A]">
                                            Définir le créneau
                                        </p>
                                        <p class="mt-0.5 text-xs leading-5 text-[#8A8894]">
                                            Choisissez la date et l'heure.
                                        </p>
                                    </div>

                                </div>


                                <div class="ml-3.5 h-4 w-px bg-[#E4E0EE]"></div>


                                <div class="flex gap-3">

                                    <div
                                        class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#EEF5EF] text-xs font-semibold text-[#4D7257]"
                                    >
                                        3
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-[#34324A]">
                                            Confirmer
                                        </p>
                                        <p class="mt-0.5 text-xs leading-5 text-[#8A8894]">
                                            Le patient sera informé.
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Privacy --}}
                        <div
                            class="rounded-[22px] border border-[#E8E0D1] bg-[#FBF8EF] p-5"
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-[#C49A5A] shadow-[0_3px_12px_rgba(52,50,74,0.04)]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="5"
                                            y="11"
                                            width="14"
                                            height="10"
                                            rx="2"
                                        />
                                        <path d="M8 11V8a4 4 0 0 1 8 0v3"/>
                                    </svg>
                                </div>

                                <div>

                                    <h3 class="text-sm font-semibold text-[#665A35]">
                                        Confidentialité
                                    </h3>

                                    <p class="mt-1 text-xs leading-5 text-[#7D735F]">
                                        Les rendez-vous sont créés uniquement
                                        pour les patients associés à votre suivi
                                        et restent protégés par les règles d'accès
                                        de la plateforme.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- FOOTER NOTE --}}
                {{-- ===================================================== --}}

                <div class="pb-10 pt-6">

                    <div class="flex items-center justify-center gap-2 text-xs text-[#8A8894]">

                        <span class="h-1.5 w-1.5 rounded-full bg-[#7FA68A]"></span>

                        <span>
                            OncoCare · Espace médical sécurisé
                        </span>

                    </div>

                </div>

            </div>
        </div>

    </div>

</x-app-layout>