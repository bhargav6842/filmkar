@extends('front/user/layout')
@section('page_title','Manage Videos')
@section('gallery_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
<style>
   .imagesize{
   width: 150px;
   height: 150px;
   }
   @media only screen   
   and (min-device-width : 360px)   
   and (max-device-width : 640px)  
   { 
   .width{
   width: 330px;
   }
   .deletebtn{
    position: fixed;
    top: -185px;
    left: 290px;
    color: black;
    text-decoration: none;
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
   h1{
  font-family: Satisfy;
  font-size:50px;
  text-align:center;
  color:black;
  padding:1%;
}
#gallery{
  -webkit-column-count:4;
  -moz-column-count:4;
  column-count:4;
  
  -webkit-column-gap:20px;
  -moz-column-gap:20px;
  column-gap:20px;
}
@media (max-width:1200px){
  #gallery{
  -webkit-column-count:3;
  -moz-column-count:3;
  column-count:3;
    
  -webkit-column-gap:20px;
  -moz-column-gap:20px;
  column-gap:20px;
}
}
@media (max-width:800px){
  #gallery{
  -webkit-column-count:2;
  -moz-column-count:2;
  column-count:2;
    
  -webkit-column-gap:20px;
  -moz-column-gap:20px;
  column-gap:20px;
}
}
@media (max-width:600px){
  #gallery{
  -webkit-column-count:1;
  -moz-column-count:1;
  column-count:1;
}  
}
#gallery img,#gallery video {
  width:100%;
  height:auto;
  margin: 4% auto;
  box-shadow:-3px 5px 15px #000;
  cursor: pointer;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}
.modal-img,.model-vid{
  width:100%;
  height:auto;
}
.modal-body{
  padding:0px;
}
.img-wraps {
    position: relative;
    /* display: inline-block; */
    
    font-size: 0;
}
.img-wraps .closes {
    position: absolute;
    top: 10px;
    right: 8px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
     
    color: #000;
    font-weight: bold;
    cursor: pointer;
    
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    /* border-radius: 50%; */
    /* border:1px solid red; */
}
.img-wraps:hover .closes {
    opacity: 1;
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
<form action="{{route('user.manage_gallery_process')}}" method="post" enctype="multipart/form-data">
   @csrf
   <div class="profile_detail_block width">
      <label>Select Photos</label>
      <input type="file" name="image[]" class="form-control" multiple id="gallery-photo-add">
      <div class="gallery" ></div>
      <div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
   </div>
</form>
<br>
<h1>Gallery</h1><hr>

@if($galleryArr != '')
<div id="gallery" class="container-fluid">  
@foreach($galleryArr as $list)
<div class="img-wraps">
  <img src="{{asset('assets/gallery/'.$username.'/'.$list->image)}}" class="img-responsive">
  <!-- <a href="#" class="deletebtn"><i class="login-icon ti-trash"></i></a> -->
  <a href="{{url('user/gallery/delete/')}}/{{$list->id}}" class="closes" title="Delete">×</a>
</div>

@endforeach

</div>
@endif


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>

  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
   $(function() {
   // Multiple images preview in browser
   var imagesPreview = function(input, placeToInsertImagePreview) {
   
       if (input.files) {
           var filesAmount = input.files.length;
   
           for (i = 0; i < filesAmount; i++) {
               var reader = new FileReader();
   
               reader.onload = function(event) {
                   $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'imagesize').appendTo(placeToInsertImagePreview);
               }
   
               reader.readAsDataURL(input.files[i]);
           }
       }
   
   };
   
   $('#gallery-photo-add').on('change', function() {
       imagesPreview(this, 'div.gallery');
   });
   });

   $(document).ready(function(){
  $("img").click(function(){
  var t = $(this).attr("src");
  $(".modal-body").html("<img src='"+t+"' class='modal-img'>");
  $("#myModal").modal();
});

$("video").click(function(){
  var v = $("video > source");
  var t = v.attr("src");
  $(".modal-body").html("<video class='model-vid' controls><source src='"+t+"' type='video/mp4'></source></video>");
  $("#myModal").modal();  
});
});//EOF Document.ready
</script>
@endsection