<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Afficher les notifications de l'utilisateur connecté.
     */
    public function index(): View
    {
        $notifications = auth()->user()
            ->notificationsPersonnelles()
            ->latest('date_notification')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Marquer une notification comme lue.
     */
    public function read(int $id): RedirectResponse
    {
        $notification = auth()->user()
            ->notificationsPersonnelles()
            ->where('id_notification', $id)
            ->firstOrFail();

        $notification->update([
            'lu' => true,
        ]);

        return back();
    }

    /**
     * Marquer toutes les notifications comme lues.
     */
    public function readAll(): RedirectResponse
    {
        auth()->user()
            ->notificationsPersonnelles()
            ->where('lu', false)
            ->update([
                'lu' => true,
            ]);

        return back();
    }
}
// كل user كيشوف غير notifications ديالو