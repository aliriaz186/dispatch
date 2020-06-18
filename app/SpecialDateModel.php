<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialDateModel extends Model
{
    public $table = "tbl_rates_special_date";
    public $primaryKey = "special_date_auto_id";
    public $timestamps = false;
}
