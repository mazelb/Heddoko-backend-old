/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Controller for profile views.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    October 2015
 */
angular.module('app.controllers')

.controller('ProfileController',
    ['$scope', '$routeParams', '$filter', 'Rover', 'ProfileService', 'GroupService',
    'Utilities', '$http',
    function($scope, $routeParams, $filter, Rover, ProfileService, GroupService, Utilities, $http) {
        Utilities.debug('ProfileController');

        // Currently displayed group.
        $scope.profile = {id: 0};
        if ($routeParams.profileId > 0 && Utilities.hasVar('profile', $routeParams.profileId))
        {
            Utilities.store.profileId = $routeParams.profileId;
            $scope.profile = Utilities.getVar('profile', $routeParams.profileId);
        }

        // Current URL path.
        $scope.isProfilePage = true;

        // Model for new profile details.
        $scope.newProfile =
        {
            id: 0,
            feet: 0,
            inches: 0,
            weightInPounds: 0,
            notes: '',
            gender: '',
            primaryTag: {},
            secondaryTags: []
        };

        // Alias for the list of groups.
        $scope.groups = $scope.global.state.group.list;

        // Alias for the selected group.
        $scope.group = $scope.global.getSelectedGroup();

        // Alias for the list of profiles.
        // $scope.profiles = $scope.global.state.profile.list;
        $scope.profiles = Utilities.listVars('profile');

        // Computes the width of the avatar depending on the height of the details panel.
        $scope.calculateAvatarHeight = function() {
            return $('#profileDetails') ? $('#profileDetails').css('height') : 0;
        };

        // Creates a new profile in the database.
        $scope.createProfile = function() {
            Utilities.debug('Creating profile...');

            Rover.addBackgroundProcess();

            var profile = ProfileService.formatForStorage($scope.newProfile);

            // Add group info.
            // TODO: allow multiple groups.
            profile.groups = [$scope.global.getSelectedGroup().id];

            ProfileService.create(profile, ['avatarSrc', 'groups', 'meta']).then(
                function(response) {

                    // Update profile list and browse to newly created profile.
                    // Rover.setState('profile', response.data.id, response.data);
                    Utilities.setVar('profile', response.data.id, response.data);
                    $scope.global.updateFilteredProfiles();
                    Rover.browseTo.path('/profile/' + response.data.id);
                    Rover.doneBackgroundProcess();
                },
                function(response) {
                    Utilities.debug('Could not create profile: ' + response.statusText);
                    Utilities.alert('Could not create profile. Please try again later.');
                    Rover.doneBackgroundProcess();
                }
            );
        };

        // Saves a profile through the uiEditableListContainer directive.
        $scope.saveProfileDetails = function() {

            var profile = ProfileService.formatForStorage($scope.profile);

            return ProfileService.update(profile.id, profile, ['avatarSrc', 'groups', 'meta']);
        };

        // Callback for uiEditableListContainer directive.
        $scope.saveProfileDetailsCallback = function(profileSaved) {

            // Update profile list.
            if (profileSaved) {

                // Update profile data.
                // Rover.setState('profile', this.id, ProfileService.format(this));
                Utilities.setVar('profile', this.id, ProfileService.format(this));
                $scope.global.updateFilteredProfiles();

                // Update the selected profile.
                // Rover.store.profileId = this.id;

                // Navigate to profile page.
                // Rover.browseTo.path('/profile/' + this.id);
            }

            //
            else {
                Utilities.alert('Could not save profile details. Please try again later.');
            }
        };

        // Deletes a profile
        $scope.deleteProfile = function() {
            Utilities.debug('Deleting profile...');

            // Show loading animation.
            Rover.addBackgroundProcess();

            ProfileService.destroy($scope.profile.id).then(

                // On success, update profile list and browse to selected group.
                function(response) {

                    // Update profile list.
                    // Rover.setState('profile', $scope.profile.id, null);
                    Utilities.setVar('profile', $scope.profile.id, null);
                    $scope.global.state.profile.list.length--;
                    $scope.global.updateFilteredProfiles();

                    // Unselect profile by default.
                    $scope.global.store.profileId = 0;

                    Rover.browseTo.group();
                    Rover.doneBackgroundProcess();
                },

                // On failure.
                function(response) {
                    Utilities.debug('Could not delete profile: ' + response.responseText);
                    Utilities.alert('Could not delete profile. Please try again later.');
                    Rover.doneBackgroundProcess();
                }
            );
        };

        // POST endpoint for avatar uploads.
        $scope.uploadAvatarEndpoint = '/api/v1/profiles/'+ $scope.profile.id +'/avatar';

        // Callback for avatar uploads.
        $scope.uploadAvatarCallback = function() {

            // Update the avatar on the currently selected profile.
            // Rover.getState('profile', $scope.profile.id).avatarSrc = this.avatarSrc;
            Utilities.getVar('profile', $scope.profile.id).avatarSrc = this.avatarSrc;

            // Update the filtered list.
            // angular.forEach($scope.global.state.profile.filtered, function(profile) {
            angular.forEach(Utilities.temp.filteredProfiles, function(profile) {
                if (profile.id === $scope.profile.id) {
                    profile.avatarSrc = this.avatarSrc;
                }
            }.bind(this));
        };

        $scope.$watch('global.store.profileId', function(id, oldId)
        {
            // Performance check.
            if (id === oldId) {
                return;
            }

            // Shortcut for the currently selected profile.
            $scope.profile = $scope.global.getSelectedProfile();

            // Format profile fields.
            $scope.profile = ProfileService.format($scope.profile);
        });

        if ($scope.profile.id > 0) {
            $scope.profile = ProfileService.format($scope.profile);
        }
    }
]);
