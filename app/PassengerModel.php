<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassengerModel extends Model
{
    public $table = "tbl_passengers";
    public $primaryKey = "passenger_auto_id";
    public $timestamps = false;
}
