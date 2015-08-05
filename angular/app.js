var articleApp = angular.module('articleApp', []);

articleApp.controller('ArticleCtrl', function ($scope, $http) {

    $http.get('article/api/index').success(function(data){
        $scope.articles = data;
    }).error(function(data){
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