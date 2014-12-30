/**
 * Created by hat on 30/12/2014.
 */

angular.module('customCMS', [])
    .controller('NewCategoryController', function($scope, $http) {
        $scope.category = {
            id: null,
            name: null,
            urlKey: null,
            locale: null
        };

        $scope.locales = [];

        // get list locales
        $http.get('/api/blog/locale', function($data){
            console.log($data);
            $scope.locales = $data['locales'];
        });
    });