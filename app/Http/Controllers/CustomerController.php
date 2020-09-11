<?php

namespace App\Http\Controllers;

use App\Cap;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getView()
    {
        return view('dashboard.customers');
    }

    public function getAll(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'options',
        );
        $totalData = Customer::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if (empty($request->input('search.value'))) {
            $customers = Customer::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $customers = Customer::where('id', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->orWhere('phone', 'LIKE', "%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = Customer::where('id', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->orWhere('phone', 'LIKE', "%{$search}%")->count();
        }
        $data = array();
        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $appUrl = env('APP_URL');
                $nestedData['id'] = "<a href='$appUrl/customer/$customer->id/details' style='color: #5d78ff'>$customer->id</a>";
                $nestedData['name'] = "<a href='$appUrl/customer/$customer->id/details' style='color: #5d78ff'>$customer->name</a>";;
                $nestedData['email'] = $customer->email;
                $nestedData['phone'] = $customer->phone;
                $nestedData['options'] = '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a href="' . env('APP_URL') . '/customers/manage/' . $customer->id . '"
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

    public function manage(int $id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('dashboard.edit-customer')->with(['customer' => $customer]);
    }

    public function update(Request $request)
    {
        try {
            $customer = Customer::where('id', $request->id)->first();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            return json_encode(['status' =>  $customer->update()]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    function getCustomerDetails($customerId)
    {
        $cap = Cap::all();
        return view('dashboard.customer-details')->with(['cap' => $cap,'customerId' => $customerId]);
    }
}
