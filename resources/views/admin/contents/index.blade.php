@extends('admin.include.master') 
	@section('title') Contents - ToonBD @endsection 
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
                                <li class="active">Article List</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 breadcrumb pull-right" style="float:right; text-align:right">
                         
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','contents');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('contents.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Article</a>
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
                                      <th>Title</th>
                                      <th>Menu Name</th>
                                     <!-- <th>Title Bangla</th>
                                      <th>Menu Name Bangla</th>-->
                                      <th>Created At</th>
                                      <th>Updated At</th>
                                      <th>Actions</th>
                                    </tr>            
                       			</thead>
                               <tbody>
                			<?php $i=0; ?>
                             @foreach($contents as $content)
                            <?php $i++; 
							?>
                            
                            <tr id="tablerow<?php echo $content->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $content->id }}" /></td>
                              <td>{{ $content->title }}</td>
                              <td>{{ \App\Menu::where(['id' => $content->menu_id])->pluck('title')->first() }}</td>
                              <!--<td>{{ $content->title_bangla }}</td>
                              <td>{{ \App\Menu::where(['id' => $content->menu_id])->pluck('title_bangla')->first() }}</td>-->
                              <td>{{ $content->created_at }}</td>
                              <td>{{ $content->updated_at }}</td>
                              <td align="right">
                              <div style="width:50%; float:left">
                             	 <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                              </div>
                              <div style="width:50%; float:left">
                              	  <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" 
                                    onclick="deleteSingle('<?php echo $content->id;?>','masterdelete','contents')"><i class="fa fa-trash"></i></button>
                              </div>
                              </td>
                        </tr>
                        @endforeach
                        {{ $contents->links() }}
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
