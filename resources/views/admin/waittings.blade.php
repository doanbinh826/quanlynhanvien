@extends('admin.admin_layout')
@section('content')

<div class="card">
    <div class="card-header">
      <a href="{{url('all_request_leave')}}" type="button" class="btn btn-danger"> Back</a>
      <br><br>
        <h3>
            Đơn xin nghỉ phép cần duyệt
        </h3>

    </div>
    <div class="card-content">
      @foreach($waittings as $waitting)
      <form action="{{url('/not_accept/'.$waitting->employee_id)}}" method="POST">
        @csrf
  <div>
      <div class="table-responsive ">
          <table class="table table-bordered">
              <thead>
                  <tr> 
                      <th scope="col">Họ và tên </th>
                      <td  style="color:blue">{{$waitting -> employee_name}} </td>
                    </tr>
                  <tr> 
                      <tr> 
                          <th scope="col">Email</th>
                          <td >{{$waitting -> email}} </td>
                        </tr>
                      <tr> 
                    <th scope="col">Thời gian</th>
                    <td><em>{{$waitting -> date_leave}}/{{$waitting -> month_leave}}/{{$waitting ->year_leave}} </em> <strong>( {{$waitting -> number_day}} ngày)</strong></td>
                  </tr>
                  <tr> 
                      <th scope="col" >Lý do </th>
                      <td>{{$waitting->reason}}</td>
                    </tr>
                </thead>
          </table>
        </div>
  </div><div class="text-center" >
    <a type="button" href="{{url('/accept/'.$waitting->employee_id)}}" class="btn btn-success">Chấp nhận</a>
    <a  type="button" data-toggle="modal" data-target="#myModal"   style="margin-left:20px" class="btn btn-danger">Không chấp nhận</a>
  </div>
  <hr>
  @endforeach
  </div>
</div>
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog" style="padding-top: 200px">
      
        <!-- Modal content-->
       
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Lý do không chấp nhận</h4>
          </div>
          <div class="modal-body">
            <textarea type="text" name="reason_not_accept" style="width: 100%" rows="5" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 20px">Close</button>
            <button type="submit" class="btn btn-primary">Gửi</button>
          </div>
        </div>
        
      </div>
    </div>   
  </div>
  </form>
@endsection
