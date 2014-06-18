'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('Mash.services', ['ngResource']).
  factory('Article', function($resource){
    return $resource(
      'articles/:articleId',
      {articleId:'@article_id'},
      {
        'get':    {method:'GET'},
        'save':   {method:'POST'},
        'query':  {method:'GET', isArray:true},
        'remove': {method:'DELETE'},
        'delete': {method:'DELETE'},
        'update': {method:'PUT'}
      }
    );
  }).
  factory('Activity', function($resource){
    return $resource(
      'activities',
      {},
      {
        'get':    {method:'GET'},
        'save':   {method:'POST'},
        'query':  {method:'GET', isArray:true},
        'remove': {method:'DELETE'},
        'delete': {method:'DELETE'},
        'update': {method:'PUT'}
      }
    );
  });
