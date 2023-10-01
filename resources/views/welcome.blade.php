<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SocialApp</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="{{asset('/')}}/css/coustom.css">
    </head>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />        
    </head>
    <body>
<!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Social Application Task</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>         
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
 <!-- End Navbar -->
 <!-- Main content -->

<div class="mainContent">
    <div class="container">
        <div class="row">
          @php 
            $TotalLike =App\Models\like::count();
            $Auth = Auth::user();
            $countComments = 1;
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
                            <button class="btn btn-primary">  {{$post->Like->count()}}<i class="fa-solid fa-heart text-white"> </i></button>
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
                  
                  <li>{{$comme->comments}}</li>
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


       
  <!-- Site footer -->
  <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify">Scanfcode.com <i>CODE WANTS TO BE SIMPLE </i> is an initiative  to help the upcoming programmers with the code. Scanfcode focuses on providing the most efficient code or snippets as the code wants to be simple. We will help programmers build up concepts in different programming languages that include C, C++, Java, HTML, CSS, Bootstrap, JavaScript, PHP, Android, SQL and Algorithm.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><a href="##/">C</a></li>
              <li><a href="#">UI Design</a></li>
              <li><a href="##">PHP</a></li>
              <li><a href="##">Java</a></li>
              <li><a href="#">Android</a></li>
              <li><a href="#">Templates</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Contribute</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Sitemap</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2017 All Rights Reserved by 
         <a href="#">Scanfcode</a>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
            </ul>
          </div>
        </div>
      </div>
</footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
