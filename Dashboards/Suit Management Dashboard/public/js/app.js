var app = angular.module('suit-editor', ['backend']);

app.controller('MainController', ['$scope', 'Suits', 'SensorTypes', 'AnatomicalPositions', function($scope, Suits, SensorTypes, AnatomicalPositions)
{
	/*	
	for (var i = 0; i <= 9; i++)
	{
		$scope.sensor_form_defaults.physical_location.box.push('BOX' + i);
		
		for (var j = 65; j <= 90; j++)
		{
			$scope.sensor_form_defaults.physical_location.XYZ.push(String.fromCharCode(j) + i);	
		}		
	}*/
	
	Suits.get()
	.success(function(suits_response)
	{
		$scope.suits = suits_response;
	});
	
	SensorTypes.get()
	.success(function(sensor_types_response)
	{
		$scope.sensor_types = sensor_types_response;
	});
	
	AnatomicalPositions.get()
	.success(function(anatomical_positions_response)
	{
		$scope.anatomical_positions = anatomical_positions_response;
	});

	$scope.new_suit_sensors = [];
	
	$scope.DeleteSuit = function(suit){
		
		bootbox.confirm("Are you sure you want to delete this suit?", function(user_response) {
			if (user_response === true)
			{
				Suits.destroy(suit).success(function(suits_response)
				{
					$scope.suits = suits_response;
				}).error(function(err_response)
				{
					console.log(err_response);
				});
			}
		}); 
	};
	
	$scope.AddNewSuit = function(){

		for (i = 0; i < $scope.new_suit_sensors.length; i++) //validate that all fields have been entered
		{ 
			if(
			   !($scope.new_suit_sensors[i].type &&
				$scope.new_suit_sensors[i].anatomical_position &&
				$scope.new_suit_sensors[i].part_no &&
				$scope.new_suit_sensors[i].serial_no &&
				$scope.new_suit_sensors[i].physical_location &&
				$scope.new_suit_sensors[i].name))
			{
				bootbox.alert("Please fill in all sensor fields before submitting a new suit");
				return;
			}
		}
		
		bootbox.confirm("Are you sure you want to add this new suit?", function(user_response) {
			if (user_response === true)
			{
				Suits.create($scope.new_suit_sensors).success(function(suits_response)
				{
					$scope.suits = suits_response;
					$scope.new_suit_sensors = [];
					$scope.current_sensor = null;
				}).error(function(err_response)
				{
					bootbox.alert("The following error occurred while submitting the new suit to the database:" + err_response);
				});
			}
		}); 

	};
	
	$scope.UpdateExistingSuit = function(suit_to_be_updated){

		for (i = 0; i < suit_to_be_updated.sensors.length; i++) //validate that all fields have been entered
		{ 
			if(
			   !(suit_to_be_updated.sensors[i].type &&
				suit_to_be_updated.sensors[i].anatomical_position &&
				suit_to_be_updated.sensors[i].part_no &&
				suit_to_be_updated.sensors[i].serial_no &&
				suit_to_be_updated.sensors[i].physical_location &&
				suit_to_be_updated.sensors[i].name))
			{
				bootbox.alert("Please fill in all sensor fields before updating this existing suit");
				return;
			}
		}
		
		bootbox.confirm("Are you sure you want to update this existing suit?", function(user_response) {
			if (user_response === true)
			{
				Suits.update(suit_to_be_updated).success(function(suits_response)
				{
					$scope.suits = suits_response;
				}).error(function(err_response)
				{
					bootbox.alert("The following error occurred while updating the suit:" + err_response);
				});
			}
		}); 

	};
	
	$scope.AddNewSensor = function(){
		
		new_sensor = {};
		
		if($scope.sensor_types.length > 0)
		{
			new_sensor.type = $scope.sensor_types[0];
		}
		
		if($scope.anatomical_positions.length > 0)
		{
			new_sensor.anatomical_position = $scope.anatomical_positions[0];
		}
		
		$scope.new_suit_sensors.push(new_sensor); //push a new empty sensor to by filled in by the user
		$scope.current_sensor = new_sensor;		
	};

}]);

angular.module('backend', []).factory('Suits', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/suits');
		},
		
		create : function(new_suit_sensors_form_data) {

			return $http({
				method: 'POST',
				url: '/suits',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param({new_suit_sensors: new_suit_sensors_form_data})
			});
		},
		
		update : function(suit) {
			return $http({
				method: 'PUT',
				url: '/suits/' + suit.id,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param({updated_suit_sensors: suit.sensors})
			});
		},
		
		destroy : function(suit)
		{
			return $http.delete('/suits/' + suit.id);
		}
	
	};

}).factory('SensorTypes', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/sensortypes');
		}
	
	};
}).factory('AnatomicalPositions', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/anatomicalpositions');
		}
	
	};
});