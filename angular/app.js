var groupApp = angular.module('groupApp', ['ngRoute']);

// http://www.amitavroy.com/justread/content/groups/ajax-data-using-angular-js-http-and-use-route-service-inside-codeigniter
// var groupApp = angular.module('groupApp', ['ngRoute']);
//routes
groupApp.config(function($routeProvider){
    $routeProvider
    .when('/',{
        templateUrl:'angular/static_views/home.html',
        controller:'mainController'
    })

    .when('/about',{
        templateUrl:'angular/static_views/about.html',
        controller:'aboutController'
    })

    .when('/contact',{
        templateUrl:'angular/static_views/contact.html',
        controller:'contactController'
    })
});

//controllers
groupApp.controller('mainController',function($scope){
    $scope.message="home page";
});

groupApp.controller('aboutController',function($scope){
    $scope.message="about page";
});

// groupApp.controller('contactController',function($scope){
//     $scope.message="contact page";
// });


groupApp.controller('groupCtrl', function ($scope, $http) {


    $http.get('api/group/index').success(function(data){
        $scope.groups = data.data;
        $scope.all_status =[
        {key:'Unpublished',value:'Unpublished'},
        {key:'Published',value:'Published'},
        {key:'Deleted',value:'Deleted'}];
        // $scope.all_status =[
        // {key:'1',value:'Unpublished'},
        // {key:'2',value:'Active'},
        // {key:'3',value:'Deleted'}];
    }).error(function(data){
        $scope.groups = data;
    });

    $scope.refresh = function(){
        $http.get('group/api/index').success(function(data){
            $scope.groups = data;
        }).error(function(data){
            $scope.groups = data;
        });
    }

    $scope.addgroup = function(){
        var newgroup = {'name': $scope.name,'content': $scope.content};
        console.log(newgroup);
        $http.post('group/api/add', newgroup).success(function(data){
            // $scope.refresh();
            console.log(data);
            $scope.name = '';
            $scope.content = '';
        }).error(function(data){
            console.log(data.error);
        });
    }

    $scope.removegroup = function(group){
        var oldgroup = {'slug': group.slug};
        console.log(oldgroup);
        $http.post('group/api/remove', oldgroup).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.publishgroup = function(group){
        var oldgroup = {'slug': group.slug};
        console.log(oldgroup);
        $http.post('group/api/publish', oldgroup).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.loadgroup = function(slug){
        console.log(slug);
        $http.get('group/api/index/'+slug).success(function(data){
            console.log(data);
            $scope.group = data;
        }).error(function(data){
            $scope.group = data;
        });
    }

    $scope.editgroup = function(group){
        var oldgroup = {'name': group.name,'content': group.content};
        console.log(oldgroup);
        $http.put('group/api/edit', oldgroup).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

});