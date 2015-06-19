/**
 * @file backend.js
 * @brief This file defines the Factories for interfacing with the back-end (CRUD)
 * @author Maxwell Mowbray (max@heddoko.com)
 * @date June 2015
 */
 
 angular.module('backendHeddoko', []).factory('Teams', function($http) {

	return { 
	
		/**
		* @brief Teams.get method used for fetching the active user's teams
		* @param void
		* @return list of user's teams
		*/
		 
		get : function() {
			return $http.get('/api/teams');
		},		
	
		/**
		* @brief Teams.create method used for creating a new team under the active user
		* @param form data pertaining to a new team entry
		* @return upon a successful addition of a new team, the back-end returns an updated teams list
		*/
	
		create : function(new_team_form_data) {
			return $http({
				method: 'POST',
				url: '/api/teams',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(new_team_form_data)
			});
		},
		
		/**
		* @brief This is the Teams.update method used for updating an existing team's details
		* @param form data pertaining to updated team details
		* @return upon a successful update of a team, the back-end returns a updated teams list
		*/
		
		update : function(team_id, updated_team_form_data) {
			return $http({
				method: 'PUT',
				url: '/api/teams'/ + team_id,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(updated_team_form_data)
			});
		},
		
		/**
		* @brief This is the Teams.destroy method used for removing a team under the active user
		* @param id of the FMS Form to be destroyed
		* @return void
		*/
		
		destroy : function(team_id) {
			return $http.delete('/api/teams/' + team_id);
		}
		
	};

}).factory('Athletes', function($http) {

	return {
	
		/**
		* @brief Athletes.get method used for fetching the athletes belonging to a given team
		* @param team id
		* @return list of athletes belonging to supplied team
		*/
	
		get : function(team_id) {
			return $http.get('/api/teams/' + team_id + '/athletes');
		},
		
		/**
		* @brief Athletes.create method used for creating a new Athlete, belonging to an existing team
		* @param the id of the team under which to add the new athlete, and the new athlete's details
		* @return upon a successful addition of a new team, the back-end returns an updated athlete's list
		*/
		
		create : function(team_id, new_athlete_form_data) {
			return $http({
				method: 'POST',
				url: '/api/teams/' + team_id + '/athletes',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(new_athlete_form_data)
			});
		}		

	};

}).factory('FMSForm', function($http) {

	return {
	
		/**
		* @brief FMSForm.get method used for fetching the fmsform belonging to a supplied athlete
		* @param id of athlete
		* @return list of FMS Forms belonging to supplied athlete
		*/
			
		get : function(athlete_id) {
			return $http.get('/api/athletes/' + athlete_id + '/fmsforms');
		},
		
		/**
		* @brief FMSForm.create method used for creating a new FMS Form, belonging to an existing athlete
		* @param the id of the athlete under which to add the new FMS Form, and the new FMS Form details
		* @return upon a successful addition of a new team, the back-end returns an updated FMS Form list
		*/
		
		create : function(athlete_id, form_data) {
			return $http({
				method: 'POST',
				url: '/api/athletes/' + athlete_id + '/fmsforms',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(form_data)
			});
		},
		
		/**
		* @brief This is the FMSForm.update method used for updating an existing FMS Form
		* @param the id of the athlete that the FMS Form belongs to, and the form data pertaining to updated team details
		* @return upon a successful update of a team, the back-end returns a updated FMS Form list
		*/
		
		update : function(athlete_id, updated_fms_form) {
			return $http({
				method: 'PUT',
				url: '/api/athletes/' + athlete_id + '/fmsforms/' + updated_fms_form.id,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(updated_fms_form)
			});
		},
		
		/**
		* @brief This is the FMSForm.destroy method used for deleting an FMS Form
		* @param id of the FMS Form to be destroyed
		* @return upon a successful deletetion of an FMS Form, the back-end returns a updated FMS Form list
		*/
		
		destroy : function(athleteid, form_id) {
			return $http.delete('/api/athletes/' + athleteid + '/fmsforms/' + form_id);
		}
	};

}).factory('SportCategories', function($http) {

	return {
	
		/**
		* @brief SportCategories.get method used for fetching the sports categories
		* @param void
		* @return list of sports categories
		*/

		get : function() {
			return $http.get('/api/sportcategories');
		}
	};

}).factory('SportMovements', function($http) {

	return {
	
		/**
		* @brief SportMovements.get method used for fetching the movements under a given sport category
		* @param id of sport category
		* @return list of sport movements belonging to supplied sport category
		*/
		
		get : function(sport_category_id) {
			return $http.get('/api/sportcategories/' + sport_category_id + '/sportmovements');
		}
		
	};
});