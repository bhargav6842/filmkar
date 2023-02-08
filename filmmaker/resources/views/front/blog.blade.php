@extends('front/layout')
@section('page_title','Film Maker')
@section('blog_select','active')
@section('nav_class','white no-background')
@section('container')

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Get In Touch</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Blog</p>
    </div>
  </div>
</div>

<section class="padd-top-80 padd-bot-80">
  <div class="container"> 
    <!-- Tab panels -->
	<div class="row">
     <div class="tab-content">
     <section class="padd-top-80 padd-bot-50">

     @foreach($blog as $list)
  <div class="container">
    <a href="{{route('blog.blogdetails', [$list->slug])}}">
	<div class="user_acount_info">
		<div class="col-md-3 col-sm-5">
		  <div class="emp-pic"> <img class="img-responsive width-450" src="{{asset('assets/blog/'.$list->thumbnail)}}" alt=""> </div>
		</div>
		<div class="col-md-9 col-sm-7">
		  <div class="emp-des">
			<h2>{{$list->title}}</h2>
			<span class="theme-cl">{{ Carbon\Carbon::parse($list->created_at)->format('d-m-Y') }}</span>
      <p>{!! Str::limit($list->blog, 350, ' ...') !!}</p>
		  </div>      
		</div> 
	</div> 	
    </a>
  </div>
        @endforeach
</section>


		<div class="clearfix"></div>
        <div class="utf_flexbox_area padd-0">
			<ul class="pagination">
			  <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">«</span> <span class="sr-only">Previous</span> </a> </li>
			  <li class="page-item active"><a class="page-link" href="#">1</a></li>
			  <li class="page-item"><a class="page-link" href="#">2</a></li>
			  <li class="page-item"><a class="page-link" href="#">3</a></li>
			  <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">»</span> <span class="sr-only">Next</span> </a> </li>
			</ul>
		</div>
     </div>
	</div>
    <!-- Tab panels -->     
  </div>
</section>
@endsection