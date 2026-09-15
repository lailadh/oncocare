<x-app-layout>

    <div class="onco-page">
        <div class="onco-container">

            {{-- Header --}}
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

                            <div class="onco-page-icon role-proche">
                                ◉
                            </div>

                            <div>

                                <h1 class="onco-page-title">
                                    Mes notifications
                                </h1>

                                <p class="onco-page-subtitle">
                                    Retrouvez ici les notifications liées à votre activité
                                    et aux patients que vous accompagnez.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Tout marquer comme lu --}}
                    @if($notifications->where('lu', false)->count() > 0)

                        <form
                            method="POST"
                            action="{{ route('notifications.readAll') }}"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="onco-btn onco-btn-proche"
                            >
                                <span>✓</span>
                                <span>Tout marquer comme lu</span>
                            </button>

                        </form>

                    @endif

                </div>

            </div>


            {{-- Résumé --}}
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
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        ◉
                    </div>

                </div>


                {{-- Nouvelles --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#5F8069;"
                        >
                            Nouvelles
                        </span>

                        <div class="onco-summary-value">
                            {{ $notifications->where('lu', false)->count() }}
                        </div>

                        <p class="mt-1 text-xs text-slate-500">
                            notifications non lues
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#EEF5F0;color:#7FA68A;"
                    >
                        !
                    </div>

                </div>

            </div>


            {{-- Centre de notifications --}}
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
                            Les informations importantes concernant votre activité.
                        </p>

                    </div>

                    <span
                        class="onco-badge"
                        style="
                            background:#EEF5F0;
                            color:#5F8069;
                        "
                    >
                        {{ $notifications->count() }} notification(s)
                    </span>

                </div>


                @if($notifications->isEmpty())

                    {{-- Empty state --}}
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
                            Les nouvelles informations apparaîtront ici.
                        </p>

                    </div>

                @else

                    <div>

                        @foreach($notifications as $notification)

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
                                        @if($notification->type === 'rendezvous')
                                            background:#F8F1E1;
                                            color:#B28B45;
                                        @elseif($notification->type === 'suivi')
                                            background:#EEF5F0;
                                            color:#7FA68A;
                                        @elseif($notification->type === 'autorisation')
                                            background:#EEF5F0;
                                            color:#648A70;
                                        @else
                                            background:#F1F6F2;
                                            color:#5F8069;
                                        @endif
                                    "
                                >

                                    @if($notification->type === 'rendezvous')

                                        ◷

                                    @elseif($notification->type === 'suivi')

                                        ♡

                                    @elseif($notification->type === 'autorisation')

                                        ◎

                                    @else

                                        ◉

                                    @endif

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

                                        @endif

                                    </div>


                                    <p
                                        class="onco-notification-text"
                                        style="color:#66706D;"
                                    >
                                        {{ $notification->message }}
                                    </p>


                                    <p
                                        class="onco-notification-time"
                                        style="color:#929490;"
                                    >
                                        {{ $notification->date_notification?->format('d/m/Y à H:i') }}
                                    </p>

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


            {{-- Confidentialité --}}
            <div
                class="onco-info-card role-proche"
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
                        Les notifications affichées vous sont destinées et
                        concernent uniquement votre activité et les informations
                        auxquelles vous êtes autorisé à accéder.
                    </p>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
