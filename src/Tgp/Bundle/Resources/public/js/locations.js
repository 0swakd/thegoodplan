(function() {
    var locations = angular.module("locations", [ ], function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });

    locations.controller("LocationsController", [ '$http', function($http) {
        var locations = this;
        locations.list = [];

        $http.get("/locations").success(function(data) {
            locations.list = data;
        });
    }]);
})();
