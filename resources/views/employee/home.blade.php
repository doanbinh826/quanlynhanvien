@extends('employee.layout')
@section('content')
    <h1>welcome to Tinasoft</h1>
    <?php 
        $reset_success = Session::get('reset_success');
        if ($reset_success) {
    ?>
    <p style="color: blue">Bạn có thể đăng nhập!</p>
    <?php 
        }
        Session::put('reset_success',null);
    ?>
@endsection