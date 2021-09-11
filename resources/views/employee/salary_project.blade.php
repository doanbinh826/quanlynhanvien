@extends('employee.layout')
@section('content')
    <div class="row">
        @foreach ($months as $month)
            <div class="col-lg-2">
                <a href="{{url('view_month/'.$month->month_deduction."/".$month->year_deduction)}}" type="button" class="btn btn-primary" style="width: 100%; height: 50px;font-size:20px">
                    {{$month->month_deduction}}/{{$month->year_deduction}}
                </a>
            </div>
        @endforeach
    </div>
@endsection