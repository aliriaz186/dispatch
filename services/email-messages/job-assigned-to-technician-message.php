<?php

namespace services\email_messages;

class JobAssignedToTechnicianMessage
{
    public function creationMessage()
    {
        $emailBody = '
   <body>
             <div style="margin-left: 50px;font-size: 25px;padding-top: 40px">Claim has been offered to you. You can click to view claim.</div><br>
            <div style="padding-top: 30px;padding-bottom: 40px">
 <a href="'. env('TECHNICIAN_URL').'/jobs" style=" background-color: #f48134;
    border-color: #f48134;
  border: none;
  color: white;
  padding: 10px 27px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
  border-radius: 3px;margin-left: 50px">View Claim</a>
  </div>
            </body>
            ';
        return $emailBody;
    }

}
