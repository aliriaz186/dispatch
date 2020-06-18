<?php

namespace App\Http\Controllers;

use App\SpecialDateModel;
use Illuminate\Http\Request;

class SpecialDatesController extends Controller
{
    //Appending And Saving New Line For Special Rates
    public function newSpecialRate(Request $request)
    {
        try {
            $locationRate = new SpecialDateModel();
            $locationRate->special_date_type = 1;
            $locationRate->special_date_method = 1;
            $locationRate->special_date_start = 00;
            $locationRate->special_date_end = 00;
            $locationRate->special_date_amount = 0;
            return json_encode(['status' => $locationRate->save()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Saving Special Rates Data
    public function saveSpecialRates(Request $request)
    {
        try {
            $locRates = json_decode($request->data, true);
            foreach ($locRates as $locRate) {
                $oldRate = SpecialDateModel::where('special_date_auto_id', $locRate["special_date_auto_id"])->first();
                $oldRate->special_date_start = $locRate["from_time"];
                $oldRate->special_date_end = $locRate["to_time"];
                $oldRate->special_date_amount = $locRate["rates"];
                $oldRate->special_date_type = $locRate["date_type"];
                $oldRate->special_date_method = $locRate["date_method"];
                $oldRate->update();
            }
            return json_encode(['status' => true]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Deleting Special Rates Data
    public function deleteSpecialRates(Request $request)
    {
        try {
            if (SpecialDateModel::where('special_date_auto_id', $request->special_date_auto_id)->exists()) {
                $result = SpecialDateModel::where('special_date_auto_id', $request->special_date_auto_id)->delete();
                return json_encode(['status' => $result]);
            } else {
                return json_encode(['status' => false, 'message' => 'Rate Not Existed']);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }
}
