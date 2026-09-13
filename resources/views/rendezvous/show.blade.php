<x-app-layout>

<div class="p-6 max-w-4xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Détails du rendez-vous
        </h1>

        <p class="mt-1 text-gray-600">
            Consultez les informations du rendez-vous.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-5 bg-green-100 border border-green-300
                    text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Patient --}}
            <div>
                <p class="text-sm text-gray-500">
                    Patient
                </p>

                <p class="mt-1 text-lg font-semibold text-gray-800">
                    {{ $rendezVous->patient->utilisateur->prenom }}
                    {{ $rendezVous->patient->utilisateur->nom }}
                </p>
            </div>

            {{-- Médecin --}}
            <div>
                <p class="text-sm text-gray-500">
                    Médecin
                </p>

                <p class="mt-1 text-lg font-semibold text-gray-800">
                    Dr {{ $rendezVous->medecin->utilisateur->prenom }}
                    {{ $rendezVous->medecin->utilisateur->nom }}
                </p>
            </div>

            {{-- Date --}}
            <div>
                <p class="text-sm text-gray-500">
                    Date
                </p>

                <p class="mt-1 text-gray-800">
                    {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('d/m/Y') }}
                </p>
            </div>

            {{-- Heure --}}
            <div>
                <p class="text-sm text-gray-500">
                    Heure
                </p>

                <p class="mt-1 text-gray-800">
                    {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('H:i') }}
                </p>
            </div>

            {{-- Motif --}}
            <div>
                <p class="text-sm text-gray-500">
                    Motif
                </p>

                <p class="mt-1 text-gray-800">
                    {{ $rendezVous->motif }}
                </p>
            </div>

            {{-- Statut --}}
            <div>
                <p class="text-sm text-gray-500">
                    Statut
                </p>

                <div class="mt-1">

                    @if($rendezVous->statut === 'en_attente')

                        <span class="inline-flex px-3 py-1 rounded-full
                                     text-sm font-medium
                                     bg-yellow-100 text-yellow-800">
                            En attente
                        </span>

                    @elseif($rendezVous->statut === 'confirme')

                        <span class="inline-flex px-3 py-1 rounded-full
                                     text-sm font-medium
                                     bg-green-100 text-green-800">
                            Confirmé
                        </span>

                    @elseif($rendezVous->statut === 'refuse')

                        <span class="inline-flex px-3 py-1 rounded-full
                                     text-sm font-medium
                                     bg-red-100 text-red-800">
                            Refusé
                        </span>

                    @else

                        <span class="inline-flex px-3 py-1 rounded-full
                                     text-sm font-medium
                                     bg-gray-100 text-gray-700">
                            {{ $rendezVous->statut }}
                        </span>

                    @endif

                </div>
            </div>

        </div>

        <div class="mt-8 pt-6 border-t flex items-center justify-between">

            {{-- Retour --}}
            <a href="{{ route('rendezvous.index') }}"
               class="text-gray-600 hover:text-gray-900">
                ← Retour aux rendez-vous
            </a>

            {{-- Supprimer --}}
            <form method="POST"
                  action="{{ route('rendezvous.destroy', $rendezVous) }}"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700
                               text-white px-5 py-2 rounded-lg">
                    Supprimer le rendez-vous
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>