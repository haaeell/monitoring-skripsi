<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['status' => 'success']);
    }

public function markAsRead($notification_id)
{
    $user = Auth::user();
    $notification = $user->unreadNotifications->where('id', $notification_id)->first();
    if ($notification) {
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read.']);
    }
    return response()->json(['error' => 'Notification not found.'], 404);
}
}
