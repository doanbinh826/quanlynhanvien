<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SaralyController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[EmployeeController::class,'index']);
Route::get('/admin',[AdminController::class,'admin_index']);

Route::get('/add_employee',[AdminController::class,'add_employee']);
Route::post('/post_employee',[AdminController::class,'post_employee']);
Route::get('/on_active/{employee_id}',[AdminController::class,'on_active']);
Route::get('/off_active/{employee_id}',[AdminController::class,'off_active']);

Route::get('/all_employee',[AdminController::class,'all_employee']);
Route::get('/edit_employee/{employee_id}',[AdminController::class,'edit_employee']);
Route::post('/post_edit/{employee_id}',[AdminController::class,'post_edit']);
Route::post('/delete_employee/{employee_id}',[AdminController::class,'delete_employee']);

//request_leave
Route::get('/all_request_leave',[AdminController::class,'all_request_leave']);
Route::get('waiting_accept',[AdminController::class,'waiting_accept']);
Route::get('accepted',[AdminController::class,'accepted']);
Route::get('canceled',[AdminController::class,'canceled']);
Route::get('/accept/{employee_id}',[AdminController::class,'accept']);
Route::post('/not_accept/{employee_id}',[AdminController::class,'not_accept']);


//Route::get('/view_salary/{employee_id}',[AdminController::class,'view_salary']);
Route::get('/all_salary',[AdminController::class,'all_salary']);
Route::get('/view_salary_month/{month}/{year}',[AdminController::class,'view_salary_month']);
Route::get('/view_detail_salary/{month_deduction}/{year_deduction}/{employee_id}',[AdminController::class,'view_detail_salary']);



//saraly_admin
Route::get('/create_saraly',[SaralyController::class,'create_saraly']);
Route::post('/save_salary',[SaralyController::class,'save_salary']);
Route::get('/create_overtime',[SaralyController::class,'create_overtime']);
Route::post('/save_overtime',[SaralyController::class,'save_overtime']);
Route::get('/create_project',[SaralyController::class,'create_project']);
Route::post('/get_employee',[SaralyController::class,'get_employee']);
Route::post('/save_project',[SaralyController::class,'save_project']);
Route::get('/check/{number}',[SaralyController::class,'check']);

//edit
Route::post('/edit_hard_salary/{employee_id}',[AdminController::class,'edit_hard_salary']);
Route::post('/save_edit_hard_salary/{employee_id}',[AdminController::class,'save_edit_hard_salary']);
Route::post('/edit_late/{employee_id}',[AdminController::class,'edit_late']);
Route::post('/save_edit_late/{employee_id}',[AdminController::class,'save_edit_late']);
Route::post('/edit_day_off/{employee_id}',[AdminController::class,'edit_day_off']);
Route::post('/save_day_off/{employee_id}',[AdminController::class,'save_day_off']);
Route::post('/edit_overtime/{employee_id}',[AdminController::class,'edit_overtime']);
Route::post('/save_overtime/{employee_id}',[AdminController::class,'save_overtime']);
Route::post('/edit_project/{employee_id}',[AdminController::class,'edit_project']);
Route::post('/save_project/{employee_id}',[AdminController::class,'save_project']);
Route::get('edit_onsite',[AdminController::class,'month_onsite']);
Route::get('edit_onsite_month/{month}/{year}',[AdminController::class,'edit_onsite_month']);
Route::post('save_onsite',[AdminController::class,'save_onsite']);
Route::post('/edit_onsite_employee/{employee_id}',[AdminController::class,'edit_onsite_employee']);
Route::post('/save_onsite_employee/{employee_id}',[AdminController::class,'save_onsite_employee']);
Route::post('/edit_orther/{employee_id}',[AdminController::class,'edit_orther']);
Route::post('/save_orther/{employee_id}',[AdminController::class,'save_orther']);



//employee
Route::post('/login',[EmployeeController::class,'login']);
Route::get('/logout',[EmployeeController::class,'logout']);
Route::get('/take_leave',[EmployeeController::class,'take_leave']);
Route::post('/send_leave',[EmployeeController::class,'send_leave']);
Route::get('/consider',[EmployeeController::class,'consider']);
Route::get('/profile',[EmployeeController::class,'profile']);
Route::post('/edit_profile/{employee_id}',[EmployeeController::class,'edit_profile']);
Route::post('/save_profile/{employee_id}',[EmployeeController::class,'save_profile']);
Route::get('forgot_password',[EmployeeController::class,'forgot_password']);
Route::post('recover_password',[EmployeeController::class,'recover_password']);
Route::get('reset_password/{email}',[EmployeeController::class,'reset_password']);
Route::post('save_password/{email}',[EmployeeController::class,'save_password']);

//salary_empoloyee
Route::get('/salary_project',[EmployeeController::class,'salary_project']);
Route::get('/view_month/{month}/{year}',[EmployeeController::class,'view_month']);

Route::get('export_employee',[AdminController::class,'export_salary']);