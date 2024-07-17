<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\College;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $todaySalePercent = ceil(Order::whereDate('created_at', today())->sum('total') / max(Order::sum('total'), 1) * 100);
        $totalOrders = number_format(Order::sum('total'), 2);
        $totalBooks = Book::count();
        $totalUniversities = University::count();
        $totalColleges = College::count();
        $totalUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();
        $totalEmployees = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'client');
        })->count();
        $mostSaledBooks = Book::getMostSoldBooks()->active()->limit(5)->get();

        $mostUserOrdered = User::withCount('orders')->orderBy('orders_count', 'desc')->limit(5)->get();

        // Get the top 5 cities with the highest total order sums
        $mostCitiesOrdered = Order::select('city_id', DB::raw('SUM(total) as total_orders'))
            ->groupBy('city_id')
            ->orderByDesc('total_orders')
            ->limit(5)
            ->get();

        // Initialize arrays to store city names and total order sums
        $cityNames = [];
        $totalCitySales = [];

        // Fetch city names and total order sums for each city
        foreach ($mostCitiesOrdered as $city) {
            $cityNames[] = City::where('id', $city->city_id)->first()->name;
            $totalCitySales[] = $city->total_orders;
        }

        $bookWithLessStock = Book::orderBy('qty')->paginate(10);

        $data = [
            'todaySalePercent' => $todaySalePercent,
            'totalOrders' => $totalOrders,
            'totalBooks' => $totalBooks,
            'totalUniversities' => $totalUniversities,
            'totalUsers' => $totalUsers,
            'totalEmployees' => $totalEmployees,
            'totalColleges' => $totalColleges,
            'mostSaledBooks' => $mostSaledBooks,
            'mostUserOrdered' => $mostUserOrdered,
            'mostCitiesOrdered' => $mostCitiesOrdered,
            'cityNames' => $cityNames,
            'totalCitySales' => $totalCitySales,
            'bookWithLessStock' => $bookWithLessStock

        ];

        return view('dashboard.index', $data);
    }
}
