@extends('layouts.app')

@section('title', 'Eishop')

@section('sidebar')
    @parent
@endsection
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
</style>
@section('content')
	 <div id="page" class="page">
          <div class="content-section">
   			 <div class="col-sm-12 col-xs-12" style="margin:0; padding:0 3px">
             	<div class="middlearea">
                    <div class="content-section-header left">
                            @if($services!="")
                                <div class="col-sm-12">
                                    <h2 class="title">{{ $services->name }}</h2>
                                    <img src="{{ asset('uploads/service/'.$services->image) }}" style="width:auto; max-width:100%; height:auto; margin:10px 0" />
                            		<p>{!! $services->details !!}</p>
                                </div>
                            @endif
                      </div>
                </div>
            </div>
    	  </div>
  	</div>
@endsection


@section('footer')
    @parent
@endsection
