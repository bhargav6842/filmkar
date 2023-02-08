@extends('front/layout')
@section('page_title','Vendor Details')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<div class="page-title">
  <div class="container">
    <div class="page-caption text-center">
      <h2>Entertainer</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Explore Entertainer</p>
    </div>
  </div>
</div>
<!-- <section class="padd-0 padd-top-20 jov_search_block_inner">
  <div class="row">
    <div class="container">
      <form>
        <fieldset class="search-form">
          <div class="col-md-4 col-sm-4">
            <input type="text" class="form-control" placeholder="Job Title, Keywords or Company Name..." />
          </div>
          <div class="col-md-3 col-sm-3">
            <select class="wide form-control">
              <option data-display="Location">Telent categories</option>
              @foreach($category as $list)
              <option value="1">{{$list->category_name}}</option>
             @endforeach
            </select>
          </div>
          <div class="col-md-3 col-sm-3">
            <select class="wide form-control">
              <option data-display="Location" disabled>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          
          <div class="col-md-2 col-sm-2 m-clear">
            <button type="submit" class="btn theme-btn full-width height-50 radius-0">Search</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</section> -->

<section class="padd-top-20 padd-bot-80">
  <div class="container"> 
    <div class="row">
      <div class="col-md-5 col-sm-4 col-xs-12">
        <h4 class="job_vacancie">{{$vendorcount}} Entertainer</h4>
      </div><br>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <div class="fl-right short_by_filter_list">
          <!-- <div class="search-wide short_by_til">
            <h5>Short By</h5>
          </div> -->
          <!-- <div class="search-wide full">
            <select class="wide form-control">
              <option value="1">Most Recent</option>
              <option value="2">Most Viewed</option>
              <option value="4">Most Search</option>
            </select>
          </div>
          <div class="search-wide full">
            <select class="wide form-control">
              <option>10 Per Page</option>
              <option value="1">20 Per Page</option>
              <option value="2">30 Per Page</option>
              <option value="4">50 Per Page</option>
            </select>
          </div> -->
        </div>
      </div>
    </div>
    
    <div class="row"> 
    @foreach($vendor as $list)
            <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="contact-box">
                  <div class="utf_flexbox_area mrg-l-10">
                     <label class="toggler toggler-danger">
                     <input type="checkbox">
                     <i class="fa fa-heart"></i> 
                     </label>
                  </div>
                  <div class="contact-img">
                @if($list->profile != null)
                     <img src="{{asset('assets/profile/'.$list->profile)}}" style="height: 150px; width: 150px;"  alt=""> 
                 @else
                 <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 150px;"  alt=""> 
                 @endif
                  </div>
                  <div class="contact-caption">
                     <a href="#">{{$list->firstname.' '.$list->lastname}}</a>
                  <div class="utf_apply_job_btn_item"> <a href="{{route('user.vendordetails', [$list->username])}}" class="btn job-browse-btn btn-radius br-light">See Profile</a> </div>
                     
                     <!-- <span>Catterline AB3 9TR</span>  -->
                  </div>

               </div>
            </div>
          @endforeach
    </div>
    <div class="clearfix"></div>
    <div class="utf_flexbox_area padd-0">
		<ul class="pagination">
		  
		</ul>
	</div>
  </div>
</section>
@endsection