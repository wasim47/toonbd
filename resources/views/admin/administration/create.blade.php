@extends('admin.include.master') 
	@section('title') New Admin - ToonBD @endsection 
@section('content')
<style>
.customtable{
	 width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
	background-color: transparent;
	border-collapse: collapse;
    border-spacing: 0;
	display: table;
    border-collapse: separate;
    border-spacing: 2px;
    border-color: grey; 
}
.customtable tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
.customtable td{
	padding:  0;
    line-height: 1.5;
    vertical-align: top;
    border-top: 1px solid #fff;
	font-size: 0.9rem;
}

.inputFieldCss{
	width:60%;
	height:auto;
	float:left;
	padding:8px;
	border-radius:0; 
	box-shadow:#333 0 0 2px 2px;
	border:1px solid #000;
	margin-bottom:5px;
	background:none;
}
.radio_container {
	display: block;
	position: relative;
	text-align:left;
	cursor: pointer;
	margin:0;
	float:left;
	background:none;
	width:100%;
	height: auto;
	padding:15px;
	color:#666;
	font-size:13px;
}

.radio_container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: auto;
	padding:7px 20px;
	color:#999;
	z-index:100000;
    width: 100%;
	font-size:13px;
}

/* On mouse-over, add a grey background color */
.radio_container:hover input ~ .checkmark {
    background-color: #eaeaea;
	color:#000;
}


/* When the checkbox is checked, add a blue background */
.radio_container input:checked ~ .checkmark {
    background-color: #666;
	color:#eaeaea;
	border:1px solid #000;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.radio_container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: auto;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header">
                    <h3 class="page-title">Create New Admin</h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>Settings</li>
                            <li class="active">New Admin</li>
                            <li style="text-align:right; float:right">
                            	<a  href="{{ route('admins.index') }}" style="color:#fff;"><i class="fa fa-list"></i> View Admin List</a>
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
                      	<div class="">
                            
                    		<form action="{{ route('admins.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                             <div class="col-sm-12">
                                             <fieldset style="width:100%; height:auto; float:left; margin:20px 5px; padding:10px; text-align:center; border:1px solid #00CC66">
                                                <legend  style="width:25%; height:auto; text-transform:uppercase; color:#00CC66; border:none">General Information</legend>
                                            
                                            <div class="col-md-6" style="padding:3px; margin:0">
                                                <div class="form-group">
                                                    <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">
                                                    Name<span style="color:#f00">*</span> : </label>
                                                    <input type="text" class="inputFieldCss" name="fullname" placeholder="Name" required>
                                                    @if ($errors->has('fullname'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('fullname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                             
                                            <div class="col-md-6" style="padding:3px; margin:0">
                                                <div class="form-group">
                                                    <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">
                                                    Contact No<span style="color:#f00">*</span> : </label>
                                                    <input type="text" class="inputFieldCss" name="contact" placeholder="Contact No" required>
                                                    @if ($errors->has('contact'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('contact') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding:3px; margin:0">
                                                <div class="form-group">
                                                    <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">Designation : </label>
                                                    <input type="text" class="inputFieldCss" name="designation" placeholder="Designation">
                                                    @if ($errors->has('designation'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('designation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding:3px; margin:0">
                                                <div class="form-group">
                                                    <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">Email : </label>
                                                    <input type="email" class="inputFieldCss" name="email" placeholder="Email">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding:3px; margin:0">
                                                <div class="form-group">
                                                    <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">Photo : </label>
                                                    <input type="file" class="inputFieldCss" name="userphoto">
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding:3px; margin:0">
                                                <div class="form-group">
                                                    <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">Address : </label>
                                                    <textarea class="inputFieldCss" name="address" placeholder="Address"></textarea>
                                                </div>
                                            </div>
                                            </fieldset>
                                             <fieldset style="width:100%; height:auto; float:left; margin:20px 5px; padding:10px; text-align:center; border:1px solid #E2B003">
                                                <legend  style="width:25%; border:none; height:auto; text-transform:uppercase; color:#E2B003">Login Information</legend>
                                                   <div class="col-md-6" style="padding:3px; margin:0">
                                                        <div class="form-group">
                                                            <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">
                                                            Login ID<span style="color:#f00">*</span> : </label>
                                                            <input type="text" class="inputFieldCss" name="username" placeholder="Login ID" required>
                                                            @if ($errors->has('username'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('username') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-6" style="padding:3px; margin:0">
                                                        <div class="form-group">
                                                            <label class="control-label" style="width:38%; float:left; text-align:right; margin:1% 1% 0 0;">
                                                            Password<span style="color:#f00">*</span> : </label>
                                                            <input type="password" class="inputFieldCss" name="password" placeholder="Password" value="bdicu1234" required>
                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div> 
                                            </fieldset>
                                               
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>              
                                            </div>
                                </form>
                    	</div>
                      </div>
                  </div>
                </div>  
              </div>
			</div>
        </div>
@endsection