@extends('front/user/layout')
@section('page_title','Manage Videos')
@section('social_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
<style>
@media only screen   
   and (min-device-width : 360px)   
   and (max-device-width : 640px)  
   { 
   .width{
   width: 330px;
   }
   }
   /* For 1024 Resolution */  
   @media only screen   
   and (min-width: 1370px)  
   and (max-width: 1605px) 
   { 
   .width{
	width: 1000px;
   }
   }  
	</style>
@if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 	
	@if(session()->has('error'))
    <div class="sufee-alert alert with-close alert-danger">
        {{session('error')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 
<form action="{{route('user.manage_socialmedia_process')}}" method="post" enctype="multipart/form-data">
   @csrf
   <div class="profile_detail_block width">
    <input type="hidden" name="user_id" value="{{$social->user_id}}">
      <label>Facebook</label>
      <input type="text" name="facebook" value="{{$social->facebook}}" class="form-control" multiple id="gallery-photo-add">
      <label>Instagram</label>
      <input type="text" name="instagram" value="{{$social->instagram}}" class="form-control" multiple id="gallery-photo-add">
      <label>Linkedin</label>
      <input type="text" name="linkedin" value="{{$social->linkedin}}" class="form-control" multiple id="gallery-photo-add">
      <label>Twitter</label>
      <input type="text" name="twitter" value="{{$social->twitter}}" class="form-control" multiple id="gallery-photo-add">
      <div class="gallery" ></div>
      <div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
   </div>
</form>
@endsection