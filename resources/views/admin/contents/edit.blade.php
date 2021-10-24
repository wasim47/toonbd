@extends('admin.include.master') 
	@section('title') Today Submission - ToonBD @endsection 
@section('content')

	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none; margin:0; padding:0">
                    <h3 class="page-title">Edit Article</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">Edit Article</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('contents.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Article List</a>
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
                    
                      <div class="row">
                            
                            {!! Form::model($contentData, ['route'=>['contents.update', $contentData->id], 'files'=>true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
					            <div class="col-sm-12" style="margin-bottom:10px;">
                              
                              <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="menu">Menu</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name="menu_id" class="form-control">
                                    <option value="{{ $menuData->id }}">{{ $menuData->title }}</option>
                                    @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                @if($errors->has('menu_id'))
                                <label class="col-md-3 col-sm-3 col-xs-12" style="color: red; display: inline;">
                                 {{ $errors->first('menu_id') }}                      
                                </label>
                                @endif
                              </div>
                            </div>
                              <div class="col-sm-12" style="margin-bottom:10px;">
                                  <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="title">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="title" class="form-control col-md-7 col-xs-12" value="{{ $contentData->title }}">
                                    </div>
                                    @if($errors->has('title'))
                                    <label class="col-md-3 col-sm-3 col-xs-12" style="color: red; display: inline;">
                                     {{ $errors->first('title') }}                      
                                    </label>
                                    @endif
                                  </div>
                              </div>                              
                             <div class="col-sm-12" style="margin-bottom:10px;">
                              <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="content">Content</span>
                                </label>
                                <div class="col-md-11 col-sm-11 col-xs-12">
                                  <textarea name="content" class="form-control ckeditor">{{ $contentData->content }}</textarea>
                                </div>
                              </div>
                        </div>
                        <!-- 
                        <div class="form-group row">
                <label for="name" class="col-md-1 col-form-label text-md-right">{{ __('Image (Optional)') }}</label>
                <div class="col-md-6">
                    <input id="image" type="file" class="form-control" name="image">
                    @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
                        
                           <div class="col-sm-12" style="margin-bottom:10px;">
                                  <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="title">Title Bangla <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="title_bangla" class="form-control col-md-7 col-xs-12" value="{{ $contentData->title_bangla }}">
                                    </div>
                                    @if($errors->has('title_bangla'))
                                    <label class="col-md-3 col-sm-3 col-xs-12" style="color: red; display: inline;">
                                     {{ $errors->first('title_bangla') }}                      
                                    </label>
                                    @endif
                                  </div>
                              </div>                              
                            <div class="col-sm-12" style="margin-bottom:10px;">
                              <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="content">Content Bangla</span>
                                </label>
                                <div class="col-md-11 col-sm-11 col-xs-12">
                                  <textarea name="content_bangla" class="form-control ckeditor">{{ $contentData->content_bangla }}</textarea>
                                </div>
                              </div>
                        </div>-->
                        
                        
                          <input id="stillthumb" type="hidden" class="form-control" name="stillthumb" value="{{ $contentData->image }}">
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                  <button class="btn btn-info" type="reset">Reset</button>
                                  <a href="{{ route('contents.index') }}" class="btn btn-primary">Cancel</a>
                                </div>
                              </div>
            
                            {!! Form::close() !!}
                        </div>
                  </div>
                </div>  
              </div>
			</div>
          </div>
@endsection