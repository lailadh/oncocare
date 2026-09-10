<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-10">

        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('dashboard') }}"
                   class="text-sm text-pink-600 hover:text-pink-700">
                    ← Retour au dashboard
                </a>

                <h1 class="mt-4 text-3xl font-bold text-slate-800">
                    Suivi médical
                </h1>

                <p class="mt-2 text-slate-500">
                    Consultez les informations de suivi médical auxquelles
                    vous êtes autorisé.
                </p>
            </div>


            {{-- Liste des suivis --}}
            @if($suivis->count())

                <div class="space-y-5">

                    @foreach($suivis as $suivi)

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div>

                                    <p class="text-sm text-slate-400">
                                        Date du suivi
                                    </p>

                                    <h2 class="text-xl font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y') }}
                                    </h2>

                                    <div class="mt-3 space-y-1 text-sm text-slate-600">

                                        <p>
                                            <strong>Patient :</strong>
                                            {{ $suivi->patient->utilisateur->prenom ?? '' }}
                                            {{ $suivi->patient->utilisateur->nom ?? '' }}
                                        </p>

                                        <p>
                                            <strong>Type de cancer :</strong>
                                            {{ $suivi->type_cancer }}
                                        </p>

                                        <p>
                                            <strong>Stade :</strong>
                                            {{ $suivi->stade }}
                                        </p>

                                        @if($suivi->medecin && $suivi->medecin->utilisateur)
                                            <p>
                                                <strong>Médecin :</strong>
                                                Dr.
                                                {{ $suivi->medecin->utilisateur->prenom }}
                                                {{ $suivi->medecin->utilisateur->nom }}
                                            </p>
                                        @endif

                                    </div>

                                </div>


                                <div>
                                    <a href="{{ route('proche.suivis.show', $suivi) }}"
                                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-pink-600 text-white font-medium hover:bg-pink-700 transition">
                                        Consulter →
                                    </a>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                    <div class="text-4xl mb-4">
                        📋
                    </div>

                    <h2 class="text-xl font-semibold text-slate-700">
                        Aucun suivi disponible
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Aucun suivi médical n'est actuellement disponible
                        pour les patients auxquels vous avez accès.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>