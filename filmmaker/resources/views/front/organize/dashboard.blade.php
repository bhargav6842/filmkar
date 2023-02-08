@extends('front/organize/layout')
@section('page_title','Dashboard')
@section('dashboard_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<div id="dashboard_listing_blcok">
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Order</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_one"><i class="fa fa-trophy"></i></p>
				<h2>2</h2> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Profile Complete </h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_two"><i class="fa fa-user"></i></p>
				<h2>30%</h2>
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Total Lead</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_three"><i class="fa fa-line-chart"></i></p>
				<h2>5</h2> 
			  </div>
			</div>
		  </div>
		</div>
@endsection
