var Reg_Stat = angular.module('Reg_Stat', []);

Reg_Stat.controller('FormLogin', function($scope, $http){
    
    $scope.checkLogin = function(){
        
        /[а-яА-ЯёЁ]+/.test(this.login) ? $scope.russianLogin = true : $scope.russianLogin = false;
        /[-!"#$%&'()*+,./:;<=>?@[\\\]_`{|}~]+/.test(this.login) ? $scope.nonLetterLogin = true : $scope.nonLetterLogin = false;
        
    };
    
    $scope.checkPassword = function(){
        
        /[а-яА-ЯёЁ]+/.test(this.password) ? $scope.russianPassword = true : $scope.russianPassword = false;
        /[-!"#$%&'()*+,./:;<=>?@[\\\]_`{|}~]+/.test(this.password) ? $scope.nonLetterPassword = true : $scope.nonLetterPassword = false;
        
    };
    
    $scope.sendLogin = function(){
        $http({method: 'GET', url:'sendLogin.php', params:{login: this.login}}).success(function(data){
            
        });
    };
    
});