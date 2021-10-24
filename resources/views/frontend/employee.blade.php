@extends('layouts.app')

@section('title', 'Eishop')

@section('sidebar')
    @parent
@endsection
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
</style>
@section('content')
	 <div id="page" class="page">
          <div class="content-section">
   			 <div class="col-sm-12 col-xs-12" style="margin:0; padding:0 3px">
             	 <div class="content-section-header left">
                	<h2 class="title">Employees Details List</h2>
                    <div class="col-sm-12">
                            @if($allemployee!="")
                                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead style="background:#C1DFFD;">
                                    <tr>
                                      <th width="4%">SI</th>
                                      <th width="15%">Image</th>  
                                      <th width="13%">Name</th>
                                      <th width="24%">Designation</th>
                                      <th width="24%">Department</th>
                                      <th width="24%">Branch</th>
                                      <th width="24%">Mobile</th>
                                      <th width="24%">Email</th> 
                                  </tr>
                			  </thead>
                               <tbody>
                			<?php $i=0; ?>
                            @foreach($allemployee as $employee)
                            <?php $i++;
							?>

                            <tr>
                              <td>{{ $i }}</td>
                              <td><img src="{{ asset('uploads/employee/'.$employee->image) }}" style="width:70px; height:auto" /></td>
                              <td>{{ $employee->name }}</td>
							  <td>{{ $employee->designation }}</td>	
                              <td>{{ $employee->department }}</td>	
                              <td>{{ $employee->branch }}</td>	
                              <td>{{ $employee->mobile }}</td>	
                              <td>{{ $employee->email }}</td>	                         
                            </tr>
                            @endforeach
            				</tbody>
                      </table>
                            @endif
                      </div>
                </div>
            </div>
    	  </div>
  	</div>
@endsection


@section('footer')
    @parent
@endsection
