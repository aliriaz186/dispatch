<?php

namespace App\Http\Controllers;

use App\Cap;
use App\ClaimFollowUp;
use App\Customer;
use App\DispatchJob;
use App\JobCompletionStatus;
use App\JobImages;
use App\JobInvoices;
use App\JobRating;
use App\Jobs\CustomerJobCreatedEmail;
use App\ScheduledJob;
use App\Technician;
use App\TechnicianWorkType;
use App\TechnicianZipCode;
use App\Worker;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use services\email_messages\JobAssignedToTechnicianMessage;
use services\email_messages\JobCreationMessage;
use services\email_services\EmailAddress;
use services\email_services\EmailBody;
use services\email_services\EmailMessage;
use services\email_services\EmailSender;
use services\email_services\EmailSubject;
use services\email_services\MailConf;
use services\email_services\PhpMail;
use services\email_services\SendEmailService;

class JobsController extends Controller
{
    public function getView(){
        return view('dashboard.jobs');
    }

    public function newJobView(){
        $technicianList = Technician::all();
        $cap = Cap::all();
        return view('dashboard.new-job')->with(['caps' => $cap,'technicianList' => $technicianList]);
    }

    public function saveJob(Request $request){
        try {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->save();
            $job = new DispatchJob();
            $job->job_address = $request->address;
            $job->city = $request->city;
            $job->estate = $request->estate;
            $job->zip_code = $request->zipCode;
            $job->policy_no = $request->policyNo;
            $job->item_type = $request->itemType;
            $job->item_location = $request->itemLocation;
            $job->issue_details = $request->issueDetails;
            $job->model_no = $request->modelNo;
            $job->serial_no = $request->serialNo;
            $job->prior_issue = $request->radioButtonPrior;

            if (empty($request->lat) || empty($request->longg)){
                try {
                    $address = $request->address;
                    $latlong = $this->get_lat_long($address);
                    $map = explode(',', $latlong);
                    $address = str_replace(" ", "+", $address);
                    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=usa&key=AIzaSyC141fW_XoCD_dJHMaTygnLX1kDLeTWcwo");
                    $json = json_decode($json);
                    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                    $job->lat = $lat;
                    $job->long = $long;
                }catch (\Exception $exception){
                    $job->lat = 25.9420377;
                    $job->long = -80.2456045;
                }

            }else{
                $job->lat = $request->lat;
                $job->long = $request->longg;
            }
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
            $result = $job->save();
//            CustomerJobCreatedEmail::dispatch(new EmailAddress($customer->email), $job->id);
            $subject = new SendEmailService(new EmailSubject("Hi, Your claim has been Created by ".env('APP_NAME')));
            $this->jobId = JWT::encode(['jobId' => $job->id], 'dispatchEncodeSecret-2020');
            $mailTo = new EmailAddress($customer->email);
            $invitationMessage = new JobCreationMessage();
            $emailBody = $invitationMessage->creationMessage($this->jobId);
            $body = new EmailBody($emailBody);
            $emailMessage = new EmailMessage($subject->getEmailSubject(), $mailTo, $body);
            $sendEmail = new EmailSender(new PhpMail(new MailConf("smtp.gmail.com", "admin@dispatch.com", "secret-2020")));
            $result = $sendEmail->send($emailMessage);

            if (!empty($request->technician_id)){
                $subject = new SendEmailService(new EmailSubject("Hi, Claim has been offered to you by ".env('APP_NAME')));
                $this->jobId = JWT::encode(['jobId' => $job->id], 'dispatchEncodeSecret-2020');
                $techEmail = Technician::where('id', $request->technician_id)->first()['email'];
                $mailTo = new EmailAddress($techEmail);
                $invitationMessage = new JobAssignedToTechnicianMessage();
                $emailBody = $invitationMessage->creationMessage();
                $body = new EmailBody($emailBody);
                $emailMessage = new EmailMessage($subject->getEmailSubject(), $mailTo, $body);
                $sendEmail = new EmailSender(new PhpMail(new MailConf("smtp.gmail.com", "admin@dispatch.com", "secret-2020")));
                $result = $sendEmail->send($emailMessage);
            }


            $this->sendMessage($request->phone, "Your claim has been created in ".env('APP_NAME') ."\nYou can track it by following this link.\n" . env('TECHNICIAN_URL'). "/job/".$this->jobId."/track");
            return json_encode(['status' => $result,'job_id' => $job->id]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function saveImages(Request $request)
    {
        if ($request->hasfile('offer_images')) {
            $images = "";
            $files = $request->file('offer_images');
            foreach ($files as $key => $file) {
                $key = $key + 1;
                $name = time() . "-{$key}." . $file->getClientOriginalExtension();
                $file->move(public_path() . '/job-files/', $name);
                $jobImages = new JobImages();
                $jobImages->job_id = $request->jobId;
                $jobImages->image = $name;
                $jobImages->save();
            }
        }
    }

    public function sendMessage($recipients, $message){
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new \Twilio\Rest\Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
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
        $totalData = DispatchJob::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        if(empty($request->input('search.value')))
        {
            $jobs = DispatchJob::offset($start)->limit($limit)->get();
        }
        else {
            $search = $request->input('search.value');
            $jobs =  DispatchJob::where('id','LIKE',"%{$search}%")->orWhere('status', 'LIKE',"%{$search}%")->orWhere('title', 'LIKE',"%{$search}%")->offset($start)->limit($limit)->get();
            $totalFiltered = DispatchJob::where('id','LIKE',"%{$search}%")->orWhere('status', 'LIKE',"%{$search}%")->orWhere('title', 'LIKE',"%{$search}%")->count();
        }
        $data = array();
        if(!empty($jobs))
        {
            foreach ($jobs as $job)
            {
                $customer = Customer::where('id', $job->id_customer)->first();
                $technician = Technician::where('id', $job->id_technician)->first();
                $appUrl = env('APP_URL');
                $nestedData['id'] = "<a href='$appUrl/jobs/$job->id/details' style='color: #5d78ff'>$job->id</a>";
                $nestedData['status'] = $job->status;
                $createdAt = explode(' ',$job->created_at)[0];
                $nestedData['created_at'] = $createdAt;
                $nestedData['customer'] = "<a href='$appUrl/jobs/$job->id/details' style='color: #5d78ff'>$customer->name ($customer->phone)</a>";
                if(!empty($technician->name))
                {
                    $nestedData['technician'] =  "<a href='$appUrl/jobs/$job->id/details' style='color: #5d78ff'>$technician->name ($technician->phone)</a>";
                }else{
                    $nestedData['technician'] =  "Not Assigned";
                }
                $nestedData['title'] =  $job->title;
                $nestedData['address'] =  $job->job_address;
                $data[] = $nestedData;
            }
        }

        $jsonData = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($jsonData);
    }

    public function getJobDetails(int $jobId){
        $job = DispatchJob::where('id', $jobId)->first();
        $customer = Customer::where('id', $job->id_customer)->first();
        $technician = Technician::where('id', $job->id_technician)->first();
        $jobImages = JobImages::where('job_id', $jobId)->get();
        $followUp = ClaimFollowUp::where('job_id', $jobId)->first();
        $jobCompletionStatus = JobCompletionStatus::where('job_id', $jobId)->first();
        $ratings = JobRating::where('jobId', $jobId)->get();
        $workerId = ScheduledJob::where('id_job', $jobId)->first()['id_worker'];
        $scheduledJob = Worker::where('id', $workerId)->first();
        $schedule = ScheduledJob::where('id_job', $jobId)->first();

        //get provider near to address
        $allProviders = Technician::all();
        $providers = [];
        foreach ($allProviders as $provider){
            $provider['work_types'] = TechnicianWorkType::where('technician_id', $provider->id)->get();
            $provider['zip_codes'] = TechnicianZipCode::where('technician_id', $provider->id)->get();
            $flag = false;
            foreach ($provider['zip_codes'] as $zip_code){
                if ($zip_code->zip_code == $job->zip_code){
                    $flag = true;
                }
            }
            if ($flag){
                array_push($providers, $provider);
            }
        }

        return view('dashboard.job-details')->with(['selectedProviders' => $providers,'schedule' => $schedule,'scheduledJob' => $scheduledJob, 'ratings' => $ratings, 'jobCompletionStatus' => $jobCompletionStatus, 'followUp' => $followUp, 'jobImages' => $jobImages, 'job' => $job, 'customer' => $customer, 'technician' => $technician]);
    }

    public function denyFollowUpClaim(Request $request)
    {
        try {
            $dispatchJob = DispatchJob::where('id', $request->jobId)->first();
            $dispatchJob->status = 'Denied';
            $result = $dispatchJob->update();
            return json_encode(['status' => $result]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'There is error on server side. Please try again!']);
        }
    }

    public function approveFollowUpClaim(Request $request)
    {
        try {
            $dispatchJob = DispatchJob::where('id', $request->jobId)->first();
            $dispatchJob->status = "Job Started";
            $result = $dispatchJob->update();
            return json_encode(['status' => $result]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'There is error on server side. Please try again!']);
        }
    }

    public function changeStatusClaim(Request $request)
    {
        try {
            $dispatchJob = DispatchJob::where('id', $request->jobId)->first();
            $dispatchJob->status = $request->jobStatus;
            $result = $dispatchJob->update();
            return json_encode(['status' => $result]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false, 'message' => 'There is error on server side. Please try again!']);
        }
    }

}
