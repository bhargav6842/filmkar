@extends('front/organize/layout')
@section('page_title','Manage Profile')
@section('manageprofile_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
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
    <form class="log-form" action="{{route('organize.manage_profile_process')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$organize_user->id}}">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="{{$organize_user->email}}" class="form-control" placeholder="username" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{$organize_user->name}}" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" value="{{$organize_user->company}}" class="form-control" placeholder="Company" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Representer</label>
                <select class="form-control" name="representer_id">
                    <option disabled selected>Select Representers</option>
                    @foreach($representers as $list)
                    @if($organize_user->representer_id==$list->id)
                    <option selected value="{{$list->id}}">
                        @else
                    <option value="{{$list->id}}">
                        @endif
                        {{$list->representers}}
                    </option>
                    @endforeach
                   
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>About Company</label>
                <textarea name="about_company" class="form-control" placeholder="About Company" required>{{$organize_user->about_company}}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" required>
                    <option disabled selected>Please Select State</option>
                    @foreach($state as $list)
				@if($organize_user->state_id==$list->id)
				<option selected value="{{$list->id}}">
					@else
				<option value="{{$list->id}}">
					@endif
					{{$list->name}}
				</option>
				@endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <select class="wide form-control br-1" name="city_id" id="city_id" required>
                @if($usercity != null)
				<option selected value="{{$usercity->id}}">
				@endif
					{{$usercity->city}}
					@foreach($cityarr as $list)
					<option value="{{$list->id}}">{{$list->city}}</option>
					@endforeach
				</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Zipcode</label>
                <input type="text" name="zipcode" value="{{$organize_user->zipcode}}" class="form-control" placeholder="zipcode" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Website</label>
                <input type="text" name="website" value="{{$organize_user->website}}" class="form-control" placeholder="website" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Phone No</label>
                <input type="text" name="phone_no" value="{{$organize_user->phone_no}}" class="form-control" placeholder="phonenumber" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Whatsapp No</label>
                <input type="text" name="whatsapp_no" value="{{$organize_user->whatsapp_no}}" class="form-control" placeholder="phonenumber">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">update</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
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
