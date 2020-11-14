<?php

namespace App\Http\Controllers;

use App\Cap;
use App\DispatchJob;
use App\JobRating;
use App\Jobs\TechnicianInvitationJob;
use App\Technician;
use App\TechnicianFiles;
use App\TechnicianWorkType;
use App\TechnicianZipCode;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use services\email_messages\InvitationMessageBody;
use services\email_services\EmailAddress;
use services\email_services\EmailBody;
use services\email_services\EmailMessage;
use services\email_services\EmailSender;
use services\email_services\EmailSubject;
use services\email_services\MailConf;
use services\email_services\PhpMail;
use services\email_services\SendEmailService;

class TechnicianController extends Controller
{

    public function getTechnicians(){
        return json_encode(Technician::all());
    }

    public function getView(){
        return view('dashboard.technician');
    }

    public function getTechnicianDetails(int $id){
        $technician = Technician::where('id', $id)->first();
        $zipCode = TechnicianZipCode::where('technician_id', $id)->get();
        $workType = TechnicianWorkType::where('technician_id', $id)->get();
        $technicianFiles = TechnicianFiles::where('technician_id', $id)->get();
        $openJobsCount = DispatchJob::where(['id_technician' => $id, 'status' => 'offered'])->count();
        $ratings = JobRating::where('technicianId', $id)->get();
        return view('dashboard.technician-details')->with(['ratings' => $ratings,'openJobsCount' => $openJobsCount,'technicianFiles' => $technicianFiles,'technician' => $technician,'zipCode' => $zipCode,'workType' => $workType]);
    }

    public function newTechnicianView(){
        return view('dashboard.new-technician');
    }

    public function addNewJob(int $id){
        $technician = Technician::where('id', $id)->first();
        $technicianList = Technician::all();
        $cap = Cap::all();
        return view('dashboard.technician-new-job')->with(['technicianList' => $technicianList, 'caps' => $cap,'technician' => $technician]);
    }

    public function saveTechnician(Request $request){
        try {

            $technician= new Technician();
            if (Technician::where('email', $request->email)->exists()) {
                return ['status' => false, 'message' => 'Email Already Exists'];
            }
            $technician->phone = $request->phone;
            $technician->company_name = $request->companyName;
            $technician->name = $request->name;
            $technician->email = $request->email;
            $technician->address = $request->address;
            $technician->city = $request->city;
            $technician->state = $request->state;
            $technician->website = $request->website;
            $technician->longg = $request->longg;
            $technician->lat = $request->lat;
            if (!empty($request->password)) {
                $technician->password = md5($request->password);
            } else {
                $technician->password = md5('12345');
            }
            $result = $technician->save();
            if(!empty($request->zipCodeArray))
            {
                $arrayZipCode = explode(',', $request->zipCodeArray);
                for ($i = 0; $i < count($arrayZipCode); $i++) {
                    $technicianZipCode = new TechnicianZipCode();
                    $technicianZipCode->technician_id = $technician->id;
                    $technicianZipCode->zip_code = $arrayZipCode[$i];
                    $technicianZipCode->save();
                }
            }
            $arrayWorkType = explode(',', $request->checkBoxesArray);
            for ($i = 0; $i < count($arrayWorkType); $i++) {
                $technicianWorkType = new TechnicianWorkType();
                $technicianWorkType->technician_id = $technician->id;
                $technicianWorkType->type = $arrayWorkType[$i];
                $technicianWorkType->save();
            }

            TechnicianInvitationJob::dispatch(new EmailAddress($technician->email), $technician->password);
            $subject = new SendEmailService(new EmailSubject("You have been invited you to join ".env('APP_NAME')."'s Team of service Technician"));
            $mailTo = new EmailAddress($technician->email);
            if (!empty($request->password)) {
                $this->password = $request->password;
            } else {
                $this->password = '12345';
            }
            $invitationMessage = new InvitationMessageBody();
            $emailBody = $invitationMessage->invitationMessageBody($this->password, $technician->email);
            $body = new EmailBody($emailBody);
            $emailMessage = new EmailMessage($subject->getEmailSubject(), $mailTo, $body);
            $sendEmail = new EmailSender(new PhpMail(new MailConf("smtp.gmail.com", "admin@dispatch.com", "secret-2020")));
            $result = $sendEmail->send($emailMessage);
            $this->sendMessage($request->phone, "You are invited to use ".env('APP_NAME') ."\nPlease Login to start your business\n" . "Your Password is  : .$this->password.\n" . env('TECHNICIAN_URL'));
            return json_encode(['status' => $result, 'technician_id' => $technician->id]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function saveFiles(Request $request)
    {
        if ($request->hasfile('offer_images')) {
            $images = "";
            $files = $request->file('offer_images');
            foreach ($files as $key => $file) {
                $key = $key + 1;
                $name = time() . "-{$key}." . $file->getClientOriginalExtension();
                $file->move(public_path() . '/technician-files/', $name);
                $technicianFiles = new TechnicianFiles();
                $technicianFiles->technician_id = $request->technicianId;
                $technicianFiles->file = $name;
                $technicianFiles->save();
            }
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
            $technician->company_name = $request->companyName;
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

    public function sendMessage($recipients, $message){
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new \Twilio\Rest\Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }

    public function manageTechnician(int $id){
        $technician = Technician::where('id', $id)->first();
        return view('dashboard.edit-technician')->with(['technician' => $technician]);
    }

    public function deleteTechnician(int $id)
    {
        try {
            Technician::where('id', $id)->delete();
            TechnicianFiles::where('technician_id', $id)->delete();
            TechnicianWorkType::where('technician_id', $id)->delete();
            TechnicianZipCode::where('technician_id', $id)->delete();
            return view('dashboard.technician')->with('status', true);
        } catch (\Exception $exception) {
            return view('dashboard.technician')->with('status', $exception->getMessage());
        }
    }

    public function getAll(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'company_name',
            2 =>'name',
            3=> 'email',
            4=> 'phone',
            5=> 'address',
            6=> 'website',
            7=> 'options',
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
                $appUrl = env('APP_URL');
                $nestedData['id'] = "<a href='$appUrl/technicians/$provider->id/details' style='color: #5d78ff'>$provider->id</a>";
                $nestedData['company_name'] =  "<a href='$appUrl/technicians/$provider->id/details' style='color: #5d78ff'>$provider->company_name</a>";
                $nestedData['name'] =  "<a href='$appUrl/technicians/$provider->id/details' style='color: #5d78ff'>$provider->name</a>";
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
                                                <li class="kt-nav__item">
                                                    <a href="'.env('APP_URL').'/technicians/delete/'.$provider->id.'"
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

    public function changeTechnician(Request $request)
    {
        $technician = DispatchJob::where('id', $request->job_id)->first();
        $technician->id_technician = $request->technician_id;
        return json_encode(['status' => $technician->update()]);
    }

    public function getProviderAgainstZipCode(Request $request){
        $allProviders = Technician::all();
        $providers = [];
        foreach ($allProviders as $provider){
           $provider['work_types'] = TechnicianWorkType::where('technician_id', $provider->id)->get();
           $provider['zip_codes'] = TechnicianZipCode::where('technician_id', $provider->id)->get();
           $flag = false;
           foreach ($provider['zip_codes'] as $zip_code){
               if ($zip_code->zip_code == $request->zipCode){
                   $flag = true;
               }
           }
           if ($flag){
               array_push($providers, $provider);
           }
        }
        return json_encode($providers);
    }
}
