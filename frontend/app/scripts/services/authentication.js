'use strict';
 
angular.module('Authentication')
 
.factory('AuthenticationService',
    ['$http', '$rootScope', 
     function ($http, $rootScope) {
        var service = {};

        service.Login = function (username, password) {
            $http.post('/users/authenticate', { username: username, password: password })
                .success(function (response) {
                    console.log(response);
                });
        };
 
        service.SetCredentials = function (token) {
            $rootScope.localStorage.setItem('token', token);            
            $http.defaults.headers.common['Authorization'] = 'Bearer ' + token; // jshint ignore:line
        };
 
        service.ClearCredentials = function () {
            $rootScope.removeItem('toke');
            $http.defaults.headers.common.Authorization = 'Bearer ';
        };
 
        return service;
    }]);


































