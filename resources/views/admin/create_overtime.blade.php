@extends('admin.admin_layout')
@section('content')
<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Tạo bảng làm thêm, lương thưởng,... dự án và tiền phạt cho nhân viên theo tháng 
                </h3>

            </div>
            <div class="card-content " style="display:flex; justify-content:center">
                <form action="{{url('/save_overtime')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1 " style="text-align: center" >Năm</label>
                        <input type="number" name="year_overtime" style="width:100%"  value="2021" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter mounth" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tháng</label>
                        <input type="number" name="mounth_overtime"  value="1" style="width:100%" class="form-control" min="1" max="12" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter mounth" required>
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
 
@endsection