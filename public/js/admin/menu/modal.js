(function($){
    $(document).ready(function(){
        $('select[name=type]').on('change', function(){
            var type = $(this).val();
            if ($(this).val() == 'article' || $(this).val() == 'category') {
                $('.custom-modal').on('focus click', function(){
                    var that = $(this);
                    $('#search-url-key').modal();

                    // reset data on new modal open
                    $('#search-box').val('');
                    $('#search-url-key .response').html('');

                    $('#search-url-key span.type').text(type);

                    $('#search-box').keyup(function(event){
                        if ($(this).val().length > 2) {
                            $.get('/admin/menu/query-' + type + '?s=' + $(this).val(), function(response){
                                $('#search-url-key .response').html(response);

                                $('.response a').on('click', function(e){
                                    e.preventDefault();

                                    that.val($(this).data('url-key'));
                                    $('#search-url-key').modal('hide');
                                });
                            });
                        }
                    });
                });
            } else {
                $('.custom-modal').off('focus click');
            }
        })
    });
})(jQuery);