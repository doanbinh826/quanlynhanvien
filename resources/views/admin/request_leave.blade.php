@extends('admin.admin_layout')
@section('content')

<div class="card">
    <div class="card-header">
        <h3>
            Đơn xin nghỉ phép
        </h3>
    </div>
    <div class="card-content row text-center">
        <div class="col-sm-4">
            <a href="{{url('waiting_accept')}}" type="button" class="btn btn-primary">
                Đang đợi duyệt<br>
                ({{count($waittings)}})
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{url('accepted')}}" type="button" class="btn btn-success">
                Đã chấp nhận<br>
                ({{count($accepteds)}})
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{url('canceled')}}" type="button" class="btn btn-danger">
                Đã hủy<br>
                ({{count($canceleds)}})
            </a>
        </div>
    </div>
</div>
@endsection