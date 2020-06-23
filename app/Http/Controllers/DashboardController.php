<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DispatchJob;
use App\Technician;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customersCount = Customer::all()->count();
        $technicianCount = Technician::all()->count();
        $jobsCount = DispatchJob::all()->count();
        return view('dashboard/dashboard')->with(['customersCount' => $customersCount,'technicianCount' => $technicianCount,'jobsCount' => $jobsCount]);
    }
}
