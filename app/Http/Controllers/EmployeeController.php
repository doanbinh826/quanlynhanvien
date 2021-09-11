<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Models\Employee;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(){
           return view('employee.home');
    }
    public function login(Request $request){
        $login = DB::table('employees')
        ->where('email',$request->email)
        ->where('password',md5($request->password))
        ->where('status',1)
        ->first();
    
        if($login){
            Session::put('employee_name',$login->employee_name);
            Session::put('employee_id',$login->employee_id);
            return view('employee.home')->with(compact('login'));
        }else{
            Session::put('login_error','error');
           return redirect()->back();
        }
    }
    public function profile(){
        $employees = DB::table('employees')
            ->where('employee_id',Session::get('employee_id'))
            ->first();
        return view('employee.profile')
            ->with(compact('employees'));
    }
    public function edit_profile($employee_id){
        $employee = DB::table('employees')
            ->where('employee_id',$employee_id)
            ->first();
        $output = '';
        $output .='
            
            <label>Họ và tên </label>
            <input type="text" class="form-control" value="'.$employee->employee_name.'" name="name" required>
            <label>Email</label>
            <input  type="email" class="form-control" value="'.$employee->email.'" name="email" required>
            <label>Số điện thoại</label>
            <input type="text" class="form-control" value="'.$employee->phone_number.'" name="phone_number" required>
            <label>Địa chỉ</label>
            <input type="text" class="form-control" value="'.$employee->address.'" name="address" required>
            <label>Mật khẩu</label>
            <input type="password" class="form-control" value="" name="password" required>
            <button type="submit" class="btn btn-primary text-right" style="margin-top: 10px">Submit</button>
        ';
        return response()->json($output);
    }
    public function save_profile(Request $request, $employee_id){
      
        DB::table('employees')
            ->where('employee_id', $employee_id)
            ->select('employee_name','email','phone_number','password','address')
            ->update([
                'employee_name'=>$request->name,
                'email'=>$request->email,
                'phone_number'=>$request->phone_number,
                'password'=>md5($request->password),
                'address'=>$request->address
            ]);
        return redirect()->back();
    }
    public function forgot_password(){
        return view('employee.forgot_password');
    }
    public function recover_password(Request $request){
        $email_exists = DB::table('employees')
            ->where('email',$request->recover)
            ->exists();
        $data = [
            'link' => url('reset_password/'.$request->recover)
        ];
        if($email_exists){
            Mail::send('employee.recover_password', $data, function ($message) use ($request) {
                $message->from('Doanbinh826@gmail.com', 'Doan Binh');
                $message->to($request->recover);
                $message->subject('Email reset Password');
            });
            Session::put('recover_success','recover');
        }else{
            Session::put('recover_error','recover');
        }
        return redirect()->back();
    }
    public function reset_password($email){
        return view('employee.reset_password')
            ->with(compact('email'));
    } 
    public function save_password(Request $request, $email){
        if($request->new_password === $request->confirm_password){
            DB::table('employees')
                ->where('email',$email)
                ->select('password')
                ->update([
                    'password'=>md5($request->new_password)
                ]);
            Session::put('reset_success','success');
            return redirect()->to('/');
        }else{
            Session::put('reset_error','error');
            return redirect()->back();
        }

    }  
    public function logout(){
        session()->put('employee_name', null);
        session()->put('employee_id', null);
        return view('employee.home');
    }
    public function take_leave(){
        return view('employee.take_leave');
    }
    public function send_leave(Request $request){
        $month_exists = DB::table('salary_deductions')
            ->where('year_deduction',$request->year_leave)
            ->where('month_deduction',$request->month_leave)
            ->where('employee_id',Session::get('employee_id'))
            ->exists();
        if($month_exists){
            DB::table('take_leaves')
                ->insert([
                    'employee_id'=>Session::get('employee_id'),
                    'date_leave'=>$request->date_leave,
                    'month_leave'=>$request->month_leave,
                    'year_leave'=>$request->year_leave,
                    'number_day'=>$request->number_day,
                    'reason'=>$request->reason,
                    'status_leave'=>0,
                    'reason_not'=>'0'
                ]);
        
            Session::put('success','success');
            
        }else{
            Session::put('error','error');
        }
        return Redirect::back();
    }
    public function consider(){
        $considers = DB::table('take_leaves')
        ->where('employee_id',Session::get('employee_id'))
        ->get();
        return view('employee.consider')
        ->with(compact('considers'));
    }
    public function salary_project(){
        $hard_salary = DB::table('employees')
            ->where('employee_id', Session::get('employee_id'))
            ->first();
        $months = DB::table('salary_deductions')
            ->where('employee_id',Session::get('employee_id'))
            ->orderBy('month_deduction','desc')
            ->get();
        return view('employee.salary_project')
            ->with(compact('hard_salary','months'));
    }
    public function view_month($month, $year){
        $hard_salary = DB::table('employees')
            ->join('salary_deductions','employees.employee_id','=','salary_deductions.employee_id')
            ->where('salary_deductions.month_deduction',$month)
            ->where('salary_deductions.year_deduction',$year)
            ->where('salary_deductions.employee_id',Session::get('employee_id'))
            ->first();
        $projects = DB::table('employees')
            ->join('projects','employees.employee_id','=','projects.employee_id')
            ->where('projects.employee_id', Session::get('employee_id'))
            ->where('projects.month',$month)
            ->where('projects.year',$year)
            ->get();
        $salary_overtimes = DB::table('employees')
            ->join('salary_overtimes','employees.employee_id','=','salary_overtimes.employee_id')
            ->where('salary_overtimes.employee_id',Session::get('employee_id'))
            ->where('salary_overtimes.mounth',$month)
            ->where('salary_overtimes.year',$year)
            ->get();
        $onsites = DB::table('onsites')
            ->where('month_onsite',$month)
            ->where('year_onsite',$year)
            ->whereNotNull('address_onsite')
            ->get();
        $onsite_footers = DB::table('onsites')
            ->where('month_onsite',$month)
            ->where('year_onsite',$year)
            ->where('employee_id',Session::get('employee_id'))
            ->get();
        $orthers = DB::table('orther_salaries')
            ->where('month_orther',$month)
            ->where('year_orther',$year)
            ->where('employee_id',Session::get('employee_id'))
            ->first();
        return view('employee.detail_month')
        ->with(compact('month',
                        'year',
                        'hard_salary',
                        'salary_overtimes',
                        'projects',
                        'onsites',
                        'onsite_footers',
                        'orthers'));
    }

    public function export_employee(){
        return Excel::download(new EmployeeExport,'employee.xlsx');
    }
}
