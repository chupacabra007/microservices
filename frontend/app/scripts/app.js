'use strict';

/**
 * @ngdoc overview
 * @name frontendApp
 * @description
 * # frontendApp
 *
 * Main module of the application.
 */
angular
  .module('frontendApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/login', {
        templateUrl: 'views/login.html',
        controller: 'LoginCtrl',
        controllerAs: 'login'
      })      
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })      
      .otherwise({
        redirectTo: '/login'
      });   
  })
  .run(['$rootScope', '$location', '$http', '$window', function($rootScope, $location, $http, $window) {
    $rootScope.localStorage = $window.localStorage;
    if ($rootScope.localStorage.getItem('token')) {
      $http.defaults.headers.common.Authorization = 'Bearer ' + $rootScope.localStorage.getItem('token');     
    }
    $rootScope.$on('$locationChangeStart', function () {
      if ($location.path() !== '/login' && !$rootScope.localStorage.getItem('token')) {
        $location.path('/login');
      }
    });
  }]);
