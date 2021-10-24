@extends('admin.include.master')
	@section('title')FAQ - Eishop @endsection
@section('content')

  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none; margin:0; padding:0">
                    <h3 class="page-title">View Article List</h3>
                        <div class="col-sm-6" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Settings</li>
                                <li class="active">FAQ List</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('faqs','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('faqs','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','faqs');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('faq.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New FAQ</a>
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
                        <div class="row">
                       <form id="form_check">
                            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                      <th width="4%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                      <th>Topic</th>
                                      <th>Question</th>
                                      <th>Answer</th>
                                      <th>Created At</th>
                                      <th>Updated At</th>
                                      <th>Actions</th>
                                    </tr>
                       			</thead>
                               <tbody>
                			<?php $i=0; ?>
                             @foreach($faq as $content)
                            <?php $i++;
								if($content->status!="" && $content->status==1){
									$statusdis = '<span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-check"></i> </span>';
								}
								else{
									$statusdis = '<span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-times"></i> </span>';
								}
							?>

                            <tr id="tablerow<?php echo $content->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $content->id }}" /></td>
                              <td>{{ $content->topic }}</td>
                              <td>{{ $content->question }}</td>
                              <td>{!! str_limit(strip_tags($content->answer), 100) !!}</td>
                              <td>{{ $content->created_at }}</td>
                              <td>{{ $content->updated_at }}</td>
                              <td align="right">
                              <div style="width:50%; float:left">
                             	 <a href="{{ route('faq.edit', $content->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                              </div>
                              <div style="width:50%; float:left">
                              	  <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                                    onclick="deleteSingle('<?php echo $content->id;?>','masterdelete','faqs')"><i class="fa fa-trash"></i></button>
                              </div>
                              </td>
                        </tr>
                        @endforeach
                        {{ $faq->links() }}
            			</tbody>
                      </table>
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
