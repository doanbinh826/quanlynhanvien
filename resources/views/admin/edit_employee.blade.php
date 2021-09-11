@extends('admin.admin_layout')
@section('content')

<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Employee
                </h3>

            </div>
            <div class="card-content">
                <form action="{{url('/post_edit/'.$edit_employee->employee_id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên</label>
                        <input type="text" name="name" value="{{$edit_employee->employee_name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User_name</label>
                        <input type="text" name="user_name" value="{{$edit_employee->user_name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập user name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ảnh đại diện</label>
                        <input type="file" name="image_profile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chọn ảnh" required>
                        <img src="{{url('public/upload/'.$edit_employee->image_profile)}}" width="120px" height="80px">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" value="{{$edit_employee->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="text" name="phone_number" value="{{$edit_employee->phone_number}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mật khẩu</label>
                        <input type="password" name="password"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập mật khẩu" required>
                    </div>
                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" name="address" value="{{$edit_employee->address}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Chức vụ</label>
                        <select name="position"  class="form-control" style="width:50%">
                            <option  value ="management" >Quản lý</option>
                            <option value="employee_official">Nhân viên chính thức</option>
                            <option value="employee_parttime">Nhân viên Parttime</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lương cứng </label>
                        <input type="number" name="hard_salary" value="{{$edit_employee->hard_salary}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập lương cứng " required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Số ngày làm việc </label>
                        <input type="number" name="day_works" value="{{$edit_employee->day_works}}" class="form-control" id="exampleInputPassword1" placeholder="Nhập số ngày làm việc" required> 
                    </div>
                    <button class="btn btn-primary " type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection