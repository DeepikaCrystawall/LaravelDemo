@extends('posts.blog_master')


@section('description', '')
@section('keywords', '')



@section('content')



    <section class="main-content">
      <p class="codewithronny" hidden>This website is developed by <a href="https://codewithronny.com/">CodeWithRonny</a></p>
    <div class="container-xll padding-30 rounded">

      <div class="row" style="align: middle;">

        <div class="col-lg-11">

          <!-- section header -->
          <div class="section-header">
            <center><h3 class="section-title">Latest Posts</h3> <img src="{{asset('assets/blog/images/wave.svg')}}" class="wave" alt="wave" /></center>

          </div>

          <div class="padding-30 rounded bordered">

            <div class="row">

              @foreach($posts as $post)

              <div class="col-md-12 col-sm-6">
                <!-- post -->
                <div class="post post-list clearfix">
                  <div class="thumb rounded">
                    <span class="post-format-sm">
                      <i class="icon-picture"></i>
                    </span>
                    <a href="{{route('blogs',$post->slug)}}">
                      <div class="inner">
                        @if($post->image)
                        <img src="{{asset ('assets/post/' .$post->image )}}" class="img-fluid rounded mt-3" alt="{{ $post->title }}" />
                        @else
                         <img src="{{asset('assets/blog/images/posts/latest-sm-1.jpg')}}" alt="{{ $post->title }}" />
                        @endif

                      </div>
                    </a>
                  </div>
                  <div class="details">
                    <ul class="meta list-inline mb-3">
                      <li class="list-inline-item"><a href="#"><i class="fa-solid fa-user"></i>{{$post->author}}</a></li>

                      <li class="list-inline-item">{{$post->created_at}}</li>
                    </ul>
                    <h5 class="post-title"><a href="{{route('blogs',$post->slug)}}">{{$post->title}}</a></h5>
                    <!-- <p class="excerpt mb-0">{!! $post->body !!}</p> -->
                    <div class="post-bottom clearfix d-flex align-items-center">
                      <div class="social-share me-auto">
                        <button class="toggle-button icon-share"></button>
                        <ul class="icons list-unstyled list-inline mb-0">
                          <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
                        </ul>
                      </div>
                      <div class="more-button float-end">
                        <a href="{{route('blogs',$post->slug)}}"><span class="icon-options"></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              @endforeach




            </div>
            <!-- load more button -->
            <div class="text-center">
              <button class="btn btn-simple">Load More</button>
            </div>

          </div>
        </div>
      </div>

</div>

</section>



@endsection
@section('additional_static')

@endsection