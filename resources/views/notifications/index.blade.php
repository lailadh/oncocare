<x-app-layout>

    @php
        $user = auth()->user();

        $roleLabel = match ($user->role) {
            'patient' => 'Patient',
            'medecin' => 'Médecin',
            'proche' => 'Proche',
            'admin' => 'Administrateur',
            default => 'Utilisateur',
        };

        $unreadCount = $notifications->where('lu', false)->count();

        $pageIconClass = match ($user->role) {
            'medecin' => 'role-medecin',
            'proche' => 'role-proche',
            'admin' => 'role-admin',
            default => 'role-patient',
        };
    @endphp


    <div class="onco-page">

        <div class="onco-container">

            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="onco-page-header">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <a
                            href="{{ route('dashboard') }}"
                            class="onco-back-link"
                        >
                            ← Retour au dashboard
                        </a>

                        <div class="onco-title-wrap">

                            <div class="onco-page-icon {{ $pageIconClass }}">
                                ◉
                            </div>

                            <div>

                                <h1 class="onco-page-title">
                                    Notifications
                                </h1>

                                <p class="onco-page-subtitle">
                                    Consultez les informations importantes liées à votre espace OncoCare.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Tout marquer comme lu --}}
                    @if($unreadCount > 0)

                        <form
                            method="POST"
                            action="{{ route('notifications.readAll') }}"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="onco-btn"
                                style="
                                    background:#16423C;
                                    color:#FFFFFF;
                                    border-color:#16423C;
                                "
                            >
                                <span>✓</span>
                                <span>Tout marquer comme lu</span>
                            </button>

                        </form>

                    @endif

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SUMMARY --}}
            {{-- ========================================================= --}}

            <div
                class="onco-summary-grid"
                style="
                    margin-top:28px;
                    grid-template-columns:repeat(2,minmax(0,1fr));
                "
            >

                {{-- Total --}}
                <div class="onco-summary-card">

                    <div>

                        <span class="onco-summary-label">
                            Total
                        </span>

                        <div class="onco-summary-value">
                            {{ $notifications->count() }}
                        </div>

                        <p class="mt-1 text-xs text-slate-500">
                            notifications reçues
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="
                            background:#EEF5F0;
                            color:#5F8069;
                        "
                    >
                        ◉
                    </div>

                </div>


                {{-- Non lues --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#5F8069;"
                        >
                            Non lues
                        </span>

                        <div class="onco-summary-value">
                            {{ $unreadCount }}
                        </div>

                        <p class="mt-1 text-xs text-slate-500">
                            notifications à consulter
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="
                            background:#E5F0E8;
                            color:#5F8069;
                        "
                    >
                        !
                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- NOTIFICATION CENTER --}}
            {{-- ========================================================= --}}

            <div
                class="onco-card"
                style="
                    margin-top:28px;
                    padding:0;
                "
            >

                <div
                    class="onco-card-header"
                    style="
                        padding:22px 24px;
                        margin-bottom:0;
                    "
                >

                    <div>

                        <h2 class="onco-card-title">
                            Centre de notifications
                        </h2>

                        <p class="onco-card-description">
                            Les informations importantes concernant votre espace {{ $roleLabel }}.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="
                            background:#EEF5F0;
                            color:#5F8069;
                        "
                    >
                        {{ $notifications->count() }}
                        notification{{ $notifications->count() > 1 ? 's' : '' }}
                    </span>

                </div>


                {{-- ===================================================== --}}
                {{-- EMPTY --}}
                {{-- ===================================================== --}}

                @if($notifications->isEmpty())

                    <div
                        class="onco-empty-state"
                        style="padding:60px 24px;"
                    >

                        <div
                            class="onco-empty-icon"
                            style="
                                background:#EEF5F0;
                                color:#7FA68A;
                            "
                        >
                            ◉
                        </div>

                        <h2 class="onco-empty-title">
                            Aucune notification
                        </h2>

                        <p class="onco-empty-text">
                            Vous n'avez aucune notification pour le moment.
                            Les nouvelles informations importantes apparaîtront ici.
                        </p>

                    </div>

                @else

                    {{-- ================================================= --}}
                    {{-- LISTE --}}
                    {{-- ================================================= --}}

                    <div>

                        @foreach($notifications as $notification)

                            @php
                                $iconBackground = '#F1F6F2';
                                $iconColor = '#5F8069';
                                $notificationIcon = '◉';

                                switch ($notification->type) {

                                    case 'rendezvous':
                                        $iconBackground = '#F8F1E1';
                                        $iconColor = '#B28B45';
                                        $notificationIcon = '◷';
                                        break;

                                    case 'suivi':
                                        $iconBackground = '#EEF5F0';
                                        $iconColor = '#7FA68A';
                                        $notificationIcon = '♡';
                                        break;

                                    case 'autorisation':
                                        $iconBackground = '#F8EDF1';
                                        $iconColor = '#B9788C';
                                        $notificationIcon = '◎';
                                        break;

                                    case 'medecin_demande':
                                        $iconBackground = '#EEEAF8';
                                        $iconColor = '#6C63A8';
                                        $notificationIcon = '✚';
                                        break;

                                    case 'medecin_statut':
                                        $iconBackground = '#EEEAF8';
                                        $iconColor = '#6C63A8';
                                        $notificationIcon = '✓';
                                        break;
                                }
                            @endphp


                            <div
                                class="onco-notification {{ !$notification->lu ? 'unread' : '' }}"
                                style="
                                    padding:20px 24px;
                                    background:{{ !$notification->lu ? '#F5F9F6' : '#FFFFFF' }};
                                    border-bottom:1px solid #E5ECE7;
                                "
                            >

                                {{-- Icon --}}
                                <div
                                    class="onco-notification-icon"
                                    style="
                                        background:{{ $iconBackground }};
                                        color:{{ $iconColor }};
                                    "
                                >
                                    {{ $notificationIcon }}
                                </div>


                                {{-- Content --}}
                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3
                                            class="onco-notification-title"
                                            style="color:#293331;"
                                        >
                                            {{ $notification->titre }}
                                        </h3>

                                        @if(!$notification->lu)

                                            <span
                                                class="onco-badge"
                                                style="
                                                    background:#E5F0E8;
                                                    color:#5F8069;
                                                    font-size:10px;
                                                "
                                            >
                                                Nouveau
                                            </span>

                                        @else

                                            <span
                                                class="onco-badge"
                                                style="
                                                    background:#F1F3F2;
                                                    color:#7A817E;
                                                    font-size:10px;
                                                "
                                            >
                                                Lue
                                            </span>

                                        @endif

                                    </div>


                                    <p
                                        class="onco-notification-text"
                                        style="color:#66706D;"
                                    >
                                        {{ $notification->message }}
                                    </p>


                                    <div
                                        class="flex flex-wrap items-center gap-3 mt-2"
                                    >

                                        <p
                                            class="onco-notification-time"
                                            style="color:#929490;"
                                        >
                                            {{ $notification->date_notification?->format('d/m/Y à H:i') }}
                                        </p>

                                        @if(!$notification->lu)

                                            <span
                                                class="text-xs font-medium"
                                                style="color:#7FA68A;"
                                            >
                                                • Non lue
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- Marquer comme lue --}}
                                @if(!$notification->lu)

                                    <form
                                        method="POST"
                                        action="{{ route('notifications.read', $notification->id_notification) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="onco-btn onco-btn-secondary"
                                            style="
                                                min-height:36px;
                                                padding:8px 12px;
                                                font-size:11px;
                                                white-space:nowrap;
                                                color:#5F8069;
                                                border-color:#C9DCCF;
                                                background:#F5F9F6;
                                            "
                                        >
                                            Marquer comme lue
                                        </button>

                                    </form>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- ========================================================= --}}
            {{-- PRIVACY --}}
            {{-- ========================================================= --}}

            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#C9DCCF;
                    background:#F5F9F6;
                "
            >

                <div
                    class="onco-info-icon"
                    style="
                        background:#E5F0E8;
                        color:#7FA68A;
                    "
                >
                    🔒
                </div>

                <div>

                    <h3
                        class="onco-info-title"
                        style="color:#5F8069;"
                    >
                        Notifications personnelles
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#6D7F73;"
                    >
                        Ces notifications sont personnelles et vous sont
                        destinées selon votre rôle et les événements liés
                        à votre espace OncoCare.
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>