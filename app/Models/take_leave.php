<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class take_leave extends Model
{
    protected $table="take_leaves";
    protected $primary_key='take_leave_id';
    protected $fillable = [
        'date_from' ,
        'date_to',
        'reason',
    ];
}
