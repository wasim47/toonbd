@extends('admin.include.master') 
	@section('title') Today Submission - ToonBD @endsection 
@section('content')

  <link href="{{ asset('/app-assets/plugins/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
    
    <div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Create New Menu</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">New Menu</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('menus.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Menu List</a>
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
                   {!! Form::model($menu, ['route'=>['menus.update', $menu->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                      {{ csrf_field() }}
                     
                              
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuname">Menu Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title" class="form-control col-md-7 col-xs-12" value="{{ $menu->title }}">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuname">Parent Menu <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="parent_id" class="form-control" onchange="ajaxSearch(this.value)">>
                          	<option value="">Parent ID</option>
                            @foreach($menus as $menu)
                            	<option value="{{ $menu->uri }}">{{ $menu->title }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuname">Sub Parent Menu <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div id="subparentid">
                                  <select name="sparent_id" class="form-control">
                                    <option value="">Sub Parent ID</option>
                                  </select>
                                  </div>
                                </div>
                              </div>
                              
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuname">Page Structure <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="page_structure" class="form-control">
                          	<option value="Text">Text</option> 
                            <option value="product">Product</option> 
                            <option value="employee">Employee</option> 
                            <option value="agent">Agent</option>  
                            <option value="circular">Circular</option>  
                            <option value="branch">Branch</option> 
                            <option value="product">Product</option> 
                            <option value="director">Board of Director</option> 
                            <option value="management">Top Executive</option>
                            <option value="report">Report</option>     
                            <option value="videos">Video Gallery</option> 
                            <option value="photos">Photo Gallery</option>                             
                          </select>
                        </div>
                      </div>
                      
                      <!--<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuname">Menu Name(In bangla) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title_bangla" class="form-control col-md-7 col-xs-12" value="{{ $menu->title_bangla }}">
                        </div>
                      </div>-->
                      
                       
                      <div class="col-sm-12">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" style="margin:10px;">Submit</button>
                          <a href="{{ route('menus.index') }}" class="btn btn-primary">Cancel</a>
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

<script>
function ajaxSearch(id)
{
	  var surl = '{{ route("menu.ajaxmenu") }}';
	  $.ajax({
		type: "GET",
		url: surl,
		data: {'colid':id},

		cache: false,
		beforeSend: function(){
			$('#LoadingImageE').show();
		},
		complete: function(){
			$('#LoadingImageE').hide();
		},
		success: function(response) {
			  //console.log(response);
			  $('#subparentid').html(response);
			  $("#LoadingImageE").hide();
		},
		error: function (xhr, status) {
		  $("#LoadingImageE").hide();
		  alert('Unknown error ' + status);
		}
	  });
}
</script>