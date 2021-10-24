 @extends('admin.include.master') 
	@section('title') Edit [{{ $usefulllinkinfo->links }}] | Officer - ToonBD @endsection 
@section('content')

 
	<div class="layout-content">
        <div class="layout-content-body">
          <!-- top tiles -->
          
          <div class="x_title">
                  <h2>Edit usefulllink</h2>
                 
                  <div class="clearfix"></div>
                </div>
          <div class="x_content">
          	{!! Form::model($usefulllinkinfo, ['route'=>['usefulllink.update', $usefulllinkinfo->id],'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                    {{ csrf_field() }}
                    <?php
                    	if($usefulllinkinfo->email!=""){
                    		list($first, $second) = explode('@',$usefulllinkinfo->email);
                        }
						else{
                        	$first = '';
                        }
                    ?>
                    <div class="col-sm-12" id="firststep">
                      <div class="col-sm-12">
                        	<div class="col-sm-6">
                            		<div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Site Name') }}
                                        <span style="color:#ff0000; font-size:20px;">*</span></label>            
                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $usefulllinkinfo->name }}" required>            
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                        			<div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Usefull Link') }}
                                        <span style="color:#ff0000; font-size:20px;">*</span></label>            
                                        <div class="col-md-8">
                                            <input id="links" type="text" class="form-control" name="links" value="{{ $usefulllinkinfo->links }}" required>            
                                            @if ($errors->has('links'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('links') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                   
                                   
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="col-md-6 pull-right">
                                <input type="submit" value="Update"  
                                style="background:#0071bb; padding:10px 30px; border:none; color:#fff; font-size:20px; box-shadow:#005995 0 0 2px 2px" />        
                            </div>
                        </div>                        
                        
                    </div>
                </form>
			</div>

    
    </div>
</div>
@endsection

 