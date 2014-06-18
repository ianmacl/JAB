'use strict';

// Declare app level module which depends on filters, and services
angular.module('MashApp', ['Mash.services']).
  config(['$routeProvider', function($routeProvider) {
    $routeProvider.otherwise({redirectTo: '/'});
  }]);
