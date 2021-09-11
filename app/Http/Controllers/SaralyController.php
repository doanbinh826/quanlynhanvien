<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class SaralyController extends Controller
{
    public function create_saraly(){
        return view('admin.create_saraly');
    }
    public function save_salary(Request $request){
        $id = DB::table('saralies')
        ->where('employee_id',$request->employee_id)
        ->exists();
        if($id){
            Session::put('error','error');
            return redirect()->back();
        }else{
            DB::table('saralies')
            ->insert([
                'employee_id'=>$request->employee_id,
                'employee_name'=>$request->employee_name,
                'date'=>$request->date,
                'mounth'=>$request->mounth,
                'year'=>$request->year,
                'hard_salary'=>$request->hard_salary,
                'day_works'=>$request->day_works,
                
            ]);
            return redirect()->back();
        }
        
    }
    public function create_overtime(){
        return view('admin.create_overtime');
    }
    public function save_overtime(Request $request){
        $employees = DB::table('employees')
        ->get();
        $emp = DB::table('employees')
            ->first();
        $month = DB::table('salary_overtimes')
        ->where('mounth',$request->mounth_overtime)
        ->where('year',$request->year_overtime)
        ->exists();
        if($month){
            Session::put('error_month','error');
            return redirect()->back();
        }else{
            foreach($employees as $employee){
                for($i = 1 ; $i<= 30; $i++){
                    DB::table('salary_overtimes')
                    ->insert([
                        'employee_id'=>$employee->employee_id,
                        'year'=>$request->year_overtime,
                        'mounth'=>$request->mounth_overtime,
                        'date'=>$i,
                        'hour'=>0
                    ]);
                    DB::table('onsites')
                        ->insert([
                            'employee_id'=>$employee->employee_id,
                            'date_onsite'=>$i,
                            'month_onsite'=>$request->mounth_overtime,
                            'year_onsite'=>$request->year_overtime,
                            'money_onsite'=>0,
                        ]);
                }
                DB::table('salary_deductions')
                ->insert([
                    'employee_id'=>$employee->employee_id,
                    'late_work'=>0,
                    'day_off'=> 0,
                    'month_deduction'=>$request->mounth_overtime,
                    'year_deduction'=>$request->year_overtime
                ]);
                for($i = 1; $i<=5 ; $i ++){
                    DB::table('projects')
                    ->insert([
                        'project_name'=>0,
                        'employee_id'=>$employee->employee_id,
                        'month'=>$request->mounth_overtime,
                        'year'=>$request->year_overtime,
                        'money'=>0,
                        'status'=> 0
                    ]);
                }
                DB::table('orther_salaries')
                ->insert([
                    'employee_id'=>$employee->employee_id,
                    'month_orther'=>$request->mounth_overtime,
                    'year_orther'=>$request->year_overtime,
                    'money_orther'=>0
                ]);
            }
            DB::table('saralies')
                ->insert([
                    'employee_id'=>$emp->employee_id,
                    'month'=>$request->mounth_overtime,
                    'year'=>$request->year_overtime,
                ]);
            
            return redirect()->back();
        }
    }
    public function create_project(){
        
        $employees = DB::table('employees')
            ->where('position','project_management')
            ->get();
        return view('admin.create_project')
        ->with(compact('employees'));
    }
    public function get_employee(Request $request){
        

        $output = '';
        for($i =1; $i<=$request->number ; $i++){
            $output.='
                    <div class="form-group ">
                    <label for="exampleInputEmail1">Employee '.$i.'</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="number" name="employee_id_'.$i.'" class="form-control employee_id_project'.$i.'" id="exampleInputPassword1"  placeholder="Enter ID" required> 
                        </div>
                        <div class="col-md-3 employee_name_project">
                            <input type="text" name="employee_name_'.$i.'" class="form-control " id="exampleInputPassword1"  placeholder="Enter Name" required>
                        </div>
                    </div>
                </div>
            ';
        }

        echo json_encode($output);
    }   

    public function save_project(Request $request){
        for($i =1; $i<=$request->number_employee ; $i++){
            $id = "employee_id_".$i."";
            $name = "employee_name_".$i."";
            DB::table('projects')
                ->insert([
                   'project_name'=>$request->name_project,
                    'manager_id'=>$request->employee_manger,
                    'money'=>$request->money,
                    'employee_id'=>$request->$id,
                    'month'=>$request->month,
                    'year'=>$request->year,
                    'money'=>0,
                    'status'=> 0
                ]);
         }
        DB::table('project_managers')
            ->insert([
                'project_name'=>$request->name_project,
                'manager_id'=>$request->employee_manger,
                'money'=>$request->money,
                'employees'=>$request->number_employee,
                'month_project_manager'=>$request->month,
                'year_project_manager'=>$request->year,
                'status'=> 0
            ]);
          return redirect()->back();
    }
}
