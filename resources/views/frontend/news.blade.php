@extends('layouts.app')

@section('title', 'Scholarship in India')

@section('sidebar')
    @parent
@endsection

@section('content')       
      <div id="page" class="page">
        <div class="content-wrapper-inner">
          <div class="content-section services-section">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="content-section-header center">
                    <h2 class="title">News</h2>
                  </div>
                </div>
              </div>
              <div class="row">
                @foreach($allnews as $lnews)	
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <div class="icon-box v4 with-image" style="min-height:450px; border:1px solid #eaeaea; padding:10px;">
                        <figure class="post-thumbnail">
                             <a href="{{ route('news.details',[$lnews->url]) }}">
                              <img src="{{ asset('uploads/news/'.$lnews->image) }}" alt="{{ $lnews->name }}">                         
                             </a>   
                                           
                          </figure>
                        <header>
                          <h4 class="title"><a href="{{ route('news.details',[$lnews->url]) }}">{!! strip_tags(str_limit($lnews->name,60)) !!}</a></h4>
                        </header>
                        <p>{!! strip_tags(str_limit($lnews->details,150)) !!}</p>
                        <p>
                          <a href="{{ route('news.details',[$lnews->url]) }}" class="color-link">Learn more
                            <i class="fa fa-long-arrow-right"></i>
                          </a>
                        </p>
                      </div>
                    </div>   
                @endforeach                
              </div>
              <div class="row">{{ $allnews->links() }}</div>
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