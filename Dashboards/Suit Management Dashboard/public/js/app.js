var app = angular.module('suit-editor', ['backend', 'selectize', 'angularUtils.directives.dirPagination']);

app.controller('MainController', ['$scope', 'Suits', 'SensorTypes', 'AnatomicalPositions', 'Equipment', 'Statuses', 'Materials', '$timeout', function($scope, Suits, SensorTypes, AnatomicalPositions, Equipment, Statuses, Materials, $timeout)
{
    $scope.suits_search_term = '';  // The value of the search term the user has typed into the search box
    $scope.suits = [];              // Contains all the suits currently displayed.
    $scope.suits_per_page = 5;      // Number of suits per page to display.
    $scope.suits_current_page = 1;
    $scope.total_suits = 0;         // Total number of suits matching the query.
    $scope.equipment_list = [];     //the list of equipment, a specific piece of hardware that can be put into a suit
    $scope.materials_list = [];     //list of materials, ie types of equipment

    // New suit data.
    $scope.new_suit = {
        equipment: [],
        current_equipment: null
    };

    // Everything related to selectize.
    $scope.selectize_container =
    {
        // Configuration for selectize controls.
        config:
        {
            create: false,
            preload: false,
            openOnFocus: true,
            hideSelected: true,
            valueField: 'id',
            labelField: 'serial_no',
            searchField: ['serial_no', 'physical_location'],
            placeholder: 'Pick a sensor',
            onInitialize: function(selectize) {},
            render: {
                option: function(item, escape) {
                    return  '<div>' +
                    '<b>' + escape(item.serial_no) +'</b><br />' +
                    '<span>'+ escape(item.material.name) +
                    ' located in "' + escape(item.physical_location) + '"</span>' +
                    '</div>';
                }
            },
            load: function(query, callback) {

                // Performance check.
                if (!query.length) return callback();

                var selectize = this;
                $.ajax({
                    url: '/equipment?search_term=' + encodeURIComponent(query),
                    type: 'GET',
                    cache: false,
                    error: function() {
                        callback();
                    },
                    success: function(response) {
                        callback(response.results);
                    }
                });
            },
            onFocus: function() {

                // Update the currently selected equipment for this specific selectize input.
                $scope.selectize_container.current.suit_id = this.$input.context.dataset.suitId;
                $scope.selectize_container.current.equipment_list = this.$input.data('equipmentList');

            },
            onBlur: function() {

                // Clear the cached options.
                this.clearOptions();
            },
            onLoad: function(data) {

                // Update the equipment available to a specific selectize input.
                for (var index in data)
                {
                    // Index equipment by ID, so we can retrieve it easily later on.
                    $scope.selectize_container.current.available_equipment_list[data[index].id] = data[index];
                }
            },
            onItemAdd: function(id, $item) {
                var equipment = $scope.selectize_container.current.available_equipment_list[id],
                    suit = $scope.FindSuit($scope.selectize_container.current.suit_id);
                if (!equipment || !suit)
                {
                    return;
                }

                // Performance check (this method might get called for each selectize input on the page).
                if ($.grep(suit.equipment, function(e) { return e.id == id; }).length > 0)
                {
                    return;
                }

                suit.equipment.push(equipment);
            }
        },

        // Stores data related to currently focused selectize control.
        current:
        {
            suit_id: 0,
            equipment_list: [],
            available_equipment_list: {}
        }
    };

    $scope.ShowLoadingDialog = function() {
        $('#loading-dialog').modal();
    };

    $scope.HideLoadingDialog = function() {
        $('#loading-dialog').modal('hide');
    };

    $scope.ResetNewSuitForm = function() {
        $scope.new_suit.equipment = [];
        $scope.new_suit.current_equipment = null;
    };

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

        if ($scope.new_suit.equipment.length == 0)
        {
            bootbox.alert('Add a minimum of 1 sensor before creating a new suit');
            return;
        }

        bootbox.confirm("Are you sure you want to add this new suit?", function(user_response) {
            if (user_response === true)
            {
                $scope.ShowLoadingDialog();
                Suits.create($scope.new_suit.equipment).then(function(response) {

                    // Update the page (this will also hide the loading dialog).
                    if (response.status == 200)
                    {
                        $scope.UpdatePage(response.data);
                        $scope.ResetNewSuitForm();
                        bootbox.alert('Suit successfully created.');
                    }

                }, function(response) {

                    // Display the error message.
                    $scope.HideLoadingDialog();
                    console.log('Error adding new suit: '+ response.statusText);
                    bootbox.alert('An error occurred:' + response.statusText);
                });
            }
        });

    };

    $scope.DeleteSuit = function(suit_id) {

        bootbox.confirm("Are you sure you want to delete this suit?", function(user_response) {
            if (user_response === true)
            {
                $scope.ShowLoadingDialog();
                Suits.destroy(suit_id).then(function(response) {

                    // Update the page (this will also hide the loading dialog).
                    if (response.status == 200)
                    {
                        $scope.UpdatePage(response.data);
                        bootbox.alert('Suit successfully deleted.');
                    }

                }, function(response) {

                    // Display the error message.
                    console.log('Error deleting suit: '+ response.statusText);
                    bootbox.alert('An error occurred:' + response.statusText);
                });
            }
        });
    };

    // Updates the equipments in a suit and refreshes the page.
    $scope.UpdateExistingSuit = function(suit_to_be_updated){

        bootbox.confirm("Are you sure you want to update this suit?", function(user_response) {
            if (user_response === true)
            {
                $scope.ShowLoadingDialog();
                Suits.update(suit_to_be_updated).then(function(response) {

                    // Update the page (this will also hide the loading dialog).
                    if (response.status == 200)
                    {
                        $scope.UpdatePage(response.data);
                        bootbox.alert('Suit successfully updated.');
                    }

                }, function(response) {

                    // Display the error message.
                    console.log('Error updating suit: '+ response.statusText);
                    bootbox.alert('An error occurred:' + response.statusText);
                });
            }
        });

    };

    // Removes an equipment from a list of equipments.
    $scope.RemoveEquipmentFromSuit = function(suit, equipment) {

        // Update the equipment list.
        $index = suit.equipment.indexOf(equipment);
        suit.equipment.splice( $index, 1 );

        // If the deleted equipment was active (selected), set the current equipment to null.
        if (suit.current_equipment && suit.current_equipment.id == equipment.id) {
            suit.current_equipment = null;
        }

    };

    $scope.ResetNewEquipmentForm = function(){

        $scope.new_equipment_data = {};
    };

    $scope.SubmitNewEquipmentForm = function(){

        $scope.ShowLoadingDialog();
        Equipment.create($scope.new_equipment_data).success(function(equipment_response)
        {
            $scope.new_equipment_data = equipment_response;
        }).error(function(response)
        {
            console.log(response);
        }).then(function(response) {
            $scope.HideLoadingDialog();
        });
    };

    $scope.FindSuit = function(suit_id) {
        if (suit_id == 'new-suit') {
            return $scope.new_suit;
        }

        var search_results = $.grep($scope.suits, function(suit){ return suit.id == suit_id; });

        return search_results.length == 1 ? search_results[0] : null;
    };

    // Queries the database to update the suits on the current page.
    $scope.UpdatePage = function(page) {

        // If we have a response, update the page with that info.
        if (typeof page == 'object') {

            $scope.suits = page.results;
            $scope.total_suits = page.total;
            $scope.HideLoadingDialog();
            return;
        }

        // If not, make sure we have a valid page number.
        page = page || $scope.suits_current_page;

        // Show loading dialog and update the page.
        $scope.ShowLoadingDialog();
        Suits.search($scope.suits_search_term, page, $scope.suits_per_page)
            .then(function(response) {

                if (response.status == 200)
                {
                    $scope.suits = response.data.results;
                    $scope.total_suits = response.data.total;
                }

                $scope.HideLoadingDialog();
            });
    }.bind($scope);

    $scope.UpdatePage();
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
        },

        search : function(query, page, per_page) {
            return $http.get('/suitsequipment?search_query='+ query +'&page='+ page +'&per_page='+ per_page);
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
