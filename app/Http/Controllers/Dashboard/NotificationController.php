<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $notificationsQuery = Notification::query();
        $notificationsQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $notificationsQuery;

        if ($request->filled('from')) {
            $notificationsQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $notificationsQuery->whereDate('created_at', '<', $request->to);
        }

        $notifications = $notificationsQuery->paginate(10);

        // Get counts without date range filtering
        $totalNotificationsCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalNotificationsCount ? ceil(($totalThisMonth / $totalNotificationsCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveNotificationsCount = $notificationsQuery->count();
        $totalActiveThisMonth = $notificationsQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveNotificationsCount ? ceil(($totalActiveThisMonth / $totalActiveNotificationsCount) * 100) : 0;

        $totalNotActiveNotificationsCount = $totalNotificationsCount - $totalActiveNotificationsCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveNotificationsCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveNotificationsCount) * 100) : 0;

        return view('dashboard.pages.notifications.index', compact('notifications', 'totalNotificationsCount', 'thisMonthPercentage', 'totalActiveNotificationsCount', 'thisActiveMonthPercentage', 'totalNotActiveNotificationsCount', 'thisNotActiveMonthPercentage'));
    }



    public function store(Request $request)
    {
        $notification = Notification::where('id', $request->id)->firstOrFail();

        if ($notification->read_at) {
            $notification->update(['read_at' => null]);
        } else {
            $notification->update(['read_at' => now()]);
        }


        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('notifications.index')->with('message', $message);
    }
}
