angular.module('heddokobackend', []).factory('FMSForm', function($http) {

    return {
        // get all the FMS forms
        get : function() {
            return $http.get('/api/fmsforms');
        },

        // save an fms form (pass in form data)
        save : function(formData) {
            return $http({
                method: 'POST',
                url: '/api/fmsforms',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(formData)
            });
        },

        // destroy an fms form
        destroy : function(id) {
            return $http.delete('/api/fmsform/' + id);
        }
    }

});