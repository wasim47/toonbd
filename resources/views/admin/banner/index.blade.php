@extends('admin.include.master')
	@section('title') Banner List - ToonBD @endsection
@section('content')
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Banner List</h3>
                        <div class="col-sm-5" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Settings</li>
                                <li class="active">Banner List</li>
                            </ol>
                        </div>
                        <div class="col-sm-7 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('banners','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('banners','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','banners');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('banner.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Banner</a>
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
                                      <th width="4%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                      <th width="13%">Name</th>
                                      <th width="22%">Image</th>
                                      <th width="15%">Meta Details</th>
                                      <th width="15%">Keywords</th>
                                      <th width="10%">Sequence</th>
                                      <th width="10%">Status</th>
                                      <th width="12%" align="right">Action</th>
                                  </tr>
                			  </thead>
                               <tbody>
                			<?php $i=0; ?>
                            @foreach($allbanner as $banner)
                            <?php $i++;								

								if($banner->status!="" && $banner->status==1){
									$statusdis = '<span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-check"></i> </span>';
								}
								else{
									$statusdis = '<span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-times"></i> </span>';
								}
							?>

                            <tr id="tablerow<?php echo $banner->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $banner->id }}" /></td>
                              <td>{{ $banner->name }}</td>
                              <td><img src="{{ asset('uploads/banner/'.$banner->image) }}" style="width:200px; height:auto" /></td>
                              <td>{{ $banner->meta_details }}</td>
                              <td>{{ $banner->keywords }}</td>
                              <td>{{ $banner->sequence }}</td>
                              <th width="10%" align="center"><?php echo $statusdis; ?></th>
                              <td align="right">
                              <div style="width:50%; float:left">
                             	 <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                              </div>
                              <div style="width:50%; float:left">
                              	  <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                                    onclick="deleteSingle('<?php echo $banner->id;?>','masterdelete','banners')"><i class="fa fa-trash"></i></button>
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
