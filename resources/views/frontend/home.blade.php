@extends('layouts.app')
@section('seodetails')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
@endsection

@section('title', 'Welcome to ToonBD.')
@section('content')
  

  <main id="main">
		<section>    
    <div style="margin-top:80px">
  	  <div class="amazingslider-wrapper" id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:100%;margin:0px auto 0px;">
        <div class="amazingslider" id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
            <ul class="amazingslider-slides" style="display:none;">
                 @foreach($banners as $banner)
                <li><img src="{{ asset('uploads/banner/'.$banner->image)}}" alt="{{ $banner->name }}"  title="{{ $banner->name }}" /></li>
                @endforeach
            </ul>
        <div class="amazingslider-engine"><a href="http://amazingslider.com" title="jQuery Slider">jQuery Slider</a></div>
        </div>
    </div>
    </div>	
  </section>
    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>About Us</h3>
        </header>

        {!! $articles->content !!}

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Services</h3>
        </header>

        <div class="row">
		
         @foreach($services as $service)
          <div class="col-md-6 col-lg-6 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <img src="{{ asset('uploads/service/'.$service->image) }}" style="width:100%; height:auto" />
              <h4 class="title"><a href="{{ route('service',$service->id) }}">{{ $service->name }}</a></h4>
              <p class="description">{!! str_limit($service->details,60) !!}</p>
            </div>
          </div>
		 @endforeach
        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container">
        <header class="section-header">
          <h3>Why choose us?</h3>
        </header>

        <div class="row row-eq-height justify-content-center">

		  @foreach($whychoose as $choose)
          	<div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-diamond"></i>
              <div class="card-body">
                <h5 class="card-title">{{ ucfirst(strtolower($choose->name)) }}</h5>
                <p class="card-text">{{ str_limit(strip_tags($choose->details),60) }}</p>
                <a href="{{ route('news.details',$choose->slug) }}" class="readmore">Read more </a>              </div>
            </div>
          </div>
          @endforeach


        </div>

        <div class="row counters">

		@foreach($counters as $counts)
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{ $counts->totals }}</span>
            <p>{{ $counts->name }}</p>
          </div>
		@endforeach
       
  
        </div>

      </div>
    </section>

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio" class="clearfix">
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Our Portfolio</h3>
        </header>

        <div class="row portfolio-container">

          
		  @foreach($protfolios as $protfolio)
          	<div class="col-lg-4 col-md-6 portfolio-item filter-web" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="{{ asset('uploads/protfolio/'.$protfolio->image) }}" class="img-fluid" alt="{{ $protfolio->name }}">
              <div class="portfolio-info">
                <h4><a href="#">{{ $protfolio->name }}</a></h4>
                <p>{!! str_limit($protfolio->details,100) !!}</p>
                <div>
                  <a href="{{ asset('uploads/protfolio/'.$protfolio->image) }}" class="link-preview" data-lightbox="portfolio" data-title="Web 3" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="{{ $protfolio->url }}" target="_blank" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>                </div>
              </div>
            </div>
          </div>
          @endforeach

          <!--<div class="col-lg-4 col-md-6 portfolio-item filter-app" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/portfolio/app2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">App 2</a></h4>
                <p>App</p>
                <div>
                  <a href="{{ asset('assets/img/portfolio/app2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="App 2" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/portfolio/card2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Card 2</a></h4>
                <p>Card</p>
                <div>
                  <a href="{{ asset('assets/img/portfolio/card2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Card 2" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>                </div>
              </div>
            </div>
          </div>-->

        </div>

      </div>
    </section>
    
    <section id="team">
      <div class="container">
        <div class="section-header">
          <h3>Team</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>

        <div class="row">
		  @foreach($ourteam as $team)
          	<div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="{{ asset('uploads/employee/'.$team->image) }}" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>{{ $team->name }}</h4>
                  <span>{{ $team->designation }}</span>
                  <!--<div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>                  </div>-->
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- #team -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="section-bg">

      <div class="container">

        <div class="section-header">
          <h3>Our CLients</h3>
        </div>

        <div class="row no-gutters clients-wrap clearfix wow fadeInUp">

		  @foreach($partners as $partner)
              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="client-logo">
                  <a href="{{ $partner->url }}" target="_blank"><img src="{{ asset('uploads/partner/'.$partner->image) }}" class="img-fluid" alt="{{ $partner->name }}"></a>
                </div>
              </div>
          @endforeach
          
          
          

        </div>

      </div>

    </section>

    <!--==========================
      Contact Section
    ============================-->
    <?php /*?><section id="contact">
      <div class="container-fluid">

        <div class="section-header">
          <h3>Contact Us</h3>
        </div>

        <div class="row wow fadeInUp">

          <div class="col-lg-6">
            <div class="map mb-4 mb-lg-0">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 312px;" allowfullscreen></iframe>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-5 info">
                <i class="ion-ios-location-outline"></i>
                <p>A108 Adam Street, NY 535022</p>
              </div>
              <div class="col-md-4 info">
                <i class="ion-ios-email-outline"></i>
                <p>info@example.com</p>
              </div>
              <div class="col-md-3 info">
                <i class="ion-ios-telephone-outline"></i>
                <p>+1 5589 55488 55</p>
              </div>
            </div>

            <div class="form">
              <div id="sendmessage" style="display:none">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form action="" method="post" role="form" class="contactForm">
                <div class="form-row">
                  <div class="form-group col-lg-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" class="btn btn-success" title="Send Message">Send Message</button></div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section><?php */?>

  </main>
        
@endsection

@section('footer')
    @parent
    
<script src="{{ asset('assets/amazingslider/amazingslider.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/amazingslider/amazingslider-1.css') }}">
<script src="{{ asset('assets/amazingslider/initslider-1.js') }}"></script>
@endsection	