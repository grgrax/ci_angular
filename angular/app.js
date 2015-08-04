var todoApp = angular.module('todoApp', []);
 
todoApp.controller('TodoCtrl', function ($scope, $http) {
 
    $http.get('todo/api/index').success(function(data){
        $scope.tasks = data;
    }).error(function(data){
        $scope.tasks = data;
    });
 
    $scope.refresh = function(){
        $http.get('todo/api/index').success(function(data){
            $scope.tasks = data;
        }).error(function(data){
            $scope.tasks = data;
        });
    }
 
    $scope.addTask = function(){
        var newTask = {name: $scope.name,content: $scope.content};
        console.log(newTask);
        $http.post('todo/add', newTask).success(function(data){
            $scope.refresh();
            $scope.name = '';
            $scope.content = '';
        }).error(function(data){
            alert(data.error);
        });
    }
 
    $scope.deleteTask = function(task){
        $http.delete('todo/tasks/' + task.id);
        $scope.tasks.splice($scope.tasks.indexOf(task),1);
    }
 
    $scope.updateTask = function(task){
        $http.put('todo/tasks', task).error(function(data){
            alert(data.error);
        });
        $scope.refresh();
    }
 
});