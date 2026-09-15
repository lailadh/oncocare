<x-app-layout>

<div class="onco-page">
    <div class="onco-container">

        {{-- Header --}}
        <div class="onco-page-header">

            <div class="onco-title-wrap">

                <div class="onco-page-icon role-patient">
                    📅
                </div>

                <div>
                    <h1 class="onco-title">
                        Demander un rendez-vous
                    </h1>

                    <p class="onco-subtitle">
                        Envoyez une demande à votre médecin.
                        La date et l'heure seront proposées par le médecin.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('patient.rendezvous.index') }}"
                class="onco-btn"
            >
                ← Retour
            </a>

        </div>


        {{-- Messages d'erreur --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">

                <div class="font-semibold mb-2">
                    Vérifiez les informations suivantes :
                </div>

                <ul class="list-disc list-inside space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif


        {{-- Formulaire --}}
        <div class="onco-card max-w-3xl mx-auto">

            <div class="mb-6">

                <h2 class="text-xl font-semibold text-slate-800">
                    Nouvelle demande
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Choisissez votre médecin et indiquez le motif
                    de votre demande.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('patient.rendezvous.demande.store') }}"
                class="space-y-6"
            >

                @csrf


                {{-- ============================= --}}
                {{-- MÉDECIN --}}
                {{-- ============================= --}}

                <div>

                    <label
                        for="id_medecin"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Médecin
                    </label>

                    <select
                        id="id_medecin"
                        name="id_medecin"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-green-700 focus:ring-green-700"
                    >

                        <option value="">
                            -- Sélectionnez votre médecin --
                        </option>


                        @forelse ($medecins as $medecin)

                            <option
                                value="{{ $medecin->id_medecin }}"
                                {{ old('id_medecin') == $medecin->id_medecin ? 'selected' : '' }}
                            >

                                Dr {{ $medecin->utilisateur->prenom }}
                                {{ $medecin->utilisateur->nom }}

                                @if ($medecin->specialite)
                                    — {{ $medecin->specialite }}
                                @endif

                            </option>

                        @empty

                            <option value="" disabled>
                                Aucun médecin ne vous suit actuellement.
                            </option>

                        @endforelse

                    </select>


                    @error('id_medecin')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- ============================= --}}
                {{-- MOTIF --}}
                {{-- ============================= --}}

                <div>

                    <label
                        for="motif"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Motif du rendez-vous
                    </label>


                    <select
                        id="motif"
                        name="motif"
                        required
                        onchange="toggleAutreMotif()"
                        class="w-full rounded-xl border-slate-300 focus:border-green-700 focus:ring-green-700"
                    >

                        <option value="">
                            -- Sélectionnez un motif --
                        </option>


                        <option
                            value="Consultation de suivi"
                            {{ old('motif') === 'Consultation de suivi' ? 'selected' : '' }}
                        >
                            🩺 Consultation de suivi
                        </option>


                        <option
                            value="Contrôle médical"
                            {{ old('motif') === 'Contrôle médical' ? 'selected' : '' }}
                        >
                            🔬 Contrôle médical
                        </option>


                        <option
                            value="Suivi du traitement"
                            {{ old('motif') === 'Suivi du traitement' ? 'selected' : '' }}
                        >
                            💊 Suivi du traitement
                        </option>


                        <option
                            value="Bilan / examens"
                            {{ old('motif') === 'Bilan / examens' ? 'selected' : '' }}
                        >
                            📋 Bilan / examens
                        </option>


                        <option
                            value="Effets secondaires du traitement"
                            {{ old('motif') === 'Effets secondaires du traitement' ? 'selected' : '' }}
                        >
                            🤕 Effets secondaires du traitement
                        </option>


                        <option
                            value="Demande d’information"
                            {{ old('motif') === 'Demande d’information' ? 'selected' : '' }}
                        >
                            💬 Demande d’information
                        </option>


                        <option
                            value="Renouvellement / adaptation du suivi"
                            {{ old('motif') === 'Renouvellement / adaptation du suivi' ? 'selected' : '' }}
                        >
                            🔄 Renouvellement / adaptation du suivi
                        </option>


                        <option
                            value="Autre"
                            {{ old('motif') === 'Autre' ? 'selected' : '' }}
                        >
                            ✏️ Autre
                        </option>

                    </select>


                    @error('motif')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- ============================= --}}
                {{-- AUTRE MOTIF --}}
                {{-- ============================= --}}

                <div
                    id="autreMotifContainer"
                    class="{{ old('motif') === 'Autre' ? '' : 'hidden' }}"
                >

                    <label
                        for="motif_autre"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Précisez le motif
                    </label>


                    <textarea
                        id="motif_autre"
                        name="motif_autre"
                        rows="4"
                        maxlength="1000"
                        placeholder="Précisez votre motif..."
                        class="w-full rounded-xl border-slate-300 focus:border-green-700 focus:ring-green-700"
                    >{{ old('motif_autre') }}</textarea>


                    @error('motif_autre')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- ============================= --}}
                {{-- INFORMATION --}}
                {{-- ============================= --}}

                <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <div class="flex gap-3">

                        <div class="text-xl">
                            ℹ️
                        </div>

                        <div>

                            <p class="font-semibold text-slate-800">
                                Comment fonctionne votre demande ?
                            </p>

                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Vous envoyez d'abord votre demande au médecin.
                                Celui-ci choisira ensuite une date et une heure
                                disponibles pour votre rendez-vous.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ============================= --}}
                {{-- ACTIONS --}}
                {{-- ============================= --}}

                <div class="flex flex-col sm:flex-row gap-3 pt-2">

                    <a
                        href="{{ route('patient.rendezvous.index') }}"
                        class="onco-btn flex-1 text-center"
                    >
                        Annuler
                    </a>


                    <button
                        type="submit"
                        class="onco-btn onco-btn-patient flex-1"
                        @if($medecins->isEmpty()) disabled @endif
                    >
                        📩 Envoyer la demande
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- ============================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================= --}}

<script>

    function toggleAutreMotif() {

        const select = document.getElementById('motif');
        const container = document.getElementById('autreMotifContainer');
        const textarea = document.getElementById('motif_autre');

        if (!select || !container || !textarea) {
            return;
        }


        if (select.value === 'Autre') {

            container.classList.remove('hidden');

            textarea.required = true;

        } else {

            container.classList.add('hidden');

            textarea.required = false;

            textarea.value = '';

        }

    }


    document.addEventListener('DOMContentLoaded', function () {

        toggleAutreMotif();

    });

</script>

</x-app-layout>
