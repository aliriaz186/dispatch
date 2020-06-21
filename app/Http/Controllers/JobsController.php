<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Job;
use App\Technician;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function getView(){
        return view('dashboard.jobs');
    }

    public function newJobView(){
        return view('dashboard.new-job');
    }

    public function saveJob(Request $request){
        try {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->save();
            $job = new Job();
            $job->job_address = $request->address;
            $job->lat = $request->lat;
            $job->long = $request->longg;
            $job->id_technician = $request->technician_id;
            $job->id_customer = $customer->id;
            $job->title = $request->title;
            $job->description = $request->description;
            $job->service_type = $request->service_type;
            $job->customer_availability_one = $request->customer_availability_one;
            $job->customer_availability_two = $request->customer_availability_two;
            $job->customer_availability_three = $request->customer_availability_three;
            $job->notes = $request->notes;
            $job->status = "offered";
            return json_encode(['status' => $job->save()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function getAll(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'status',
            2=> 'customer',
            3=> 'technician',
            4=> 'title',
            5=> 'address',
        );
        $totalData = Job::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if(empty($request->input('search.value')))
        {
            $jobs = Job::offset($start)->limit($limit)->get();
        }
        else {
            $search = $request->input('search.value');
            $jobs =  Job::where('id','LIKE',"%{$search}%")->orWhere('status', 'LIKE',"%{$search}%")->orWhere('title', 'LIKE',"%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = Job::where('id','LIKE',"%{$search}%")->orWhere('status', 'LIKE',"%{$search}%")->orWhere('title', 'LIKE',"%{$search}%")->count();
        }
        $data = array();
        if(!empty($jobs))
        {
            foreach ($jobs as $job)
            {
                $nestedData['id'] = $job->id;
                $nestedData['status'] = $job->status;
                $nestedData['customer'] = Customer::where('id', $job->id_customer)->first()['name'];
                $nestedData['technician'] =  Technician::where('id', $job->id_technician)->first()['name'];
                $nestedData['title'] =  $job->title;
                $nestedData['address'] =  $job->job_address;
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
