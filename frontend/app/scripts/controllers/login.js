'use strict';

angular.module('frontendApp')
  .controller('LoginCtrl',
    ['$scope', function ($scope) {
    	  $scope.login = function() {
    	      console.log('Login');
    	  };    	  
    }]);