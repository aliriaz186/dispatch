<?php

namespace App\Http\Controllers;

use App\DriverModel;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    //Displaying Drivers List Page With Data
    public function index()
    {
        $data['title'] = 'Drivers | Taxi Grid';
        $data['extra'] = null;
        return view('dashboard/drivers')->with(['data' => $data]);
    }

    //get all drivers
    public function getAll(Request $request)
    {
        $columns = array(
            0 => 'fleet_auto_id',
            1 => 'fleet_driver_name',
            2 => 'fleet_driver_email',
            3 => 'fleet_driver_phone',
            4 => 'fleet_driver_address',
            5 => 'car',
            6 => 'license',
            7 => 'earnings',
            8 => 'status',
            9 => 'options',
        );
        $totalData = DriverModel::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $drivers = DriverModel::offset($start)->limit($limit)->orderBy($order, $dir)->get();
        } else {
            $search = $request->input('search.value');
            $drivers = DriverModel::where('fleet_auto_id', 'LIKE', "%{$search}%")->orWhere('fleet_driver_name', 'LIKE', "%{$search}%")->orWhere('fleet_driver_email', 'LIKE', "%{$search}%")->orWhere('fleet_driver_phone', 'LIKE', "%{$search}%")->orWhere('fleet_driver_address', 'LIKE', "%{$search}%")->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = DriverModel::where('fleet_auto_id', 'LIKE', "%{$search}%")->orWhere('fleet_driver_name', 'LIKE', "%{$search}%")->orWhere('fleet_driver_email', 'LIKE', "%{$search}%")->orWhere('fleet_driver_phone', 'LIKE', "%{$search}%")->orWhere('fleet_driver_address', 'LIKE', "%{$search}%")->count();
        }
        $data = array();
        if (!empty($drivers)) {
            foreach ($drivers as $driver) {
                $data_date = date_create($driver->fleet_driver_license_expire);
                $currentdate = date_create(date("Y/m/d H:i:s"));
                //difference between two dates
                $diff = date_diff($data_date, $currentdate);
                //count days
                $days_diff = $diff->format("%a") . " Days";
                $driver->days_diff = $days_diff;
                $nestedData['fleet_auto_id'] = $driver->fleet_auto_id;
                $nestedData['fleet_driver_name'] = $driver->fleet_driver_name;
                $nestedData['fleet_driver_email'] = $driver->fleet_driver_email;
                $nestedData['fleet_driver_phone'] = $driver->fleet_driver_phone;
                $nestedData['fleet_driver_address'] = $driver->fleet_driver_address;
                $nestedData['car'] = '<div class="kt-user-card-v2">
                                            <div class="kt-user-card-v2__details">
                                                <span class="btn btn-bold btn-label-danger"
                                                      style="text-align: left;padding: 5px 5px 5px 5px;">' . $driver->fleet_plate_no . '</span>
                                            </div>
                                        </div>';
                $nestedData['license'] = '<div class="kt-user-card-v2">
                                            <div class="kt-user-card-v2__details">
                                <span class="btn btn-bold btn-label-success"
                                      style="text-align: left; padding: 5px 5px 5px 5px;">
                                     ' . $driver->fleet_driver_license_no . '<br>
                                    ' . $driver->fleet_driver_license_expire . '
                                    (' . $driver->days_diff . ')
                                  </span>
                                            </div>
                                        </div>';
                $nestedData['earnings'] = 'Today : 0<br>
                                        Week : 0<br>
                                        Total : 0<br>';
                if ($driver->fleet_driver_status == 2) {
                    $nestedData['status'] = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">InActive</span>';
                } else {
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
                                                    <a href="' . env('APP_URL') . '/drivers/manage/' . $driver->fleet_auto_id . '"
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
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    //Displaying Manage Drivers Page With Data
    public function manage(int $driverId)
    {
        $data['title'] = 'Manage Passengers | Taxi Grid';
        $data['extra'] = null;
        $data['fleets'] = $this->get_fleet_types();
        $data['selected_driver'] = DriverModel::where('fleet_auto_id', $driverId)->first();
        return view('dashboard/drivers/manage-fleet')->with(['data' => $data]);
    }

    function get_fleet_types()
    {
        return array(
            '1' => 'Saloon',
            '2' => 'Executive Saloon',
            '3' => 'Estate - Wagon',
            '4' => 'Executive Estate',
            '5' => 'VIP',
            '6' => 'MPV 06 or Pepole Carrier',
            '7' => 'MPV 08 or Minibus',
            '8' => 'Executive MPV'
        );
    }

    //Updating Driver Data
    public function updateDriver(Request $request)
    {
        try {
            if (DriverModel::where('fleet_auto_id', $request->fleet_auto_id)->exists()) {
                $driver = DriverModel::where('fleet_auto_id', $request->fleet_auto_id)->first();
                $driver->fleet_driver_status = $request->fleet_driver_status;
                $driver->fleet_driver_name = $request->fleet_driver_name;
                if ($driver->fleet_driver_email != $request->fleet_driver_email) {
                    if (DriverModel::where('fleet_driver_email', $request->fleet_driver_email)->exists() && DriverModel::where('fleet_driver_email', $request->fleet_driver_email)->first()['fleet_auto_id'] != $request->fleet_auto_id) {
                        return json_encode(['status' => false, 'message' => 'Email Already Exists!']);
                    }
                    $driver->fleet_driver_email = $request->fleet_driver_email;
                } else {
                    $driver->fleet_driver_email = $request->fleet_driver_email;
                }
                if (!empty($request->fleet_driver_password)) {
                    $driver->fleet_driver_password = $request->fleet_driver_password;
                } else {
                    $driver->fleet_driver_password = "12345";
                }
                $driver->fleet_driver_phone = $request->fleet_driver_phone;
                $driver->fleet_driver_gender = $request->fleet_driver_gender;
                $driver->fleet_driver_address = $request->fleet_driver_address;
                $driver->fleet_driver_city = $request->fleet_driver_city;
                $driver->fleet_driver_postal_code = $request->fleet_driver_postal_code;
                $driver->fleet_driver_license_no = $request->fleet_driver_license_no;
                $driver->fleet_driver_license_expire = $request->fleet_driver_license_expire;
                $driver->fleet_type_id = $request->fleet_type_id;
                $driver->fleet_plate_no = $request->fleet_plate_no;
                $driver->fleet_make = $request->fleet_make;
                $driver->fleet_model = $request->fleet_model;
                $driver->fleet_is_baby_seat = $request->fleet_is_baby_seat;
                $driver->fleet_is_wheelchair = $request->fleet_is_wheelchair;
                $driver->fleet_contract_amount = $request->fleet_contract_amount;
                return json_encode(['status' => $driver->update()]);

            } else {
                return json_encode(['status' => false, 'message' => 'Fleet Driver not Existed!']);
            }
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try again.']);
        }

    }

    //Displaying New Driver Page
    public function newDriver()
    {
        $data['fleets'] = $this->get_fleet_types();
        return view('dashboard/drivers/new-driver')->with(['data' => $data]);
    }

    //Saving Driver Data
    public function saveDriver(Request $request)
    {
        try {
            $driver = new DriverModel();
            if (DriverModel::where('fleet_driver_email', $request->fleet_driver_email)->exists()) {
                return ['status' => false, 'message' => 'Email Already Exists'];
            }
            $driver->fleet_company_auto_id = 100001;
            $driver->fleet_driver_status = $request->fleet_driver_status;
            $driver->fleet_driver_name = $request->fleet_driver_name;
            $driver->fleet_driver_email = $request->fleet_driver_email;
            $driver->fleet_driver_code = "Not given";
            if (!empty($request->fleet_driver_password)) {
                $driver->fleet_driver_password = $request->fleet_driver_password;
            } else {
                $driver->fleet_driver_password = "12345";
            }
            $driver->fleet_driver_phone = $request->fleet_driver_phone;
            $driver->fleet_driver_gender = $request->fleet_driver_gender;
            $driver->fleet_driver_address = $request->fleet_driver_address;
            $driver->fleet_driver_city = $request->fleet_driver_city;
            $driver->fleet_driver_postal_code = $request->fleet_driver_postal_code;
            $driver->fleet_driver_license_no = $request->fleet_driver_license_no;
            $driver->fleet_driver_license_expire = $request->fleet_driver_license_expire;
            $driver->fleet_type_id = $request->fleet_type_id;
            $driver->fleet_plate_no = $request->fleet_plate_no;
            $driver->fleet_make = $request->fleet_make;
            $driver->fleet_model = $request->fleet_model;
            $driver->fleet_is_baby_seat = $request->fleet_is_baby_seat;
            $driver->fleet_is_wheelchair = $request->fleet_is_wheelchair;
            $driver->fleet_contract_amount = $request->fleet_contract_amount;
            return json_encode(['status' => $driver->save()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'Server Error! Try again.']);
        }
    }
}
