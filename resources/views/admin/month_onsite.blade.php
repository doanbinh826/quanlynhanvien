@extends('admin.admin_layout')
@section('content')
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-content">
        <div class="row">
            @foreach ($months as $month)
                <div class="col-lg-2">
                    <a href="{{url('edit_onsite_month/'.$month->month."/".$month->year)}}" type="button" class="btn btn-primary" style="width: 100%; height: 50px;font-size:20px">
                        {{$month->month}}/{{$month->year}}
                    </a>
                </div>
            @endforeach
            
        </div>
    </div>
</div>
@endsection