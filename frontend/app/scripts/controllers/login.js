'use strict';

angular.module('frontendApp')
  .controller('LoginCtrl',
    ['$scope', '$rootScope', '$location', 
    function ($scope, $rootScope, $location) {
    	  $scope.login = function() {
    	      console.log("Login!");
    	  };    	  
    }]);