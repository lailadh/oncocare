<x-app-layout>

<div class="p-6 max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Détail du rendez-vous
        </h1>

        <p class="mt-1 text-slate-500">
            Informations sur le rendez-vous du patient suivi.
        </p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Patient --}}
        <div class="p-6 border-b border-slate-200">
            <p class="text-sm text-slate-500">
                Patient
            </p>

            <p class="mt-1 text-lg font-semibold text-slate-800">
                {{ $rendezVous->patient->utilisateur->prenom }}
                {{ $rendezVous->patient->utilisateur->nom }}
            </p>
        </div>

        {{-- Informations --}}
        <div class="p-6 space-y-5">

            {{-- Date --}}
            <div>
                <p class="text-sm text-slate-500">
                    Date et heure
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('d/m/Y à H:i') }}
                </p>
            </div>

            {{-- Médecin --}}
            <div>
                <p class="text-sm text-slate-500">
                    Médecin
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    Dr.
                    {{ $rendezVous->medecin->utilisateur->prenom }}
                    {{ $rendezVous->medecin->utilisateur->nom }}
                </p>
            </div>

            {{-- Motif --}}
            <div>
                <p class="text-sm text-slate-500">
                    Motif
                </p>

                <p class="mt-1 text-slate-800">
                    {{ $rendezVous->motif }}
                </p>
            </div>

            {{-- Statut --}}
            <div>
                <p class="text-sm text-slate-500">
                    Statut
                </p>

                <div class="mt-2">

                    @if ($rendezVous->statut === 'confirme')

                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                            Confirmé
                        </span>

                    @elseif ($rendezVous->statut === 'refuse')

                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                            Refusé
                        </span>

                    @else

                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                            En attente
                        </span>

                    @endif

                </div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">

            <a
                href="{{ route('proche.rendezvous.index') }}"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-slate-700 text-white text-sm font-medium hover:bg-slate-800 transition"
            >
                ← Retour aux rendez-vous
            </a>

        </div>

    </div>

</div>


</x-app-layout>
