<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class all_salary_employee extends Model
{
    protected $table="all_salary_employees";
    protected $primary_key='all_salary_employee_id';
    protected $fillable = [
        'employee_name' ,
        'employee_id',
        'email',
        'address',
        'phone_number',
        'position',
        'Total',
        'month',
        'year'
    ];

    public static function getSalary(){
        $recore = DB::table('all_salary_employees')
            ->orderBy('year','desc')
            ->orderBy('month','desc')
            ->select('employee_name'
                    ,'user_name'
                    ,'position',
                    'hard_salary',
                    'salary_overtime',
                    'salary_project',
                    'onsite',
                    'salary_orther',
                    'lates',
                    'late_work',
                    'number_day_offs',
                    'day_offs',
                    'salary_total',
                    'month',
                    'year',
                    'all_total'
                    )
            ->get()
            ->toArray();
        return $recore;
    }
}
