function connectController($scope, $rootScope, $location, connectService, userService){
	$('body').css({'background':'url("../assets/bg-accueil.jpg") cover'});
	$rootScope.connect = false;
	sessionStorage.setItem('groupe','');
	$scope.connect = function (){
		console.log('kkklklkl');
	}
	userService.getAll().then(function(res, err){
		$scope.test = res.data;
		console.log($scope.test);
		console.log('erreur');
		console.log(err);
	});
	// $scope.connect = function(){
	// 	connectService.connect($scope.user).then(function(res){
	// 		$rootScope.token = res.data.token;
  //     $rootScope.user = res.data.user;
	// 		$location.path('/');
	// 	}).catch(function(){
	// 		$rootScope.loginMessage.title = "Connexion error";
	// 		$rootScope.loginMessage.message = "Error login or password";
	// 	});
	// }
}
