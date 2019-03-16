<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>eTester WSIZ</title>

        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <script src="/js/angular.md5.js" crossorigin="anonymous"></script>
        <script src="/js/angular.storage.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Raleway', sans-serif;
            }
            
            .content-page {
                margin-top: 30px;
                width: 100%;
                padding: 20px;
                /*border:1px solid rgba(144,144,144,0.3);*/
                border-left:3px solid rgba(144,144,144,0.3);
                box-shadow: 0px 0px 7px rgba(144,144,144,0.2);
                border-radius: 5px;
            }
            
            .content-page.danger {
                border-left:3px solid #dc3545;
            }
            
            .loader {
                position: absolute;
                left: 0;
                top:0;
                display: block;
                height: 100vh;
                width: 100vw;
                padding-top: 45vh;
                font-size: 40px;
            }
            
            .a,.b,.c,.d,.e,.f{
                font-size:0;
            }
            
        </style>
    </head>
    <body ng-app="myApp" ng-controller="testCtrl">
                    <div class="loader" ng-show="!loader">
                        <div class="">
                            <div class="" style="text-align: center">Proszę czekać !!, czytam dane</div>
                        </div>
                    </div>
        
                    <div class="alert alert-warning alert-dismissible fade show" ng-show="danger" role="alert">
                      <strong>Błąd</strong> @{{danger}}.
                      <button type="button" class="close" ng-click="danger=false">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>        
        <div class="container"  >
            
            <div class="content">

            
                    <div class="row h">
                        <div class="col-sm"><h2>eTester</h2></div>
                        <div class="col-sm text-right " ng-show="user.imie!=undefined" ng-click="logout()" style="cursor:pointer; padding-top: 10px;">@{{user.imie}} @{{user.nazwisko}} (@{{user.album}}) wyloguj</div>
                        
                    </div>
                
                    
                  
                
                    @include('testTemplate::logowanie')
                    @include('testTemplate::page')
                    @include('testTemplate::egzaminStart',['page'=>\wsiz\etester\Model\Page::find(2)])
                    


            </div>
        </div>
                    <script>
                    var app = angular.module('myApp', ['ngStorage']);
                    app.controller('testCtrl', function($scope, $http, $localStorage, $interval ) {
                        $scope.$storage = $localStorage;
                        
                        $scope.errmess = "";
                        $scope.dziekanpass = "";
                        
                        
                        $scope.czytajdane_usera = function()
                        {
                           $http.get('https://dziekanat.wsi.edu.pl/get/wd-auth/user?wdauth='+$scope.$storage.user).then(
                                  function(e){
                                      if(e.data.status!=undefined)
                                      {
                                        $scope.$storage.logowanieView = 1;
                                      } else
                                        $scope.user = e.data;
                                      console.log($scope.user);
                                  }, 
                                  function(e){} 
                                );
                        }
                        
                        $scope.logout= function(){
                            delete $scope.$storage.user;
                            location.reload();
                        }
                        
                        if($scope.$storage.user==undefined)
                        {
                            $scope.$storage.logowanieView = 1;
                        } else
                        {
                            $scope.czytajdane_usera();
                        }
                        
                        
                        $scope.rozpocznijtest = function()
                        {
                            $scope.dziekanpassord="";
                            if($scope.dziekanpass!="")
                                $scope.dziekanpassord=md5($scope.dziekanpass);
                            $scope.dziekanpass = "";
                            
                            
                            $http.get('/generujpytania?pass='+$scope.dziekanpassord).then(function(e){
                                $scope.$storage.test = false
                                if(e.data.egzamin === null)
                                {
                                    $scope.danger = "Program nie wylosował pytań lub hasło dziekana jest niepoprawne";
                                } else {
                                    
                                    $scope.$storage.test = e.data;
                                   console.log(e);
                                }
                                console.log(e);
                            },function(e){
                                
                            });
                        }
                        
                        $scope.logowanie = function() {
                            
                            $http.get('https://dziekanat.wsi.edu.pl/get/wd-auth/auth?album='+$scope.albumnr+'&pass='+md5($scope.albumpass)).then(
                                    function(e){
                                        if(e.data.status==undefined)
                                        {
                                           $scope.$storage.user = e.data;
                                           $scope.$storage.logowanieView = 0;
                                           $scope.czytajdane_usera();
                                           
                                        } else
                                        {
                                            $scope.danger = "Problem z logowaniem do serwera WSIZ, zły login lub hasło";
                                            
                                        }
                                          console.log(e);  
                                    },
                                    function(e){
                                        $scope.danger = "Problem z logowaniem do serwera WSIZ"
                                        $scope.$storage.logowanieView = 1;
                                    }
                            )
                            
                        }
                        
                        $scope.logowaniedziekana = function() {
                            
                            $http.get('logowaniedziekana?pass='+md5($scope.albumpass)).then(
                                    function(e){
                                    },
                                    function(e){
                                        $scope.danger = "Problem z logowaniem do serwera WSIZ"
                                        $scope.$storage.logowanieView = 1;
                                    }
                            )
                            
                        }
                        
                        $scope.loader = true;
                        
                    });
                    </script>
    </body>
</html>
