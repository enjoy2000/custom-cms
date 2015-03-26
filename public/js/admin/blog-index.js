(function($){
    $(document).ready(function(){
        $(document).on('click', 'a.delete-blog', function(e){
            e.preventDefault();
            var deleteUrl = $(this).attr('href');

            bootbox.confirm('Are you sure to delete this blog?', function(result){
                if (result) {
                    window.location.href = deleteUrl;
                }
            });
        })
    });
})(jQuery)