angular.module('backendHeddoko', []).factory('Teams', function($http) {

	return { 
	
		create : function(new_team_name) {
			return $http({
				method: 'POST',
				url: '/api/teams',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(new_team_name)
			});
		},
		
		update : function(team_id, updated_team_form_data) {
			return $http({
				method: 'PUT',
				url: '/api/teams'/ + team_id,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(updated_team_form_data)
			});
		},
		
		get : function() {
			return $http.get('/api/teams');
		},
		
		destroy : function(id) {
			return $http.delete('/api/teams/' + id);
		}
	};

}).factory('TeamAthletes', function($http) {

	return {
		get : function(teamid) {
			return $http.get('/api/teams/' + teamid + '/athletes');
		}
	};

}).factory('FMSForm', function($http) {

	return {

		// save an fms form (pass in form data)
		save : function(athleteid, formData) {
			return $http({
				method: 'POST',
				url: '/api/athletes/' + athleteid + '/fmsforms',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(formData)
			});
		},
		
		get : function(athleteid) {
			return $http.get('/api/athletes/' + athleteid + '/fmsforms');
		},
		
		destroy : function(athleteid, formid) {
			return $http.delete('/api/athletes/' + athleteid + '/fmsforms/' + formid);
		}
	};

}).factory('SportCategories', function($http) {

	return {
	
		save : function(new_sport_category_form_data) {
			return $http({
				method: 'POST',
				url: '/api/sportcategories',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(new_sport_category_form_data)
			});
		},

		get : function() {
			return $http.get('/api/sportcategories');
		},
		
		destroy : function(sport_category_id) {
			return $http.delete('/api/sportcategories/' + sport_category_id );
		}
	};

}).factory('SportMovements', function($http) {

	return {
	
		save : function(sport_category_id, new_sport_movement_form_data) {
			return $http({
				method: 'POST',
				url: '/api/sportcategories/' + sport_category_id + '/sportmovements',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(new_sport_movement_form_data)
			});
		},
		
		get : function(sportcatid) {
			return $http.get('/api/sportcategories/' + sportcatid + '/sportmovements');
		},
		
		destroy : function(sport_category_id, sport_movement_id) {
			return $http.delete('/api/sportcategories/' + sport_category_id + '/sportmovements/' + sport_movement_id );
		}
	};

});