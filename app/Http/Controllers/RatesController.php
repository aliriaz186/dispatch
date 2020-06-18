<?php

namespace App\Http\Controllers;

use App\CustomDateRateModel;
use App\LocationRatesModel;
use App\MileageRateModel;
use App\SpecialDateModel;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    //Displaying Mileage Rates Page List With Data
    public function mileage()
    {
        $data['title'] = 'Mileage Rates | Taxi Grid';
        $data['extra'] = null;
        $data['mileage_rates'] = MileageRateModel::all();
        return view('dashboard/rates/mileage-rate')->with(['data' => $data]);
    }

    //Displaying Location Rates Page List With Data
    public function location()
    {
        $data['title'] = 'Location Rates | Taxi Grid';
        $data['extra'] = null;
        $data['location_rates'] = LocationRatesModel::all();
        return view('dashboard/rates/location-rates')->with(['data' => $data]);
    }

    //Displaying Special Rates Page List With Data
    public function specialdate()
    {
        $data["date_types"] = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        $data['title'] = 'Special Date Rates | Taxi Grid';
        $data['extra'] = null;
        $data['special_date_rates'] = SpecialDateModel::where([['special_date_type', '>', 0]])->get();
        return view('dashboard/rates/special-date-rates')->with(['data' => $data]);
    }

    //Displaying Custom Rates Page List With Data
    public function customdate()
    {
        $data['custom_date_rates'] = CustomDateRateModel::where([['special_date_type', '=', 0]])->get();
        $data['title'] = 'Special Date Rates | Taxi Grid';
        $data['extra'] = null;
        return view('dashboard/rates/custom-date-rates')->with(['data' => $data]);
    }

    //Appending And Saving New Line For Location Rates
    public function newLocationRate()
    {
        try {
            if (count(LocationRatesModel::all()) > 0) {
                $locationRate = new LocationRatesModel();
                $locationRateLatest = LocationRatesModel::where([['location_auto_id', '>', 0]])->orderBy('location_auto_id', 'DESC')->first();
                $locationRate->from_text = $locationRateLatest->destination_text;
                $locationRate->destination_text = $locationRate->from_text + ($locationRateLatest->destination_text - $locationRateLatest->from_text);
                $miles = $locationRate->destination_text - $locationRate->from_text;
                if ($miles < 0) {
                    $miles = 0;
                }
                $locationRate->miles = $miles;
                $locationRate->rate = $locationRateLatest->rate;
                $locationRate->taxi_company_auto_id = 100001;
                return json_encode(['status' => $locationRate->save()]);
            } else {
                $locationRate = new LocationRatesModel();
                $locationRate->from_text = 0;
                $locationRate->destination_text = 0;
                $locationRate->miles = 0;
                $locationRate->rate = 0;
                $locationRate->taxi_company_auto_id = 100001;
                return json_encode(['status' => $locationRate->save()]);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Saving Location Rates Data
    public function saveLocationRates(Request $request)
    {
        try {
            $locRates = json_decode($request->data, true);
            foreach ($locRates as $locRate) {
                $oldRate = LocationRatesModel::where('location_auto_id', $locRate["location_auto_id"])->first();
                $oldRate->from_text = $locRate["from_text"];
                $oldRate->destination_text = $locRate["destination_text"];
                $oldRate->miles = $locRate["miles"];
                $oldRate->rate = $locRate["rate"];
                $oldRate->update();
            }
            return json_encode(['status' => true]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Deleting Location Rates Data
    public function deleteLocationRates(Request $request)
    {
        try {
            if (LocationRatesModel::where('location_auto_id', $request->location_auto_id)->exists()) {
                $result = LocationRatesModel::where('location_auto_id', $request->location_auto_id)->delete();
                return json_encode(['status' => $result]);
            } else {
                return json_encode(['status' => false, 'message' => 'Rate Not Existed']);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }
}
