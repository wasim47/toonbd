<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="theme-color" content="#009875">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
	<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    
  <!-- Bootstrap CSS File -->
  <link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link rel="manifest" href="manifest.json">

</head>

    <body>
    
       
        @section('sidebar')
        	<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo float-left">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ route('home')}}">Home</a></li>
          @foreach($menus as $menu)
            <?php
				if($menu->page_structure=='Text'){	
					$mainurl = route('websitecontent',[$menu->uri,null,null]);	
				}
				elseif($menu->page_structure!='Text'){
					$mainurl = route($menu->page_structure);	
				}
				else{
					$mainurl = route('home');	
				}
                $submenus = App\Menu::where('parent_id',$menu->uri)->where('sparent_id', NULL);
				 if($submenus->count()!=0){
				 	$mclass = 'drop-down';
				 }
				 else{
				 	$mclass = '';
				 }
            ?>
              <li class="{{ $mclass }}"><a href="{{ $mainurl }}">{{ $menu->title }} </a>
              	@if($submenus->count()!=0)
                	<ul>
                      @foreach($submenus->get() as $smenu)
						<?php
							if($smenu->page_structure=='Text'){	
								$suburl = route('websitecontent',[$menu->uri,$smenu->uri,null]);	
							}
							elseif($smenu->page_structure!='Text'){
								$suburl = route($smenu->page_structure);
							}							
							else{
								$suburl = route('home');
							}
							
                            $lastmenus = App\Menu::where('sparent_id',$smenu->uri);	
							if($lastmenus->count()!=0){
								$sclass = 'drop-down';
							 }
							 else{
								$sclass = '';
							 }											
                        ?>
                      <li class="{{ $sclass }}"><a href="{{ $suburl }}">{{ $smenu->title }} </a>
                      	@if($lastmenus->count()!=0)
                             <ul>
                             	 @foreach($lastmenus->get() as $lmenu)
                                 	<?php
										if($lmenu->page_structure=='Text'){	
											$lasturl = route('websitecontent',[$menu->uri,$smenu->uri,$lmenu->uri]);	
										}
										elseif($lmenu->page_structure!='Text'){
											$lasturl = route($lmenu->page_structure);
										}							
										else{
											$lasturl = route('home');
										}									
									?>
                                  	<li><a href="{{ $lasturl }}">{{ $lmenu->title }} </a></li>
                                 @endforeach
                            </ul>
                        @endif
                      </li>
                      @endforeach
                    </ul>
                @endif
              </li>
          @endforeach
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header>
    	@show

        @yield('content')
        
        
        @section('footer')
        	<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>ToonBD</h3>
            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="img-fluid"></a>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              @foreach($menus as $menu)
            <?php
				if($menu->page_structure=='Text'){	
					$mainurl = route('websitecontent',[$menu->uri,null,null]);	
				}
				elseif($menu->page_structure!='Text'){
					$mainurl = route($menu->page_structure);	
				}
				else{
					$mainurl = route('home');	
				}
            ?>
              <li><a href="{{ $mainurl }}">{{ $menu->title }} </a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              House-55, sonargaon janapatha road, <br>
              sector- 07, uttara Dhaka <br>
              Bangladesh <br>
              <strong>Phone:</strong> +8801629113353<br>
              <strong>Email:</strong> rikunatunbarta@gmail.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/Toonbdltd/" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>ToonBD</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">softXmagic</a>
      </div>
    </div>
  </footer>
  			 <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
              <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
              <script src="{{ asset('assets/lib/jquery/jquery-migrate.min.js') }}"></script>
              <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
              <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
              <script src="{{ asset('assets/lib/mobile-nav/mobile-nav.js') }}"></script>
              <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
              <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
              <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
              <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
              <script src="{{ asset('assets/lib/isotope/isotope.pkgd.min.js') }}"></script>
              <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
              <script src="{{ asset('assets/contactform/contactform.js') }}"></script>
              <script src="{{ asset('assets/js/main.js') }}"></script>
        	  <script src="{{ asset('assets/js/index.js') }}"></script>
          </body>
        </html>
        @show
   