@extends('layouts.app')

@section('title', 'Eishop')

@section('sidebar')
    @parent
@endsection

@section('content')
	<main id="main">
    	 <section class="breadcrumbs">
          <div class="container">
            <div class="d-flex justify-content-between align-items-center">
              <h2>Video Gallery</h2>
              <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Video Gallery</li>
              </ol>
            </div>
          </div>
        </section>
         <section id="services" class="section-bg">
              <div class="container">
                <div class="row">
                            @if($videos!="")
                                <?php $i=0; ?>
                                @foreach($videos as $video)
                                <?php
									$i++;
									$videoImagePath = asset('uploads/video/'.$video->cover);			
									if($video->cover!=""){
										$coverImage = $videoImagePath;
									}
									else{
									  $coverImage = asset('assets/front/images/defaultlogo.png');	
									}
								?>
                                    <div class="col-sm-4">
                                    <div style="margin:10px; float:left; width:100%; padding:0; height:180px;box-shadow:#ccc 0 0 2px 2px;">                                                 
                                       <a  class="youtube" href='https://www.youtube.com/embed/{{ $video->video_ref }}?rel=0&amp;wmode=transparent'>
                                            <img src="{{ $coverImage }}" style="width:100%; height:100%;"  title="{{ $video->video_title }}" alt="{{ $video->video_title }}"/>
                                       </a>    
                                     </div>
                					</div>
                                 @endforeach
                            @endif
                </div>
              </div>
    	  </section>
     </main>
@endsection


@section('footer')
    @parent
    
  <link rel="stylesheet" href="{{ asset('assets/colorbox/colorbox.css') }}" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="{{ asset('assets/colorbox/jquery.colorbox.js') }}"></script>
<script>
	(function($) {
		$(".youtube").colorbox({iframe:true, width:"80%", height:"80%"});
	})(jQuery);
</script>
@endsection
