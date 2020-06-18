<?php

namespace App\Http\Controllers;

use App\CustomDateRateModel;
use Illuminate\Http\Request;

class CustomDateRateController extends Controller
{
    //Appending And Saving New Line For Custom Date Rates
    public function newCustomDateRate(Request $request)
    {
        try {
            $locationRate = new CustomDateRateModel();
            $locationRate->special_date_type = 0;
            $locationRate->special_date_method = 1;
            $locationRate->special_date_start = 00;
            $locationRate->special_date_end = 00;
            $locationRate->special_date_amount = 0;
            return json_encode(['status' => $locationRate->save()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Saving Custom Date Rates Data
    public function saveCustomDateRates(Request $request)
    {
        try {
            $locRates = json_decode($request->data, true);
            foreach ($locRates as $locRate) {
                $oldRate = CustomDateRateModel::where('special_date_auto_id', $locRate["custom_date_auto_id"])->first();
                $oldRate->special_date_start = $locRate["from_time"];
                $oldRate->special_date_end = $locRate["to_time"];
                $oldRate->special_date_amount = $locRate["rates"];
                $oldRate->special_date_method = $locRate["date_method"];
                $oldRate->update();
            }
            return json_encode(['status' => true]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Deleting Custom Date Rates Data
    public function deleteCustomDateRates(Request $request)
    {
        try {
            if (CustomDateRateModel::where('special_date_auto_id', $request->custom_date_auto_id)->exists()) {
                $result = CustomDateRateModel::where('special_date_auto_id', $request->custom_date_auto_id)->delete();
                return json_encode(['status' => $result]);
            } else {
                return json_encode(['status' => false, 'message' => 'Rate Not Existed']);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }
}
