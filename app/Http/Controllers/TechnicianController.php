<?php

namespace App\Http\Controllers;

use App\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{

    public function getTechnicians(){
        return json_encode(Technician::all());
    }

    public function getView(){
        return view('dashboard.technician');
    }

    public function newTechnicianView(){
        return view('dashboard.new-technician');
    }

    public function saveTechnician(Request $request){
        try {
            $technician= new Technician();
            if (Technician::where('email', $request->email)->exists()) {
                return ['status' => false, 'message' => 'Email Already Exists'];
            }
            $technician->phone = $request->phone;
            $technician->name = $request->name;
            $technician->email = $request->email;
            $technician->address = $request->address;
            $technician->website = $request->website;
            $technician->longg = $request->longg;
            $technician->lat = $request->lat;
            if (!empty($request->password)) {
                $technician->password = $request->password;
            } else {
                $technician->password = "12345";
            }
            return json_encode(['status' => $technician->save()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function updateTechnician(Request $request){
        try {
            $technician= Technician::where('id', $request->id)->first();
            if ($technician->email != $request->email) {
                if (Technician::where('email', $request->email)->exists() && Technician::where('email', $request->email)->first()['id'] != $request->id) {
                    return json_encode(['status' => false, 'message' => 'Email Already Exists!']);
                }
                $technician->email = $request->email;
            } else {
                $technician->email = $request->email;
            }
            $technician->phone = $request->phone;
            $technician->name = $request->name;
            $technician->email = $request->email;
            $technician->address = $request->address;
            $technician->website = $request->website;
            $technician->longg = $request->longg;
            $technician->lat = $request->lat;
            if (!empty($request->password)) {
                $technician->password = $request->password;
            }
            return json_encode(['status' => $technician->update()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function manageTechnician(int $id){
        $technician = Technician::where('id', $id)->first();
        return view('dashboard.edit-technician')->with(['technician' => $technician]);
    }

    public function getAll(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'name',
            2=> 'email',
            3=> 'phone',
            4=> 'address',
            5=> 'website',
            6=> 'options',
        );
        $totalData = Technician::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if(empty($request->input('search.value')))
        {
            $providers = Technician::offset($start)->limit($limit)->get();
        }
        else {
            $search = $request->input('search.value');
            $providers =  Technician::where('id','LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone', 'LIKE',"%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = Technician::where('id','LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone', 'LIKE',"%{$search}%")->count();
        }
        $data = array();
        if(!empty($providers))
        {
            foreach ($providers as $provider)
            {
                $nestedData['id'] = $provider->id;
                $nestedData['name'] = $provider->name;
                $nestedData['email'] = $provider->email;
                $nestedData['phone'] = $provider->phone;
                $nestedData['address'] =  $provider->address;
                $nestedData['website'] =  $provider->website;
                $nestedData['options'] = '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a href="'.env('APP_URL').'/technicians/manage/'.$provider->id.'"
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
}
