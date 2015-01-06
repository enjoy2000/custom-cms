/**
 * Created by antiprovn on 1/1/15.
 */
$(document).ready(function(){
    $('#blog-content').summernote();

    // init
    if ($('#select-locale').val()) {
        listCategories($('#select-locale').val());
    }

    // select locale
    $('#select-locale').on('change', function(){
        var localeId = $(this).val();
        listCategories(localeId);
    });

    // validate form
    var newBlogForm = $('form#blogForm');
    newBlogForm.validate({
        highlight: function(element) {
            $(element).parent().addClass("text-danger");
            $(element).parent().addClass("has-error");
        },
        unhighlight: function(element) {
            $(element).parent().removeClass("text-danger");
            $(element).parent().removeClass("has-error");
        }
    });
    newBlogForm.on('submit', function(e){
        var validate = newBlogForm.valid();
        if (validate != true) {
            e.preventDefault();
        }
    });

    function listCategories(localeId) {
        $.ajax({
            url: '/api/blog/category?locale=' + localeId,
            type: 'get',
            success: function($data) {
                console.log($data);
                var catOptions = '';
                $.each($data['categories'], function(){
                    catOptions += '<option value="' + this.id + '">' + this.name + '</option>';
                });
                console.log(catOptions);
                $('#select-category').html(catOptions);
                if (originValCats) {
                    $('#select-category').val(originValCats);
                }
                $('select#select-category').multiselect('rebuild');
            }
        })
    }
});