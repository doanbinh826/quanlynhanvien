@extends('employee.layout')
@section('content')
    @foreach($considers as $consider)
    <div>
        <div class="table-responsive ">
            <table class="table table-bordered">
                <thead>
                    <tr> 
                        <th scope="col">Status</th>
                        <td>
                            @if($consider -> status_leave == 0)
                            <em style="color: blue">Đang đợi duyệt...</em>
                            @elseif($consider -> status_leave ==1)
                            <em style="color: #00e600">Được chấp nhận</em>
                            @else
                            <em style="color: red">Không chấp nhận</em>
                            @endif
                        </td>
                      </tr>
                    <tr> 
                      <th scope="col">Thời gian</th>
                      <td><em>{{$consider -> date_leave}}/{{$consider -> month_leave}}/{{$consider ->year_leave}} </em> <strong>( {{$consider -> number_day}} days)</strong> </td>
                    </tr>
                    <tr> 
                        <th scope="col" >Lý do</th>
                        <td>{{$consider->reason}}</td>
                    </tr>
                    @if($consider -> status_leave == 2)
                    <tr> 
                      <th scope="col" style="color: red">Lý do từ chối </th>
                      <td><em>{{$consider->reason_not}}</em></td>
                    </tr>
                    @endif
                  </thead>
                 
            </table>
          </div>
    </div>
    <hr>
    @endforeach
@endsection