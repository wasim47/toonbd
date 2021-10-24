 @extends('admin.include.master') 
	@section('title') All topic of FAQ - Eishop @endsection 
@section('content')

	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Faq Topic List</h3>
                        <div class="col-sm-6" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Settings</li>
                                <li class="active">Faq Topic List</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('faqtopic','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('faqtopic','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','faqtopic');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('faqtopic.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Faq Topic</a>
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
                                <thead>
                                    <tr>
                                      <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                      <th width="49%">Topic Name</th>
                              		  <th width="12%" align="right">Action</th>
                            	</tr>
                				 </thead>
                               <tbody>
                               <?php $i=0; ?>
                            @foreach($faqtopic as $menu)
							   <?php $i++; 	 ?>
                            
                            <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $menu->id }}" /></td>
                              <td>{{ $menu->name }}</td>
                              <td align="right">
                              <div style="width:50%; float:left">
                             	 <a href="{{ route('faqtopic.edit', $menu->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i> Edit</a>
                              </div>
                              <div style="width:50%; float:left">
                              	  <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" 
                                    onclick="deleteSingle('<?php echo $menu->id;?>','masterdelete','faqtopic')"><i class="fa fa-trash"></i> Delete</button>
                              </div>
                              </td>
                            </tr>
                            @endforeach
            
                      		</tbody>
                      </table> 
                      </form>
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
