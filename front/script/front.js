var app = angular.module("sabbath", []);
app.controller("front", function($scope,$http) { // КОНТРОЛЛЕР ГЛАВНОЙ СТРАНИЦЫ
    


  $scope.contents ='hello'; // Начальное состаяние главной страницы

 
  $scope.setTemplate = function () { // Переключатель страниц

	  return './front/html/'+ $scope.contents + '.html';
  }
  $scope.goto  = function(to) { // функция вызова переключения страниц

    $scope.contents = to;
  }
  $scope.startAugury = function () { // Старт гадания

      $http.get('?cmd=startAugury').
              then(
                      function success(response) {
                          $scope.Augury = response.data;
                          $scope.goto('number');
                          
                      },
                      function error(response) {
                        
                      }
                  );
  }
  $scope.sendNumber = function (num) { // Отправить число

    $http.get('?cmd=sendNumber&num=' + num).
              then(
                      function success(response) {
                          $scope.Stats = response.data; // возвращает статистику
                          $scope.goto('hello');
                          
                      },
                      function error(response) {
                        
                      }
                  );
  }

});






