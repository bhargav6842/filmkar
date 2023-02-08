@extends('admin/layout')
@section('page_title','Manage Category')
@section('container')
<div class="overview-wrap">
    <h2 class="title-1">Manage SubCategory</h2>
    <a href="{{url('admin/subcategory')}}" class="au-btn au-btn-icon au-btn--blue">
        <i class="zmdi zmdi-plus"></i>Back</a>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add SubCategory</div>
                    <div class="card-body">
                        <form action="{{route('subcategory.manage_subcategory_process')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$id}}"/>
                            @csrf
                            <div class="form-group">
                            <label for="cat_id" class="control-label mb-1"> Category</label>
                              <select id="cat_id" name="cat_id" class="form-control" required>
                                 <option value="">Select Categories</option>
                                 @foreach($category as $list)
                                 @if($cat_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
                            </div>
                            @error('cat_id')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            <div class="form-group">
                                <label for="subcategory_name" class="control-label mb-1">SubCategory Name</label>
                                <input id="subcategory_name" name="subcategory_name" type="text" class="form-control" placeholder="Enter SubCategory Name" 
                                value="{{$subcategory_name}}">
                                @error('subcategory_name')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subcategory_slug" class="control-label mb-1">SubCategory Slug</label>
                                <input id="subcategory_slug" name="subcategory_slug" type="text" class="form-control" placeholder="Enter SubCategory Slug" 
                                value="{{$subcategory_slug}}">
                                @error('subcategory_slug')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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