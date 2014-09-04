var myApp = angular.module('razborApp', []);

myApp.factory('RequestApi', ['$http', function ($http) {

	var RequestApi = {};

	RequestApi.getParts = function(req_id){
		return $http({
			method: 'GET',
			url: '/admin/requests/getParts',
			data: {id: req_id}
		});
	};

	return RequestApi;
}]);

myApp.controller('RequestCtrl', ['$scope', 'RequestApi', function ($scope, RequestApi) {
    
	$scope.parts = [];

	console.log($scope.request_id);

	RequestApi.getParts($scope.request_id).success(function(res){
		$scope.parts.push(res);
	});

	$scope.addPart = function(part){
		$scope.parts.push(part);

		$scope.part = {};

		$scope.part.id = '';
		$scope.part.name = '';
		$scope.part.location_id = '';
		$scope.part.price_sell = '';

		console.log($scope);
	};
    
}]);