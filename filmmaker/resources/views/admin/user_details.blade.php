@extends('admin/layout')
@section('page_title','User Details')
@section('user_select','active')
@section('container')
<style>
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
</style>
<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4>User Tab</h4>
									</div>
									<div class="card-body">
										<div class="default-tab">
											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-home"
													 aria-selected="true">Profile</a>
													<a class="nav-item nav-link" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-profile"
													 aria-selected="false">Gallery</a>
													<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-videos" role="tab" aria-controls="nav-contact"
													 aria-selected="false">Videos</a>
												</div>
											</nav>
											<div class="tab-content pl-3 pt-2" id="nav-tabContent">
												<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                @if($vendor->profile != null)
                                                    <img src="{{asset('assets/profile/'.$vendor->profile)}}" style="height: 150px; width: 150px;"  alt=""> 
                                                    @else
                                                    <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 150px;"  alt=""> 
                                                    @endif
                                                    <div class="col-sm-12 mrg-bot-10"><strong>Full Name : </strong>{{$vendor->firstname}} {{$vendor->lastname}}</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>Category : </strong>{{implode(", ",$categoryname)}}</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>Phone no: </strong>{{$vendor->phonenumber}}</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>Email: </strong>{{$vendor->email}}</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>City: </strong>{{$vendor->state}}, {{$vendor->city}}</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>Age: </strong>{{$yearsold}} Years Old</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>Gender: </strong>{{$vendor->gender}}</div>
                                                    <div class="col-sm-12 mrg-bot-10"><strong>About : </strong>{!!$vendor->about_you!!}</div>
												</div>
												<div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab">
                                                @if(count($galleryArr) >0)
                                                    <div class="detail-wrapper">
                                                        <div class="detail-wrapper-header">
                                                            <h4>Gallery</h4>
                                                        </div>
                                                        <div class="detail-wrapper-body">
                                                            <div id="gallery" class="container-fluid">
                                                            @foreach($galleryArr as $list)
                                                            <div class="img-wraps">
                                                                <img src="{{asset('assets/gallery/'.$vendor->username.'/'.$list->image)}}" class="img-responsive">
                                                            </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                <p>No Photos Found!</p>  
                                                @endif
												</div>
												<div class="tab-pane fade" id="nav-videos" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                @if(count($galleryArr) >0)

                                                <div class="detail-wrapper-body">
                                                    @foreach($videosarr as $list)
                                                    @php
                                                    $url = $list->video_link;
                                                    $final_url = 'https://www.youtube.com/embed/'.substr($url, strrpos($url, '/') + 1);
                                                    @endphp
                                                    <iframe width="300" height="150" src="{{$final_url}}" frameborder="0" allowfullscreen></iframe>

                                                        @endforeach
                                                </div>
                                                @else
                                                <p>No Videos Found!</p>
                                                @endif
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
                        <div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>
<script>
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
