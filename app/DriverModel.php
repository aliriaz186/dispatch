<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverModel extends Model
{
    public $table = "tbl_fleets";
    public $primaryKey = "fleet_auto_id";
    public $timestamps = false;
}
