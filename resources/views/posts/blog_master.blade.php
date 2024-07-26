<!DOCTYPE html>
<html lang="en-US">


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{{ $title }}</title>

	<meta name="robots" content="index, follow" >

	<meta name="description" content="Luisnvaya - ">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="msvalidate.01" content="2831CC3FF80C61E18759E18201B9E6E0" />
    <meta name="google-site-verification" content="w8DEWLWZyrAf9x3t3FqDVltDdXacFqYZTUJNNQIREYs" />
	@yield('additional_meta')


	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="{{asset('assets/blog/css/bootstrap.min.css')}}" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('assets/blog/css/all.min.css')}}" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('assets/blog/css/slick.css')}}" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('assets/blog/css/simple-line-icons.css')}}" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('assets/blog/css/style.css')}}" type="text/css" media="all">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	@yield('additional_static')

	@yield('extracss')



</head>

<body>

<!-- preloader -->
 <div id="preloader">
	<div class="book">
		<div class="inner">
			<div class="left"></div>
			<div class="middle"></div>
			<div class="right"></div>
		</div>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>

<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

	<!-- header -->
	@include('posts.utils.blog_header')

	@yield('content')



	<!-- footer -->
	@include('posts.utils.footer')

</div><!-- end site wrapper -->

<!-- search popup area -->
@include('posts.utils.search')

<!-- side menu -->
@include('posts.utils.canva')


<!-- JAVA SCRIPTS -->
<script src="{{asset('assets/blog/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/blog/js/popper.min.js')}}"></script>
<script src="{{asset('assets/blog/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/blog/js/slick.min.js')}}"></script>
<script src="{{asset('assets/blog/js/jquery.sticky-sidebar.min.js')}}"></script>
<script src="{{asset('assets/blog/js/custom.js')}}"></script>

<!-- <script src='https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js'></script> -->

<script src="https://cdn.tiny.cloud/1/invalid-origin/tinymce/5.4.2-90/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    const url='<?php echo URL('/'); ?>';
</script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
    });
  </script>


</body>


</html>