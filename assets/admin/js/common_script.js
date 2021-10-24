var app = angular.module("appTable",[]);
app.controller("ItemsController",function($scope) {
$scope.items = [{newItemName:''}];
	$scope.addItem = function (index) {
		$scope.items.push({newItemName:''});
	}
	var newDataList = [];
	 $scope.deleteItem = function (index) {
		 if(!index){
			alert("\tDelete Error. \n Root Row not deletable.");
			$scope.items.push({newItemName:''});
		}
		$scope.items.splice(index, 1);
	}			
});

function actionMenu(id){
		//alert(id);
		//$('#actonlists' + id).css('display', 'block');
		$("#actonlists"+id).slideToggle();
	}
	
	
	function deleteSingle(id,patch,tables){
		
	  swal({
			title: "Are you sure?",
			text: "You will not be able to recover this imaginary file!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: patch,
				type: "GET",
				data: {'id':id,'tablename':tables},
				dataType: "html",
				success: function () {
					swal("Done!", "It was succesfully deleted!", "success");
					$("#tablerow" + id).fadeOut('slow');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Error deleting!", "Please try again", "error");
				}
			});
		});
		
	}