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
             	 <div class="content-section-header left">
            		<div class="container">
                	<h2 class="title">Top Executive</h2>
                    <div class="articleareas">
                            @if($managements!="")
                                <?php $i=0; ?>
                                @foreach($managements as $management)
                                <?php $i++; ?>
                                    <div class="col-sm-12">
                                        <div style="width:100%; height:auto; float:left; margin-bottom:30px; border:15px solid #eaeaea; text-align:left">
                                            <div class="col-sm-2" style="margin:0; padding:0">
                                            	<img src="{{ asset('uploads/management/'.$management->image) }}" style="width:100%; height:auto; margin:0; padding:0"  />
                                            </div>
                                            <div class="col-sm-10">
                                            <h4 style="margin:0; padding:0">{{ $management->name }}</h4>
                                            <h5 style="margin:0; padding:0; color:#0033FF">{{ $management->designation }}</h5>
                                            <div style="margin-top:5px; text-align:justify; line-height:18px; font-size:14px; padding:5px 0; float:left; width:100%;">{!! strip_tags($management->details) !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                 @endforeach
                            @endif
                      </div>
                </div>
            </div>
            </div>
    	  </div>
  	</div>
@endsection


@section('footer')
    @parent
@endsection
