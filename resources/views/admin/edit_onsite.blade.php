@extends('admin.admin_layout')
@section('content')


<div class="card">
    <div class="card-header">
    </div>
    <div  style="width: 40%; margin-left:30%">
        <table class=" card-content table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Năm</th>
                    <th>Tháng</th>
                    <th>Ngày</th>
                    <th>Tiền thưởng <em>(VND)</em></th>
                    <th></th>
                </tr>
                
            </thead>
            <tbody>
                @foreach ($onsites as $onsite)
                <form action="{{url('save_onsite')}}" method="post">
                    @csrf
                    <tr>
                        <td>{{$onsite->year_onsite}}</td>
                        <td>{{$onsite->month_onsite}}</td>
                        <td>{{$onsite->date_onsite}}</td>
                        <td>
                            <input name="date_onsite" type="hidden" class="form-control" value="{{$onsite->date_onsite}}">
                            <input name="year_onsite" type="hidden" class="form-control" value="{{$onsite->year_onsite}}">
                            <input name="month_onsite" type="hidden" class="form-control" value="{{$onsite->month_onsite}}">
                            <input name="money_onsite" type="number" class="form-control" value="{{$onsite->money_onsite}}">
                        </td>  
                        <td>
                            <button type="submit" class="btn btn-default text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                    </svg>
                            </button>
                        </td>  
                        
                    </tr>
                </form>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@endsection