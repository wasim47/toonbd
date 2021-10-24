@extends('layouts.app')

@section('title', 'Scholarship in India')

@section('sidebar')
    @parent
@endsection

@section('content')       
      <div id="page" class="page">
        <div class="content-wrapper-inner">
          	<div class="content-section">
            <div class="container">
              <div class="row">
                <div class="col-md-8">
                  <article class="post single">
                    <figure class="post-thumbnail">
                      <img src="{{ asset('uploads/news/'.$news->image) }}" alt="{{ $news->name }}" style="width:100%; height:auto">                    </figure>
                    <header class="article-header">
                      <ul class="meta">
                        <li class="meta-date">Posted on
                          <a href="#">{{ date('l , d F Y',strtotime($news->updated_at)) }}</a>
                        </li>
                        <li class="meta-category">in
                          <a href="{{ route('news') }}">News & Events</a>
                        </li>
                      </ul>
                      <h2 class="title">{{ ucfirst($news->name) }}</h2>
                    </header>
                    <p>{!! $news->details !!}</p>                    
                    
                  </article>
                  
                  
                  
                  <div class="content-section pb0">
                    	<h3>Related News</h3>
                    	@foreach($relatednews as $rnews)	
                        	<div class="post preview">
                              <figure class="post-thumbnail">
                                <div class="hover">
                                  <a href="{{ route('news.details',[$rnews->url]) }}" class="lightbox-images">
                                    <span class="wicon-iconmonstr-zoom-in-thin"></span>                          
                                    </a>                        
                                </div>
                                <img src="{{ asset('uploads/news/'.$rnews->image) }}" alt="{!! $rnews->name !!}">                      
                              </figure>
                              <div class="post-content">
                                <ul class="meta">
                                  <li class="meta-date">Posted on
                                    <a href="#">{{ date('l ,d F Y',strtotime($rnews->updated_at)) }}</a>
                                  </li>
                                  <li class="meta-category">in
                                    <a href="{{ route('news') }}">News</a>
                                  </li>
                                </ul>
                                <h4 class="post-title">
                                   <a href="{{ route('news.details',[$rnews->url]) }}" style="color:#00">{!! strip_tags(str_limit($rnews->name,50)) !!}</a>
                                </h4>
                                 <div>{!! strip_tags(str_limit($rnews->details,100)) !!}</div>
                              </div>
                            </div>
                    	@endforeach
                  </div>
                 
                </div>
                
                <div class="col-md-4">
                  <div class="sidebar">
                    <div class="widget widget-categories">
                      <h4 class="widget-title" style="color:#000; font-weight:bold">News</h4>
                      <div class="widget-content">
                        <ul>
                        	
                          @foreach($latestnews as $lnews)	
                          	<li> <a href="{{ route('news.details',[$lnews->url]) }}" style="color:#000">{!! strip_tags(str_limit($lnews->name,50)) !!}</a></li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>             
@endsection
		 
         <script src="{{ asset('assets/front/js/vendor.js')}}"></script>
	     <script src="{{ asset('assets/front/js/framework.js')}}"></script>
         <script src="{{ asset('assets/front/js/template.js')}}"></script>
         
@section('footer')
    @parent
@endsection