<x-app-layout>

    <div class="p-6 max-w-3xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Gérer le rendez-vous
            </h1>

            <p class="mt-1 text-gray-600">
                Acceptez ou refusez la demande de rendez-vous du patient.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">

            {{-- Informations du rendez-vous --}}
            <div class="mb-6 space-y-4">

                <div>
                    <p class="text-sm text-gray-500">Patient</p>

                    <p class="text-lg font-semibold text-gray-800">
                        {{ $rendezVous->patient->utilisateur->prenom }}
                        {{ $rendezVous->patient->utilisateur->nom }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Date et heure demandées</p>

                    <p class="text-gray-800">
                        {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('d/m/Y à H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Motif</p>

                    <p class="text-gray-800">
                        {{ $rendezVous->motif }}
                    </p>
                </div>

            </div>

            <div class="border-t pt-6">

                <form method="POST"
                      action="{{ route('rendezvous.update', $rendezVous) }}">

                    @csrf
                    @method('PATCH')

                    <div class="mb-6">

                        <label for="statut"
                               class="block text-sm font-medium text-gray-700 mb-2">
                            Décision
                        </label>

                        <select
                            id="statut"
                            name="statut"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm
                                   focus:border-blue-500 focus:ring-blue-500">

                            <option value="en_attente"
                                {{ $rendezVous->statut === 'en_attente' ? 'selected' : '' }}>
                                En attente
                            </option>

                            <option value="confirme"
                                {{ $rendezVous->statut === 'confirme' ? 'selected' : '' }}>
                                Accepter le rendez-vous
                            </option>

                            <option value="refuse"
                                {{ $rendezVous->statut === 'refuse' ? 'selected' : '' }}>
                                Refuser le rendez-vous
                            </option>

                        </select>

                        @error('statut')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="flex items-center justify-between">

                        <a href="{{ route('rendezvous.show', $rendezVous) }}"
                           class="text-gray-600 hover:text-gray-900">
                            ← Annuler
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700
                                   text-white font-medium
                                   px-5 py-2.5 rounded-lg
                                   transition">
                            Enregistrer la décision
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>