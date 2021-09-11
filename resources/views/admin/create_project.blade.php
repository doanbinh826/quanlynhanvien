@extends('admin.admin_layout')
@section('content')
<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create Project
                </h3>

            </div>
            <div class="card-content " >
                <form action="{{url('/save_project')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1 " style="text-align: center" >Name Project</label>
                        <input type="text" name="name_project" style="width:100%"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name project" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1 " style="text-align: center" >Manager</label>
                        <select class="form-control" name="employee_manger" style="width: 50%">
                            @foreach ($employees as $employee)
                                <option value="{{$employee->employee_id}}">{{$employee->employee_name}}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="exampleInputPassword1">Date</label>
                                <input type="number" name="date" class="form-control" id="exampleInputPassword1"  placeholder="date" required>
                            </div>
                            <div class="col-3">
                                <label for="exampleInputPassword1">Mounth</label>
                                <input type="number" name="month" value="8" class="form-control" id="exampleInputPassword1"  placeholder="mounth" required>
                            </div>
                            <div class="col-3">
                                <label for="exampleInputPassword1">Year</label>
                                <input type="number" name="year" value="2021" class="form-control" id="exampleInputPassword1"  placeholder="year" required>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Employees</label>
                        <input class="form-control " id="number_employee" type="number" name="number_employee" style="width:20%" value="0" min="1" style="width:100%"  min="1" max="12" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter mounth" required>
                    </div>
                    <div id="employees">
                        <div class="form-group ">
                            <label for="exampleInputEmail1">Employee 1</label>
                            <div class="row">
                                <div class="col-3">
                                    <input type="number" name="ID"  class="form-control employee_id_project " id="exampleInputPassword1"  placeholder="Enter ID" required>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="date" class="form-control" id="exampleInputPassword1"  placeholder="Enter Name" required>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputEmail1">Money</label>
                        <input type="number" name="money" class="form-control" style="width: 50%" id="exampleInputPassword1"  placeholder="Enter money" required>
                    </div>
                    <button class="btn btn-primary ">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    $error = Session::get('error_month');
    if ($error) {
    ?>
    <script>
        alertify.error('Month existed');
    </script>
    <?php 
    Session::put('error_month',null);
    }
    ?>
    <script>
        $(document).ready(function(){
            $( "#number_employee" ).change(function() {
                var number =  $( this ).val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: '{{url('/get_employee')}}',
                    type: 'post',
                    dataType: 'json',
                    data: {_token: _token ,number:number},
                    success: function (data) {
                        $('#employees').html(data);
                    }
                });
            }); 
        });
    </script>

@endsection