<x-app-layout>

    <div class="p-6 max-w-4xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Demander un rendez-vous
            </h1>

            <p class="text-gray-600 mt-1">
                Envoyez une demande de rendez-vous à votre médecin.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6">

            <form method="POST" action="{{ route('patient.rendezvous.store') }}">
                @csrf

                <div class="mb-5">
                    <label for="id_medecin"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Médecin
                    </label>

                    <select name="id_medecin"
                            id="id_medecin"
                            required
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">

                        <option value="">
                            -- Sélectionnez un médecin --
                        </option>

                        @foreach($medecins as $medecin)
                            <option value="{{ $medecin->id_medecin }}"
                                {{ old('id_medecin') == $medecin->id_medecin ? 'selected' : '' }}>

                                Dr {{ $medecin->utilisateur->prenom }}
                                {{ $medecin->utilisateur->nom }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-5">
                    <label for="date_heure"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Date et heure
                    </label>

                    <input type="datetime-local"
                           name="date_heure"
                           id="date_heure"
                           value="{{ old('date_heure') }}"
                           required
                           min="{{ now()->format('Y-m-d\TH:i') }}"
                           class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-5">
                    <label for="motif"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Motif du rendez-vous
                    </label>

                    <select name="motif"
                            id="motif"
                            required
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">

                        <option value="">
                            -- Sélectionnez un motif --
                        </option>

                        <option value="Consultation de suivi"
                            {{ old('motif') === 'Consultation de suivi' ? 'selected' : '' }}>
                            Consultation de suivi
                        </option>

                        <option value="Contrôle de suivi"
                            {{ old('motif') === 'Contrôle de suivi' ? 'selected' : '' }}>
                            Contrôle de suivi
                        </option>

                        <option value="Autre"
                            {{ old('motif') === 'Autre' ? 'selected' : '' }}>
                            Autre
                        </option>

                    </select>
                </div>

                <div class="flex items-center justify-between mt-6">

                    <a href="{{ route('patient.rendezvous.index') }}"
                       class="text-gray-600 hover:text-gray-900">
                        ← Retour
                    </a>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        Envoyer la demande
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
