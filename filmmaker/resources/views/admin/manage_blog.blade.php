@extends('admin/layout')
@section('page_title','Manage Blog')
@section('blog_select','active')
@section('container')
<div class="overview-wrap">
    <h2 class="title-1">Manage Category</h2>
    <a href="{{url('admin/blog')}}" class="au-btn au-btn-icon au-btn--blue">
        <i class="zmdi zmdi-plus"></i>Back</a>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add Blog</div>
                    <div class="card-body">
                        <form action="{{route('blog.manage_blog_process')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$id}}"/>
                            @csrf
                            <div class="form-group">
                                <label for="title" class="control-label mb-1">Title</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Enter Blog Title" 
                                value="{{$title}}">
                                @error('title')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Blog Slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" placeholder="Enter Category Slug" 
                                value="{{$slug}}">
                                @error('slug')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="thumbnail" class="control-label mb-1">Blog Slug</label>
                                <input id="thumbnail" name="thumbnail" type="file" class="form-control" 
                                value="{{$thumbnail}}">
                                @error('thumbnail')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <img src="{{asset('assets/blog/'.$thumbnail)}}" style="height: 150px; width: 150px;"  alt="">
                            <div class="form-group">
                                <label for="blog" class="control-label mb-1">Blog</label>
                                <textarea type="text" id="blog" name="blog" class="form-control" required placeholder="Tell us about your self">{{$blog}}</textarea>
                                @error('blog')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
   var loadFile = function(event) {
     var reader = new FileReader();
     reader.onload = function(){
       var output = document.getElementById('output');
       output.src = reader.result;
     };
     reader.readAsDataURL(event.target.files[0]);
   };
   $(document).ready(function () {
   CKEDITOR.replace('blog');
   
});


</script>
@endsection