/**
 * Created by antiprovn on 1/3/15.
 */
$(document).ready(function(){
    /**
     * Effect for main menu
     */
    $('#top-nav .dropdown').hover(
        function(){
            $(this).addClass('open active');
            $(this).find('.toggle-dropdown').dropdown('toggle');
        },
        function(){
            $(this).removeClass('open active');
            $(this).find('.toggle-dropdown').dropdown('toggle');

            // for current menu item
            if ($(this).hasClass('current-menu-item')) {
                $(this).addClass('active');
            }
        }
    );
    $('#top-nav .dropdown > a').click(function(e){
        e.preventDefault();

        window.location.href = $(this).attr('href');
    });

    // news ticker
    $.get(newsTickerUrl, function($data){
        $('.news-ticker').html($data);
    });

    $('.news-ticker').newsTicker({
        row_height: 28,
        max_rows: 1,
        speed: 600,
        direction: 'up',
        duration: 4000,
        autostart: 1,
        pauseOnHover: 1
    });
});