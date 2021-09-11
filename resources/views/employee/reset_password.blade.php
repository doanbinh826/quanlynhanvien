@extends('employee.layout')
@section('content')
    <form action="{{url('save_password/'.$email)}}" method="POST">
        @csrf
        <h3>{{$email}}</h3>
        <label>Mật khẩu </label>
        <input name="new_password" type="password" class="form-control" placeholder="Enter new password" required>
        <input name="confirm_password" type="password" class="form-control" placeholder="Confirm new password" required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    

    <?php 
        $reset_error = Session::get('reset_error');
        if ($reset_error) {
    ?>
    <p style="color: red">Nhập lại mật khẩu không chính xác!</p>
    <?php 
        }
        Session::put('reset_error',null);
    ?>
@endsection