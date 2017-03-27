

/**
 * @ngdoc function
 * @name guideAppApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the guideAppApp
 */

/*jslint devel: true */
/*global angular */
angular.module('guideAppApp')
    .controller('MainCtrl', ['$scope', '$location', '$rootScope', '$dataFactory','City','Local', function ($scope, $location, $rootScope, $dataFactory,City,Local) {
        'use strict';









        var
            getCitiesSuccess = function (data) {
                console.log('Success');
                $scope.cities = data.items;
                console.log(data);
                $scope.$apply();
            },

            getCitiesError = function (data) {
                console.log('error');
                console.log(data);

            },

            getEntitiesSuccess = function (data) {


            },

            getEntitiesError = function (data) {
                console.log('error');
                console.log(data);
            };
        
        $scope.map = { center: { latitude: $rootScope.mLatitude, longitude: $rootScope.mLongitude }, zoom: 5 };
        $scope.randomMarkers = [];
        
        $scope.init = function () {
            $scope.cities = City.query(function(data) {
                // success handler
                console.log(data.cities);
                $scope.cities= data.cities;

            }, function(error) {
                // error handler
                console.log("error");
            });
           // $dataFactory.getCities(getCitiesSuccess, getCitiesError);
        };
        
        $scope.selectCityChange = function () {

	        var selectCity = $scope.selectCity,
                latitude = selectCity.latitude,
                longitude = selectCity.longitude;

            console.log($scope.selectCity,
                latitude = selectCity.latitude,
                longitude = selectCity.longitude);

		    $scope.map = { center: { latitude: latitude, longitude: longitude}, zoom: 11 };


            $scope.locals = Local.query(function(data) {
                // success handler
                console.log('ok');
                console.log(data);

                var locals = data.locals;
                console.log("lat",locals);


                if (locals) {
                    var positions = [];
                    $scope.randomMarkers = [];

                    locals.forEach(function (element, index) {



                        var p = {
                            id: index,
                            latitude: element.latitude,
                            longitude: element.longitude,
                            title: 'msqdsdq'
                        };

                        positions.push(p);
                    });

                    $scope.randomMarkers = positions;

                    if(!$scope.$$phase) {
                        $scope.$apply();
                    }

                }

            }, function(error) {
                // error handler
                console.log("error");
            });

		  //  $dataFactory.getLocalsByIdCategory(selectCity.id, null, getEntitiesSuccess, getEntitiesError);
	    };

        $rootScope.init($scope);
        
    }]);
