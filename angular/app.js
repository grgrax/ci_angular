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

    $scope.group={};
    $scope.currentGroup={};

    $scope.groupStatus=[
    {id: 1, name: "Yes"},
    {id: 2, name: "No"}
    ];

    loadGroups();

    $scope.refresh = function(){
        loadGroups();
    }

    $scope.resetForm = function(){
        // if($scope.add){
        //     console.log($scope);
        //     // $scope.group.name=null;
        // }else{
        //     $scope.group = angular.copy($scope.currentGroup);
        //     console.log($scope);
        // }
    }

    function loadGroups(){
        $http.get('api/group').success(function(data){
            $scope.groups = data.data;
        }).error(function(data){
            $scope.groups = data;
        });
    }


    //add
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

    
    //edit
    $scope.loadGroup = function(slug){
        $http.get('api/group?slug='+slug).success(function(data){
            $scope.currentGroup = data.data;
            $scope.group = data.data;
            $scope.add=false;
            $scope.edit=true;
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.editGroup = function(group){
        $http({
          method  : 'POST',
          url     : 'api/group/edit',
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' },  
          data: 'slug='+group.slug+'&name='+group.name+'&desc='+group.desc+'&status='+group.status
      })
        .success(function(data){
            console.log(data);
            loadGroups();
        }).error(function(data){
            console.log(data.error);
        });
    }

    $scope.cancelEditing = function(){
        $scope.add=true;
        $scope.edit=false;
        $scope.group={};
        console.log($scope);
    }

    //delete
    $scope.deleteGroup = function(slug){
        if(confirm('Are you sure want to delete')){
            $http({
              method  : 'POST',
              url     : 'api/group/delete',
              headers : { 'Content-Type': 'application/x-www-form-urlencoded' },  
              data: 'slug='+slug
          })
            .success(function(data){
                console.log(data);
                loadGroups();
            }).error(function(data){
                console.log(data.error);
            });          
        }
    }

});