<x-app-layout>

    <div class="onco-page">

        <div class="onco-container">

            {{-- ====================================================== --}}
            {{-- HEADER --}}
            {{-- ====================================================== --}}

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

                            <div
                                class="onco-page-icon"
                                style="background:#F1EFF8;color:#7567A8;"
                            >
                                ◉
                            </div>

                            <div>

                                <h1 class="onco-page-title">
                                    Mes notifications
                                </h1>

                                <p class="onco-page-subtitle">
                                    Retrouvez ici les notifications liées à votre activité sur OncoCare.
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
                                class="onco-btn onco-btn-medecin"
                            >
                                <span>✓</span>
                                <span>Tout marquer comme lu</span>
                            </button>

                        </form>

                    @endif

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- SUMMARY --}}
            {{-- ====================================================== --}}

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

                        <span
                            class="onco-summary-label"
                            style="color:#655A88;"
                        >
                            Total
                        </span>

                        <div class="onco-summary-value">
                            {{ $notifications->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            notifications reçues
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F1EFF8;color:#7567A8;"
                    >
                        ◉
                    </div>

                </div>


                {{-- Non lues --}}
                <div class="onco-summary-card">

                    <div>

                        <span
                            class="onco-summary-label"
                            style="color:#8A6B32;"
                        >
                            Nouvelles
                        </span>

                        <div class="onco-summary-value">
                            {{ $notifications->where('lu', false)->count() }}
                        </div>

                        <p class="mt-1 text-xs text-[#756D84]">
                            notifications non lues
                        </p>

                    </div>

                    <div
                        class="onco-summary-icon"
                        style="background:#F8F1E1;color:#C7A45B;"
                    >
                        !
                    </div>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- NOTIFICATIONS --}}
            {{-- ====================================================== --}}

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
                        style="background:#F1EFF8;color:#655A88;"
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
                            style="background:#F1EFF8;color:#7567A8;"
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
                                    background:{{ !$notification->lu ? '#FAF7FB' : '#FFFFFF' }};
                                    border-bottom:1px solid #EEEAE6;
                                "
                            >

                                {{-- Icon --}}
                                <div
                                    class="onco-notification-icon"
                                    style="
                                        @if($notification->type === 'rendezvous')
                                            background:#F8F1E1;
                                            color:#C7A45B;
                                        @elseif($notification->type === 'suivi')
                                            background:#F1EFF8;
                                            color:#7567A8;
                                        @elseif($notification->type === 'autorisation')
                                            background:#EEF5F0;
                                            color:#7FA68A;
                                        @else
                                            background:#F4EFF5;
                                            color:#6B4C6F;
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
                                                    background:#F1EFF8;
                                                    color:#655A88;
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


                                {{-- Mark as read --}}
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
                                                color:#655A88;
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


            {{-- ====================================================== --}}
            {{-- PRIVACY --}}
            {{-- ====================================================== --}}

            <div
                class="onco-info-card"
                style="
                    margin-top:24px;
                    border-color:#DED9EB;
                    background:#F8F6FB;
                "
            >

                <div
                    class="onco-info-icon"
                    style="background:#F1EFF8;color:#7567A8;"
                >
                    🔒
                </div>

                <div>

                    <h3
                        class="onco-info-title"
                        style="color:#655A88;"
                    >
                        Notifications personnelles
                    </h3>

                    <p
                        class="onco-info-text"
                        style="color:#756D84;"
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