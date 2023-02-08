@extends('front/user/layout')
@section('page_title','Manage Videos')
@section('videos_select','active')
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
<form action="{{route('user.manage_videos_process')}}" method="post">
    @csrf
<div class="profile_detail_block width">
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
    @php 
    $loop_count_num=1;
    @endphp
    @foreach($videosArr as $key=>$val)
    @php 
    $loop_count_prev=$loop_count_num;
    $video=(array)$val;
    @endphp
    <input type="hidden" name="id[]" value="{{$val['id']}}">
    <div class="col-md-12 col-sm-12 col-xs-12  video_">
			  <div class="form-group">
				<label>Enter Video Link</label>
				<input type="text" name="video_link[]" class="form-control" value="{{$val['video_link']}}" placeholder="Enter Video Link">
			  </div>
			</div>
            <div class="col-md-2 col-sm-2 col-xs-12">
			  <div class="form-group">
				<!-- <label>Add+</label> -->
				<a href="{{url('user/delete/video/')}}/{{$val['id']}}" class="btn btn-m theme-btn full-width">Delete</a>
			  </div>
			</div>
    @endforeach
			<div id="video_box"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<!-- <label>Add+</label> -->
				<button type="button" onclick="add_video_more()" class="form-control">Add+</button>
			  </div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
		</div>
        </form>

		<script>
			var count = 1;
			function add_video_more(){
				count++;
				// alert(count)
				var html = '<div class="col-md-10 col-sm-10 col-xs-12 video_'+count+'"><div class="form-group"><input type="text" name="video_link[]" class="form-control" placeholder="Enter Video Link"></div></div>';

				 html+= '<div class="col-md-2 col-sm-2 col-xs-12 video_'+count+'"><div class="form-group"><button type="button" name="video_link[]" onclick="remove_video('+count+')" class="btn btn-m theme-btn full-width">Remove</button></div></div>';
				 jQuery('#video_box').append(html)
			}

			function remove_video(count){
        jQuery('.video_'+count).remove();
   }
		</script>
		
@endsection
