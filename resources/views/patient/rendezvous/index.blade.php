<x-app-layout>

    <div class="p-6 max-w-6xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Mes rendez-vous
                </h1>

                <p class="text-gray-600 mt-1">
                    Consultez vos rendez-vous médicaux.
                </p>
            </div>

            <a href="{{ route('patient.rendezvous.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Demander un rendez-vous
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($rendezVous->isEmpty())

            <div class="bg-white rounded-xl shadow p-8 text-center">
                <div class="text-4xl mb-3">📅</div>

                <h2 class="text-lg font-semibold text-gray-800">
                    Aucun rendez-vous
                </h2>

                <p class="text-gray-500 mt-2">
                    Vous n'avez pas encore de rendez-vous.
                </p>

                <a href="{{ route('patient.rendezvous.create') }}"
                   class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Demander un rendez-vous
                </a>
            </div>

        @else

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full text-left">

                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Date
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Médecin
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

                            @foreach($rendezVous as $rdv)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-800">
                                            {{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y') }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($rdv->medecin && $rdv->medecin->utilisateur)
                                            Dr {{ $rdv->medecin->utilisateur->prenom }}
                                            {{ $rdv->medecin->utilisateur->nom }}
                                        @else
                                            <span class="text-gray-400">
                                                Médecin non disponible
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $rdv->motif ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if($rdv->statut === 'confirme')

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                                Confirmé
                                            </span>

                                        @elseif($rdv->statut === 'refuse')

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                                Refusé
                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                                En attente
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-6 py-4">

                                        <a href="{{ route('patient.rendezvous.show', $rdv) }}"
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            Voir détails
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>

            </div>

        @endif

        <div class="mt-6">
            <a href="{{ route('dashboard') }}"
               class="text-gray-600 hover:text-gray-900">
                ← Retour au dashboard
            </a>
        </div>

    </div>

</x-app-layout>
