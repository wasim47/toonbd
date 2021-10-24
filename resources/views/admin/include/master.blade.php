  	@include('admin.include.app')
    @include('admin.include.header') 
        @yield('content') 
    @include('admin.include.footer')
	 <link href="{{ asset('assets/admin/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/elephant.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/application.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="{{ asset('assets/admin/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.3.0/dist/sweetalert2.all.js"></script>
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/js/common_script.js') }}"></script>
<script>
$(document).ready(function() {
$('#responsive-datatable').DataTable();
} );

checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}


function permissions(tables,status,statuscol){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var dataval= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			dataval[j]=summeCode[i].value;
			j++;			
		}		
	}
	if(dataval=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			if(tables == 'customers'){
				var urls = "{{ url('administration/permissionsuser') }}";
			}
			else{
				var urls = "{{ url('administration/permissions') }}";
			}
			
			var hrefdata = urls+"?approve_val="+dataval+"&&tablename="+tables+"&&status="+status+"&&statuscol="+statuscol;
			window.location.href=hrefdata;
	}	
}

function deletedata(patch,tables)
{
		var summeCode=document.getElementsByName("summe_code[]");
		var j=0;
		var dataval= new Array();
		var furl = patch;
		var imagedel = false;
		for(var i=0; i < summeCode.length; i++){
			if(summeCode[i].checked)
			{
				dataval[j]=summeCode[i].value;
				j++;				
			}			
		}
		if(dataval=="")
		{
			swal({
			  title: "Unchecked credential!",
			  text: "Please check one or more!",
			  icon: "warning",
			});
			return false;
		}
		else{	

			swal({
			  title: 'Are you sure?',
			  //type: 'warning',
			  imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}",
			  confirmButtonText: 'Ok, Delete It',
			  showCloseButton: true,
  			  showCancelButton: true,
			  text: "Do you want to Delete Selected Data !",
			 // input: 'checkbox',
			  //inputPlaceholder: ' Delete all Images for Selected Submission'
			}).then((result) => {
			  if (result.value) {
				//swal({type: 'success', text: 'You have a bike!'});
				imagedel = true;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':dataval,'deletetype':'multiple','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected data are deleted",
						  type: "success",
						});
						 var len = html.length;
						for(i in html){
							 $("#tablerow" + html[i]).fadeOut('slow');
						}				
					 }					
				});	
			
			  } else {
				console.log('modal was dismissed by ${result.dismiss}')
			  }
			  
		});
	}
}

function deleteSingle(id,patch,tables){
		
		var furl = patch;
		//alert(tables);
		var imagedel = false;
		
			swal({
			  imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}",
			  title: 'Are you sure?',			 
			  confirmButtonText: 'Ok, Delete It',
			  //type: 'warning',
			  showCloseButton: true,
  			  showCancelButton: true,
			  text: "Do you want to Delete Selected data !",
			  //input: 'checkbox',
			  //inputPlaceholder: ' Delete all Images for Selected data'
			}).then((result) => {
			  if (result.value) {
				//swal({type: 'success', text: 'You have a bike!'});
				imagedel = true;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':id,'deletetype':'single','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected data are deleted",
						  type: "success",
						});
						$("#tablerow" + id).fadeOut('slow');
					 }					
				});	
			
			  } else if (result.value === 0) {
				//swal({type: 'error', text: "You don't have a bike :("});
				imagedel = false;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':id,'deletetype':'single','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected Submission are deleted",
						  type: "success",
						});
						$("#tablerow" + id).fadeOut('slow');			
					 }					
				});	
			
			  } else {
				console.log('modal was dismissed by ${result.dismiss}')
			  }
			  
		});
	}



</script>
  </body>
</html>