<x-app-layout>

```
<div class="p-6 max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Rendez-vous
        </h1>

        <p class="mt-1 text-slate-500">
            Consultez les rendez-vous du patient que vous accompagnez.
        </p>
    </div>

    {{-- Message succès --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($rendezVous->count())

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Patient
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Date & heure
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Médecin
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Statut
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700 text-right">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        @foreach ($rendezVous as $rdv)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Patient --}}
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800">
                                        {{ $rdv->patient->utilisateur->prenom }}
                                        {{ $rdv->patient->utilisateur->nom }}
                                    </div>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y à H:i') }}
                                </td>

                                {{-- Médecin --}}
                                <td class="px-6 py-4 text-slate-600">
                                    Dr.
                                    {{ $rdv->medecin->utilisateur->prenom }}
                                    {{ $rdv->medecin->utilisateur->nom }}
                                </td>

                                {{-- Statut --}}
                                <td class="px-6 py-4">

                                    @if ($rdv->statut === 'confirme')

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Confirmé
                                        </span>

                                    @elseif ($rdv->statut === 'refuse')

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            Refusé
                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            En attente
                                        </span>

                                    @endif

                                </td>

                                {{-- Action --}}
                                <td class="px-6 py-4 text-right">

                                    <a
                                        href="{{ route('proche.rendezvous.show', $rdv) }}"
                                        class="inline-flex items-center px-4 py-2 rounded-lg bg-pink-500 text-white text-sm font-medium hover:bg-pink-600 transition"
                                    >
                                        Consulter →
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @else

        {{-- Aucun rendez-vous --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-10 text-center">

            <div class="text-4xl mb-4">
                📅
            </div>

            <h2 class="text-lg font-semibold text-slate-800">
                Aucun rendez-vous
            </h2>

            <p class="mt-2 text-slate-500">
                Aucun rendez-vous n'est actuellement disponible pour le patient suivi.
            </p>

        </div>

    @endif

</div>
```

</x-app-layout>
