 @extends('admin.include.master') 
	@section('title') Usefull Link List - ToonBD @endsection 
@section('content')

 
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Usefull Link List</h3>
                        <div class="col-sm-6" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="active">Usefull Link  List</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','usefulllinks');" style="color:#fff; margin-right:5px;" 
                          class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('usefulllink.create') }}" style="color:#fff; margin-right:0" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Type</a>
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
                            <table width="100%" class="table table-bordered table-striped">
                 	 <thead>
                        <tr>
                          <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                          <th width="4%" height="22">SI</th>
                          <th width="34%">Site name</th>
                          <th width="34%">Usefull Link</th>
                          <th width="7%">Action</th>
                       </tr>
                    </thead>
                    <tbody>
                     <?php $i=0; ?>
                    @foreach($usefulllink as $k=>$menu)
					<?php $i++; 
					?>
                    <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">	
                    	<td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $menu->id }}" /></td>
                    	<td>{{ $i }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->links }}</td>
                        <td  align="center">
                        
                        <a href="{{ route('usefulllink.edit', $menu->id) }}" class="btn btn-warning btn-xs" style="font-size: 12px; float:left; margin-right:5px;" title="Edit">
                        <i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-xs" style="font-size: 12px; float:left;"
                                    onclick="deleteSingle('<?php echo $menu->id;?>','masterdelete','usefulllinks')"><i class="fa fa-trash"></i></button>
                                    
                                    
                       </td>
                    </tr>
                     
                	@endforeach
                     <tr><td colspan="10">{{ $usefulllink->links() }}</td></tr>
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
