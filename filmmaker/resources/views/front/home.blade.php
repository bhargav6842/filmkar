@extends('front/layout')
@section('page_title','Film Maker')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<div class="utf_main_banner_area" style="background-image:url(https://i.dawn.com/large/2016/09/57e24a0ddb6ca.jpg);" data-overlay="8">
   <div class="container">
      <div class="col-md-8 col-sm-10">
         <div class="caption cl-white home_two_slid">
            <h2>Book Your Live Entertainer</h2>
            <p>For any event, occasion or celebration </p>
         </div>
         <form>
            <fieldset class="utf_home_form_one">
               <div class="col-md-10 col-sm-10 padd-0">
                  <input type="text" class="form-control br-1" placeholder="Search Keywords..." />
               </div>
               <div class="col-md-2 col-sm-2 padd-0 m-clear">
                  <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
               </div>
            </fieldset>
         </form>
      </div>
   </div>
</div>
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Live Entertainers</h2>
               <p>Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
            </div>
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
                     <!-- <span>Catterline AB3 9TR</span>  -->
                  </div>
               </div>
            </div>
          @endforeach
         </div>
      </div>
      <!-- Tab panels -->     
   </div>
</section>
<section class="utf_job_category_area">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="heading">
               <h2>Categories</h2>
               <p>Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
          @foreach($category_count as $list)
            <div class="col-md-3 col-sm-6">
               <a href="{{ route('details', [$list['category_slug']]) }}" title="">
                  <div class="utf_category_box_area">
                     <div class="utf_category_desc">
                        <div class="category-detail utf_category_desc_text">
                           <h4>{{$list['category_name']}}</h4>
                           <p>{{$list['count']}}</p>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
          @endforeach
            <div class="col-md-12 mrg-top-20 text-center">
               <!-- <a href="browse-category.html" class="btn theme-btn btn-m">View All Categories</a> -->
            </div>
         </div>
      </div>
   </div>
</section>
<script src="assets/js/custom.js"></script> 
@endsection