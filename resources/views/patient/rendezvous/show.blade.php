<x-app-layout>

<div class="p-6 max-w-4xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Détails de mon rendez-vous
        </h1>

        <p class="mt-1 text-gray-600">
            Consultez les informations de votre rendez-vous.
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

            <div>
                <p class="text-sm text-gray-500">Médecin</p>

                <p class="mt-1 text-lg font-semibold text-gray-800">
                    Dr {{ $rendezVous->medecin->utilisateur->prenom }}
                    {{ $rendezVous->medecin->utilisateur->nom }}
                </p>

                @if($rendezVous->medecin->specialite)
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $rendezVous->medecin->specialite }}
                    </p>
                @endif
            </div>

            <div>
                <p class="text-sm text-gray-500">Date</p>

                <p class="mt-1 text-lg font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('d/m/Y') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Heure</p>

                <p class="mt-1 text-gray-800">
                    {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('H:i') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Motif</p>

                <p class="mt-1 text-gray-800">
                    {{ $rendezVous->motif }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Statut</p>

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

                    @endif

                </div>
            </div>

        </div>

        <div class="mt-8 pt-6 border-t">

            <a href="{{ route('patient.rendezvous.index') }}"
               class="text-gray-600 hover:text-gray-900">
                ← Retour à mes rendez-vous
            </a>

        </div>

    </div>

</div>

</x-app-layout>
