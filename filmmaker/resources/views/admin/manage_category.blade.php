@extends('admin/layout')
@section('page_title','Manage Category')
@section('container')
<div class="overview-wrap">
    <h2 class="title-1">Manage Category</h2>
    <a href="{{url('admin/category')}}" class="au-btn au-btn-icon au-btn--blue">
        <i class="zmdi zmdi-plus"></i>Back</a>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$id}}"/>
                            @csrf
                            <div class="form-group">
                                <label for="category_name" class="control-label mb-1">Category</label>
                                <input id="category_name" name="category_name" type="text" class="form-control" placeholder="Enter Category Name" 
                                value="{{$category_name}}">
                                @error('category_name')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" class="form-control" placeholder="Enter Category Slug" 
                                value="{{$category_slug}}">
                                @error('category_slug')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                            <label for="parent_id" class="control-label mb-1"> parent category</label>
                              <select id="parent_id" name="parent_id" class="form-control">
                                 <option value="">Select Categories</option>
                                 @foreach($category as $list)
                                 @if($parent_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
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