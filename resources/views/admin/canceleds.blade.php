@extends('admin.admin_layout')
@section('content')


<div class="card">
    <div class="card-header">
        <a href="{{url('all_request_leave')}}" type="button" class="btn btn-danger"> Back</a>
        <br><br>
        <h3>
            Đơn xin nghỉ phép đã hủy
        </h3>
    </div>
    <div class="card-content">
      @foreach($canceleds as $canceled)
      <div class="table-responsive ">
          <table class="table table-bordered">
              <thead>
                  <tr> 
                    <th scope="col">Họ và tên </th>
                    <td  style="color:blue">{{$canceled -> employee_name}} </td>
                  </tr> 
                  <tr> 
                    <th scope="col">Email</th>
                    <td >{{$canceled -> email}} </td>
                  </tr>
                  <tr>
                    <th scope="col">Thời gian</th>
                    <td><em>{{$canceled -> date_leave}}/{{$canceled -> month_leave}}/{{$canceled ->year_leave}} </em> <strong>( {{$canceled -> number_day}} ngày)</strong></td>
                  </tr>
                  <tr> 
                    <th scope="col" >Lý do </th>
                    <td>{{$canceled->reason}}</td>
                  </tr>
                  <tr> 
                    <th scope="col" style="color: red">Lý do không chấp nhận</th>
                    <td>{{$canceled->reason_not}}</td>
                  </tr>
                </thead>
          </table>
      </div>
    </div>
  @endforeach
</div> 
@endsection