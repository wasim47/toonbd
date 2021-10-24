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
                         
                          <a  href="{{ route('video.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Video</a>
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
                      <div class="card-block">
                      <form id="form_check">
                            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            
                        <tr>
                          <th width="29%">Title</th>
                          <th width="9%">Video Code</th>
                          <th width="9%">Cover Photo</th>
                          <th width="10%">Created At</th>
                          <th width="23%">Updated At</th>
                          <th>Actions</th>
                        </tr>
            			<?php $i=0; ?>
                        @foreach($video as $content)     
                        <?php $i++;
							?>       
                        <tr id="tablerow<?php echo $content->id;?>" class="tablerow">
                          <td>{!! $content->video_title !!}</td>
                           <td>{{ $content->video_ref }}</td>
                          <td><img src="{{ asset('uploads/video/'.$content->cover) }}" style="width:100px; height:auto" /></td>
                          <td>{{ $content->created_at }}</td>
                          <td>{{ $content->updated_at }}</td>
                          <td width="15%">
                          <a href="{{ route('video.edit', $content->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; width:40%; margin-right:10px;">Edit</a>
                          <div style="width:50%; float:left">
                          {!! Form::open(['method'=>'delete', 'route'=>['video.destroy', $content->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger custom-delete-button', 'onclick'=>'return confirm("Are you sure you want to delete this record?")']) !!}
                            {!! Form::close() !!}
                         </div>
                         </td>
                        </tr>
                        @endforeach
                        {{ $video->links() }}
            
                      </table> 
                      </div>
                  </div>
                </div>  
              </div>
       </div>
   </div>
@endsection
