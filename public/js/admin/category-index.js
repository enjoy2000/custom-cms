/**
 * Created by antiprovn on 12/31/14.
 */
(function($){
    $(document).ready(function(){
        var $moderators = [];
        var $categories = [];

        $('#loading').show();
        var ajaxCall = 0;
        $.get('/api/blog/category', function($data){
            console.log($data['categories']);
            $categories = $data['categories'];
            ajaxCallComplete();
        });
        $.get('/api/blog/moderator', function($data){
            console.log($data['moderators']);
            $moderators = $data['moderators'];
            ajaxCallComplete();
        });

        // update moderators for categories
        $('select.select-mod').change(function(){
            console.log('select changed');
        });

        var ajaxCallComplete = function() {
            ajaxCall++;
            if (ajaxCall == 2) { // finish ajax call
                $('#loading').hide();

                // render html
                var html = '';
                $.each($categories, function(){
                    var that = this;

                    // render moderators select
                    var modOptions = '';
                    $.each($moderators, function(){
                        var mod = this;
                        var checked = '';
                        $.each(that.moderators, function(){
                            if (this.id == mod.id) {
                                checked = ' selected="selected"';
                            }
                        });
                        modOptions += '<option' + checked + ' value="' +
                            this.id +
                            '">' +
                            this.displayName +
                            '</option>';
                    });

                    html += '<tr id="category' + this.id + '">' +
                        '<td>' +
                        this.id +
                        '</td>' +
                        '<td>' +
                        this.name +
                        '</td>' +
                        '<td>' +
                        this.locale.name +
                        '</td>' +
                        '<td>' +
                        '<select class="form-control select-mod" multiple>' +
                        modOptions +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<a class="btn btn-success" href="#" onclick="updateMod('+this.id+')" title="Update Moderators">' +
                        '<i class="fa fa-send"></i>' +
                        '</a> ' +
                        '<a class="btn btn-info" href="#" onclick="edit('+this.id+')" title="Edit">' +
                        '<i class="fa fa-edit"></i>' +
                        '</a> ' +
                        '<a class="btn btn-danger" href="#" onclick="removeCategory('+this.id+')" title="Remove this category">' +
                        '<i class="fa fa-remove"></i>' +
                        '</a>' +
                        '</td>' +
                        '</tr>';
                });

                $('#categories-grid').html(html);

                $('select.select-mod').multiselect('rebuild');
            }
        }

        // edit category
        window.edit = function($id) {
            window.location.href = "/admin/category/edit/" + $id;
        }

        window.removeCategory = function($id) {
            bootbox.confirm("Are you sure to delete this category?", function(result) {
                if (result == true) {
                    $.ajax({
                        url: '/api/blog/'+$id+'/category',
                        type: 'delete',
                        success: function($data){
                            console.log($data);
                            if ($data['success']) {
                                $('tr#category' + $id).remove();
                            }
                        }
                    })
                }
            });
        }

        window.updateMod = function($id) {
            var mods = $('tr#category' + $id + ' select.select-mod').val();
            console.log(mods);
            if (mods == null) {
                var errorUpdateMess = '<div class="alert alert-danger alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button>' +
                    'There is no moderator selected.</div>';
                $('#content div.alert').hide();
                $('#content').prepend(errorUpdateMess);
                return false;
            }
            $('#loading').show();
            $.ajax({
                url: '/api/blog/'+$id+'/category',
                type: 'put',
                data: {updateMods: mods},
                success: function($data){

                    if ($data['category']) {
                        var successUpdateMess = '<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button>' +
                            'Update category "'+ $data['category'].name +'" successfully!</div>';
                        $('#content div.alert').hide();
                        $('#content').prepend(successUpdateMess);
                        $('#loading').hide();
                    }
                }
            })
        }
    })
})(jQuery);