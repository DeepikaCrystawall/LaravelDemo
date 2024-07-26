<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset ('shawosy/assets/logo/favicon.png')}}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="tag" content="@yield('meta_tag')">
     <meta name="description" content="@yield('meta_description')">
    <meta name="Keywords" content="@yield('keywords')">
    <meta name="author" content="@yield('author')">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/fonts/Feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/%40fancyapps/fancybox/dist/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/aos/dist/aos.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/choices.js/public/shawosy/assets/styles/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/flickity-fade/flickity-fade.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/flickity/dist/flickity.min.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/highlightjs/styles/vs2015.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/jarallax/dist/jarallax.css')}}">
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/libs/quill/dist/quill.core.css')}}" />

    <!-- Map -->
    <link href="{{asset ('shawosy/assets/ui/api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css')}}" rel='stylesheet' />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset ('shawosy/assets/ui/css/theme.min.css')}}">

    <title>@yield('title')</title>




  </head>
  <body >





    @yield('content')



 <!-- FOOTER
    ================================================== -->
    @yield('extrajs')
<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/tuig8csskih7cnyvijgmfwu1626pqgoo9cwerfxjpustlnzu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>





    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->
    <script src="{{asset ('shawosy/assets/ui/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/%40fancyapps/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/aos/dist/aos.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/choices.js/public/shawosy/assets/scripts/choices.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/countup.js/dist/countUp.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/flickity/dist/flickity.pkgd.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/flickity-fade/flickity-fade.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/isotope-layout/dist/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/jarallax/dist/jarallax.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/jarallax/dist/jarallax-video.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/jarallax/dist/jarallax-element.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/quill/dist/quill.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/smooth-scroll/dist/smooth-scroll.min.js')}}"></script>
    <script src="{{asset ('shawosy/assets/ui/libs/typed.js/lib/typed.min.js')}}"></script>

    <!-- Map -->
    <script src="{{asset ('shawosy/assets/ui/api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js')}}"></script>

    <!-- Theme JS -->
    <script src="{{asset ('shawosy/assets/ui/js/theme.min.js')}}"></script>




  </body>


</html>