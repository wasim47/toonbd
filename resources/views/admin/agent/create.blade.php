@extends('admin.include.master') 
	@section('title') New Agent - ToonBDs @endsection 
@section('content')

	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Create New Agent</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">New Agent</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('agent.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Agent List</a>
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
                      	<div class="col-sm-12">
                            <form method="POST" action="{{ route('agent.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Agent Name') }}</label>
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
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('NID') }}</label>
                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control" name="nid" value="{{ old('nid') }}">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="contact" class="col-md-3 col-form-label text-md-right">{{ __('Mobile No.') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}">
                                @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Agent Photo') }}</label>
                            <div class="col-md-8">
                                <input id="image" type="file" class="form-control" name="image">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                         <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('License File') }} <small>(Only image allow)</small></label>
                            <div class="col-md-8">
                                <input id="license_file" type="file" class="form-control" name="license_file">
                            </div>
                        </div>
                                           
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('Birth Certificate No.') }}</label>
                            <div class="col-md-6">
                                <input id="birth_certificate" type="text" class="form-control" name="birth_certificate" value="{{ old('birth_certificate') }}">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('Passport') }}</label>
                            <div class="col-md-6">
                                <input id="passport" type="text" class="form-control" name="passport" value="{{ old('passport') }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('A.F.A Code No.') }}</label>
                            <div class="col-md-6">
                                <input id="afacode" type="text" class="form-control" name="afacode" value="{{ old('afacode') }}">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('License No.') }}</label>
                            <div class="col-md-6">
                                <input id="license_no" type="text" class="form-control" name="license_no" value="{{ old('license_no') }}">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('Agent License Issues Date') }}</label>
                            <div class="col-md-6">
                                <input id="license_issue_date" type="date" class="form-control" name="license_issue_date" value="{{ old('license_issue_date') }}">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{ __('Agent License Expire Date') }}</label>
                            <div class="col-md-6">
                                <input id="license_deadline" type="date" class="form-control" name="license_deadline" value="{{ old('license_deadline') }}">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="department" class="col-md-3 col-form-label text-md-right">{{__('Work Area') }}</label>
                            <div class="col-md-6">
                                <input id="work_area" type="text" class="form-control" name="work_area" value="{{ old('work_area') }}">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-8">
                               <select name="status" class="form-control">
                               	 <option value="1">Display</option>
                                 <option value="0">Not Display</option>
                               </select>
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