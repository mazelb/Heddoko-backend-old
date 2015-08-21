var app = angular.module('suit-editor', ['backend', 'selectize', 'angularUtils.directives.dirPagination']);

app.controller('MainController', ['$scope', 'Suits', 'SensorTypes', 'AnatomicalPositions', 'Equipment', 'Statuses', 'Materials', '$timeout', function($scope, Suits, SensorTypes, AnatomicalPositions, Equipment, Statuses, Materials, $timeout)
{
    // We use a template object that we will clone for each data model, and store
    // these models in $scope.data for easy access.
    $scope.data = {};
    var dataTemplate = {
        name: '',           // Title for a data item.
        list: [],           // List of data items.
        total: 0,           // Total number of data items matching the current query.
        per_page: 20,       // Number of data items to display per page.
        current_page: 1,    // Current page for pagination.
        search_term: '',    // Search query to filter results.
        service: null,      // Angular service for HTTP requests.

        // Updates the current page.
        updatePage: function(page, showLoadingDialog) {

            showLoadingDialog = typeof showLoadingDialog == 'boolean' ? showLoadingDialog : true;

            // If we have a response, update the page with that info.
            if (typeof page == 'object') {

                this.list = page.results;
                this.total = page.total;

                // Hide the loading dialog.
                showLoadingDialog ? $scope.HideLoadingDialog() : null;

                return;
            }

            // If not, make sure we have a valid page number.
            page = page || this.current_page;

            // Show loading dialog and update the page.
            showLoadingDialog ? $scope.ShowLoadingDialog() : null;
            this.service.search(this.search_term, page, this.per_page)
                .then(function(response) {

                    if (response.status == 200)
                    {
                        this.list = response.data.results;
                        this.total = response.data.total;
                    }

                    // Hide loading dialog.
                    showLoadingDialog ? $scope.HideLoadingDialog() : null;
                }.bind(this));
        },

        // Stores the information related to new items.
        new_item: {
            name: '',
            equipment: [],
            current_equipment: null,
            reset: function() {
                this.equipment = [];
                this.current_equipment = null;
            }
        },

        // Retrieves an item from the list by ID.
        find: function(id) {

            // Performance check.
            if (id == 'new-item') {
                return this.new_item;
            }

            var search_results = $.grep(this.list, function(item) { return item.id == id; });
            return search_results.length == 1 ? search_results[0] : null;
        },

        // Updates an existing item.
        update: function(item) {

            bootbox.confirm('Are you sure you want to update this '+ this.name +'?', function(user_response) {
                if (user_response === true)
                {
                    $scope.ShowLoadingDialog();
                    this.service.update(item).then(function(response) {

                        // Update the page (this will also hide the loading dialog).
                        if (response.status == 200)
                        {
                            this.updatePage(response.data);
                            bootbox.alert(this.name +' successfully updated.');
                        }

                    }.bind(this), function(response) {

                        // Display the error message.
                        console.log('Error updating '+ this.name +': '+ response.statusText);
                        bootbox.alert('An error occurred:' + response.statusText);
                    }.bind(this));
                }
            }.bind(this));

        },

        // Removes an item from the database.
        destroy: function(id) {

            bootbox.confirm('Are you sure you want to delete this '+ this.name +'?', function(user_response) {
                if (user_response === true)
                {
                    $scope.ShowLoadingDialog();
                    this.service.destroy(id).then(function(response) {

                        // Update the page (this will also hide the loading dialog).
                        if (response.status == 200)
                        {
                            this.updatePage(response.data);
                            bootbox.alert(this.name +' successfully deleted.');
                        }

                    }.bind(this), function(response) {

                        // Display the error message.
                        console.log('Error deleting '+ this.name +': '+ response.statusText);
                        bootbox.alert('An error occurred:' + response.statusText);
                    }.bind(this));
                }
            }.bind(this));
        },

        // Stores everything related to selectize models.
        selectize: null
    };

    //
    // Materials model.
    //
    $scope.data.materials = $.extend(true, {}, dataTemplate, {
        name: 'Material',
        per_page: 20,
        service: Materials
    });

    //
    // Equipment model.
    //
    $scope.data.equipment = $.extend(true, {}, dataTemplate, {
        name: 'Equipment',
        per_page: 20,
        service: Equipment
    });

    //
    // Anatomical positions model.
    //
    $scope.data.anatomical_positions = $.extend(true, {}, dataTemplate, {
        name: 'Anatomical Position',
        per_page: 10,
        service: AnatomicalPositions
    });

    //
    // Statuses model.
    //
    $scope.data.statuses = $.extend(true, {}, dataTemplate, {name: 'Status', service: Statuses});

    //
    // Suitsequipment model.
    //
    $scope.data.suits = $.extend(true, {}, dataTemplate, {
        name: 'Suit',
        per_page: 5,
        service: Suits,
        add: function() {

            // Confirm that we have equipment in our new suit.
            if (this.new_item.equipment.length == 0)
            {
                bootbox.alert('Add a minimum of 1 equipment before creating a new suit');
                return;
            }

            bootbox.confirm("Are you sure you want to add this new suit?", function(user_response) {
                if (user_response === true)
                {
                    $scope.ShowLoadingDialog();
                    Suits.create(this.new_item.equipment).then(function(response) {

                        // Update the page (this will also hide the loading dialog).
                        if (response.status == 200)
                        {
                            this.updatePage(response.data);
                            this.new_item.reset();
                            bootbox.alert('Suit successfully created.');
                        }

                    }.bind(this), function(response) {

                        // Display the error message.
                        $scope.HideLoadingDialog();
                        console.log('Error adding new suit: '+ response.statusText);
                        bootbox.alert('An error occurred:' + response.statusText);
                    });
                }
            }.bind(this));

        },
        removeEquipment: function(suit, equipment) {

            // Update the equipment list.
            $index = suit.equipment.indexOf(equipment);
            suit.equipment.splice( $index, 1 );

            // If the deleted equipment was active (selected), set the current equipment to null.
            if (suit.current_equipment && suit.current_equipment.id == equipment.id) {
                suit.current_equipment = null;
            }
        },
        selectize: {
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
                    $scope.data.suits.selectize.current.suit_id = this.$input.context.dataset.suitId;
                    $scope.data.suits.selectize.current.equipment_list = this.$input.data('equipmentList');

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
                        $scope.data.suits.selectize.current.available_equipment_list[data[index].id] = data[index];
                    }
                },
                onItemAdd: function(id, $item) {
                    var equipment = $scope.data.suits.selectize.current.available_equipment_list[id],
                        suit = $scope.data.suits.find($scope.data.suits.selectize.current.suit_id);
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
        }
    });

    $scope.ShowLoadingDialog = function() {
        $('#loading-dialog').modal();
    };

    $scope.HideLoadingDialog = function() {
        $('#loading-dialog').modal('hide');
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

    // Load the data for each tab.
    for (type in $scope.data) {
        $scope.data[type].updatePage(1, true);
    }
}]);

//CRUD methods for communicating with the back end

angular.module('backend', [])
    .factory('Suits', function($http) {

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
                return $http.get('/suitsequipment?search_term='+ query +'&page='+ page +'&per_page='+ per_page);
            }

        };

    }).factory('SensorTypes', function($http) {

        return {

            get : function()
            {
                return $http.get('/sensortypes');
            }

        };
    }).factory('AnatomicalPositions', function($http) {

        return {

            get : function()
            {
                return $http.get('/anatomicalpositions');
            },

            search : function(query, page, per_page) {
                return $http.get('/anatomicalpositions?search_term='+ query +'&page='+ page +'&per_page='+ per_page);
            }

        };
    }).factory('Statuses', function($http) {

        return {

            get : function()
            {
                return $http.get('/statuses');
            },

            search : function(query, page, per_page) {
                return $http.get('/dummy-for-testing?search_query='+ query +'&page='+ page +'&per_page='+ per_page);
            }

        };
    }).factory('Equipment', function($http) {

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
            },

            search : function(query, page, per_page) {
                return $http.get('/equipment?search_term='+ query +'&page='+ page +'&per_page='+ per_page);
            }

        };
    }).factory('Materials', function($http) {

        return {

            get : function()
            {
                return $http.get('/materials');
            },

            search : function(query, page, per_page) {
                return $http.get('/materials?search_term='+ query +'&page='+ page +'&per_page='+ per_page);
            }

        };
    });
