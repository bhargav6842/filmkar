@extends('admin/layout')
@section('page_title','Manage Language')
@section('representers_select','active')
@section('container')
    <h1 class="mb10">Manage Representer Category</h1>
    <a href="{{url('admin/language')}}">
        <button type="button" class="btn btn-success">
            Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('representer.manage_representer_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="representers" class="control-label mb-1">Representers</label>
                                    <input id="representers" value="{{$representers}}" name="representers" type="text" class="form-control" required placeholder="Enter representers" >
                                    @error('representers')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                                <input type="hidden" name="id" value="{{$id}}"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
                        
@endsection