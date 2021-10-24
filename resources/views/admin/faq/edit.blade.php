@extends('admin.include.master')
	@section('title') FAQ - Eishop @endsection
@section('content')

    <div class="layout-content">
            <div class="layout-content-body">
                <div class="col-sm-12">
                    <div class="page-header" style="border:none; margin:0; padding:0">
                    <h3 class="page-title">FAQ Edit</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">Edit FAQ</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('faq.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View FAQ List</a>
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
                 {!! Form::model($contentData, ['route'=>['faq.update', $contentData->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                  {{ csrf_field() }}
                  <div class="col-sm-12" style="margin-bottom:10px;">

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="menu">Topic</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="topic" class="form-control">
                            <option value="{{ $contentData->topic }}">{{ $contentData->topic }}</option>
                            @foreach($faqtopic as $menu)
                            <option value="{{ $menu->slug }}">{{ $menu->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @if($errors->has('topic'))
                        <label class="col-md-2 col-sm-2 col-xs-12" style="color: red; display: inline;">
                         {{ $errors->first('topic') }}
                        </label>
                        @endif
                      </div>
                    </div>
                  <div class="col-sm-12" style="margin-bottom:10px;">
                	  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Question <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="question" class="form-control col-md-7 col-xs-12" value="{{ $contentData->question }}">
                        </div>
                        @if($errors->has('question'))
                        <label class="col-md-2 col-sm-2 col-xs-12" style="color: red; display: inline;">
                         {{ $errors->first('question') }}
                        </label>
                        @endif
                      </div>
                  </div>

				 <div class="col-sm-12" style="margin-bottom:10px;">
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="content">Answer</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="answer" class="form-control ckeditor">{{ $contentData->answer }}</textarea>
                    </div>
                  </div>
            </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <button class="btn btn-info" type="reset">Reset</button>
                      <a href="{{ route('faq.index') }}" class="btn btn-primary">Cancel</a>
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
