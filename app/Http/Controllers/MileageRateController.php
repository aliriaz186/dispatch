<?php

namespace App\Http\Controllers;

use App\MileageRateModel;
use Illuminate\Http\Request;

class MileageRateController extends Controller
{
    //Appending And Saving New Line For Mileage Rates
    public function newMileageRate()
    {
        try {
            if (count(MileageRateModel::all()) > 0) {
                $locationRate = new MileageRateModel();
                $locationRateLatest = MileageRateModel::where([['rate_auto_id', '>', 0]])->orderBy('rate_auto_id', 'DESC')->first();
                $locationRate->from = $locationRateLatest->destination;
                $locationRate->destination = $locationRate->from + ($locationRateLatest->destination - $locationRateLatest->from);
                $locationRate->rate = $locationRateLatest->rate;
                $locationRate->taxi_company_auto_id = 100001;
                return json_encode(['status' => $locationRate->save()]);
            } else {
                $locationRate = new MileageRateModel();
                $locationRate->from = 0;
                $locationRate->destination = 0;
                $locationRate->rate = 0;
                $locationRate->taxi_company_auto_id = 100001;
                return json_encode(['status' => $locationRate->save()]);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Saving Mileage Rates Data
    public function saveMileageRates(Request $request)
    {
        try {
            $locRates = json_decode($request->data, true);
            foreach ($locRates as $locRate) {
                $oldRate = MileageRateModel::where('rate_auto_id', $locRate["rate_auto_id"])->first();
                $oldRate->from = $locRate["from"];
                $oldRate->destination = $locRate["destination"];
                $oldRate->rate = $locRate["rate"];
                $oldRate->update();
            }
            return json_encode(['status' => true]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }

    //Deleting Mileage Rates Data
    public function deleteMileageRates(Request $request)
    {
        try {
            if (MileageRateModel::where('rate_auto_id', $request->rate_auto_id)->exists()) {
                $result = MileageRateModel::where('rate_auto_id', $request->rate_auto_id)->delete();
                return json_encode(['status' => $result]);
            } else {
                return json_encode(['status' => false, 'message' => 'Rate Not Existed']);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try Again', 'error' => $exception->getMessage()]);
        }
    }
}
