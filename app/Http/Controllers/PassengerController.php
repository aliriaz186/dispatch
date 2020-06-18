<?php

namespace App\Http\Controllers;

use App\PassengerModel;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    //Viewing Passengers List Page
    public function index()
    {
        $data['title'] = 'Passengers | Taxi Grid';
        $data['extra'] = null;
        return view('dashboard/passengers')->with(['data' => $data]);
    }

    //get passengers all data
    public function getAll(Request $request){
        $columns = array(
            0 =>'passenger_system_id',
            1 =>'passenger_name',
            2=> 'passenger_email',
            3=> 'passenger_phone',
            4=> 'card_detail',
            5=> 'status',
            6=> 'rides',
            7=> 'options',
        );
        $totalData = PassengerModel::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if(empty($request->input('search.value')))
        {
            $passengers = PassengerModel::offset($start)->limit($limit)->get();
        }
        else {
            $search = $request->input('search.value');
            $passengers =  PassengerModel::where('passenger_auto_id','LIKE',"%{$search}%")->orWhere('passenger_name', 'LIKE',"%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = PassengerModel::where('passenger_auto_id','LIKE',"%{$search}%")->orWhere('passenger_name', 'LIKE',"%{$search}%")->count();
        }
        $data = array();
        if(!empty($passengers))
        {
            foreach ($passengers as $passenger)
            {
                $nestedData['passenger_system_id'] = $passenger->passenger_system_id;
                $nestedData['passenger_name'] = $passenger->passenger_name;
                $nestedData['passenger_email'] = $passenger->passenger_email;
                $nestedData['passenger_phone'] = $passenger->passenger_phone;
                $nestedData['card_detail'] =   '<span style="display: block;white-space: nowrap;width: 12em;overflow: hidden;text-overflow: ellipsis;">Name: '.$passenger->passenger_cc_name_on_card.'</span>
                                        <span style="display: block;white-space: nowrap;width: 12em;overflow: hidden;text-overflow: ellipsis;">Card No: '.$passenger->passenger_cc_card_number.'</span>';
                if($passenger->status == 2){
                    $nestedData['status'] = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">InActive</span>';
                }else{
                    $nestedData['status'] = ' <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">Active</span>';
                }
                $nestedData['rides'] = '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">999</span>';
                $nestedData['options'] = '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                        <span class="kt-nav__link-text">Reports</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="'.env('APP_URL').'/passengers/manage/'.$passenger->passenger_auto_id.'"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                        <span class="kt-nav__link-text">Manage</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    //Viewing Manage Passenger Page With Data
    public function manage(int $passengerId)
    {
        $data['title'] = 'Manage Passengers | Taxi Grid';
        $data['extra'] = null;
        $data['countries'] = null;
        $data['selected_passenger'] = PassengerModel::where('passenger_auto_id', $passengerId)->first();
        return view('dashboard/passengers/manage-passenger')->with(['data' => $data]);
    }

    //Viewing New Passenger Page
    public function newPassenger()
    {
        return view('dashboard/passengers/new-passenger');
    }

    //Saving Passenger Data
    public function savePassenger(Request $request)
    {
        try {
            $passenger = new PassengerModel();
            if (PassengerModel::where('passenger_email', $request->passenger_email)->exists()) {
                return ['status' => false, 'message' => 'Email Already Exists'];
            }
            $passenger->passenger_phone = $request->passenger_phone;
            $passenger->passenger_name = $request->passenger_name;
            $passenger->passenger_email = $request->passenger_email;
            if (!empty($request->passenger_password)) {
                $passenger->passenger_password = $request->passenger_password;
            } else {
                $passenger->passenger_password = "12345";
            }
            $passengerSystemId = PassengerModel::where([['passenger_auto_id', '>', 0]])->orderBy('passenger_auto_id', 'DESC')->first()['passenger_system_id'];
            $passengerSystemIdNumber = explode("S", $passengerSystemId);
            $passenger->passenger_system_id = 'ATCUS' . ($passengerSystemIdNumber[1] + 1);
            $passenger->passenger_type = 1;
            $passenger->passenger_cc_name_on_card = $request->passenger_cc_name_on_card;
            $passenger->passenger_cc_card_number = $request->passenger_cc_card_number;
            $passenger->passenger_cc_card_expire = $request->passenger_cc_card_expire;
            $passenger->passenger_cc_country = $request->passenger_cc_country;
            $passenger->passenger_cc_address = $request->passenger_cc_address;
            $passenger->passenger_cc_city = $request->passenger_cc_city;
            $passenger->passenger_cc_postcode = $request->passenger_cc_postcode;
            return json_encode(['status' => $passenger->save()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    //Updating Passenger Data
    public function updatePassenger(Request $request)
    {
        try {
            if (PassengerModel::where('passenger_auto_id', $request->passenger_auto_id)->exists()) {
                $passenger = PassengerModel::where('passenger_auto_id', $request->passenger_auto_id)->first();
                $passenger->passenger_name = $request->passenger_name;
                if ($passenger->passenger_email != $request->passenger_email) {
                    if (PassengerModel::where('passenger_email', $request->passenger_email)->exists() && PassengerModel::where('passenger_email', $request->passenger_email)->first()['passenger_auto_id'] != $request->passenger_auto_id) {
                        return json_encode(['status' => false, 'message' => 'Email Already Exists!']);
                    }
                    $passenger->passenger_email = $request->passenger_email;
                } else {
                    $passenger->passenger_email = $request->passenger_email;
                }
                if (!empty($request->passenger_password)) {
                    $passenger->passenger_password = $request->passenger_password;
                } else {
                    $passenger->passenger_password = "12345";
                }
                $passenger->passenger_phone = $request->passenger_phone;
                $passenger->passenger_cc_name_on_card = $request->passenger_cc_name_on_card;
                $passenger->passenger_cc_card_number = $request->passenger_cc_card_number;
                $passenger->passenger_cc_card_expire = $request->passenger_cc_card_expire;
                $passenger->passenger_cc_country = $request->passenger_cc_country;
                $passenger->passenger_cc_address = $request->passenger_cc_address;
                $passenger->passenger_cc_city = $request->passenger_cc_city;
                $passenger->passenger_cc_postcode = $request->passenger_cc_postcode;
                return json_encode(['status' => $passenger->update()]);

            } else {
                return json_encode(['status' => false, 'message' => 'Passenger not Existed!']);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try again.']);
        }
    }

}
