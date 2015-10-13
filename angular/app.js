var groupApp = angular.module('groupApp', ['ngRoute']);

// http://www.amitavroy.com/justread/content/groups/ajax-data-using-angular-js-http-and-use-route-service-inside-codeigniter
//routes
groupApp.config(function($routeProvider){
    $routeProvider
    .when('/',{
        templateUrl:'angular/module/group/views/list.html',
        controller:'GroupController'
    })

    .when('/about',{
        templateUrl:'angular/static_views/about.html',
        controller:'AboutController'
    })

    .when('/contact',{
        templateUrl:'angular/static_views/contact.html',
        controller:'contactController'
    })
});

//controllers
groupApp.controller('AboutController',function($scope){
    $scope.message="about page";
});



groupApp.controller('GroupController', function ($scope, $http) {

    $scope.filterGroup='angular/module/group/views/filter.html'
    
    $scope.add=true;
    $scope.addForm="angular/module/group/views/add.html";
    
    $scope.edit=false;
    $scope.editForm="angular/module/group/views/edit.html";

    $scope.message="home page";
    $scope.group_menu=true;

    $scope.group=null;
    // $scope.name=null;
    // $scope.desc=null;

    loadGroups();

    function loadGroups(){
        $http.get('api/group').success(function(data){
            $scope.groups = data.data;
            $scope.all_status =[
            {key:'Active',value:'Active'},
            {key:'Inactive',value:'Inactive'}
            ];
        }).error(function(data){
            $scope.groups = data;
        });
    }
    
    $scope.refresh = function(){
        loadGroups();
    }

    $scope.addGroup = function(group){
        $http({
          method  : 'POST',
          url     : 'api/group/add',
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' },  
          data: 'name='+group.name+'&desc='+group.desc
      })
        .success(function(data){
            console.log(data);
            loadGroups();
        }).error(function(data){
            console.log(data.error);
        });
    }

    $scope.cancelAddding = function(){
        $scope.group=null;
    }

    $scope.removeGroup = function(group){
        var oldgroup = {'slug': group.slug};
        console.log(oldgroup);
        $http.post('group/api/remove', oldgroup).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.publishGroup = function(group){
        var oldgroup = {'slug': group.slug};
        console.log(oldgroup);
        $http.post('group/api/publish', oldgroup).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.loadGroup = function(slug){
        // console.log(slug);
        $http.get('api/group?slug='+slug).success(function(data){
            $scope.group = data.data;
            $scope.add=false;
            $scope.edit=true;
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.cancelEditing = function(){
        $scope.add=true;
        $scope.edit=false;
        $scope.group=null;
    }


    $scope.editGroup = function(group){
        console.log(group);
        return false;
        $http.put('group/api/edit', oldgroup).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

});