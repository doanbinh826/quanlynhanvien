@extends('admin.admin_layout')
@section('content')
<div class="card">
    <div class="card-header">
        {{--  <a href="{{url('view_salary_month')}}" type="button" class="btn btn-danger">back</a>  --}}
        <h4>
            Lương của <strong>{{$hard_salary->employee_name}}</strong> trong tháng :  <strong>{{$month_deduction}} / {{$year_deduction}}</strong>
        </h4>
    </div>
    <div class="card-content table-responsive">
        <div class="row">
            <div class="col-lg-4">
                <table class="table table-border table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Họ và tên</th>
                            <td>{{$hard_salary -> employee_name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">User name</th>
                            <td>{{$hard_salary -> user_name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Email</th>
                            <td>{{$hard_salary -> email}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Số điện thoại</th>
                            <td>{{$hard_salary -> phone_number}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Địa chỉ </th>
                            <td>{{$hard_salary -> address}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Chức vụ </th>
                            <td>{{$hard_salary -> position}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Lương cứng </th>
                            <td>{{number_format( $hard_salary->hard_salary )}} VND</td>
                        </tr>
                        <tr>
                            <th scope="col">Số ngày làm việc</th>
                            <td>{{$hard_salary->day_works}} ngày</td>
                            <td>
                                <a class="edit_hard" data-url = "{{url('edit_hard_salary',['employee_id'=> $hard_salary ->employee_id])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-2"></div>
            <div class="col-lg-4">
                <table class="table table-border table-hover">
                    <thead>
                    
                        <?php
                            $p = 0;
                            $money = 0;
                        ?>
                        @foreach ($projects as $project)
                            <tr>
                                <?php
                                    $p++;
                                ?>
                                <th>
                                    Project {{$p}}
                                </th>
                                <th>{{$project->project_name}}</th>
                                <td>{{number_format($project->money)}} VND</td>
                                <td>
                                    <a class="edit_project" data-url = "{{url('edit_project',['employee_id'=> $project->employee_id])}}"
                                        data-month="{{$month_deduction}}" data-year="{{$year_deduction}}" data-project ="{{$project->project_id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                $money += $project->money;
                            ?>
                        @endforeach
                        
                        <tr>
                            <th scope="col">Đi muộn</th>
                            <td>
                                <strong>{{$hard_salary -> late_work}} h </strong> = 
                                <em>
                                    <?php 
                                    $late =$hard_salary->late_work * 50000;
                                    ?>
                                    {{ number_format($late) }} 
                                    VND
                                </em>
                                <td>
                                    <a class="edit_late" data-url = "{{url('edit_late',['employee_id'=> $hard_salary ->employee_id])}}"
                                        data-month="{{$month_deduction}}" data-year="{{$year_deduction}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                </td>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Ngày nghỉ</th>
                            <td>
                                <strong>{{$hard_salary->day_off}} ngày </strong> = 
                                <em>    
                                    <?php 
                                        $off = $hard_salary->day_off * $hard_salary->hard_salary/$hard_salary->day_works ;
                                    ?>
                                        {{ number_format($off )}} 
                                    VND
                                </em>
                                <td>
                                    <a class="edit_day_off" data-url = "{{url('edit_day_off',['employee_id'=> $hard_salary ->employee_id])}}"
                                        data-month="{{$month_deduction}}" data-year="{{$year_deduction}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                </td>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Lương làm thêm </th>
                            <td>
                                
                                <?php 
                                    $over = 0;
                                    $hour =0;
                                ?>
                                @foreach ($salary_overtimes as $salary_overtime)
                                    <?php 
                                        $hour += $salary_overtime -> hour; 
                                        $over = $hour * ($hard_salary -> hard_salary / $hard_salary -> day_works / 8 * 1.5);
                                    ?>
                                @endforeach
                                <strong>{{$hour}} h</strong> = 
                                <em>{{ number_format($over) }} VND</em>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Onsites</th>
                            <td>
                                
                                <?php 
                                    $on = 0;
                                    $on_money =0;
                                ?>
                                @foreach ($onsites as $onsite)
                                    <?php 
                                        $on += $onsite ->money_onsite; 
                                    ?>
                                @endforeach
                                <em>{{ number_format($on) }} VND</em>
                                    
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Lương khác</th>
                            <td> 
                                <em>{{ number_format($orthers ->money_orther) }} VND</em>       
                            </td>
                            <td>(Lý do: {{$orthers->reason_orther}})</td>
                            <td>
                                <a class="edit_orther" data-url = "{{url('edit_orther',['employee_id'=> $hard_salary ->employee_id])}}"
                                    data-month="{{$month_deduction}}" data-year="{{$year_deduction}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="text-center bg-info" style="border: 1px black solid;">
            <h4>
                {{number_format($hard_salary->hard_salary + $money + $over + $on - $late - $off + $orthers ->money_orther )}} VND</h1> 
        </div>
    </div>
</div>
<div class="card">
    <div class="card-content table-responsive ">
        <div class="container">
            <div class="table table-responsive">
                <h3>Bảng lương làm thêm</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <?php 
                            $o = 0;
                            ?>
                            <th scope="col">Ngày</th>
                            @foreach ($salary_overtimes as $salary_overtime)
                            <?php 
                                $o++;
                            ?>
                                <td>{{$o}}</td> 
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="col">Giờ</th>
                            @foreach ($salary_overtimes as $salary_overtime)
                                <td>{{$salary_overtime->hour}}</td>
                            @endforeach
                            
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table table-responsive">
                <h3>Bảng lương Onsites</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <?php 
                            $ons = 0;
                            ?>
                            <th scope="col">Ngày</th>
                            @foreach ($onsite_footers as $onsite)
                                <td>{{$onsite->date_onsite}}</td>
                            @endforeach
                                
                        </tr>
                        <tr>
                            <th scope="col">Giờ</th>
                            @foreach ($onsite_footers as $onsite)
                                <td>{{$onsite->address_onsite}}</td>
                            @endforeach
                            
                        </tr>
                        
                    </thead>
                </table>
            </div>
        <form action="{{url('save_edit_hard_salary/'.$hard_salary ->employee_id)}}" method="post">
            @csrf
            <div id="edit_hard_salary">

            </div>
            
        </form>
        <form action="{{url('save_edit_late/'.$hard_salary ->employee_id)}}" method="post">
            @csrf
            <div id="edit_late_day">

            </div>
            
        </form>
        <form action="{{url('save_day_off/'.$hard_salary ->employee_id)}}" method="post">
            @csrf
            <div id="edit_day_off">

            </div>
            
        </form>
        <form action="{{url('save_orther/'.$hard_salary ->employee_id)}}" method="post">
            @csrf
            <div id="edit_orther">

            </div>
        </form>
        <form action="{{url('save_project/'.$hard_salary ->employee_id)}}" method="post">
            @csrf
            <div id="edit_project">
                
            </div>
            
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.edit_hard').on('click',function(e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {_token: _token},
                success: function (data) {
                    $('#edit_hard_salary').html(data);
                }
            });
        })
        $('.edit_late').on('click',function(e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var month = $(this).data('month');
            var year = $(this).data('year');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {_token: _token , month:month , year:year},
                success: function (data) {
                    $('#edit_late_day').html(data);
                }
            });
        })
        $('.edit_day_off').on('click',function(e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var month = $(this).data('month');
            var year = $(this).data('year');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {_token: _token , month:month , year:year},
                success: function (data) {
                    $('#edit_day_off').html(data);
                }
            });
        })
        $('.edit_orther').on('click',function(e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var month = $(this).data('month');
            var year = $(this).data('year');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {_token: _token , month:month , year:year},
                success: function (data) {
                    $('#edit_orther').html(data);
                }
            });
        })
        $('.edit_project').on('click',function(e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var url = $(this).data('url');
            var month = $(this).data('month');
            var year = $(this).data('year');
            var id = $(this).data('project');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {_token: _token, month:month , year:year , id:id},
                success: function (data) {
                    $('#edit_project').html(data);
                }
            });
        })
    })
</script>
@endsection