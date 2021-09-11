@extends('admin.admin_layout')
@section('content')

<div class="card">
    <div class="card-header">
      <a href="{{url('all_request_leave')}}" type="button" class="btn btn-danger"> Back</a>
      <br><br>
        <h3>
            Đơn xin nghỉ phép đã duyệt
        </h3>
    </div>
    <div class="card-content">
      @foreach($accepteds as $accepted)
      <div class="table-responsive ">
          <table class="table table-bordered">
              <thead>
                  <tr> 
                    <th scope="col">Họ và tên </th>
                    <td  style="color:blue">{{$accepted -> employee_name}} </td>
                  </tr> 
                  <tr> 
                    <th scope="col">Email</th>
                    <td >{{$accepted -> email}} </td>
                  </tr>
                  <tr>
                    <th scope="col">Thời gian</th>
                    <td><em>{{$accepted -> date_leave}}/{{$accepted -> month_leave}}/{{$accepted ->year_leave}} </em> <strong>( {{$accepted -> number_day}} ngày)</strong></td>
                  </tr>
                  <tr> 
                    <th scope="col" >Lý do </th>
                    <td>{{$accepted->reason}}</td>
                  </tr>
                </thead>
          </table>
      </div>
    </div>
  @endforeach
</div> 
@endsection