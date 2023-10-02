@extends('layouts.userApp')

@section('title')Social application @endsection
@section('content')

 <!-- Main content -->

<div class="mainContent">
    <div class="container">
        <div class="row">
          @php            
            $Auth = Auth::user();           
          @endphp
        @foreach($GetPost as $post)
            <div class="col-md-4">               
                <div class="card">
                    <div class="card-body">
                        <img class="postImg" src="{{asset('/')}}images/{{$post->image}}" alt="images" />
                        <h2 class="postTitle">E-commarse </h2>
                        <p class="content">{{ Str::limit($post->content, 100) }} </p>
                    </div>
                    <div class="card-header bg-primary ">
                        <form action="{{route('Like')}}" method="post" class="likeBtn" >
                            @csrf()
                            <input type="hidden" name="like" value="like">
                            @if($Auth==true)
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            @else

                            @endif                            
                            <input type="hidden" name="postId" value="{{$post->id}}">                            
                            <button class="btn btn-primary">  {{$post->Like->count()}} <i class="fa-solid fa-heart text-white"> </i></button>
                        </form> 
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$post->id}}"> {{$post->comment->count()}} <i class="fa-solid fa-comment text-white"> </i> </button>                                                             
                    </div>
                </div>                
            </div>

            <!-- Modal -->
          <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">List of Comments</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                 
                <form action="{{route('comments')}}" method="post">
                  @csrf()
                      <textarea name="comments" placeholder="Write your comments" class="form-control" id="" cols="20" rows="3"></textarea>
                          @if($Auth==true)
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            @else
                          @endif                            
                            <input type="hidden" name="postId" value="{{$post->id}}"> 
                      <button class="btn btn-success btn-sm mt-2">Commite</button>
                </form>
                @foreach($post->comment as $comme)
                  
                  <li>
                    {{$comme->comments}} 
                    @if($Auth==true)
                        @if($comme->user_id == $Auth->id)
                          <a href="{{route('DeleteComments',[$comme->id])}}" class="text-danger">remove</a>
                        @endif
                    @endif

                  </li>
                @endforeach
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>
    </div>
</div>


@endsection    
  