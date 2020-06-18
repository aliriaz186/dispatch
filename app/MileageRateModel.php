<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MileageRateModel extends Model
{
    public $table = "tbl_rates_companies";
    public $primaryKey = "rate_auto_id";
    public $timestamps = false;
}
