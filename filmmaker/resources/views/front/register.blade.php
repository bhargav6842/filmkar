@extends('front/layout')
@section('page_title','Register')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
  .d-none{
    display: none;
  }
  </style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Create an Account</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> SignUp</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container">
      <div class="log-box">
        <form class="log-form" action="{{route('user.user_register')}}" method="post">
            @csrf
            <div class="col-md-12">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" onkeypress="return AvoidSpace(event);" onblur="this.value=removeSpaces(this.value);"class="form-control" placeholder="username" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" placeholder="first name" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" placeholder="last name" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phonenumber" class="form-control" placeholder="Phone number" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="c_password" class="form-control" placeholder="confirm Password" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Gender</label>
                <select class="wide form-control br-1" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <div id="output"></div>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" required>
                    <option disabled selected>Please Select State</option>
                    @foreach($state as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <select class="wide form-control br-1" name="city_id" id="city_id" required>
                <option disabled selected>Please Select City</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Telent Categories</label>
                <select class="wide form-control br-1 label ui selection fluid dropdown" name="categories[]" id="categories" required multiple>
                <option disabled>Please Select Categories</option>
                    @foreach($category as $list)
                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                    @endforeach
                </select>
            <!-- <a href="javascript:;" onclick="selectcat()" id="add">Add</a> -->
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Subcategory</label>
                <select class="wide form-control br-1 wide form-control br-1 label ui selection fluid dropdown" id="subcat" name="categories[]" required multiple>
                <option disabled>Please Select subcategory</option>
                </select>
              </div>
            </div>
            <div class="d-none" id="div">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Eye Color</label>
                  <select class="wide form-control br-1 " id="eyecolor" name="eyecolor">
                  <option value="Black">Black</option>
                  <option value="Blue">Blue</option>
                  <option value="Brown">Brown</option>
                  <option value="Green">Green</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Hair Color</label>
                  <select class="wide form-control br-1 " id="haircolor" name="haircolor">
                  <option value="Black" >Black</option>
                  <option value="Brown" >Brown</option>
                  <option value="Gray" >Gray</option>
                  <option value="Red" >Red</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Dress Size</label>
                  <select class="wide form-control br-1 " id="dresssize" name="dresssize">
                  <option value="XS/38">XS/38</option>
                  <option value="S/39">S/39</option>
                  <option value="M/40">M/40</option>
                  <option value="L/42">L/42</option>
                  <option value="XL/44">XL/44</option>
                  <option value="2XL/46">2XL/46</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Shoe Size</label>
                <input type="number" name="shoesize" id="shoesize" min="4" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Hair Type</label>
                <select class="wide form-control br-1 " id="hairtype" name="hairtype">
                  <option value="Short">Short</option>
                  <option value="Long">Long</option>
                  <option value="Medium">Medium</option>
                  </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Talent Height in CM</label>
                <input type="number" name="talent_height_in_CM" id="talent_height_in_CM" min="100" class="form-control" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Waist in CM</label>
                <input type="number" name="waist_in_CM" id="waist_in_CM" min="30" class="form-control">
              </div>
            </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Languages Spoken</label>
                <select name="language[]" id="language" class="wide form-control br-1 label ui selection fluid dropdown" multiple required>
                <option disabled >Please Select Languages</option>
                    @foreach($language as $list)
                    <option value="{{$list->id}}">{{$list->language}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Birthdate</label>
                <input type="date" name="birthdate" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Years Of Experience</label>
                <input type="number" name="year_of_experience" min="1" class="form-control" placeholder="Years Of Experience" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>About You</label>
                <textarea type="text" id="aboutyou" name="about_you" class="form-control" required placeholder="Tell us about your self"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Sign Up</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
      </div>
  </div>
</section>
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


</script>

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

        /* Not Allow Spcace Type in textbox */
function AvoidSpace(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}

/* Remove Blank Space Automatically Before, After & middle of String */

function removeSpaces(string) {
 return string.split(' ').join('');
}
    </script>
@endsection
