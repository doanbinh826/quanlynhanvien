 <!DOCTYPE html>
<html>
<head>
	<title>Trang quản lý Admin</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="assets/AT-pro-logo.png"/>

	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('back-end/fontawesome-free/css/all.min.css')}}">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<!-- End import lib -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('back-end/style.css')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


	
</head>
<body class="overlay-scrollbar">
	<form>
		@csrf
	</form>
	<!-- navbar -->
	<div class="navbar">
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
			<li class="nav-item">
				{{--  <img alt="ATPro logo" class="logo logo-light">
				<img alt="ATPro logo" class="logo logo-dark">  --}}
			</li>
		</ul>
		<!-- end nav left -->
		<!-- form -->
	
		{{-- <form class="navbar-search">
		
			<input type="text" name="Search" class="navbar-search-input" placeholder="What you looking for...">
			<i class="fas fa-search"></i>
		</form> --}}
		<!-- end form -->
		<!-- nav right -->
		<ul class="navbar-nav nav-right">
			<li class="nav-item mode">
				<a class="nav-link" href="#" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>
		
			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					{{--  <img src="assets/tuat.jpg" alt="User image" class="dropdown-toggle" data-toggle="user-menu">  --}}
					<ul id="user-menu" class="dropdown-menu">
						<li  class="dropdown-menu-item">
							<a class="dropdown-menu-link">
								<div>
									<i class="fas fa-user-tie"></i>
								</div>
								<span>Profile</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-cog"></i>
								</div>
								<span>Settings</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="far fa-credit-card"></i>
								</div>
								<span>Payments</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-spinner"></i>
								</div>
								<span>Projects</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span>Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<!-- end nav right -->
	</div>
	<!-- end navbar -->
	<!-- sidebar -->
	<div class="sidebar">
		<ul class="sidebar-nav">
			<li class="sidebar-nav-item">
				<a  href="{{url('/admin')}}" class="sidebar-nav-link active ">
					<div>
						<i class="fas fa-tachometer-alt"></i>
					</div>
					<span>
						Dashboard
					</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="{{url('/add_employee')}}" class="sidebar-nav-link ">
					<div>
						<i class="fab fa-accusoft"></i>
					</div>
					<span>Thêm Nhân viên</span>
				</a>
			</li>
        
			<li  class="sidebar-nav-item">
				<a href="{{url('/all_employee')}}" class="sidebar-nav-link">
					<div>
						<i class="fas fa-tasks"></i>
					</div>
					<span>Tất cả nhân viên</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="{{url('create_overtime')}}" class="sidebar-nav-link">
					<div>
						<i class="fas fa-spinner"></i>
					</div>
					<span>Làm thêm và Trừ lương</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="{{url('edit_onsite')}}" class="sidebar-nav-link">
					<div>
						<i class="fas fa-spinner"></i>
					</div>
					<span>Cập nhật tiền thưởng Onsite</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="{{url('/all_request_leave')}}" class="sidebar-nav-link">
					<div>
						<i class="fas fa-check-circle"></i>
					</div>
					<span>Đơn nghỉ phép</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="{{url('/all_salary')}}" class="sidebar-nav-link">
					<div>
						<i class="fas fa-check-circle"></i>
					</div>
					<span>Lương </span>
				</a>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div class="wrapper" style="background-color: darkgray">
    @yield('content')
	</div>
    <!-- import script -->
	<script src="{{asset('back-end/index.js')}}"></script>
	<!-- end import script -->
</body>
</html>  



