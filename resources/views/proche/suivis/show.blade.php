<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-10">

        <div class="max-w-5xl mx-auto px-6">

            {{-- Retour --}}
            <div class="mb-6">
                <a href="{{ route('proche.suivis.index') }}"
                   class="text-sm text-pink-600 hover:text-pink-700">
                    ← Retour aux suivis
                </a>
            </div>

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">
                    Détail du suivi médical
                </h1>

                <p class="mt-2 text-slate-500">
                    Informations médicales accessibles selon votre autorisation.
                </p>
            </div>

            {{-- Informations patient --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

                <h2 class="text-xl font-bold text-slate-800 mb-5">
                    👤 Patient
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <p class="text-sm text-slate-400">
                            Nom complet
                        </p>

                        <p class="font-semibold text-slate-700">
                            {{ $suivi->patient->utilisateur->prenom ?? '' }}
                            {{ $suivi->patient->utilisateur->nom ?? '' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-400">
                            Date du suivi
                        </p>

                        <p class="font-semibold text-slate-700">
                            {{ \Carbon\Carbon::parse($suivi->date_suivi)->format('d/m/Y') }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- Informations médicales --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

                <h2 class="text-xl font-bold text-slate-800 mb-5">
                    🩺 Informations médicales
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <p class="text-sm text-slate-400">
                            Type de cancer
                        </p>

                        <p class="font-semibold text-slate-700">
                            {{ $suivi->type_cancer }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-400">
                            Stade
                        </p>

                        <p class="font-semibold text-slate-700">
                            {{ $suivi->stade }}
                        </p>
                    </div>

                    @if($suivi->evolution)
                        <div>
                            <p class="text-sm text-slate-400">
                                Évolution
                            </p>

                            <p class="text-slate-700">
                                {{ $suivi->evolution }}
                            </p>
                        </div>
                    @endif

                    @if($suivi->observation)
                        <div>
                            <p class="text-sm text-slate-400">
                                Observation
                            </p>

                            <p class="text-slate-700">
                                {{ $suivi->observation }}
                            </p>
                        </div>
                    @endif

                    @if($suivi->traitement)
                        <div class="md:col-span-2">
                            <p class="text-sm text-slate-400">
                                Traitement
                            </p>

                            <p class="text-slate-700">
                                {{ $suivi->traitement }}
                            </p>
                        </div>
                    @endif

                </div>

            </div>

            {{-- Médecin --}}
            @if($suivi->medecin && $suivi->medecin->utilisateur)

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <h2 class="text-xl font-bold text-slate-800 mb-5">
                        👨‍⚕️ Médecin
                    </h2>

                    <p class="text-slate-700">
                        Dr.
                        {{ $suivi->medecin->utilisateur->prenom }}
                        {{ $suivi->medecin->utilisateur->nom }}
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>