/**
 * Created by cfibqqz on 19/02/2016.
 */
angular.module('homeApp').controller('home_ctrl',function ($scope,$location,Data) {
	
	$scope.documents=[];

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
    
    
});