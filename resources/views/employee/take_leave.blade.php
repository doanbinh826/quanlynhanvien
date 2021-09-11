@extends('employee.layout')
@section('content')
<h1>Please fill out the form</h1>
<form action="{{url('/send_leave')}}" method="POST">
    @csrf
        <div class="form-group " >
          <div class="row">
              <div class="col-sm-3">
                  <label for="exampleInputPassword1">Ngày</label>
                  <input type="number" name="date_leave" class="form-control" id="exampleInputPassword1"  placeholder="date" required>
              </div>
              <div class="col-sm-3">
                  <label for="exampleInputPassword1">Tháng</label>
                  <input type="number" name="month_leave" value="8" class="form-control" id="exampleInputPassword1"  placeholder="mounth" required>
              </div>
              <div class="col-sm-3">
                  <label for="exampleInputPassword1">Năm</label>
                  <input type="number" name="year_leave" value="2021" class="form-control" id="exampleInputPassword1"  placeholder="year" required>
              </div>
          </div>
        <div class="form-group ">
          <label for="exampleFormControlInput1">Số ngày</label>
          <input type="number" name="number_day" style="width:50%" class="form-control" id="exampleFormControlInput1" required>
      </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Lý do </label>
      <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Gửi</button>
  </form>
  <?php
    $success = Session::get('success');
    if($success){
    ?>
    <script>
        alertify.success('Success message');
    </script>
    <?php
     Session::put('success',null);
    }
    ?>


    <?php
    $error = Session::get('error');
    if($error){
    ?>
    <script>
        alertify.error('THáng làm việc chưa tồn tại!');
    </script>
    <?php
     Session::put('error',null);
    }
    ?>
@endsection