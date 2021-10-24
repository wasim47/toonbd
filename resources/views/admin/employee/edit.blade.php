@extends('admin.include.master') 
	@section('title') Edit - {{ $employee->name }} - ToonBD @endsection 
@section('content')

  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
    
    <div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Employee Information Edit</h3>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li>Settings</li>
                        <li class="active">Edit - {{ $employee->name }}</li>
                         <li style="text-align:right; float:right">
                            	<a  href="{{ route('employee.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Employee List</a>
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
						{!! Form::model($employee, ['route'=>['employee.update', $employee->id], 'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                        
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $employee->name }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Designation') }}</label>
                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control" name="designation" value="{{ $employee->designation }}">
                                @if ($errors->has('designation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-md-2 col-form-label text-md-right">{{ __('Department') }}</label>
                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control" name="department" value="{{ $employee->department }}">
                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="branch" class="col-md-2 col-form-label text-md-right">{{ __('Branch') }}</label>
                            <div class="col-md-6">
                                <input id="branch" type="text" class="form-control" name="branch" value="{{ $employee->branch }}">
                                @if ($errors->has('designbranchation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('branch') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact" class="col-md-2 col-form-label text-md-right">{{ __('Mobile No.') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ $employee->mobile }}">
                                @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $employee->email }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image">
                                <img src="{{ asset('uploads/employee/'.$employee->image) }}" style="width:100px; height:auto" />
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                      
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                               <select name="status" class="form-control">
                               	 <option value="1">Display</option>
                                 <option value="0">Not Display</option>
                               </select>
                               <input id="stillthumb" type="hidden" class="form-control" name="stillthumb" value="{{ $employee->image }}">
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
