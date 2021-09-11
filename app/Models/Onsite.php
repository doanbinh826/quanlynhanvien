<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onsite extends Model
{
    protected $table="onsites";
    protected $primary_key='onsite_id';
    protected $fillable = [
        'onsite_id',
        'employee_id',
        'date_onsite',
        'month_onsite',
        'year_onsite',
        'address_onsite',
        'money_onsite',
    ];
}
