/**
 * Created by hat on 30/12/2014.
 */
angularModule.controller('NewCategoryController', function($scope, $http) {
    $scope.category = nullCategory = {
        id: null,
        name: null,
        urlKey: null,
        locale: ''
    };

    $scope.locales = [];

    // get list locales
    $http.get('/api/blog/locale').success(function($data){
        console.log($data['locales']);
        $scope.locales = $data['locales'];
    });

    var createForm = $('form#newCategory');
    createForm.validate({
        highlight: function(element) {
            $(element).parent().addClass("text-danger");
            $(element).parent().addClass("has-error");
        },
        unhighlight: function(element) {
            $(element).parent().removeClass("text-danger");
            $(element).parent().removeClass("has-error");
        }
    });

    $scope.submit = function() {
        var validate = createForm.valid();
        if (validate == true) {
            $http.post('/api/blog/mission-category', $scope.category).success(function($data){
                if ($data['success']) {
                    $scope.category = nullCategory;
                    window.location.href = "/admin/mission-category";
                }
            });
        }
    }
});