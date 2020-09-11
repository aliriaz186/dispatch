<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DispatchJob;
use App\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customersCount = Customer::all()->count();
        $technicianCount = Technician::all()->count();
        $jobsCount = DispatchJob::all()->count();
        $totalOpenClaimsCount = DispatchJob::where('created_at', '<', Carbon::now()->subDays(2)->toDateTimeString())->where('status', 'offered')->count();
        $totalTodayCompletedClaims = DispatchJob::where('created_at' , Carbon::today())->where('status', 'Completed')->count();
        $month = date('m');
        $totalThisWeekCompletedClaims = DispatchJob::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status', 'Completed')->count();
        $totalThisMonthCompletedClaims = DispatchJob::whereMonth('created_at' , $month)->where('status', 'Completed')->count();
        $year = date('yy');
        $totalThisYearCompletedClaims = DispatchJob::whereYear('created_at' , $year)->where('status', 'Completed')->count();
        $deniedClaimsCount = DispatchJob::where('status', 'denied')->count();
        $closedJobsCount = DispatchJob::where('status' , 'Completed')->count();
        $followUpCount = DispatchJob::where('status' , 'Follow Up')->count();

        return view('dashboard/dashboard')->with(['followUpCount' => $followUpCount,'closedJobsCount' => $closedJobsCount,'deniedClaimsCount' => $deniedClaimsCount,'totalThisWeekCompletedClaims' => $totalThisWeekCompletedClaims,'totalThisYearCompletedClaims' => $totalThisYearCompletedClaims,'totalThisMonthCompletedClaims' => $totalThisMonthCompletedClaims,'totalTodayCompletedClaims' => $totalTodayCompletedClaims,'totalOpenClaimsCount' => $totalOpenClaimsCount,'customersCount' => $customersCount,'technicianCount' => $technicianCount,'jobsCount' => $jobsCount]);
    }
}
