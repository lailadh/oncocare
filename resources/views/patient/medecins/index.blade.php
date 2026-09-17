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
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            🔍
                        </div>

                        <div>

                            <h1 class="onco-page-title">
                                Rechercher un médecin
                            </h1>

                            <p class="onco-page-subtitle">
                                Trouvez un médecin actif et envoyez une demande de suivi.
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


            {{-- Recherche --}}
            <div
                class="onco-card"
                style="margin-top:28px;"
            >
                <form
                    method="GET"
                    action="{{ route('patient.medecins.index') }}"
                >
                    <div class="onco-search">
                        <span class="onco-search-icon">🔍</span>
                        <input
                            type="text"
                            name="q"
                            value="{{ $search }}"
                            placeholder="Rechercher par nom, prénom ou spécialité..."
                            class="onco-input"
                        >
                    </div>
                </form>
            </div>


            {{-- Liste des médecins --}}
            <div
                class="onco-card"
                style="margin-top:20px;padding:0;"
            >

                <div
                    class="onco-card-header"
                    style="padding:22px 24px;margin-bottom:0;"
                >
                    <div>
                        <h2 class="onco-card-title">Médecins disponibles</h2>
                        <p class="onco-card-description">
                            Sélectionnez un médecin pour lui envoyer une demande de suivi.
                        </p>
                    </div>
                    <span
                        class="onco-badge"
                        style="background:#FBF1F3;color:#9A6470;"
                    >
                        {{ $medecins->count() }} médecin(s)
                    </span>
                </div>

                @if($medecins->count())

                    <div class="onco-table-wrapper" style="border:0;border-radius:0;box-shadow:none;">

                        <table class="onco-table">

                            <thead>
                                <tr>
                                    <th>Médecin</th>
                                    <th>Spécialité</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($medecins as $medecin)

                                    @php
                                        $estAssocie = in_array($medecin->id_medecin, $associesIds);
                                    @endphp

                                    <tr>
                                        <td>
                                            <div class="onco-user-cell">
                                                <div
                                                    class="onco-avatar"
                                                    style="background:#FBF1F3;color:#B97886;"
                                                >
                                                    {{ strtoupper(substr($medecin->utilisateur->prenom ?? 'M', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="onco-user-name">
                                                        Dr {{ $medecin->utilisateur->prenom }} {{ $medecin->utilisateur->nom }}
                                                    </div>
                                                    <div class="onco-user-meta">
                                                        {{ $medecin->utilisateur->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="onco-table-primary">
                                                {{ $medecin->specialite ?? 'Non renseignée' }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($estAssocie)
                                                <span
                                                    class="onco-badge"
                                                    style="background:#EAF4EC;color:#4B7655;"
                                                >
                                                    <span
                                                        style="width:6px;height:6px;border-radius:50%;background:#7FA68A;"
                                                    ></span>
                                                    Déjà suivi
                                                </span>
                                            @else
                                                <span
                                                    class="onco-badge"
                                                    style="background:#EEF5EF;color:#4D7257;"
                                                >
                                                    <span
                                                        style="width:6px;height:6px;border-radius:50%;background:#7FA68A;"
                                                    ></span>
                                                    Disponible
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <a
                                                href="{{ route('patient.medecins.show', $medecin) }}"
                                                class="onco-btn onco-btn-patient"
                                            >
                                                Voir le profil
                                                <span>→</span>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div
                        class="onco-empty-state"
                        style="padding:56px 24px;"
                    >
                        <div
                            class="onco-empty-icon"
                            style="background:#FBF1F3;color:#D99AA6;"
                        >
                            🔍
                        </div>
                        <h3 class="onco-empty-title">
                            Aucun médecin trouvé
                        </h3>
                        <p class="onco-empty-text">
                            @if($search)
                                Aucun médecin ne correspond à votre recherche « {{ $search }} ».
                            @else
                                Aucun médecin actif n'est actuellement disponible.
                            @endif
                        </p>
                    </div>

                @endif

            </div>


            <div
                class="onco-info-card"
                style="margin-top:24px;border-color:#EED7DC;background:#FFF9FA;"
            >
                <div
                    class="onco-info-icon"
                    style="background:#FBF1F3;color:#D99AA6;"
                >
                    ℹ️
                </div>
                <div>
                    <h3 class="onco-info-title" style="color:#9A6470;">
                        Comment ça fonctionne ?
                    </h3>
                    <p class="onco-info-text" style="color:#8B6D74;">
                        Sélectionnez un médecin pour lui envoyer une demande de suivi.
                        Le médecin devra accepter votre demande avant que vous puissiez
                        échanger avec lui.
                    </p>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
