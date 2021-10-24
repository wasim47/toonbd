@extends('layouts.app')

@section('title', 'ToonBD')

@section('sidebar')
    @parent
@endsection

@section('content') 
	                    
        <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>
              @if($articles!="")
                {{ $articles->title }}
              @else
                {{ $menuslug->title }}
              @endif
          </h2>
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>{{ $menuslug->title }}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="about" class="inner-page pt-4">
      <div class="container">
      	@if($articles!="")
        	<p>
              {!! $articles->content !!}
            </p>
        @endif
      </div>
    </section>

  </main> 
            
@endsection


@section('footer')
    @parent
@endsection


