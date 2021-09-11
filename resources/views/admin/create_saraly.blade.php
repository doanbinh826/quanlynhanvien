@extends('admin.admin_layout')
@section('content')
<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create Salary for Employee
                </h3>

            </div>
            <div class="card-content">
                <form action="{{url('/save_salary')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name Employee</label>
                        <input type="text" name="employee_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" name="employee_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ID Employee" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Time to Start Work</label>
                        <div class="row">
                            <div class="col-3">
                                <label for="exampleInputPassword1">Date</label>
                                <input type="number" name="date" class="form-control" id="exampleInputPassword1"  placeholder="date" required>
                            </div>
                            <div class="col-3">
                                <label for="exampleInputPassword1">Mounth</label>
                                <input type="number" name="mounth" value="8" class="form-control" id="exampleInputPassword1"  placeholder="mounth" required>
                            </div>
                            <div class="col-3">
                                <label for="exampleInputPassword1">Year</label>
                                <input type="number" name="year" value="2021" class="form-control" id="exampleInputPassword1"  placeholder="year" required>
                            </div>
                        </div>
                        
                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Salary hard</label>
                        <input type="text" name="hard_salary" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter salary" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Day Works</label>
                        <input type="text" name="day_works" class="form-control" id="exampleInputPassword1" placeholder="Day works" required> 
                    </div>
                    
                    <button class="btn btn-primary ">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    $error = Session::get('error');
    if ($error) {
    ?>
    <script>
        alertify.error('ID Employee existed');
    </script>
    <?php 
    Session::put('error',null);
    }
    ?>
@endsection