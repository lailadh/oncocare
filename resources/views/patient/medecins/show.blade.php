<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            <div class="onco-page-header">

                <a
                    href="{{ route('patient.medecins.index') }}"
                    class="onco-back-link"
                >
                    ← Retour à la recherche
                </a>

                <div class="onco-title-wrap">

                    <div
                        class="onco-page-icon"
                        style="background:#FBF1F3;color:#D99AA6;"
                    >
                        👨‍⚕️
                    </div>

                    <div>

                        <h1 class="onco-page-title">
                            Profil du médecin
                        </h1>

                        <p class="onco-page-subtitle">
                            Consultez les informations du médecin et envoyez une demande de suivi.
                        </p>

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


            {{-- Profil --}}
            <div
                class="onco-card"
                style="margin-top:28px;"
            >

                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

                    <div class="onco-user-cell">

                        <div
                            class="onco-avatar"
                            style="width:72px;height:72px;background:#FBF1F3;color:#B97886;font-size:24px;"
                        >
                            {{ strtoupper(substr($medecin->utilisateur->prenom ?? 'M', 0, 1)) }}
                        </div>

                        <div>

                            <div
                                class="text-2xl font-medium text-[#293331]"
                                style="font-family:'Newsreader',serif;"
                            >
                                Dr {{ $medecin->utilisateur->prenom }}
                                {{ $medecin->utilisateur->nom }}
                            </div>

                            <div class="mt-1 text-sm text-[#66706D]">
                                Médecin OncoCare
                            </div>

                            <div class="mt-3">
                                @if($estAssocie)
                                    <span
                                        class="onco-badge"
                                        style="background:#EAF4EC;color:#4B7655;font-size:12px;"
                                    >
                                        ✓ Vous êtes suivi par ce médecin
                                    </span>
                                @elseif($demandeEnAttente)
                                    <span
                                        class="onco-badge"
                                        style="background:#F8F1E1;color:#8A6B32;font-size:12px;"
                                    >
                                        ⏳ Demande en attente
                                    </span>
                                @else
                                    <span
                                        class="onco-badge"
                                        style="background:#EEF5EF;color:#4D7257;font-size:12px;"
                                    >
                                        Disponible
                                    </span>
                                @endif
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Infos --}}
                <div class="mt-7 grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div
                        class="rounded-2xl p-4"
                        style="background:#FAF9F8;"
                    >
                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Email
                        </p>
                        <p class="mt-2 text-sm font-medium text-[#293331]">
                            {{ $medecin->utilisateur->email }}
                        </p>
                    </div>

                    <div
                        class="rounded-2xl p-4"
                        style="background:#FAF9F8;"
                    >
                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#8B918E]">
                            Spécialité
                        </p>
                        <p class="mt-2 text-sm font-medium text-[#293331]">
                            {{ $medecin->specialite ?? 'Non renseignée' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Action --}}
            @if(!$estAssocie && !$demandeEnAttente)

                <div
                    class="onco-card"
                    style="margin-top:20px;"
                >
                    <form
                        method="POST"
                        action="{{ route('patient.demandes-suivi.store') }}"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="id_medecin"
                            value="{{ $medecin->id_medecin }}"
                        >

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h3 class="text-lg font-semibold text-[#293331]">
                                    Envoyer une demande de suivi
                                </h3>
                                <p class="mt-1 text-sm text-[#66706D]">
                                    Le médecin devra accepter votre demande avant le début du suivi.
                                </p>
                            </div>

                            <button
                                type="submit"
                                class="onco-btn onco-btn-patient"
                                onclick="return confirm('Envoyer cette demande de suivi à Dr {{ $medecin->utilisateur->prenom }} {{ $medecin->utilisateur->nom }} ?');"
                            >
                                📩 Envoyer la demande
                            </button>

                        </div>
                    </form>
                </div>

            @elseif($demandeEnAttente)

                <div
                    class="onco-card"
                    style="margin-top:20px;border-color:#EEE4CE;background:#FBF8EF;"
                >
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl"
                            style="background:#F8F1E1;color:#C49A5A;"
                        >
                            ⏳
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#293331]">
                                Demande en attente
                            </h3>
                            <p class="mt-1 text-sm text-[#66706D]">
                                Vous avez déjà une demande de suivi en attente avec ce médecin.
                                Vous recevrez une notification lorsque le médecin aura répondu.
                            </p>
                        </div>
                    </div>
                </div>

            @endif


            <div
                class="onco-info-card"
                style="margin-top:24px;border-color:#EED7DC;background:#FFF9FA;"
            >
                <div
                    class="onco-info-icon"
                    style="background:#FBF1F3;color:#D99AA6;"
                >
                    🔒
                </div>
                <div>
                    <h3 class="onco-info-title" style="color:#9A6470;">
                        Confidentialité
                    </h3>
                    <p class="onco-info-text" style="color:#8B6D74;">
                        Les informations de votre demande sont privées et sécurisées.
                        Seul le médecin concerné peut consulter et traiter votre demande.
                    </p>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
