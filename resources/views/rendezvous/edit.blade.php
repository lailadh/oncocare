<x-app-layout>

    <div class="p-6 max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Gérer la demande de rendez-vous
            </h1>

            <p class="mt-1 text-gray-600">
                Traitez la demande du patient en confirmant ou en refusant le rendez-vous.
            </p>
        </div>

        {{-- Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white rounded-xl shadow p-6">

            {{-- Informations du patient --}}
            <div class="mb-6 space-y-4">

                <div>
                    <p class="text-sm text-gray-500">
                        Patient
                    </p>

                    <p class="text-lg font-semibold text-gray-800">
                        {{ $rendezVous->patient->utilisateur->prenom }}
                        {{ $rendezVous->patient->utilisateur->nom }}
                    </p>
                </div>

                {{-- Motif --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Motif de la demande
                    </p>

                    <p class="text-gray-800">
                        {{ $rendezVous->motif }}
                    </p>
                </div>

                {{-- Statut actuel --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Statut actuel
                    </p>

                    <span class="inline-flex mt-1 px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        En attente
                    </span>
                </div>

            </div>

            <div class="border-t pt-6">

                <form
                    method="POST"
                    action="{{ route('rendezvous.update', $rendezVous) }}"
                >
                    @csrf
                    @method('PATCH')

                    {{-- Décision --}}
                    <div class="mb-6">

                        <label
                            for="statut"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Décision
                        </label>

                        <select
                            id="statut"
                            name="statut"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                            <option value="">
                                -- Sélectionner une décision --
                            </option>

                            <option
                                value="confirme"
                                {{ old('statut') === 'confirme' ? 'selected' : '' }}
                            >
                                Accepter le rendez-vous
                            </option>

                            <option
                                value="refuse"
                                {{ old('statut') === 'refuse' ? 'selected' : '' }}
                            >
                                Refuser le rendez-vous
                            </option>

                        </select>

                        @error('statut')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Date et heure --}}
                    <div
                        id="date-container"
                        class="mb-6 hidden"
                    >

                        <label
                            for="date_heure"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Date et heure du rendez-vous
                        </label>

                        <input
                            type="datetime-local"
                            id="date_heure"
                            name="date_heure"
                            value="{{ old('date_heure') }}"
                            min="{{ now()->format('Y-m-d\TH:i') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                        <p class="mt-2 text-sm text-gray-500">
                            Cette date et cette heure seront communiquées au patient.
                        </p>

                        @error('date_heure')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between">

                        <a
                            href="{{ route('rendezvous.show', $rendezVous) }}"
                            class="text-gray-600 hover:text-gray-900"
                        >
                            ← Annuler
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg transition"
                        >
                            Enregistrer la décision
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- Afficher/cacher la date selon la décision --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const statut = document.getElementById('statut');
            const dateContainer = document.getElementById('date-container');
            const dateInput = document.getElementById('date_heure');

            function updateDateVisibility() {

                if (statut.value === 'confirme') {

                    dateContainer.classList.remove('hidden');
                    dateInput.required = true;

                } else {

                    dateContainer.classList.add('hidden');
                    dateInput.required = false;
                }
            }

            statut.addEventListener('change', updateDateVisibility);

            updateDateVisibility();
        });
    </script>

</x-app-layout>