<x-app-layout>

    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Mes suivis médicaux
                </h1>

                <p class="mt-1 text-gray-600">
                    Consultez l'historique de vos suivis médicaux.
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100
                      hover:bg-gray-200 text-gray-700 rounded-lg
                      font-medium transition">
                ← Retour
            </a>
        </div>


        {{-- Message si aucun suivi --}}
        @if($suivis->isEmpty())

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">

                <div class="text-5xl mb-4">
                    🩺
                </div>

                <h2 class="text-xl font-semibold text-gray-800">
                    Aucun suivi trouvé
                </h2>

                <p class="mt-2 text-gray-500">
                    Aucun suivi médical n'a encore été enregistré pour votre dossier.
                </p>

            </div>

        @else

            {{-- Liste des suivis --}}
            <div class="space-y-5">

                @foreach($suivis as $suivi)

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200
                                p-6 hover:shadow-md transition">

                        {{-- Informations principales --}}
                        <div class="flex flex-col md:flex-row md:items-center
                                    md:justify-between gap-4 mb-5">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Date du suivi
                                </p>

                                <p class="text-lg font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y') }}
                                </p>
                            </div>


                            <div>
                                <p class="text-sm text-gray-500">
                                    Type de cancer
                                </p>

                                <p class="font-medium text-gray-800">
                                    {{ $suivi->type_cancer ?? '—' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-sm text-gray-500">
                                    Stade
                                </p>

                                <span class="inline-block px-3 py-1 rounded-full
                                             bg-blue-100 text-blue-700 text-sm font-medium">
                                    {{ $suivi->stade ?? '—' }}
                                </span>
                            </div>

                        </div>


                        {{-- Médecin --}}
                        @if($suivi->medecin && $suivi->medecin->utilisateur)

                            <div class="border-t border-gray-100 pt-4 mb-4">

                                <p class="text-sm text-gray-500">
                                    Médecin
                                </p>

                                <p class="font-medium text-gray-800">
                                    Dr.
                                    {{ $suivi->medecin->utilisateur->prenom }}
                                    {{ $suivi->medecin->utilisateur->nom }}
                                </p>

                            </div>

                        @endif


                        {{-- Détails médicaux --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            {{-- Observation --}}
                            <div class="bg-gray-50 rounded-lg p-4">

                                <p class="text-sm font-semibold text-gray-700 mb-2">
                                    Observation
                                </p>

                                <p class="text-sm text-gray-600">
                                    {{ $suivi->observation ?: 'Aucune observation.' }}
                                </p>

                            </div>


                            {{-- Évolution --}}
                            <div class="bg-gray-50 rounded-lg p-4">

                                <p class="text-sm font-semibold text-gray-700 mb-2">
                                    Évolution
                                </p>

                                <p class="text-sm text-gray-600">
                                    {{ $suivi->evolution ?: 'Non renseignée.' }}
                                </p>

                            </div>


                            {{-- Traitement --}}
                            <div class="bg-gray-50 rounded-lg p-4">

                                <p class="text-sm font-semibold text-gray-700 mb-2">
                                    Traitement
                                </p>

                                <p class="text-sm text-gray-600">
                                    {{ $suivi->traitement ?: 'Non renseigné.' }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>
