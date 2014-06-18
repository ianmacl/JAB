'use strict';

/* Controllers */

function ActivityCtrl($scope, Activity) {
  $scope.activities = Activity.query();

  $scope.addActivity = function() {
    $scope.activities.push(Activity.save({name: $scope.activity_name, value: $scope.activity_length}));
  }

  $scope.$watch('tasks', function () {
    //$scope.remainingCount = filterFilter($scope.tasks, {completed: 0}).length;
    //$scope.completedCount = $scope.tasks.length - $scope.remainingCount;
    //$scope.allChecked = !$scope.remainingCount;
  }, true);
}


function ArticleCtrl($scope, Article) {
  $scope.articles = Article.query();

  $scope.addArticle = function() {
    $scope.articles.push(Article.save({title: $scope.article_title, body: $scope.article_body}));
  }

  $scope.$watch('tasks', function () {
    //$scope.remainingCount = filterFilter($scope.tasks, {completed: 0}).length;
    //$scope.completedCount = $scope.tasks.length - $scope.remainingCount;
    //$scope.allChecked = !$scope.remainingCount;
  }, true);
}
