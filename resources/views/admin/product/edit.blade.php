@extends('admin.include.master') 
	@section('title') Edit - {{ $product->name }} - ToonBD @endsection 
@section('content')

  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
    
    <div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Product Information Edit</h3>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li>Settings</li>
                        <li class="active">Edit - {{ $product->name }}</li>
                         <li style="text-align:right; float:right">
                            	<a  href="{{ route('product.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Product List</a>
                            </li>
                    </ol>
                </div>
            
              @if (session()->has('messageType'))
                  <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                      <strong>STATUS: </strong> {{ session()->get('message') }}
                  </div>
              @endif
		</div>
      <div class="row-fluid">
        <div class="col-sm-12">
          <div class="card">
            	<div class="row" style="margin:10px">
                      	<div class="col-sm-offset-2">                           
						{!! Form::model($product, ['route'=>['product.update', $product->id], 'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                        
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Details') }}</label>
                            <div class="col-md-8">
                                <textarea id="details" class="form-control ckeditor" name="details">{{ $product->details }}</textarea>
                                @if ($errors->has('details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <!--<div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Meta Details') }}</label>
                            <div class="col-md-6">
                                <input id="meta_details" type="text" class="form-control" name="meta_details" value="{{ $product->meta_details }}">
                                @if ($errors->has('meta_details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Keywords') }}</label>
                            <div class="col-md-6">
                                <input id="keywords" type="text" class="form-control" name="keywords" value="{{ $product->keywords }}">
                                @if ($errors->has('keywords'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('keywords') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Sequence') }}</label>
                            <div class="col-md-6">
                                <input id="sequence" type="number" class="form-control" name="sequence" value="{{ $product->sequence }}" style="width:30%">
                                @if ($errors->has('sequence'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sequence') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                               <select name="status" class="form-control">
                               	 <option value="1">Display</option>
                                 <option value="0">Not Display</option>
                               </select>
                               <input id="stillthumb" type="hidden" class="form-control" name="stillthumb" value="{{ $product->image }}">
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    	</div>
                      </div>
              	
          </div>
        </div>  
      </div>
	</div>
  </div>
@endsection

  <script src="{{ asset('/app-assets/plugins/datatables/dataTables.min.js') }}"></script>
  <script src="{{ asset('/app-assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('/app-assets/pages/datatables.js') }}"></script>
