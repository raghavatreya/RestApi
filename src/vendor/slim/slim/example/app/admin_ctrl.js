/**
 * Created by cfibqqz on 06/04/2016.
 */
angular.module('homeApp').controller('admin_ctrl', function ($scope,$location,Data) {
    console.log("welcome admin");

   $scope.documents=[];

   $scope.deleteDoc=function(id){
   		$.ajax({
   			url:"http://localhost/testrest/src/vendor/slim/slim/example/api/delete/"+id,
   			type:"delete",
   			async:false,
   			success:function(data){
   					alert("delterd");
   			}

   		});

   		$scope.getResult();
   };	



	$scope.getResult=function(){
		var term=$scope.key;
		var type=$scope.type;
		//alert('search/'+term);
		Data.get('search/'+term).then(function (results) {
           // if (results.code == 200) {
                //$scope.document_master=results.response;
                //console.log($scope.document_master);
            //}else{
            //    console.log(results.message);
            console.log(results.Document[0]);
            $scope.documents=results.Document;
            });

	};
	$scope.getdelete = function(term1){
		Data.delete('delete/'+term1).then(function (results){
			console.log("Deleted Document Succesful");
            //$scope.documents=results.Document;
		});
	};
});