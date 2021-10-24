@extends('layouts.app')

@section('title', 'Our Products')

@section('sidebar')
    @parent
@endsection
@section('content')
	   
    <main id="main">
        <section class="breadcrumbs">
          <div class="container">
            <div class="d-flex justify-content-between align-items-center">
              <h2>Product</h2>
              <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Products</li>
              </ol>
            </div>
          </div>
        </section>
        
        <section id="services" class="section-bg">
          <div class="container">
          	<div class="row">
                 @foreach($products as $product)
                  <div class="col-md-4 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
                    <div class="box">
                      <img src="{{ asset('uploads/product/'.$product->image) }}" />
                      <h4 class="title"><a href="{{ route('product.details',$product->id) }}">{{ $product->name }}</a></h4>
                    </div>
                  </div>
                 @endforeach
              </div>
          </div>
        </section>
    </main>
@endsection


@section('footer')
    @parent
@endsection
