'use strict';
 
angular.module('frontendApp')
 
.factory('AuthenticationService',
    ['$http', '$rootScope', 
     function ($http, $rootScope) {
        var service = {};

        service.Login = function (username, password) {
        	   console.log(username, password);
            $http.post('/users/authenticate', { username: username, password: password })
                .then(function onSuccess(response) {
                    console.log(response);
                }, function onError (response) {
                    console.log(response);
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


































