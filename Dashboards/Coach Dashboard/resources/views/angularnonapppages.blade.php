<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Admin Box - AngularJS theme</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>

        <script src="{{ url('js/jquery.min.js') }}"></script>		

        <link rel="stylesheet" href="{{ url('css/main.css') }}">
        <link rel="stylesheet" href="{{ url('css/app.css') }}">

    </head>
    <body>
		
			<header>		

				<a class="nav-logo" href="/">
					<img src="/images/logo/heddoko_logo.svg" alt="Heddoko">
				</a>	

				<div class="social">
					<p>
						<a href="https://www.facebook.com/heddoko" target="_blank"><i class="fa fa-3x fa-facebook"></i></a>
						<a href="https://twitter.com/heddoko" target="_blank"><i class="fa fa-3x fa-twitter"></i></a>
						<a href="https://www.linkedin.com/company/heddoko" target="_blank"><i class="fa fa-3x fa-linkedin"></i></a>
						<a href="https://instagram.com/heddoko/" target="_blank"><i class="fa fa-3x fa-instagram"></i></a>						
					</p>
				</div>
		
			</header>
		
			@yield('content')
			
			<div id="footer" class="navbar-fixed-bottom" style="color:white;text-align:center;">
				&copy; Copyright Heddoko
			</div>

    </body>
		
</html>