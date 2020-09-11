<?php

namespace App\Http\Controllers;

use App\Cap;
use App\CustomerCapAmount;
use Illuminate\Http\Request;

class CapController extends Controller
{
    public function getView(){
        return view('dashboard.cap');
    }

    public function newCapView(){
        return view('dashboard.new-cap');
    }

    public function manage(int $id)
    {
        $cap = Cap::where('id', $id)->first();
        return view('dashboard.edit-cap')->with(['cap' => $cap]);
    }

    public function deleteCap(int $id)
    {
        try {
            Cap::where('id', $id)->delete();
            return view('dashboard.cap')->with('status', true);
        } catch (\Exception $exception) {
            return view('dashboard.cap')->with('status', $exception->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $cap = Cap::where('id', $request->id)->first();
            $cap->name = $request->name;
            $cap->total_amount = $request->totalAmount;
            return json_encode(['status' =>  $cap->update()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function getAllCap(Request $request){
        $columns = array(
            1 =>'name',
            2 => 'total_amount',
            3 => 'options',
        );
        $totalData = \App\Cap::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if(empty($request->input('search.value')))
        {
            $providers = \App\Cap::offset($start)->limit($limit)->get();
        }
        else {
            $search = $request->input('search.value');
            $providers =  \App\Cap::where('id','LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone', 'LIKE',"%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = \App\Cap::where('id','LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->orWhere('email', 'LIKE',"%{$search}%")->orWhere('phone', 'LIKE',"%{$search}%")->count();
        }
        $data = array();
        if(!empty($providers))
        {
            foreach ($providers as $provider)
            {
                $appUrl = env('APP_URL');
                $nestedData['name'] = $provider->name;
                $nestedData['total_amount'] = '$'.$provider->total_amount;
                $nestedData['address'] =  $provider->address;
                $nestedData['options'] = '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a href="' . env('APP_URL') . '/caps/manage/' . $provider->id . '"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                        <span class="kt-nav__link-text">Manage</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="'.env('APP_URL').'/caps/delete/'.$provider->id.'"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon fas fa-trash"></i>
                                                        <span class="kt-nav__link-text">Delete</span>
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

    public function saveCap(Request $request){
        try {
            $cap = new Cap();
            $cap->name = $request->name;
            $cap->total_amount = $request->totalAmount;
            $result = $cap->save();
            return json_encode(['status' => $result]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function getAllCaps(Request $request)
    {
        $columns = array(
//            0 => 'id',
            1 => 'name',
            2 => 'total_amount',
            3 => 'amount_added',
            4 => 'options',
        );
        $totalData = Cap::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if (empty($request->input('search.value'))) {
            $customers = Cap::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $customers = Cap::where('id', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->orWhere('phone', 'LIKE', "%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = Cap::where('id', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->orWhere('phone', 'LIKE', "%{$search}%")->count();
        }
        $data = array();
        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $appUrl = env('APP_URL');
//                $nestedData['id'] = "<a href='$appUrl/customer/$customer->id/details' style='color: #5d78ff'>$customer->id</a>";
                $nestedData['name'] = "$customer->name";
                $nestedData['total_amount'] = $customer->total_amount;
                if(CustomerCapAmount::where(['customer_id' => $customer->id,'cap_id' => $customer->id,])->exists())
                $nestedData['amount_added'] = $customer->phone;
                $nestedData['options'] = '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a href="' . env('APP_URL') . '/customers/manage/' . $customer->id . '"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon fas fa-sort-amount-up"></i>
                                                        <span class="kt-nav__link-text">Add Amount</span>
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

    function addCapAmount(Request $request)
    {
        if (CustomerCapAmount::where(['customer_id' => $request->customerId, 'cap_id' => $request->capId])->exists()) {
            $amount = CustomerCapAmount::where(['customer_id' => $request->customerId, 'cap_id' => $request->capId])->first()['amount_added'];
            $customerCap = CustomerCapAmount::where(['customer_id' => $request->customerId, 'cap_id' => $request->capId])->first();
            $customerCap->amount_added = (int)$amount + (int)$request->amount;
            $customerCap->update();
        } else {
            $customerCapAmount = new CustomerCapAmount();
            $customerCapAmount->customer_id = $request->customerId;
            $customerCapAmount->cap_id = $request->capId;
            $customerCapAmount->amount_added = $request->amount;
            $customerCapAmount->save();
        }
        return redirect('customer/'.$request->customerId.'/details');
    }
}
