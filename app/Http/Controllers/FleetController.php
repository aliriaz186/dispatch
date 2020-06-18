<?php

namespace App\Http\Controllers;

use App\DriverModel;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    //Displaying Fleet Page
    public function index()
    {
        $data['title'] = 'Cars | Taxi Grid';
        $data['extra'] = null;
        $data['fleet_info'] = $this->get_fleet_info();
        foreach ($data['fleet_info'] as $key => $fleet) {
            $data['fleet_info'][$key]["img"] = "media/cars/car_" . ($key + 1) . ".png";
            $data['fleet_info'][$key]["driver_count"] = DriverModel::where('fleet_type_id', ($key + 1))->count();
            $data['fleet_info'][$key]["drivers"] = DriverModel::where('fleet_type_id', ($key + 1))->get();
        }
        $data['car_lists'] = [];
        return view('dashboard/fleets')->with(['data' => $data]);
    }

    function get_fleet_info()
    {
        return array(
            '0' => array(
                'fleet_name' => 'Saloon',
                'fleet_passenger' => '4',
                'fleet_luggage' => '2',
                'fleet_cabin' => '1'
            ),
            '1' => array(
                'fleet_name' => 'Executive Saloon',
                'fleet_passenger' => '4',
                'fleet_luggage' => '2',
                'fleet_cabin' => '1'
            ),
            '2' => array(
                'fleet_name' => 'Estate - Wagon',
                'fleet_passenger' => '4',
                'fleet_luggage' => '3',
                'fleet_cabin' => '1'
            ),
            '3' => array(
                'fleet_name' => 'Executive Estate',
                'fleet_passenger' => '4',
                'fleet_luggage' => '3',
                'fleet_cabin' => '1'
            ),
            '4' => array(
                'fleet_name' => 'VIP',
                'fleet_passenger' => '4',
                'fleet_luggage' => '2',
                'fleet_cabin' => '2'
            ),
            '5' => array(
                'fleet_name' => 'MPV 06 or Pepole Carrier',
                'fleet_passenger' => '6',
                'fleet_luggage' => '4',
                'fleet_cabin' => '2'
            ),
            '6' => array(
                'fleet_name' => 'MPV 08 or Minibus',
                'fleet_passenger' => '8',
                'fleet_luggage' => '6',
                'fleet_cabin' => '2'
            ),
            '7' => array(
                'fleet_name' => 'Executive MPV',
                'fleet_passenger' => '7',
                'fleet_luggage' => '7',
                'fleet_cabin' => '0'
            ),
        );
    }
}
