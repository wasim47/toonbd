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
                    <div class="articleareas">
                            @if($products!="")
                                <div class="col-sm-12">
                                    <div style="width:100%; height:auto; float:left; margin-bottom:30px;  text-align:left; padding:10px;">
                                        <div class="col-sm-12">
                                        <img src="{{ asset('uploads/product/'.$products->image) }}" style="width:80px; height:auto; margin:0; padding:0"  />
                                        <h4 style="margin:0; padding:0">{{ $products->name }}</h4>
                                        <div style="margin-top:5px; text-align:justify; line-height:18px; font-size:14px; padding:5px 0; float:left; width:100%;">
                                        {!! $products->details !!}</div>
                                        </div>
                                    </div>
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
