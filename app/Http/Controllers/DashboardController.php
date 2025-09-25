<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\ActivityLog; // kalau kamu punya tabel log
use App\Models\Employee;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index() {
    $totalRooms = Room::count();
    $totalCustomers = Customer::count();
    $totalMaintenances = Maintenance::count();
    $totalEmployees = Employee::count();
    $totalMonthlyReservations = Reservation::whereMonth('check_in', Carbon::now()->month)->count();
    $totalMonthlyMaintenances = Maintenance::whereMonth('created_at', Carbon::now()->month)->count();

    $thisMonthBusinessReservations = Reservation::whereMonth('check_in', Carbon::now()->month)->count();
    $lastMonthBusinessReservations = Reservation::whereMonth('check_in', Carbon::now()->subMonth()->month)->count();

    return view('dashboard', compact(
        'totalRooms','totalCustomers','totalMaintenances','totalEmployees',
        'totalMonthlyReservations','totalMonthlyMaintenances',
        'thisMonthBusinessReservations','lastMonthBusinessReservations'
    ));
}
}