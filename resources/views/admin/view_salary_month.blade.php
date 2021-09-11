@extends('admin.admin_layout')
@section('content')
<form >
    @csrf
    
<div class="card">
    <div class="card-header">       
        <div class="row">
            <div class="col-sm-11">
                <h3>
                    Bảng lương tất cả nhân viên theo tháng:  <strong>{{$month}} / {{$year}}</strong>
                </h3>
            </div>
            <div class="col-sm-1 ">
                <a type="button" href="{{url('export_employee')}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" style="border-radius: 5px;border: 2px solid #3385ff;; padding:3px"  width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                </a>
            </div>
            
        </div>
        
    </div>
    <div class="card-content table-responsive">
        <a href="{{url('all_salary')}}" type="button" class="btn btn-danger">back</a>
        <table class="table table-border table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ và tên </th>
                    <th>User Name</th>
                    <th>Lương cứng </th>
                    <th>Lương làm thêm</th>
                    <th>Lương thưởng dự án</th>
                    <th>Lương Onsite</th>
                    <th>Lương khác</th>
                    <th>Tiền phạt</th>
                    <th>Tổng lương <em style="font-size: smaller">(VND)</em> </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i =0;
                $all = 0;
                ?>
            @foreach ($hard_salarys as $hard_salary)
                <tr>
                    <td>
                        <?php
                        $i++;
                        echo $i; 
                        ?>
                    </td>                                       
                    <td>{{$hard_salary->employee_name}}</td> 
                    <td>{{$hard_salary->user_name}}</td> 
                    <td>{{number_format($hard_salary->hard_salary)}}</td> 
                    <!-- overtime--->
                    <?php 
                                $over = 0;
                            ?>
                        @foreach ($salary_overtimes as $salary_overtime)
                            <?php 
                                if ($salary_overtime ->employee_id == $hard_salary->employee_id ) {
                                    $over += $salary_overtime->hour * ($hard_salary->hard_salary / $hard_salary->day_works / 8 * 1.5);
                                }                   
                            ?>
                        @endforeach
                    <td>{{number_format($over)}}</td>
                    <td>
                        <?php 
                            $proj = 0;
                        ?>
                        @foreach ($projects as $project)
                            <?php 
                                if ($project ->employee_id == $hard_salary->employee_id ) {
                                    $proj += $project->money;
                                }       
                            ?>
                        @endforeach
                        {{$proj}}
                    </td>
                   

                    <!--onsite-->
                     <td>
                        <?php 
                            $on = 0;
                        ?>
                         @foreach ($onsites as $onsite)
                            <?php 
                                if ($onsite ->employee_id == $hard_salary->employee_id ) {
                                    $on += $onsite->money_onsite;
                                }     
                            ?>
                            
                         @endforeach
                         {{number_format($on)}} 
                    </td> 
                    <!--khác-->
                    <td>
                        <?php 
                            $or = 0;
                        ?>
                         @foreach ($orthers as $orther)
                            <?php 
                                if ($orther ->employee_id == $hard_salary->employee_id ) {
                                    $or += $orther->money_orther;
                                }     
                            ?>
                            
                         @endforeach
                         {{number_format($or)}} 
                    </td> 
                    <!--deduction-->
                    <td>
                        <?php 
                            $deduction =($hard_salary->hard_salary / $hard_salary->day_works * $hard_salary->day_off) + ($hard_salary->late_work * 50000);
                        ?>
                        {{number_format($deduction)}}
                    </td> 
                    
                    <td>
                        <?php 
                            $total = $over + $proj + $hard_salary->hard_salary + $on + $or - $deduction;
                        ?>
                            {{number_format($total)}}
                    </td>
                    

                    {{--  end_salary  --}}
                    <td>
                        <a href="{{url('view_detail_salary/'.$hard_salary->month_deduction."/".$hard_salary->year_deduction."/".$hard_salary->employee_id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                              </svg>
                        </a>
                    </td>
                </tr>
                <?php 
                $all += $total;
                ?>
                <!--imsert table_all--->
                <?php 
                    $save =  DB::table('all_salary_employees')
                        ->where('employee_id',$hard_salary->employee_id)
                        ->where('month',$month)
                        ->where('year',$year)
                        ->exists();
                    if($save == null){
                        DB::table('all_salary_employees')
                        ->insert([
                            'employee_id'=>$hard_salary->employee_id,
                            'employee_name'=>$hard_salary->employee_name,
                            'user_name'=>$hard_salary->user_name,
                            'position'=>$hard_salary->position,
                            'hard_salary'=>$hard_salary->hard_salary,
                            'salary_overtime'=>$over,
                            'salary_project'=>$proj,
                            'onsite'=>$on,
                            'salary_orther'=>$or,
                            'lates'=>$hard_salary->late_work,
                            'late_work'=>$hard_salary->late_work* 50000,
                            'number_day_offs'=>$hard_salary->day_off,
                            'day_offs'=>$hard_salary->hard_salary / $hard_salary->day_works * $hard_salary->day_off,
                            'salary_total' =>$total,
                            'all_total'=> 0,
                            'month'=>$month,
                            'year'=>$year
                        ]);
                    }else {
                        DB::table('all_salary_employees')
                        ->where('employee_id',$hard_salary->employee_id)
                        ->where('month',$month)
                        ->where('year',$year)
                        ->select('hard_salary','salary_overtime','salary_project','onsite','lates','late_work','number_day_offs','day_offs','salary_total','all_total','salary_orther')
                        ->update([
                            'hard_salary'=>$hard_salary->hard_salary,
                            'salary_overtime'=>$over,
                            'salary_project'=>$proj,
                            'onsite'=>$on,
                            'salary_orther'=>$or,
                            'lates'=>$hard_salary->late_work,
                            'late_work'=>$hard_salary->late_work* 50000,
                            'number_day_offs'=>$hard_salary->day_off,
                            'day_offs'=>$hard_salary->hard_salary / $hard_salary->day_works * $hard_salary->day_off,
                            'salary_total' =>$total,
                            'all_total'=> 0,
                        ]);
                    }
                ?>

            @endforeach 
            </tbody>
            <p style="text-align:end; border:2px">Tổng lương toàn công ty: <strong><u>{{number_format($all)}}</u></strong> VND</p> 
        </table>
    </div>
    <?php 
        $save =  DB::table('all_salary_employees')
            ->where('employee_id',$hard_salary->employee_id)
            ->where('month',$month)
            ->where('year',$year)
            ->exists();
        if($save == null){
            DB::table('all_salary_employees')
                ->select('all_total')
                ->insert([
                    'all_total'=> $all,
                ]);
        }else {
            DB::table('all_salary_employees')
                ->where('employee_id',$hard_salary->employee_id)
                ->where('month',$month)
                ->where('year',$year)
                ->select('all_total')
                    ->update([
                        'all_total'=> $all,
                    ]);
                }
            ?>
</div>
</form>
@endsection