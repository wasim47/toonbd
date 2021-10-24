@extends('layouts.app')

@section('title', 'Circular')

@section('sidebar')
    @parent
@endsection

@section('content')
	<main id="main">
    	 <section class="breadcrumbs">
          <div class="container">
            <div class="d-flex justify-content-between align-items-center">
              <h2>Circular</h2>
              <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Circular</li>
              </ol>
            </div>
          </div>
        </section>
         <section id="services" class="section-bg">
              <div class="container">
                <div class="row">
                    @if($directors!="")
                        <?php $i=0; ?>
                        @foreach($directors as $director)
                        <?php $i++; ?>
                            <div class="col-sm-4">
                                <a href="{{ asset('uploads/circular/'.$director->image) }}" target="_blank">
                                   <div style="width:96%; height:auto; float:left; margin:10px; border:1px solid #222357; text-align:center">
                                        <div style="width:100%; height:auto; text-align:center; float:left;">
                                            <img src="{{ asset('uploads/circular/'.$director->image) }}" style="width:100%; min-height:400px; max-height:400px;  text-align:center"  />
                                        </div>
                                        <h4 style="text-align:center; padding:20px 0; width:100%; float:left">{{ $director->name }}</h4>
                                    </div>
                                </a>
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
@endsection
