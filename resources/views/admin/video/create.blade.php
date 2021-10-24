@extends('admin.include.master')
	@section('title') Video List - Eishops @endsection
@section('content')


	<div class="layout-content">
        <div class="layout-content-body">
        	 <div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Video List</h3>
                        <div class="col-sm-5" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Settings</li>
                                <li class="active">Blog List</li>
                            </ol>
                        </div>
                        <div class="col-sm-7 breadcrumb pull-right" style="float:right; text-align:right">
                         
                          <a  href="{{ route('video.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Blog</a>
                      </div>
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
                            <form method="POST" action="{{ route('video.store') }}" class="form-horizontal" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              
                              
                             <div class="col-sm-12" style="margin-bottom:10px;">
                                  <div class="col-sm-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Video Title</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control ckeditor" name="video_title"  style="margin-bottom:5px;"/>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Cover Image</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12"><input type="file" class="form-control" name="cover" style="margin-bottom:5px;"/></div>
                                  </div>
                                  <div class="col-sm-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Video  (YouTube 11 digit code)</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12"><!--<input type="file" class="form-control" name="videos"/>-->
                                    <input type="text" class="form-control" name="videos" placeholder="YouTube 11 digit code">
                                    <a href="{{ asset('assets/front/images/youtube.png') }}" target="_blank" style="color:#000; margin-top:20px; float:left">
                                        Click here to view demo <img src="{{ asset('assets/front/images/youtube.png') }}" style="width:30px; height:30px;" /></a></div>
                                  </div>
                                  
                                    
                      			    
                                  <div class="col-sm-12" style="margin-top:30px;">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
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

<script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function(){	
	$("#meta_description").keyup(function(){
	  $("#counts").text("Total Characters: " + $(this).val().length);
	});	
});
</script>
