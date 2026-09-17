<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            <div class="onco-page-header">

                <div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="onco-back-link"
                    >
                        ← Retour au dashboard
                    </a>

                    <div class="onco-title-wrap">

                        <div
                            class="onco-page-icon"
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            📩
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Demandes de suivi reçues
                            </h1>

                            <p class="onco-page-subtitle">
                                Consultez et traitez les demandes de suivi envoyées par les patients.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            @if(session('success'))

                <div
                    class="onco-alert onco-alert-success"
                    style="margin-top:24px;"
                >
                    <div class="onco-alert-icon">✓</div>
                    <div>
                        <div class="onco-alert-title">Opération réussie</div>
                        <div class="onco-alert-text">{{ session('success') }}</div>
                    </div>
                </div>

            @endif


            @if($errors->any())

                <div
                    class="onco-alert onco-alert-error"
                    style="margin-top:24px;"
                >
                    <div class="onco-alert-icon">!</div>
                    <div>
                        <div class="onco-alert-title">Erreur</div>
                        <div class="onco-alert-text">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endif


            {{-- Résumé --}}
            @php
                $enAttente = $demandes->where('statut', 'en_attente')->count();
                $acceptees = $demandes->where('statut', 'acceptee')->count();
                $refusees = $demandes->where('statut', 'refusee')->count();
            @endphp

            <div
                class="onco-summary-grid"
                style="margin-top:28px;grid-template-columns:repeat(3,minmax(0,1fr));"
            >

                <div class="onco-summary-card">
                    <div>
                        <span class="onco-summary-label" style="color:#655A88;">
                            En attente
                        </span>
                        <div class="onco-summary-value" style="color:#655A88;">
                            {{ $enAttente }}
                        </div>
                    </div>
                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ⏳
                    </div>
                </div>

                <div class="onco-summary-card">
                    <div>
                        <span class="onco-summary-label" style="color:#4B7655;">
                            Acceptées
                        </span>
                        <div class="onco-summary-value" style="color:#4B7655;">
                            {{ $acceptees }}
                        </div>
                    </div>
                    <div
                        class="onco-summary-icon"
                        style="background:#EAF4EC;color:#7FA68A;"
                    >
                        ✓
                    </div>
                </div>

                <div class="onco-summary-card">
                    <div>
                        <span class="onco-summary-label" style="color:#9A5661;">
                            Refusées
                        </span>
                        <div class="onco-summary-value" style="color:#9A5661;">
                            {{ $refusees }}
                        </div>
                    </div>
                    <div
                        class="onco-summary-icon"
                        style="background:#F7E9EB;color:#D99AA6;"
                    >
                        ✗
                    </div>
                </div>

            </div>


            {{-- Liste --}}
            <div
                class="onco-card"
                style="margin-top:28px;padding:0;"
            >

                <div
                    class="onco-card-header"
                    style="padding:22px 24px;margin-bottom:0;"
                >
                    <div>
                        <h2 class="onco-card-title">Demandes reçues</h2>
                        <p class="onco-card-description">
                            Les demandes de suivi envoyées par les patients.
                        </p>
                    </div>
                    <span
                        class="onco-badge"
                        style="background:#F1EFF8;color:#655A88;"
                    >
                        {{ $demandes->count() }} demande(s)
                    </span>
                </div>

                @if($demandes->count())

                    <div class="space-y-0">

                        @foreach($demandes as $demande)

                            <div
                                class="px-6 py-6 {{ !$loop->last ? 'border-b border-[#EEEAE6]' : '' }} transition hover:bg-[#FCFBF8]"
                                style="padding:22px 24px;"
                            >

                                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                    {{-- Patient --}}
                                    <div class="flex items-center gap-4">

                                        <div
                                            class="onco-avatar"
                                            style="width:50px;height:50px;background:#FBF1F3;color:#B97886;font-size:18px;"
                                        >
                                            {{ strtoupper(substr($demande->patient->utilisateur->prenom ?? 'P', 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="text-base font-semibold text-[#293331]">
                                                {{ $demande->patient->utilisateur->prenom }}
                                                {{ $demande->patient->utilisateur->nom }}
                                            </div>
                                            <div class="mt-0.5 text-xs text-[#8B918E]">
                                                Demandé le {{ \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y') }}
                                            </div>
                                        </div>

                                    </div>


                                    {{-- Statut + Actions --}}
                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                                        @if($demande->statut === 'en_attente')

                                            <div class="flex items-center gap-2">

                                                <form
                                                    method="POST"
                                                    action="{{ route('medecin.demandes-suivi.accepter', $demande) }}"
                                                    onsubmit="return confirm('Accepter la demande de suivi de {{ $demande->patient->utilisateur->prenom }} {{ $demande->patient->utilisateur->nom }} ?');"
                                                >
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="onco-btn"
                                                        style="background:#EAF4EC;color:#4B7655;border-color:#D5E5D9;"
                                                    >
                                                        ✓ Accepter
                                                    </button>
                                                </form>

                                                <form
                                                    method="POST"
                                                    action="{{ route('medecin.demandes-suivi.refuser', $demande) }}"
                                                    onsubmit="return confirm('Refuser la demande de suivi de {{ $demande->patient->utilisateur->prenom }} {{ $demande->patient->utilisateur->nom }} ?');"
                                                >
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="onco-btn"
                                                        style="background:#F7E9EB;color:#9A5661;border-color:#EECFD4;"
                                                    >
                                                        ✗ Refuser
                                                    </button>
                                                </form>

                                            </div>

                                        @elseif($demande->statut === 'acceptee')

                                            <span
                                                class="onco-badge"
                                                style="background:#EAF4EC;color:#4B7655;"
                                            >
                                                <span
                                                    style="width:6px;height:6px;border-radius:50%;background:#7FA68A;"
                                                ></span>
                                                Acceptée
                                                @if($demande->date_traitement)
                                                    — {{ \Carbon\Carbon::parse($demande->date_traitement)->format('d/m/Y') }}
                                                @endif
                                            </span>

                                        @elseif($demande->statut === 'refusee')

                                            <span
                                                class="onco-badge"
                                                style="background:#F7E9EB;color:#9A5661;"
                                            >
                                                <span
                                                    style="width:6px;height:6px;border-radius:50%;background:#D99AA6;"
                                                ></span>
                                                Refusée
                                                @if($demande->date_traitement)
                                                    — {{ \Carbon\Carbon::parse($demande->date_traitement)->format('d/m/Y') }}
                                                @endif
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div
                        class="onco-empty-state"
                        style="padding:56px 24px;"
                    >
                        <div
                            class="onco-empty-icon"
                            style="background:#F1EFF8;color:#7567A8;"
                        >
                            📩
                        </div>
                        <h3 class="onco-empty-title">
                            Aucune demande reçue
                        </h3>
                        <p class="onco-empty-text">
                            Vous n'avez pas encore reçu de demande de suivi de la part de patients.
                        </p>
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
