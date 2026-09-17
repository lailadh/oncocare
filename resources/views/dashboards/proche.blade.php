<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                Dashboard Proche
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Espace de suivi et d'accès autorisé
            </p>
        </div>
    </x-slot>

    <div class="py-6 bg-slate-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6 text-center">
                <h1 class="text-2xl font-bold text-slate-800">
                    Bonjour {{ auth()->user()->prenom }} 👋
                </h1>

                <p class="text-slate-500 mt-2">
                    Bienvenue dans votre espace proche autorisé.
                    Vous pouvez consulter uniquement les informations partagées avec vous.
                </p>
            </div>

            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5 mb-6 flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-2xl">🔒</div>
                <div>
                    <h2 class="text-base font-semibold text-emerald-800">Accès limité et sécurisé</h2>
                    <p class="text-sm text-emerald-700 mt-1">
                        Vous pouvez uniquement consulter les informations que le patient a choisi de partager avec vous.
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Patient suivi</h2>

                @if(isset($autorisations) && $autorisations->count())
                    @foreach($autorisations as $autorisation)
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-5 h-full flex flex-col justify-between text-left min-h-[180px]">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-lg">
                                    {{ strtoupper(substr($autorisation->patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">
                                        {{ $autorisation->patient->utilisateur->prenom ?? '' }}
                                        {{ $autorisation->patient->utilisateur->nom ?? '' }}
                                    </h3>
                                    <p class="text-sm text-slate-500">
                                        Autorisation : {{ $autorisation->statut }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4">
                                @if($autorisation->acces_suivi)
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        ✓ Suivi médical
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        Suivi non accessible
                                    </span>
                                @endif

                                @if($autorisation->acces_rendez_vous)
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        ✓ Rendez-vous
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        Rendez-vous non accessible
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-2xl border border-dashed border-slate-200 p-8 text-center">
                        <div class="text-4xl mb-3">👤</div>
                        <p class="text-lg font-semibold text-slate-700">Aucun patient autorisé</p>
                        <p class="text-sm text-slate-500 mt-2">
                            Aucun patient ne vous a encore donné accès à ses informations.
                        </p>
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Mes accès</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-stretch">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition h-full flex flex-col justify-between items-center text-center min-h-[240px]">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-4 shrink-0">
                        <span class="text-2xl">🩺</span>
                    </div>

                    <div class="flex flex-col items-center flex-1 w-full">
                        <h3 class="text-lg font-semibold text-slate-800">Suivi médical</h3>
                        <p class="text-sm text-slate-500 mt-2 mb-5 flex-1">
                            Consultez les informations de suivi médical uniquement lorsqu'un accès vous a été accordé.
                        </p>
                    </div>

                    <a href="{{ route('proche.suivis.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition mt-auto w-full max-w-[220px]">
                        Consulter le suivi →
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition h-full flex flex-col justify-between items-center text-center min-h-[240px]">
                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4 shrink-0">
                        <span class="text-2xl">📅</span>
                    </div>

                    <div class="flex flex-col items-center flex-1 w-full">
                        <h3 class="text-lg font-semibold text-slate-800">Rendez-vous</h3>
                        <p class="text-sm text-slate-500 mt-2 mb-5 flex-1">
                            Consultez les rendez-vous du patient lorsque cette information vous est accessible.
                        </p>
                    </div>

                    <a href="{{ route('proche.rendezvous.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition mt-auto w-full max-w-[220px]">
                        Voir les rendez-vous →
                    </a>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>

