<?php

namespace App\Http\Controllers;

use App\Exports\SalaryExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function admin_index(){
        return view('admin.admin_home');
    }
    public function add_employee(){
        return view('admin.add_employee');
    }
    public function post_employee(Request $request){
        if ($request ->hasFile('image_profile')){
            $file =$request ->file('image_profile');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/upload',$filename);
            //$banner ->banner_image = $filename;
        
            DB::table('employees')
            ->insert([
                'employee_name'=>$request->name,
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'image_profile'=>$filename,
                'password'=>md5($request->password),
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
                'position'=>$request->position,
                'hard_salary'=>$request->hard_salary,
                'day_works'=>$request->day_works,
                'status'=> 1,

            ]);
        }else{
            DB::table('employees')
            ->insert([
                'employee_name'=>$request->name,
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'image_profile'=>0,
                'password'=>md5($request->password),
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
                'position'=>$request->position,
                'hard_salary'=>$request->hard_salary,
                'day_works'=>$request->day_works,
                'status'=> 1,
            ]);
        }
        return Redirect::back();
    }
    public function all_employee(){
        $all_employees = DB::table('employees')
            ->get();
        return view('admin.all_employee')
            ->with(compact('all_employees'));
    }
    public function edit_employee($employee_id){

        $edit_employee= DB::table('employees')
            ->where('employee_id',$employee_id)
            ->first();
      
        return view('admin.edit_employee')
            ->with(compact('edit_employee'));
    }
    public function post_edit(Request $request, $employee_id){
        if ($request ->hasFile('image_profile')){
            $file =$request ->file('image_profile');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/upload',$filename);
            //$banner ->banner_image = $filename;
        
            DB::table('employees')
            ->where('employee_id',$employee_id)
            ->update([
                'employee_name'=>$request->name,
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'image_profile'=>$filename,
                'password'=>md5($request->password),
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
                'position'=>$request->position,
                'hard_salary'=>$request->hard_salary,
                'day_works'=>$request->day_works,
                'status'=> 1,

            ]);
        }else{
            DB::table('employees')
            ->where('employee_id',$employee_id)
            ->update([
                'employee_name'=>$request->name,
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'image_profile'=>0,
                'password'=>md5($request->password),
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
                'position'=>$request->position,
                'hard_salary'=>$request->hard_salary,
                'day_works'=>$request->day_works,
                'status'=> 1,
            ]);
        }
        return redirect()->to('/all_employee');
    }
    public function on_active($employee_id){
        DB::table('employees')
        ->where('employee_id',$employee_id)
        ->select('status')
        ->update([
            'status'=> 1
        ]);
        return redirect()->back();
    }
    public function off_active($employee_id){
        DB::table('employees')
        ->where('employee_id',$employee_id)
        ->select('status')
        ->update([
            'status'=> 0
        ]);
        return redirect()->back();
    }
    public function delete_employee($employee_id){
        DB::table('employees')
        ->where('employee_id',$employee_id)
        ->delete();
        return response()->json();
    }
    public function all_request_leave(){
        $waittings = DB::table('take_leaves')
            ->join('employees','employees.employee_id','=','take_leaves.employee_id')
            ->where('status_leave',0)
            ->get();
        $accepteds = DB::table('take_leaves')
            ->join('employees','employees.employee_id','=','take_leaves.employee_id')
            ->where('status_leave',1)
            ->get();
        $canceleds = DB::table('take_leaves')
            ->join('employees','employees.employee_id','=','take_leaves.employee_id')
            ->where('status_leave',2)
            ->get();
        return view('admin.request_leave')
        ->with(compact('waittings','accepteds','canceleds'));
    }
    public function waiting_accept(){
        $waittings = DB::table('take_leaves')
            ->join('employees','employees.employee_id','=','take_leaves.employee_id')
            ->where('status_leave',0)
            ->get();
        return view('admin.waittings')
            ->with(compact('waittings'));
    }
    public function accepted(){
        $accepteds = DB::table('take_leaves')
            ->join('employees','employees.employee_id','=','take_leaves.employee_id')
            ->where('status_leave',1)
            ->get();
        return view('admin.accepteds')
            ->with(compact('accepteds'));
    }
    public function canceled(){
        $canceleds = DB::table('take_leaves')
            ->join('employees','employees.employee_id','=','take_leaves.employee_id')
            ->where('status_leave',2)
            ->get();
        return view('admin.canceleds')
            ->with(compact('canceleds'));
    }
    public function accept($employee_id){
        $take_leaves =DB::table('take_leaves')
            ->where('employee_id',$employee_id)
            ->where('status_leave',0)
            ->orderBy('take_leave_id','desc')
            ->first();

        $day_offs= DB::table('take_leaves')
            ->where('employee_id',$employee_id)
            ->where('month_leave',$take_leaves->month_leave)
            ->where('year_leave',$take_leaves->year_leave)
            ->orderBy('take_leave_id','desc')
            ->first();
        $number_day_offs =  DB::table('salary_deductions')
            ->where('employee_id',$employee_id)
            ->where('month_deduction',$take_leaves->month_leave)
            ->where('year_deduction',$take_leaves->year_leave)
            ->first();
        DB::table('salary_deductions')
            ->where('employee_id',$employee_id)
            ->where('month_deduction',$take_leaves->month_leave)
            ->where('year_deduction',$take_leaves->year_leave)
            ->select('day_off')
            ->update([
                'day_off'=>$number_day_offs->day_off + $day_offs->number_day ,
            ]);
            DB::table('take_leaves')
            ->where('employee_id',$employee_id)
            ->where('status_leave',0)
            ->select('status_leave')
            ->update([
                'status_leave'=> 1
            ]);
        return redirect()->back();
    }
    public function not_accept(Request $request,$employee_id){
        DB::table('take_leaves')
            ->where('employee_id',$employee_id)
            ->where('status_leave',0)
            ->select('status_leave','reason_not')        
            ->update([
                'status_leave'=> 2,
                'reason_not'=>$request->reason_not_accept,
            ]);
        return redirect()->back();
    }
    public function view_salary($employee_id){
        
    }
    public function all_salary(){   
        $months = DB::table('saralies')
            ->select('year','month')
            ->orderBy('year','desc')
            ->orderBy('month','desc')
            ->get();
        return view('admin.all_salary')
            ->with(compact('months'));
    }
    public function view_salary_month($month,$year){
            $hard_salarys = DB::table('employees')
                ->join('salary_deductions','employees.employee_id','=','salary_deductions.employee_id')
                ->where('salary_deductions.month_deduction',$month)
                ->where('salary_deductions.year_deduction',$year)
                ->get();
            $projects = DB::table('employees')
                ->join('projects','employees.employee_id','=','projects.employee_id')
                ->where('projects.month',$month)
                ->where('projects.year',$year)  
                ->get();
            $deductions = DB::table('employees')
                ->join('salary_deductions','employees.employee_id','=','salary_deductions.employee_id')
                ->where('salary_deductions.month_deduction',$month)
                ->where('salary_deductions.year_deduction',$year)
                ->get();
            $salary_overtimes = DB::table('employees')
                ->join('salary_overtimes','employees.employee_id','=','salary_overtimes.employee_id')
                ->where('salary_overtimes.mounth',$month)
                ->where('salary_overtimes.year',$year)
                ->get();
            $onsites = DB::table('onsites')
                ->where('month_onsite',$month)
                ->where('year_onsite',$year)
                ->whereNotNull('address_onsite')
                ->get();
            $orthers = DB::table('orther_salaries')
                ->where('month_orther',$month)
                ->where('year_orther',$year)
                ->get();
        return view('admin.view_salary_month')
                ->with(compact('hard_salarys','salary_overtimes','onsites'))
                ->with(compact('projects'))
                ->with(compact('month'))
                ->with(compact('year','orthers'));
    }
    public function view_detail_salary($month_deduction , $year_deduction , $employee_id){
        $hard_salary = DB::table('employees')
            ->join('salary_deductions','employees.employee_id','=','salary_deductions.employee_id')
            ->where('salary_deductions.month_deduction',$month_deduction)
            ->where('salary_deductions.year_deduction',$year_deduction)
            ->where('salary_deductions.employee_id',$employee_id)
            ->first();
            
        $projects = DB::table('employees')
            ->join('projects','employees.employee_id','=','projects.employee_id')
            ->where('projects.employee_id', $employee_id)
            ->where('projects.month',$month_deduction)
            ->where('projects.year',$year_deduction)
            ->get();
        $salary_overtimes = DB::table('employees')
            ->join('salary_overtimes','employees.employee_id','=','salary_overtimes.employee_id')
            ->where('salary_overtimes.employee_id', $employee_id)
            ->where('salary_overtimes.mounth',$month_deduction)
            ->where('salary_overtimes.year',$year_deduction)
            ->get();
        $onsites = DB::table('onsites')
            ->where('month_onsite',$month_deduction)
            ->where('year_onsite',$year_deduction)
            ->whereNotNull('address_onsite')
            ->get();
        $onsite_footers = DB::table('onsites')
            ->where('month_onsite',$month_deduction)
            ->where('year_onsite',$year_deduction)
            ->where('employee_id',$employee_id)
            ->get();
        $orthers = DB::table('orther_salaries')
            ->where('month_orther',$month_deduction)
            ->where('year_orther',$year_deduction)
            ->where('employee_id',$employee_id)
            ->first();
        return view('admin.detail_salary')
            ->with(compact('month_deduction',
                            'year_deduction',
                            'hard_salary',
                            'salary_overtimes',
                            'projects',
                            'onsites',
                            'onsite_footers',
                            'orthers'));
    }

    public function edit_hard_salary($employee_id){
        $employee = DB::table('employees')
            ->where('employee_id',$employee_id)
            ->first();
        $output = '';
        $output .='
            <label>Lương cứng </label>
            <input name="hard_salary" type="number" class="form-control" value="'.$employee->hard_salary.'">
            <label>Số ngày làm việc </label>
            <input name="day_works" type="number" class="form-control" value="'.$employee->day_works.'">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_edit_hard_salary($employee_id, Request $request){
        DB::table('employees')
            ->where('employee_id',$employee_id)
            ->select('hard_salary','day_works')
            ->update([
                'hard_salary'=> $request->hard_salary,
                'day_works'=>$request->day_works
            ]);
        return redirect()->back();
    }
    public function edit_late($employee_id ,Request $request){
        $late = DB::table('salary_deductions')
            ->where('month_deduction',$request->month)
            ->where('year_deduction',$request->year)
            ->where('employee_id',$employee_id)
            ->first();
        $output = '';
        $output .='
            <label>Đi muộn</label>
            <input name="late_work" type="number" class="form-control" value="">
            <input name="month" value="'.$request->month.'" type="hidden">
            <input name="year" value="'.$request->year.'" type="hidden">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_edit_late($employee_id, Request $request){
        $salary = DB::table('salary_deductions')
            ->where('employee_id',$employee_id)
            ->where('month_deduction', $request->month)
            ->where('year_deduction', $request->year)
            ->first();
        DB::table('salary_deductions')
            ->where('employee_id',$employee_id)
            ->where('month_deduction', $request->month)
            ->where('year_deduction', $request->year)
            ->select('late_work')
            ->update([
                'late_work'=>$salary->late_work + $request->late_work,
            ]);
        return redirect()->back();
    }
    public function edit_day_off($employee_id ,Request $request){
        $late = DB::table('salary_deductions')
            ->where('month_deduction',$request->month)
            ->where('year_deduction',$request->year)
            ->where('employee_id',$employee_id)
            ->first();
        $output = '';
        $output .='
            <label>Ngày nghỉ</label>
            <input name="day_off" type="number" class="form-control" value="">
            <input name="month" value="'.$request->month.'" type="hidden">
            <input name="year" value="'.$request->year.'" type="hidden">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_day_off($employee_id, Request $request){
        $day_off = DB::table('salary_deductions')
            ->where('employee_id',$employee_id)
            ->where('month_deduction', $request->month)
            ->where('year_deduction', $request->year)
            ->first();
        DB::table('salary_deductions')
            ->where('employee_id',$employee_id)
            ->where('month_deduction', $request->month)
            ->where('year_deduction', $request->year)
            ->select('day_off')
            ->update([
                'day_off'=>$day_off->day_off + $request->day_off,
            ]);
        return redirect()->back();
    }
    public function edit_overtime($employee_id ,Request $request){
        $output = '';
        $output .='
            <h3>Cập nhật làm thêm</h3>
            <div class="row">
                <div class="col-lg-6">
                    <label>Ngày</label>
                    <input name="date" type="number" class="form-control" value="">
                </div>
                <div class="col-lg-6">
                    <label>Giờ</label>
                    <input name="hour" type="number" class="form-control" value="">
                </div>
            </div>
            <input name="month" value="'.$request->month.'" type="hidden">
            <input name="year" value="'.$request->year.'" type="hidden">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_overtime($employee_id, Request $request){
        $hour = DB::table('salary_overtimes')
            ->where('employee_id',$employee_id)
            ->where('mounth', $request->month)
            ->where('year', $request->year)
            ->where('date',$request->date)
            ->first();
        DB::table('salary_overtimes')
            ->where('employee_id',$employee_id)
            ->where('mounth', $request->month)
            ->where('year', $request->year)
            ->where('date',$request->date)
            ->select('hour')
            ->update([
                'hour'=>$hour->hour + $request->hour,
            ]);
        return redirect()->back();
    }
    public function save_salary_export(Request $request){
        DB::table('all_salary_employees')
            ->insert([
                'employee_name'=>$request->name,
                'employee_id'=>$request->id,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'position'=>$request->position,
                'Total'=>$request->total,
                'month'=>$request->month,
                'year'=>$request->year
            ]);
        return redirect()->back();
    }
    public function edit_project($employee_id ,Request $request){
        $project = DB::table('projects')
            ->where('employee_id',$employee_id)
            ->where('project_id',$request->id)
            ->first();
        $output = '';
        $output .='
            <h3>Project</h3>
            <div class="row">
                <div class="col-lg-6">
                    <label>Tên Dự Án</label>
                    <input name="project_name" type="text" class="form-control" value="'.$project->project_name.'">
                </div>
                <div class="col-lg-6">
                    <label>Số tiền</label>
                    <input name="money" type="number" class="form-control" value="'.$project->money.'">
                </div>
            </div>
            <input name="project_id" value="'.$request->id.'" type="hidden">
            <input name="month" value="'.$request->month.'" type="hidden">
            <input name="year" value="'.$request->year.'" type="hidden">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_project($employee_id, Request $request){
        DB::table('projects')
            ->where('project_id',$request->project_id)
            ->where('employee_id',$employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->select('project_name','money')
            ->update([
                'project_name'=>$request->project_name,
                'money'=>$request->money,
            ]);
        return redirect()->back();
    }
    public function edit_onsite_employee($employee_id ,Request $request){
        $output = '';
        $output .='
            <h3>Cập nhật Onsite</h3>
            <div class="row">
                <div class="col-lg-3">
                    <label>Ngày</label>
                    <input name="date_onsite" type="number" class="form-control" value="">
                </div>
                <div class="col-lg-9">
                    <label>Địa điểm</label>
                    <input name="address_onsite" type="text" class="form-control" value="">
                </div>
            </div>
            <input name="month" value="'.$request->month.'" type="hidden">
            <input name="year" value="'.$request->year.'" type="hidden">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function edit_orther($employee_id ,Request $request){
        $output = '';
        $output .='
            <h3>Cập nhật lương khác</h3>
            <div class="row">
                <div class="col-lg-6">
                    <label>Tiền</label>
                    <input name="money_orther" type="number" class="form-control" value="">
                </div>
                <div class="col-lg-6">
                    <label>Lý do </label>
                    <input name="reason_orther" type="text" class="form-control" value="">
                </div>
            </div>
            <input name="month" value="'.$request->month.'" type="hidden">
            <input name="year" value="'.$request->year.'" type="hidden">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_orther($employee_id, Request $request){
        $money = DB::table('orther_salaries')
            ->where('employee_id',$employee_id)
            ->where('month_orther', $request->month)
            ->where('year_orther', $request->year)
            ->first();
        DB::table('orther_salaries')
            ->where('employee_id',$employee_id)
            ->where('month_orther', $request->month)
            ->where('year_orther', $request->year)
            ->select('money_orther','reason_orther')
            ->update([
                'money_orther'=>$money->money_orther +  $request->money_orther,
                'reason_orther'=>$money->reason_orther.','.$request->reason_orther,
            ]);
        return redirect()->back();
    }
    public function save_onsite_employee($employee_id, Request $request){

        DB::table('onsites')
            ->where('employee_id',$employee_id)
            ->where('month_onsite', $request->month)
            ->where('year_onsite', $request->year)
            ->where('date_onsite',$request->date_onsite)
            ->select('address_onsite')
            ->update([
                'address_onsite'=>$request->address_onsite,
            ]);
        return redirect()->back();
    }
    public function month_onsite(){
        $months = DB::table('saralies')
            ->select('year','month')
            ->orderBy('year','desc')
            ->orderBy('month','desc')
            ->get();
        return view('admin.month_onsite')
            ->with(compact('months'));
    }
    public function edit_onsite_month($month,$year){
        $employee_id= DB::table('saralies')
            ->first();
        $onsites = DB::table('onsites')
            ->where('year_onsite',$year)
            ->where('month_onsite',$month)
            ->where('employee_id',$employee_id->employee_id)
            ->get();
        return view('admin.edit_onsite')
            ->with(compact('onsites'));
    }
    public function save_onsite(Request $request){
        DB::table('onsites')
            ->where('year_onsite',$request->year_onsite)
            ->where('month_onsite',$request->month_onsite)
            ->where('date_onsite',$request->date_onsite)
            ->update([
                'money_onsite'=>$request->money_onsite,
            ]);
        return redirect()->back();
    }
    public function export_salary(){
        $salary = new SalaryExport;
        return Excel::download($salary,'salary.xlsx');
    }
}
