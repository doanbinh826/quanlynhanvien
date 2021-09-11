@extends('admin.admin_layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>
           Taas cả nhân viên
        </h3>

    </div>
    <div class="card-content">
        <table class="table table-border table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ và tên </th>
                    <th>User Name</th>
                    <th>Ảnh đại diện</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Lương cứng</th>
                    <th>Số ngày làm việc </th>
                    <th>Active</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i =0;
                ?>
                @foreach($all_employees as $employee)
                <tr>
                    <td>
                        <?php
                        $i++;
                        echo $i; 
                        ?>
                    </td>
                    <td> {{$employee->employee_name}} </td>
                    <td>{{$employee->user_name}} </td>
                    <td>
                        <img src="{{url('public/upload/'.$employee->image_profile)}}" width="120px" height="80px">
                    </td>
                    <td>{{$employee->email}} </td> 
                    <td>{{$employee->phone_number}} </td>
                    <td>{{$employee->address}} </td>
                    <td>{{$employee->position}} </td>
                    <td>{{$employee->hard_salary}} </td>
                    <td>{{$employee->day_works}} </td>
                    <td>
                        @if($employee->status == 0)
                        <a type="button" href="{{url('on_active/'.$employee->employee_id)}}" class="btn btn-success">ON</a>
                        @else
                        <a type="button" href="{{url('off_active/'.$employee->employee_id)}}" class="btn btn-danger">OFF</a>
                        @endif
                    </td>
                
                    <td>
                        <a href="{{url('edit_employee/'.$employee->employee_id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg>
                        </a>
                    </td>
                    <td>
                        <a type="button" data-url="{{url('delete_employee/'.$employee->employee_id)}}" class="delete">
                            <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                              </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('.delete').on('click',function (e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var url = $(this).data('url');
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',

            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: {_token: _token},
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            })
        })
    })


</script>
@endsection
