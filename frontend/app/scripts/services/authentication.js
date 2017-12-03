'use strict';
 
angular.module('frontendApp')
 
.factory('AuthenticationService',
    ['$http', '$rootScope', '$location', 
     function ($http, $rootScope, $location) {
        var service = {};

        service.Login = function (username, password) {
        	   $http.post('/users/authenticate', { username: username, password: password })
                .then(function onSuccess(response) {
                	  service.SetCredentials(response.data.token);
                	  $location.path('/');
                });
        };
 
        service.SetCredentials = function (token) {
            $rootScope.localStorage.setItem('token', token);            
            $http.defaults.headers.common['Authorization'] = 'Bearer ' + token; // jshint ignore:line
        };
 
        service.ClearCredentials = function () {
            $rootScope.localStorage.removeItem('token');
            $http.defaults.headers.common.Authorization = 'Bearer ';
        };
 
        return service;
    }]);


































