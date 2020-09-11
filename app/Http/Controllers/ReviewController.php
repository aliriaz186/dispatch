<?php

namespace App\Http\Controllers;

use App\JobRating;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getView(){
        $jobRating = JobRating::all();
        return view('dashboard.reviews')->with(['reviews' => $jobRating]);
    }
}
