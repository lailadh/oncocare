<x-app-layout>

<div class="p-6 max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Demandes de rendez-vous
            </h1>

            <p class="text-gray-600 mt-1">
                Consultez et gérez les rendez-vous de vos patients.
            </p>
        </div>

        <a href="{{ route('dashboard') }}"
           class="text-gray-600 hover:text-gray-900">
            ← Retour au dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 bg-green-100 border border-green-300
                    text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">

        @if($rendezVous->isEmpty())

            <div class="p-8 text-center text-gray-500">
                <p class="text-lg">
                    Aucun rendez-vous trouvé.
                </p>
            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-700">
                                Patient
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-700">
                                Date
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-700">
                                Heure
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-700">
                                Motif
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-700">
                                Statut
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-700">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach($rendezVous as $rendezVousItem)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">
                                        {{ $rendezVousItem->patient->utilisateur->prenom }}
                                        {{ $rendezVousItem->patient->utilisateur->nom }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($rendezVousItem->date_heure)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($rendezVousItem->date_heure)->format('H:i') }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $rendezVousItem->motif }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($rendezVousItem->statut === 'en_attente')

                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-sm font-medium
                                                     bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>

                                    @elseif($rendezVousItem->statut === 'confirme')

                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-sm font-medium
                                                     bg-green-100 text-green-800">
                                            Confirmé
                                        </span>

                                    @elseif($rendezVousItem->statut === 'refuse')

                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-sm font-medium
                                                     bg-red-100 text-red-800">
                                            Refusé
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('rendezvous.show', $rendezVousItem) }}"
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            Voir
                                        </a>

                                        @if($rendezVousItem->statut === 'en_attente')

                                            <a href="{{ route('rendezvous.edit', $rendezVousItem) }}"
                                               class="bg-blue-600 hover:bg-blue-700
                                                      text-white px-3 py-2 rounded-lg text-sm">
                                                Gérer
                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

</x-app-layout>
