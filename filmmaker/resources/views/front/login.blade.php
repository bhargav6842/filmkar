@extends('front/layout')
@section('page_title','Login')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
    .none{
        display: none;
    }
    </style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Login an Account</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Login</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container">
      <div class="log-box">
      @if(session()->has('error'))
    <div class="sufee-alert alert with-close alert-danger">
        {{session('error')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 	
    <div class="col-md-6">
              <div class="form-group">
              <button type="submit" id="btn-telent" onclick="telent()" class="btn  btn-m full-width">Login as Telent</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <button type="submit" id="btn-organisation" onclick="organisation()" class="btn  btn-m full-width">Login as Organisation</button>
              </div>
            </div>
        <form class="log-form none" action="{{route('user.auth')}}" method="post" id="telent">
            @csrf
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="username" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="password" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Login</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
        <form class="log-form none" action="{{route('organisation_user.auth')}}" id="organisation" method="post">
            @csrf
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="username" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="password" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Login</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
      </div>
  </div>
</section>
<script>
  function telent() {
    $("#telent").removeClass("none");
    $("#organisation").addClass("none");
    $("#btn-telent").addClass("theme-btn");
    $("#btn-organisation").removeClass("theme-btn");
  }
  function organisation() {
    $("#organisation").removeClass("none");
    $("#telent").addClass("none");
    $("#btn-organisation").addClass("theme-btn");
    $("#btn-telent").removeClass("theme-btn");
  }
  </script>
@endsection
