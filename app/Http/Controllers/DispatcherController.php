<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispatcherController extends Controller
{
    //Displaying Dispatcher Page
    public function index()
    {
        $data['title']              = 'Dispatcher | Taxi Grid';
        $data['extra']              = null;
        $data['lug_pass_counts']    = $this->get_counts();
        return view('dashboard/dispatcher')->with(['data' => $data]);
    }

    function get_counts()
    {
        return array(
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10'
        );
    }
}
