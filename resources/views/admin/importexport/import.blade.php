 @extends('admin.include.master') 
	@section('title') New Usefull Link Entry - ToonBD @endsection 
@section('content')

 
	<div class="layout-content" ng-app="appTable" ng-controller='ItemsController'>
        <div class="layout-content-body">
        	<div class="col-sm-12">
                
            
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
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="form-control">
                                <br>
                                <button class="btn btn-success">Import User Data</button>
                                <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
                            </form> 
                      </div>
                  </div>
                </div>  
              </div>
			</div>
        </div>
@endsection
