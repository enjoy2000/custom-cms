/**
 * Created by hatdao on 4/19/15.
 */
(function($){
    $(document).ready(function(){
        /*
        $('.article-photo img').tooltip({
            position: 'center'
        });
        */

        $('.article-photo img').click(function(e){
            e.preventDefault();

            $.fancybox({
                'href' : this.src,
                'title' : this.alt
            });
        });
    });
})(jQuery);