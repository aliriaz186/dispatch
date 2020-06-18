<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationRatesModel extends Model
{
    public $table = "tbl_rates_location";
    public $primaryKey = "location_auto_id";
    public $timestamps = false;
}
