<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mebel CRM tizimi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
	<link href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    @yield('styles')

</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                {{-- <img class="logo-compact" src="{{ asset('images/logo.png') }}" alt=""> --}}
                <img class="brand-title" src="{{ asset('images/logo.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <img class="brand-title" width="320" height="34" src="{{ asset('images/logo.png') }}" alt="">
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
                                    <img src="{{ asset('assets/images/avatar/10.webp') }}" width="20" alt=""/>
									<div class="header-info">
										<span> {{ auth()->user()->name }}
                                            @if (auth()->user()->role == "admin") <strong> - Admin </strong>
                                                    @elseif (auth()->user()->role == "seller") <strong> - Sotuvchi </strong>
                                                    @elseif (auth()->user()->role == "manager") <strong> - Boshqaruvchi </strong>
                                                    @elseif (auth()->user()->role == "controller") <strong> - Nazoratchi </strong>
                                                    @elseif (auth()->user()->role == "client") <strong> - Mijoz </strong>
                                            @endif
                                        </span>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:;" onclick="document.getElementById('logout').submit();" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                    <form action="{{ route('logout') }}" id="logout" method="POST" style="display: none;">
                                        {{csrf_field()}}
                                   </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @if (auth()->user()->role != "client")
            <div class="deznav">
                <div class="deznav-scroll">
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="{{ route('index') }}" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Bosh sahifa</span>
                            </a>
                        </li>
                        @if (auth()->user()->role == "seller" || auth()->user()->role == "admin")
                        <li>
                            <a href="{{ route('order') }}" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Buyurtma qo'shish</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('get.users') }}" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Foydalanuvchilar</span>
                            </a>
                        </li>
                        @if (auth()->user()->role == "admin")
                        <li>
                            <a href="{{ route('get.archives') }}" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Arxiv</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <div class="deznav">
                <div class="deznav-scroll">
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="javascript:;" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Cheklangan huquq</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        <!--**********************************
            Sidebar end
        ***********************************-->
        @yield('content')


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://float.uz">Float Lab</a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
	<script src="{{ asset('assets/js/deznav-init.js') }}"></script>
	<script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.js') }}"></script>

	<!-- Apex Chart -->
	<script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

	<!-- Dashboard 1 -->
	<script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
	<script>
		function assignedDoctor()
		{

			/*  testimonial one function by = owl.carousel.js */
			jQuery('.assigned-doctor').owlCarousel({
				loop:false,
				margin:30,
				nav:true,
				autoplaySpeed: 3000,
				navSpeed: 3000,
				paginationSpeed: 3000,
				slideSpeed: 3000,
				smartSpeed: 3000,
				autoplay: false,
				dots: false,
				navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
				responsive:{
					0:{
						items:1
					},
					576:{
						items:2
					},
					767:{
						items:3
					},
					991:{
						items:2
					},
					1200:{
						items:3
					},
					1600:{
						items:5
					}
				}
			})
		}

		jQuery(window).on('load',function(){
			setTimeout(function(){
				assignedDoctor();
			}, 1000);
		});

	</script>

</body>
</html>

