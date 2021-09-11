<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $table="employees";
    protected $primary_key='employee_id';
    protected $fillable = [
        'employee_name' ,
        'email',
        'address',
        'phone_number',
        'position',
    ];

    public static function getEmployee(){
        $recore = DB::table('employees')
            ->select('employee_id','employee_name' ,'email','address','phone_number','position')
            ->get()
            ->toArray();
        return $recore;
    }
}
