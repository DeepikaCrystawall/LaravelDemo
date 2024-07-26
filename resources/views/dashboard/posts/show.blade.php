@extends('dashboard.layouts.master2')

@section('title', 'Post Show | Luis N Vaya ')



@section('content')

    <a href="{{ route('posts.index') }}" class="btn btn-default pull-right"><- Go Back</a>

    <br><br><br>

    <!-- SHAPE
    ================================================== -->
    <div class="position-relative">
      <div class="shape shape-bottom shape-fluid-x svg-shim text-light">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"/></svg>
      </div>
    </div>




<section>

      <div class="container-fluid">

        <div class="row">





          <div class="col-12 col-lg-6 col-xl-8 offset-lg-3 offset-xl-2 py-7 py-lg-9 px-lg-7">
            <br><br>

            <!-- Heading -->
            <h1 class="mb-1 display-4 text-center">{{ $post->title }}</h1><br><br>
            <div class="col ml-n5">

               <div class="row align-items-center py-5 border-top border-bottom">
              <div class="col-auto">

                <!-- Avatar -->
                <div class="avatar avatar-lg">
                  <img src="{{asset ('assets/luisnvaya_favicon.png')}}" alt="..." class="avatar-img rounded-circle">
                </div>

              </div>
              <div class="col ml-n5">

                <!-- Name -->
                <h6 class="text-uppercase mb-0">
                  Admin
                </h6>

                <!-- Date -->
                <time class="font-size-sm text-muted" datetime="2019-05-20">
                  Published on {{ $post->updated_at }}
                </time>

              </div>
              <div class="col-auto">

                <!-- Share -->
                <span class="h6 text-uppercase text-muted d-none d-md-inline mr-4">
                  Share:
                </span>

                <!-- Icons -->
                <ul class="d-inline list-unstyled list-inline list-social">
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="https://www.instagram.com" class="text-decoration-none" target="_blank">
                      <img src="{{asset ('shawosy/assets/ui/img/icons/social/instagram.svg')}}" class="list-social-icon" alt="...">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="{{asset ('shawosy/assets/ui/img/icons/social/facebook.svg')}}" class="list-social-icon" alt="...">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="{{asset ('shawosy/assets/ui/img/icons/social/twitter.svg')}}" class="list-social-icon" alt="...">
                    </a>
                  </li>
                </ul>

              </div>
            </div>
            <br><br>
            <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-11 col-xl-11">

            <figure class="figure mb-7">

              <!-- Image -->
              <img class="figure-img img-fluid rounded lift lift-lg" src="{{asset ('assets/post/' .$post->image )}}" alt="...">

              <!-- Caption -->
              <!-- <figcaption class="figure-caption text-center">
                This is a caption on this photo for reference
              </figcaption> -->

            </figure>
            <p class="lead mb-7 text-center text-muted">
              {!! $post->body !!}
            </p>
          </div>
          <p><strong>Tags: </strong>{{ $post->tags }}</p>
        </div>
        <br><br>

        <div class="row align-items-center py-5 border-top border-bottom">
              <div class="col-auto">

                <!-- Avatar -->
                <div class="avatar avatar-lg">
                  <img src="{{asset ('assets/luisnvaya_favicon.png')}}" alt="..." class="avatar-img rounded-circle">
                </div>

              </div>
              <div class="col ml-n5">

                <!-- Name -->
                <h6 class="text-uppercase mb-0">
                  Admin
                </h6>

                <!-- Date -->
                <time class="font-size-sm text-muted" datetime="2019-05-20">
                  Published on {{ $post->updated_at }}
                </time>

              </div>
              <div class="col-auto">

                <!-- Share -->
                <span class="h6 text-uppercase text-muted d-none d-md-inline mr-4">
                  Share:
                </span>

                <!-- Icons -->
                <ul class="d-inline list-unstyled list-inline list-social">
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="https://www.instagram.com" class="text-decoration-none" target="_blank">
                      <img src="{{asset ('shawosy/assets/ui/img/icons/social/instagram.svg')}}" class="list-social-icon" alt="...">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="{{asset ('shawosy/assets/ui/img/icons/social/facebook.svg')}}" class="list-social-icon" alt="...">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="{{asset ('shawosy/assets/ui/img/icons/social/twitter.svg')}}" class="list-social-icon" alt="...">
                    </a>
                  </li>
                </ul>

              </div>
            </div>





          </div>








        </div> <!-- / .row -->
      </div>
    </section>
@endsection