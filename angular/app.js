var articleApp = angular.module('articleApp', ['ngRoute']);

// http://www.amitavroy.com/justread/content/articles/ajax-data-using-angular-js-http-and-use-route-service-inside-codeigniter
// var articleApp = angular.module('articleApp', ['ngRoute']);
//routes
articleApp.config(function($routeProvider){
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

// // //controllers
articleApp.controller('mainController',function($scope){
    $scope.message="home page";
});

articleApp.controller('aboutController',function($scope){
    $scope.message="about page";
});

// articleApp.controller('contactController',function($scope){
//     $scope.message="contact page";
// });


articleApp.controller('ArticleCtrl', function ($scope, $http) {


    $http.get('api/group/index').success(function(data){
        console.log(data);
        $scope.articles = data.data;
        $scope.all_status =[
        {key:'Unpublished',value:'Unpublished'},
        {key:'Published',value:'Published'},
        {key:'Deleted',value:'Deleted'}];
        // $scope.all_status =[
        // {key:'1',value:'Unpublished'},
        // {key:'2',value:'Active'},
        // {key:'3',value:'Deleted'}];
    }).error(function(data){
        console.log(data);
        $scope.articles = data;
    });

    $scope.refresh = function(){
        $http.get('article/api/index').success(function(data){
            $scope.articles = data;
        }).error(function(data){
            $scope.articles = data;
        });
    }

    $scope.addArticle = function(){
        var newArticle = {'name': $scope.name,'content': $scope.content};
        console.log(newArticle);
        $http.post('article/api/add', newArticle).success(function(data){
            $scope.refresh();
            $scope.name = '';
            $scope.content = '';
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.removeArticle = function(article){
        var oldArticle = {'slug': article.slug};
        console.log(oldArticle);
        $http.post('article/api/remove', oldArticle).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.publishArticle = function(article){
        var oldArticle = {'slug': article.slug};
        console.log(oldArticle);
        $http.post('article/api/publish', oldArticle).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

    $scope.loadArticle = function(slug){
        console.log(slug);
        $http.get('article/api/index/'+slug).success(function(data){
            console.log(data);
            $scope.article = data;
        }).error(function(data){
            $scope.article = data;
        });
    }

    $scope.editArticle = function(article){
        var oldArticle = {'name': article.name,'content': article.content};
        console.log(oldArticle);
        $http.put('article/api/edit', oldArticle).success(function(data){
            $scope.refresh();
            console.log(data);
        }).error(function(data){
            alert(data.error);
        });
    }

});