<!DOCTYPE html>
<html class="" lang="zxx">

<!-- Mirrored from utouchdesign.com/themes/envato/escort/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Jan 2023 04:02:07 GMT -->
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FILMKAR - @yield('page_title')</title>

<!-- Favicon Icon -->
<link rel="shortcut icon" href="{{asset('assets/setting/Filmkar fevicon PNG Circle.png')}}" />

<!-- CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap-select.min.css')}}">
<link href="{{asset('assets/plugins/icons/css/icons.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap/css/bootsnav.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/plugins/nice-select/css/nice-select.css')}}">
<link href="{{asset('assets/plugins/aos-master/aos.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;display=swap" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css'>

<link rel="stylesheet" type="text/css" href="{{asset('assets/crop-image/iEdit.css')}}">
</head>
<body class="utf_skin_area">
<div class="page_preloader"></div>
<!-- ======================= Start Navigation ===================== -->
<!-- class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav" -->
<nav class="navbar navbar-default navbar-mobile navbar-fixed @yield('nav_class') bootsnav">
  <div class="container"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
      <a class="navbar-brand" href="{{route('home')}}"> <img src="assets/setting/logo-white.png" style="height: 60px; padding-bottom: 15px;" class="logo logo-display" alt=""> <img src="assets/setting/logo-black.png" style="height: 60px; padding-bottom: 15px;" class="logo logo-scrolled" alt=""> </a> 
	</div>
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
        <li class="dropdown @yield('home_select')"> <a href="{{route('home')}}">Home</a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse Telent</a>
          <ul class="dropdown-menu animated fadeOutUp">
            @foreach($category as $list)
            <li><a href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></li>
            @endforeach
          </ul>
        </li>
        <li class="dropdown @yield('contact_select')"> <a href="{{route('contact')}}">Contact</a> </li>
        <li class="dropdown @yield('blog_select')"> <a href="{{route('blog')}}">Blog</a> </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      @if(session()->has('USER_ID'))
      <li class="dropdown sign-up"> 
		  <a class="dropdown-toggle btn-signup red-btn" data-toggle="dropdown" href="#"> 
			<img src="" class="img-responsive img-circle" alt="">{{ Session::get('USER_NAME')}}
		  </a>
          <ul class="dropdown-menu animated fadeOutUp">
            <li><a href="{{route('user.dashboard')}}">Profile</a></li>
            <li><a href="{{route('user.logout')}}">Logout</a></li>
          </ul>
        </li>
          @elseif(session()->has('organisation_ID'))
          <li class="dropdown sign-up"> 
          <a class="dropdown-toggle btn-signup red-btn" data-toggle="dropdown" href="#"> 
          <img src="" class="img-responsive img-circle" alt="">{{ Session::get('organisation_NAME')}}
          </a>
          <ul class="dropdown-menu animated fadeOutUp">
            <li><a href="{{route('organize.dashboard')}}">Profile</a></li>
            <li><a href="{{route('user.logout')}}">Logout</a></li>
          </ul>
        </li>
          @else
          
        <li class="br-right"><a class="btn-signup red-btn" href="{{route('user.login')}}" ><i class="login-icon ti-user"></i>Login</a></li>
        <li class="dropdown"><a class="btn-signup red-btn dropdown-toggle" data-toggle="dropdown" ><span class="ti-briefcase"></span>Register As</a>
        <ul class="dropdown-menu animated fadeOutUp">
        <li class="sign-up"><a class="btn-signup red-btn"  href="{{route('user.register')}}"><span class="ti-user"></span>&nbsp;&nbsp;Talent</a>
            <li class="sign-up"><a class="btn-signup red-btn"  href="{{route('user.register.organisation')}}"><span class="ti-user"></span>&nbsp;&nbsp;Organisation</a>
          </ul>
        </li>
        
        </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- ======================= End Navigation ===================== --> 
@section('container')
@show
<!-- ================= footer start ========================= -->
<footer class="footer">
  <div class="container"> 
    <div class="row">
	  <div class="col-md-3 col-sm-4">
    <a href="/"><img class="footer-logo" src="{{asset('assets/setting/logo-color.png')}}" alt=""></a>
        <p>Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since.</p>
        <!-- Social Box -->
        <div class="f-social-box">
          <ul>
            <li><a href="#"><i class="fa fa-facebook facebook-cl"></i></a></li>
            <li><a href="#"><i class="fa fa-google google-plus-cl"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter twitter-cl"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram instagram-cl"></i></a></li>
          </ul>
        </div>        
      </div>	
      <div class="col-md-9 col-sm-8">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <h4>Job Categories</h4>
            <ul>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Work from Home</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Internship Job</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Freelancer Job</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Part Time Job</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Full Time Job</a></li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-6">
            <h4>Job Type</h4>
            <ul>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Create Account</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Career Counseling</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> My Oficiona</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Report a Problem</a></li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-6">
            <h4>Resources</h4>
            <ul>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> My Account</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Support</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> How It Works</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Underwriting</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Employers</a></li>
            </ul>
          </div>
		  <div class="col-md-3 col-sm-6">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Jobs Listing</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> About Us</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Privacy Policy</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Term & Condition</a></li>
            </ul>
          </div>
        </div>
      </div>      
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="copyright text-center">
          <p>Copyright © 2021 All Rights Reserved.</p>		  
        </div>
      </div>
    </div>
  </div>
</footer>


<div><a href="#" class="scrollup">Scroll</a></div>

<!-- Jquery js--> 
<script src="{{asset('assets/js/jquery.min.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/bootsnav.js')}}"></script> 
<script src="{{asset('assets/js/viewportchecker.js')}}"></script> 
<script src="{{asset('assets/js/slick.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/wysihtml5-0.3.0.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap-wysihtml5.js')}}"></script> 
<script src="{{asset('assets/plugins/aos-master/aos.js')}}"></script> 
<script src="{{asset('assets/plugins/nice-select/js/jquery.nice-select.min.js')}}"></script> 
<script src="{{asset('assets/crop-image/iEdit.js')}}"></script>
<script src="{{asset('assets/crop-image/script.js')}}"></script>
<script>
	$(window).load(function() {
	  $(".page_preloader").fadeOut("slow");;
	});
	AOS.init();
</script>
</body>

<!-- Mirrored from utouchdesign.com/themes/envato/escort/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Jan 2023 04:03:05 GMT -->
</html>