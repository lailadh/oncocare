<x-app-layout>

    <div class="py-10 bg-slate-50 min-h-screen">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Dossier du patient
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Consultez les informations et l'historique du patient.
                    </p>
                </div>

                <a href="{{ route('medecin.patients.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-slate-200 text-slate-700 text-sm font-medium
                          hover:bg-slate-300 transition">
                    ← Retour
                </a>

            </div>

            {{-- Informations personnelles --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-14 h-14 rounded-full bg-pink-100
                                flex items-center justify-center">

                        <span class="text-2xl">
                            👤
                        </span>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            {{ $patient->utilisateur->prenom }}
                            {{ $patient->utilisateur->nom }}
                        </h2>

                        <p class="text-sm text-slate-500">
                            Patient OncoCare
                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-slate-500">
                            Email
                        </p>

                        <p class="mt-1 font-medium text-slate-800">
                            {{ $patient->utilisateur->email }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-slate-500">
                            Téléphone
                        </p>

                        <p class="mt-1 font-medium text-slate-800">
                            {{ $patient->utilisateur->telephone ?? '—' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-slate-500">
                            Date de naissance
                        </p>

                        <p class="mt-1 font-medium text-slate-800">
                            {{ $patient->date_naissance
                                ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y')
                                : '—'
                            }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-slate-500">
                            Adresse
                        </p>

                        <p class="mt-1 font-medium text-slate-800">
                            {{ $patient->adresse ?? '—' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Historique des suivis --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="p-6 border-b border-slate-200">

                    <h2 class="text-xl font-bold text-slate-800">
                        Historique des suivis
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Les différents suivis médicaux enregistrés pour ce patient.
                    </p>

                </div>


                @if ($patient->suivis->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead class="bg-slate-50 border-b border-slate-200">

                                <tr>

                                    <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                        Date
                                    </th>

                                    <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                        Type de cancer
                                    </th>

                                    <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                        Stade
                                    </th>

                                    <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                        Évolution
                                    </th>

                                    <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                        Traitement
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-200">

                                @foreach ($patient->suivis as $suivi)

                                    <tr class="hover:bg-slate-50 transition">

                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $suivi->date_suivi
                                                ? \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y')
                                                : '—'
                                            }}
                                        </td>


                                        <td class="px-6 py-4 text-slate-700">
                                            {{ $suivi->type_cancer ?? '—' }}
                                        </td>


                                        <td class="px-6 py-4 text-slate-700">
                                            {{ $suivi->stade ?? '—' }}
                                        </td>


                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $suivi->evolution ?? '—' }}
                                        </td>


                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $suivi->traitement ?? '—' }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="p-10 text-center">

                        <div class="text-4xl mb-4">
                            🩺
                        </div>

                        <h3 class="text-lg font-semibold text-slate-800">
                            Aucun suivi médical
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Aucun suivi médical n'est encore enregistré pour ce patient.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>