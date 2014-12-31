$(document).ready(function(){
    var editForm = $('form#editCategory');
    editForm.validate({
        highlight: function(element) {
            $(element).parent().addClass("text-danger");
            $(element).parent().addClass("has-error");
        },
        unhighlight: function(element) {
            $(element).parent().removeClass("text-danger");
            $(element).parent().removeClass("has-error");
        }
    });
    editForm.on('submit', function(e){
        var validate = editForm.valid();
        if (validate != true) {
            e.preventDefault();
        }
    });
});