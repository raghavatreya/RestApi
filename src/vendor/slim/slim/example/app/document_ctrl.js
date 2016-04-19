/**
 * Created by cfibqqz on 06/04/2016.
 */
angular.module('homeApp').controller('document_master_ctrl', function ($scope,Data,$location) {
    console.log("welcome admin in document_master_ctrl");

   $scope.getResult=function(){
        var pic=$scope.pic;
        var authorid=$scope.authorid;
        var tag = $scope.tag;
        var Value='{tag:'+tag+',authorid:'+authorid+'}';
        //alert('search/'+term);
        /*
        Data.post('insert/'+json).then(function (results) {
           // if (results.code == 200) {
                //$scope.document_master=results.response;
                //console.log($scope.document_master);
            //}else{
            //    console.log(results.message);
            console.log(results.Document[0]);
            $scope.documents=results.Document;
            });

            */
                 var req = {
                 method: 'POST',
                 url: 'http://localhost/testrest/src/vendor/slim/slim/example/api/insert',
                 headers: {
                   'Content-Type': undefined
                 },
                 data: { Value: 'Value',pic:'pic' }
                }

                $http(req).then(function(){
                    alert("Successful");
                }, function(){

                    alert("Error");
                });
                    
                    };

});
