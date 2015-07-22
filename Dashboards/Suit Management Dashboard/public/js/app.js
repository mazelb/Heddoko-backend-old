var app = angular.module('suit-editor', ['backend']);

app.controller('MainController', ['$scope', 'Suits', function($scope, Suits)
{

	Suits.get()
	.success(function(suits_response)
	{
		$scope.suits = suits_response;
	});
	
	$scope.DeleteSuit = function(suit){
		Suits.destroy(suit).success(function(suits_response)
		{
			$scope.suits = suits_response;			
			
		}).error(function(err_response)
		{
			console.log(err_response);
		});
	};
  

}]);

angular.module('backend', []).factory('Suits', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/suits');
		},
		
		destroy : function(suit)
		{
			return $http.delete('/suits/' + suit.id);
		}
	
	};

}).factory('SensorTypes', function()
{
	//TODO
}).factory('AnatomicalPositions', function()
{
	var shinyNewServiceInstance;
	// factory function body that constructs shinyNewServiceInstance
	return shinyNewServiceInstance;
});