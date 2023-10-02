@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>{!! Session::get('success') !!}</span>
                    </div>
                @endif
                @if(Session::get('error'))
                    <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>{!! Session::get('error') !!}</span>
                    </div>
                @endif 
                <div class="card-header">Create post</div>
                <div class="card-body">
                    <form action="{{route('createPost')}}" method="post" enctype="multipart/form-data">
                        @csrf()
                        <input type="hidden" name="userId" value=" {{ Auth::user()->id }}">
                        <div class="input-groupe">
                            <textarea name="content" id="" cols="60" rows="10"></textarea>
                            @error('content')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-groupe">
                          <label for="">Image</label>
                            <input type="file" name="image" class="form-control"> 
                            @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror                         
                        </div>
                        <button class="btn btn-success mt-2">Submit</button>
                        <a href="{{route('GetPost')}}"class="btn btn-success mt-2">Back</a>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
