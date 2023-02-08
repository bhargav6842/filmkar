@extends('front/layout')
@section('page_title','Register')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Login an Account</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Register organisation</p>
    </div>
  </div>
</div>
@if(session()->has('error'))
    <div class="sufee-alert alert with-close alert-danger">
        {{session('error')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 
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
        <form class="log-form" action="{{route('organisation.register')}}" method="post">
            @csrf
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="username" required>
                @error('email')
                  <div class="alert alert-danger" role="alert">
                      {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="password" required>
                @error('password')
                  <div class="alert alert-danger" role="alert">
                      {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" class="form-control" placeholder="Company" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Representer</label>
                <select class="form-control" name="representer_id">
                    <option disabled selected>Select Representers</option>
                    @foreach($representers as $list)
                    <option value="{{$list->id}}">{{$list->representers}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>About Company</label>
                <textarea name="about_company" class="form-control" placeholder="About Company" required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>State</label>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" required>
                    <option disabled selected>Please Select State</option>
                    @foreach($state as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>City</label>
                <select class="wide form-control br-1" name="city_id" id="city_id" required>
                <option disabled selected>Please Select City</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Zipcode</label>
                <input type="text" name="zipcode" class="form-control" placeholder="zipcode" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Website</label>
                <input type="text" name="website" class="form-control" placeholder="website" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Phone No</label>
                <input type="text" name="phone_no" class="form-control" placeholder="phonenumber" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Whatsapp No</label>
                <input type="text" name="whatsapp_no" class="form-control" placeholder="phonenumber">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Register</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
      </div>
  </div>
</section>
<script>
$("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
    });
});
</script>
@endsection