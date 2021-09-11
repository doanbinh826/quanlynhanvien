@extends('employee.layout')
@section('content')
<div class="row">
    <div class="table-responsive col-lg-5">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <td>{{$employees->employee_name}}</td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td>{{$employees->user_name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$employees->email}}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{$employees->phone_number}}</td>
                </tr>
                <tr>
                     <th>Địa chỉ</th>
                     <td>{{$employees->address}}</td>
                </tr>  
            </thead>
        </table>
    </div>
    <div class="col-lg-1 text-center">
        <a type="button" class="edit_profile" data-url="{{url('edit_profile/'.$employees->employee_id)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </a>
    </div>
    <div class="col-lg-6" >
        <form action="{{url('save_profile/'.$employees->employee_id)}}" method="post"  >
            @csrf
            <div id="edit_profile">

            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.edit_profile').on('click',function(e){
            e.preventDefault();
            var _token = $('input[name= "_token"]').val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {_token: _token},
                success: function (data) {
                    $('#edit_profile').html(data);
                }
            })
        })
    })
</script>
@endsection