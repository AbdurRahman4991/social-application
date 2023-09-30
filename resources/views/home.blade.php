@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create post</div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-groupe">
                            <textarea name="content" id="" cols="60" rows="10"></textarea>
                        </div>
                        <div class="input-groupe">
                          <label for="">Image</label>
                            <input type="file" name="image" class="form-control">                            
                        </div>
                        <button class="btn btn-success mt-2">Submit</button>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
