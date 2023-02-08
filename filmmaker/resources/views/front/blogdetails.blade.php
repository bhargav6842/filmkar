@extends('front/layout')
@section('page_title','Blog Details')
@section('blog_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
    @media only screen   
   and (min-device-width : 360px)   
   and (max-device-width : 640px)  
   {
    .padding{
        padding: 3px;
    }
   }
   /* For 1024 Resolution */  
   @media only screen   
   and (min-width: 1370px)  
   and (max-width: 1605px) 
   { 
    .padding{
        padding: 150px;
    }
   } 
</style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Job Detail</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Job Detail</p>
    </div>
  </div>
</div>
<div class="detail-wrapper" class="padding">
          <div class="detail-wrapper-header">
            <h4>{{$signleblog->title}}</h4>
          </div>
          <div class="detail-wrapper-body">
            <p>{!!$signleblog->blog!!}</p>
          </div>
        </div>
@endsection
