<html lang="en">
<head>
  <title>Quản lý nhân viên </title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    
</head>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    
    /* Full-width input fields */
    input[type=email], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    /* Set a style for all buttons */
    #login {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    
    #login:hover {
      opacity: 0.8;
    }
    
    /* Extra styles for the cancel button */
    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }
    
    /* Center the image and position the close button */
    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
      position: relative;
    }

    .container {
      padding: 16px;
    }
    
    span.psw {
      float: right;
      padding-top: 16px;
    }
    
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      padding-top: 60px;
    }
    
    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
      border: 1px solid #888;
      width: 100%; /* Could be more or less, depending on screen size */
    }
    
    /* The Close Button (x) */
    .close {
      position: absolute;
      right: 25px;
      top: 0;
      color: #000;
      font-size: 35px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: red;
      cursor: pointer;
    }
    
    /* Add Zoom Animation */
    .animate {
      -webkit-animation: animatezoom 0.6s;
      animation: animatezoom 0.6s
    }
    
    @-webkit-keyframes animatezoom {
      from {-webkit-transform: scale(0)} 
      to {-webkit-transform: scale(1)}
    }
      
    @keyframes animatezoom {
      from {transform: scale(0)} 
      to {transform: scale(1)}
    }
    
    /* Change styles for span and cancel button on extra small screens */
    /* @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    } */
    </style>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="#" class="navbar-brand">TinaSoft</a>
                    </div>

                    <div class="navbar-collapse collapse"  id="mobile_menu">
                        <ul class="nav navbar-nav" style="margin-left: 100px;">
                            <li ><a href="{{url('/')}}">Trang chủ</a></li>
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Đơn xin nghỉ <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                  <?php
                                  $employee_id = Session::get('employee_id');
                                  if(isset($employee_id)){
                              ?>
                                   <li><a href="{{url('/take_leave')}}">Tạo đơn</a></li>
                              <?php 
                                  }else{
                              ?>
                                   <li><a onClick="take_login()">Tạo đơn</a></li>
                              <?php 
                                  }
                              ?>
                                  <li><a href="{{url('/consider')}}">Tất cả đơn</a></li>
                                </ul>
                            </li>

                            <?php
                                  $employee_id = Session::get('employee_id');
                                  if(isset($employee_id)){
                              ?>
                                   <li><a href="{{url('salary_project')}}">Lương</a></li>
                              <?php 
                                  }else{
                              ?>
                                   <li><a onClick="take_login()">Lương</a></li>
                              <?php 
                                  }
                              ?>
                              
                            
                        </ul>
                    
                        <ul class="nav navbar-nav navbar-right">
                          <?php
                                $employee_id = Session::get('employee_id');
                                $employee_name = Session::get('employee_name');
                                if(isset($employee_id) && isset($employee_name) ){
                            ?>
                                <li><a href="{{url('profile')}}"><span class="glyphicon glyphicon-user"></span> {{$employee_name}}</a></li>
                            <?php 
                                }else{
                            ?>
                                <li><a href=""><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                            <?php 
                                }
                            ?>
                            
                            <?php
                                $employee_id = Session::get('employee_id');
                                if(isset($employee_id)){
                            ?>
                                <li><a href="{{url('/logout')}}">Đăng xuất</a></li>
                            <?php 
                                }else{
                            ?>
                                <li><a href="#" onclick="document.getElementById('id01').style.display='block'" >Đăng nhập</a></li>
                            <?php 
                                }
                            ?>
                            

                            <div id="id01" class="modal" >
  
                                <form class="modal-content animate" action="{{url('/login')}}" method="post">
                                    @csrf
                                    <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                   
                                    </div>

                                    <div class="container" >
                                        <label for="email"><b>Email</b></label>
                                        <input type="email" placeholder="Enter Email" name="email" required>

                                        <label for="psw"><b>Password</b></label>
                                        <input type="password"  placeholder="Enter Password" name="password" required>
                                    
                                        <button id="login" type="submit">Login</button>
                                       
                                      
                                        </div>

                                        <div class="container" style="background-color:#f1f1f1">
                                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                        <span class="psw">Quên <a href="{{url('forgot_password')}}">mật khẩu?</a></span>
                                    </div>
                                </form>
                                </div>

                                <script>
                                        // Get the modal
                                    var modal = document.getElementById('id01');

                                        // When the user clicks anywhere outside of the modal, close it
                                    window.onclick = function(event) {
                                        if (event.target == modal) {
                                             modal.style.display = "none";
                                        }
                                    }
                                </script>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div style="margin-top:50px" class="container">
      @yield('content')
    </div> 

    <?php 
      $login_error = Session::get('login_error');
      if($login_error){
    ?>
    <script>
      alertify.error('Đăng nhập thật bại!');
    </script>
    <?php 
      Session::put('login_error',null);
      }
    ?>


    <script>
      function take_login(){
        alertify.error('You must login!');
      }
    </script>

</body>
</html>