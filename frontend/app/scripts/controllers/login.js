'use strict';

angular.module('frontendApp')
  .controller('LoginCtrl',
    ['$scope', 'AuthenticationService',
     function ($scope, AuthenticationService) {
        var vm = this;

        AuthenticationService.ClearCredentials();        
            	  
    	  $scope.login = function() {
    	      vm.dataLoading = true;
    	      
    	      AuthenticationService.Login(vm.username, vm.password, function (response) {
    	          console.log(response);
    	          vm.dataLoading = false;
    	      });
    	      
    	  };    	  
    }]);