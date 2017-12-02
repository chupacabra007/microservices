'use strict';

angular.module('frontendApp')
  .controller('LoginCtrl',
    ['$scope', 'AuthenticationService',
     function ($scope, AuthenticationService) {
        AuthenticationService.ClearCredentials();        
            	  
    	  $scope.login = function() {
    	      $scope.dataLoading = true;
    	      AuthenticationService.Login($scope.username, $scope.password, function (response) {
    	          console.log(response);
    	          $scope.dataLoading = false;
    	      });
    	      
    	  };    	  
    }]);