@extends('admin.include.master')
	@section('title') Report List - ToonBD @endsection
@section('content')
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Report List</h3>
                        <div class="col-sm-5" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Settings</li>
                                <li class="active">Report List</li>
                            </ol>
                        </div>
                        <div class="col-sm-7 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('reports','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('reports','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','reports');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('report.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Report</a>
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
                                      <th width="20%">Menu</th>
                                      <th width="53%">Headline</th>
                                      <th width="8%">File</th>
                                      <th width="7%">Year</th>
                                      <th width="10%" align="right">Action</th>
                                  </tr>
                			  </thead>
                               <tbody>
                			<?php $i=0; ?>
                            @foreach($allreport as $report)
                            <?php $i++;	
								$selectedmenu = App\Menu::where('id',$report->menu_id)->first();
								if($selectedmenu!=""){
									$menuname = $selectedmenu->title;
								}
								else{
								    $menuname = '';
								}	
							?>

                            <tr id="tablerow<?php echo $report->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $report->id }}" /></td>
                              <td>{{ $menuname }}</td>
                              <td>{{ $report->name }}</td>
                              <td><a href="{{ route('report.download',[$report->name,$report->files]) }}">Download</a></td>
                              <td>{{ $report->years }}</td>
                              <td align="right">
                              <div style="width:50%; float:left">
                             	 <a href="{{ route('report.edit', $report->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                              </div>
                              <div style="width:50%; float:left">
                              	  <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                                    onclick="deleteSingle('<?php echo $report->id;?>','masterdelete','reports')"><i class="fa fa-trash"></i></button>
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
