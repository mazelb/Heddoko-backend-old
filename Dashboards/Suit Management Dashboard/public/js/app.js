var app = angular.module('suit-editor', ['backend', 'selectize']);

app.controller('MainController', ['$scope', 'Suits', 'SensorTypes', 'AnatomicalPositions', 'Equipment', 'Statuses', 'Materials', function($scope, Suits, SensorTypes, AnatomicalPositions, Equipment, Statuses, Materials)
{
	
	//configuration for selectize control
	$scope.new_equipment_config = {
		valueField: 'id',
		labelField: 'serial_no',
		searchField: 'serial_no',
		placeholder: 'Pick a sensor',
		onInitialize: function(selectize){},
		render: {
			option: function(item, escape) {
				return '<div>' +
					'<span class="title">' + escape(item.serial_no) +'</span> ' +
					'<span class="description">' + escape(item.physical_location) + '</span>' +
				'</div>';
			}
		},
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: '/equipment'/*?q=' + encodeURIComponent(query)*/  ,
				type: 'GET',
				error: function() {
					callback();
				},
				success: function(response) {
					callback(response);
				}
			});
		}
	};

	$scope.search_term = ''; //the value of the search term the user has typed into the search box
	$scope.filtered_suits_list = []; //a subset of the suits
	$scope.equipment_list = []; //the list of equipment, a specific piece of hardware that can be put into a suit
	$scope.materials_list = []; //list of materials, ie types of equipment
	
	Suits.get()
	.success(function(suits_response)
	{
		$scope.suits = suits_response;
	});
	
	Statuses.get() //retrieve the list of possible statuses from the back end
	.success(function(status_types_response)
	{
		$scope.status_types = status_types_response;
	});
	
	Materials.get() //retrieve the list of possible materials from the back end
	.success(function(materials_response)
	{
		$scope.materials_list = materials_response;
	});
	
	AnatomicalPositions.get() //retrieve the list of possible anatomical positions from the back end
	.success(function(anatomical_positions_response)
	{
		$scope.anatomical_positions = anatomical_positions_response;
	});

	$scope.AddNewSuit = function() {
		
		if ((typeof $scope.new_suit_equipment_ids === 'undefined') || $scope.new_suit_equipment_ids.length == 0)
		{
			bootbox.alert('Add a minimum of 1 sensor before creating a new suit');
			return;
		}
		
		bootbox.confirm("Are you sure you want to add this new suit?", function(user_response) {
			if (user_response === true)
			{
				Suits.create($scope.new_suit_equipment_ids).success(function(create_suits_response)
				{
					$scope.suits = create_suits_response;
					$scope.new_suit_equipment_ids = [];
					
					//alert($('#asdfg').loadedSearches);
					//$('#asdfg').loadedSearches = {};
				}).error(function(err_response)
				{
					console.log(err_response);
					bootbox.alert("The following error occurred while submitting the new suit to the database:" + err_response);
				});
			}
		});

	};
	
	$scope.DeleteSuit = function(suit_id){
		
		bootbox.confirm("Are you sure you want to delete this suit?", function(user_response) {
			if (user_response === true)
			{
				Suits.destroy(suit_id).success(function(suits_response)
				{
					$scope.suits = suits_response; //use the updated list of suits from the backend
					$scope.equipment_list = [];
				});
			}
		}); 
	};
	
	$scope.UpdateExistingSuit = function(suit_to_be_updated){
		
		bootbox.confirm("Are you sure you want to update this suit?", function(user_response) {
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
	
	$scope.RemoveExistingSensor = function(sensors_list, sensor_to_be_removed, active_sensor){
		
		$index = sensors_list.indexOf(sensor_to_be_removed);
		sensors_list.splice( $index, 1 );
	};
	
	$scope.ResetNewEquipmentForm = function(){
		
		$scope.new_equipment_data = {};
	};
	
	$scope.SubmitNewEquipmentForm = function(){
		
		Equipment.create($scope.new_equipment_data).success(function(equipment_response)
		{
			$scope.new_equipment_data = equipment_response;
		}).error(function(response)
		{
			console.log(response);
		});
	};

}]);

//CRUD methods for communicating with the back end

angular.module('backend', []).factory('Suits', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/suitsequipment');
		},
		
		create : function(new_suit_sensors_form_data) {

			return $http({
				method: 'POST',
				url: '/suitsequipment',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param({new_suit_equipment_list: new_suit_sensors_form_data})
			});
		},
		
		update : function(suit) {
			return $http({
				method: 'PUT',
				url: '/suitsequipment/' + suit.id,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param({updated_suit_equipment: suit.equipment})
			});
		},
		
		destroy : function(suit_id)
		{
			return $http.delete('/suitsequipment/' + suit_id);
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
}).factory('Statuses', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/statuses');
		}
	
	};
}).factory('Equipment', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/equipment');
		},
		
		create : function(new_equipment_form_data) {

			return $http({
				method: 'POST',
				url: '/equipment',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param({new_equipment_data: new_equipment_form_data})
			});
		}
	
	};
}).factory('Materials', function($http)
{
	return { 
	
		get : function()
		{
			return $http.get('/materials');
		}
	
	};
});
