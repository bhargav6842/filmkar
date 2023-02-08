@extends('front/layout')
@section('page_title','Film Maker')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
@extends('front/layout')
@section('page_title','Film Maker')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Profile Settings</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Profile Settings</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3">
		<div id="leftcol_item">
			@if(isset($profile) != '')
		  <div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('assets/profile/'.$profile)}}"> <span class="user-photo-action">{{ Session::get('USER_NAME')}}</span> </div>
		  @else
		  <div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('assets/profile/default_avatar.jpg')}}"> <span class="user-photo-action">{{ Session::get('USER_NAME')}}</span> </div>
		  @endif
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li class="@yield('dashboard_select')"><a href="{{route('user.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li class="@yield('manageprofile_select')"><a href="{{route('organize.manage_profile')}}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
			<li class="@yield('password_select')"><a href="{{route('organize.change_password')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
			<li><a href="{{route('user.logout')}}"><i class="login-icon ti-power-off"></i> Logout</a></li>
		  </ul>
		</div>
	  </div>
	  <div class="col-md-9">
      @section('organizecontainer')
    @show
      </div>	  
    </div>
  </div>
</section>
@endsection

@endsection
