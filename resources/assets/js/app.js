angular.module('washingtonian', []);

angular.module('washingtonian')
  .controller('FitFestController', ['$scope', function ($scope) {

    $scope.selectedCourses = [];

    $scope.addCourse = function (course) {
      console.log($scope.selectedCourses.length);
      if( $scope.selectedCourses.length != 3)
        $scope.selectedCourses.push(course);

    };

    $scope.removeCourse = function (course) {
      var index = $scope.selectedCourses.indexOf(course);
      $scope.selectedCourses.splice(index, 1);
    };

  }]);




