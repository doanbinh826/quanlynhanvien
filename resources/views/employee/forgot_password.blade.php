@extends('employee.layout')
@section('content')
    
    <?php 
        $recover_error = Session::get('recover_error');
        if ($recover_error) {
    ?>
    <p style="color: red">Email không tồn tại!</p>
    <?php 
        }
        Session::put('recover_error',null);
    ?>
    <form action="{{url('recover_password/')}}" method="POST">
        @csrf
        <label>Your Email</label>
        <input name="recover" type="email" class="form-control" placeholder="Enter email" required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php 
        $recover_success = Session::get('recover_success');
        if ($recover_success) {
    ?>
    <p style="color: blue">Bạn vui lòng kiểm tra email để reset lại mật khẩu!</p>
    <?php 
        }
        Session::put('recover_success',null);
    ?>
@endsection