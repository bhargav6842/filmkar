@extends('front/user/layout')
@section('page_title','Manage Profile')
@section('manageprofile_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
<style>
	.d-none{
		display: none;
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
<form action="{{route('user.manage_profile_process')}}" method="post" enctype="multipart/form-data">
	@csrf
	<input name="id" type="hidden" value="{{$id}}">
<div class="profile_detail_block">
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" value="{{$username}}" placeholder="username">
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>First Name</label>
				<input type="text" class="form-control" name="firstname" value="{{$firstname}}" placeholder="Slogan">
			  </div>
			</div>          
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Last Name</label>
				<input type="text" class="form-control" name="lastname" value="{{$lastname}}" placeholder="mail@example.com">
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email" value="{{$email}}" placeholder="mail@example.com">
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Phone</label>
				<input type="text" class="form-control" name="phonenumber" value="{{$phonenumber}}" placeholder="123 214 13247">
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Gender</label>
				<select class="wide form-control" name="gender">
				  @if($gender=='male')
				  <option value="male" selected>Male</option>
				  <option value="female">Female</option>
				  @else
				  <option value="female" selected>Female</option>
				  <option value="male">Male</option>
				  @endif
				</select>
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Language</label>
				<select class="wide form-control label ui selection fluid dropdown" name="language[]" multiple="multiple">
				@foreach($languages as $onelan)
					@if(in_array($onelan->id, $lanarrselected))
					<option selected value="{{$onelan->id}}">
					@else
					<option value="{{$onelan->id}}">
					@endif
					{{$onelan->language}}</option>
					@endforeach
				</select>
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Profile</label>
				<input type="file" name="profile" id="image" class="form-control" onchange="loadFile(event)">
				<textarea name="base_profile_img" id="base_profile_img" style="display: none;"></textarea>
			  </div>
			  <img style="width: 150px;" id="output"/>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>State</label>
				<select class="wide form-control" name="state_id" id="state_id">
				@foreach($state as $list)
				@if($state_id==$list->id)
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
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <label>City</label>
			  <select class="wide form-control" id="city_id" name="city_id">
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
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Categories</label>
				<select class="wide form-control label ui selection fluid dropdown" name="categories[]" id="categories" multiple="multiple">
				@foreach($category as $onecat)
					@if(in_array($onecat->id, $catarrselected))
					<option selected value="{{$onecat->id}}">
					@else
					<option value="{{$onecat->id}}">
					@endif
					{{$onecat->category_name}}</option>
					@endforeach
					
				</select>
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
			  <label>Subcategory</label>
				<select class="wide form-control label ui selection fluid dropdown" id="subcat" name="categories[]" multiple="multiple">
				@foreach($subcatselected as $onesubcat)
				@if(in_array($onesubcat->id, $catarrselected))
				<option selected value="{{$onesubcat->id}}">
				@else
					<option value="{{$onesubcat->id}}">
					@endif
					{{$onesubcat->category_name}}</option>
					@endforeach
				</option>
				
				</select>
			  </div>
			</div>
			<div id="div" class="{{$dnone}}">
				<input type="hidden" name="attr_id" value="{{$attr_id}}">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Eye Color</label>
						<select class="wide form-control br-1 " id="eyecolor" name="eyecolor">
							<option value="Black" {{$eyecolor == 'Black' ? "selected" : ""}} >Black</option>
							<option value="Blue" {{$eyecolor == 'Blue' ? "selected" : ""}}>Blue</option>
							<option value="Brown" {{$eyecolor == 'Brown' ? "selected" : ""}}>Brown</option>
							<option value="Green" {{$eyecolor == 'Green' ? "selected" : ""}}>Green</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Hair Color</label>
						<select class="wide form-control br-1 " id="haircolor" name="haircolor">
							<option value="Black" {{$haircolor == 'Black' ? "selected" : ""}}>Black</option>
							<option value="Brown" {{$haircolor == 'Brown' ? "selected" : ""}}>Brown</option>
							<option value="Gray" {{$haircolor == 'Gray' ? "selected" : ""}}>Gray</option>
							<option value="Red" {{$haircolor == 'Red' ? "selected" : ""}}>Red</option>
                  		</select>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Dress Size</label>
						<select class="wide form-control br-1 " id="dresssize" name="dresssize">
							<option value="XS/38" {{$dresssize == 'XS/38' ? "selected" : ""}}>XS/38</option>
							<option value="S/39" {{$dresssize == 'S/39' ? "selected" : ""}}>S/39</option>
							<option value="M/40" {{$dresssize == 'M/40' ? "selected" : ""}}>M/40</option>
							<option value="L/42" {{$dresssize == 'L/42' ? "selected" : ""}}>L/42</option>
							<option value="XL/44" {{$dresssize == 'XL/44' ? "selected" : ""}}>XL/44</option>
							<option value="2XL/46" {{$dresssize == '2XL/46' ? "selected" : ""}}>2XL/46</option>
						</select>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Shoe Size</label>
                		<input type="number" value="{{$shoesize}}" name="shoesize" id="shoesize" min="4" class="form-control">
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Hair Type</label>
						<select class="wide form-control br-1 " id="hairtype" name="hairtype">
							<option value="Short" {{$hairtype == 'Short' ? "selected" : ""}}>Short</option>
							<option value="Long" {{$hairtype == 'Long' ? "selected" : ""}}>Long</option>
							<option value="Medium" {{$hairtype == 'Medium' ? "selected" : ""}}>Medium</option>
						</select>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Talent Height in CM</label>
                		<input type="number" value="{{$talent_height_in_CM}}" name="talent_height_in_CM" id="talent_height_in_CM" min="100" class="form-control" >
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Waist in CM</label>
                		<input type="number" value="{{$waist_in_CM}}" name="waist_in_CM" id="waist_in_CM" min="30" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Birthdate</label>
				<input type="date" class="form-control" name="birthdate" value="{{$birthdate}}" placeholder="username">
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>year of experience</label>
				<input type="text" class="form-control" min="1" name="year_of_experience" value="{{$year_of_experience}}" placeholder="Slogan">
			  </div>
			</div>  
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>About You</label>
                <textarea type="text" id="aboutyou" name="about_you" class="form-control" required placeholder="Tell us about your self">{{$about_you}}</textarea>
			  </div>
			</div>    
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
		</div>
		</form>
		<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js'></script>
    <script id="rendered-js">
        $('.label.ui.dropdown').
        dropdown();

        $('.no.label.ui.dropdown').
        dropdown({
            useLabels: false
        });


        $('.ui.button').on('click', function() {
            $('.ui.dropdown').
            dropdown('restore defaults');
        });
        //# sourceURL=pen.js
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script>
$("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
    });
});

$("#categories").change(function(){

var selected = [];
var selectedtext = [];
for (var option of document.getElementById('categories').options)
{
	if (option.selected) {
		selected.push(option.value);
		selectedtext.push(option.text.toLowerCase());
	}
}

// var category_box_1 = document.getElementById('category_box_1').value;
// alert(category_box_1);
$.get("/getsubcat?array="+selected, function(data){
	$("#subcat").html(data);
});

$.get("/getisattrcategory?array="+selected, function(data){
	if(data == 1){
	  $("#div").removeClass("d-none");
	  $("#eyecolor").attr('required', ''); 
	  $("#haircolor").attr('required', ''); 
	  $("#dresssize").attr('required', ''); 
	  $("#shoesize").attr('required', ''); 
	  $("#hairtype").attr('required', ''); 
	  $("#talent_height_in_CM").attr('required', ''); 
	  $("#waist_in_CM").attr('required', ''); 
	}else{
	  $("#div").addClass("d-none");
	}
});


});
</script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
   var loadFile = function(event) {
     var reader = new FileReader();
     reader.onload = function(){
       var output = document.getElementById('output');
       output.src = reader.result;
     };
     reader.readAsDataURL(event.target.files[0]);
   };
   $(document).ready(function () {
   CKEDITOR.replace('aboutyou');
   
});

var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
@endsection