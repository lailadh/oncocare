<x-app-layout>
<div class="p-6 max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Mes patients
        </h1>

        <p class="mt-1 text-slate-500">
            Consultez la liste des patients que vous suivez.
        </p>
    </div>

    @if ($patients->count())

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    {{-- Table Header --}}
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Patient
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Email
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Téléphone
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Date de naissance
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-700">
                                Action
                            </th>

                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-slate-200">

                        @foreach ($patients as $patient)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Patient --}}
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800">
                                        {{ $patient->utilisateur->prenom }}
                                        {{ $patient->utilisateur->nom }}
                                    </div>
                                </td>

                                {{-- Email --}}
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $patient->utilisateur->email }}
                                </td>

                                {{-- Téléphone --}}
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $patient->utilisateur->telephone ?? '—' }}
                                </td>

                                {{-- Date de naissance --}}
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $patient->date_naissance
                                        ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y')
                                        : '—'
                                    }}
                                </td>

                                {{-- Action --}}
                                <td class="px-6 py-4">
                                    <a href="{{ route('medecin.patients.show', $patient) }}"
                                       class="inline-flex items-center px-4 py-2 rounded-lg
                                              bg-pink-600 text-white text-sm font-medium
                                              hover:bg-pink-700 transition">
                                        Voir le dossier →
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @else

        {{-- Aucun patient --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-10 text-center">

            <div class="text-4xl mb-4">
                👤
            </div>

            <h2 class="text-lg font-semibold text-slate-800">
                Aucun patient
            </h2>

            <p class="mt-2 text-slate-500">
                Aucun patient n'est actuellement associé à votre compte.
            </p>

        </div>

    @endif

</div>

</x-app-layout>
