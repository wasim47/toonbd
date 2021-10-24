 @extends('admin.include.master') 
	@section('title') New Usefull Link Entry - ToonBD @endsection 
@section('content')

 
	<div class="layout-content" ng-app="appTable" ng-controller='ItemsController'>
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">Create New Usefull Link</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">New Usefull Link</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('usefulllink.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Usefull Link List</a>
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
                            <form method="POST" action="{{ route('usefulllink.store') }}" enctype="multipart/form-data" id="tabs">
                        @csrf
						
                        <div class="col-sm-12">
                        	<div class="col-sm-6">
                        			
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Site Name') }}
                                        <span style="color:#ff0000; font-size:20px;">*</span></label>            
                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>            
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Usefull Link') }}
                                        <span style="color:#ff0000; font-size:20px;">*</span></label>            
                                        <div class="col-md-8">
                                            <input id="links" type="text" class="form-control" name="links" value="{{ old('links') }}" required>            
                                            @if ($errors->has('links'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('links') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
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
@endsection
