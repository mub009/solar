
app.controller('DealerController',function ($scope,$http) {
    
 
  
    angular.element('#NavMainUsers').addClass("open active");
    
    angular.element('#ArrowMainUsers').addClass("open active");
    
    angular.element('#NavUsersDealer').addClass("open active");


      $http.get(base_url+"admin/user/dealer/details")
          .then(function(Response) {

        //     console.log(DealerDetails);
            $scope.dealerDetails=Response.data;

        });

          //$('#sample_11').DataTable();
          //angular.element('#sample_11').DataTable();

       // angular.module('formvalid', ['ui.bootstrap', 'ui.utils']);
   

       $scope.initDataTable = function() {
       $timeout(function() {
            if (rowCount >= 0) {
              console.log("Entered into Sorting");
              $("#sample_11").dataTable({
                 "pagingType" : "full_numbers",
                 "order" : [ [ 2, "desc" ] ]
              });
           }
        }, 200)
     }


          $scope.myWelcome='test';
   // $http.get('')

       

});

