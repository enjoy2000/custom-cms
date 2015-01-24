$(document).ready(function(){
    var block = $('#right-sidebar');
    $.get(latestNewsUrl).success(function($data){
        var html ='';
        console.log($data);
        $.each($data.blogs, function(){
            html += '<div class="blog item row" style="border-bottom: solid 1px #ccc; padding: 5px 0;">' +
            '<a href="'+this.blogUrl+'" title="'+this.title+'">'+this.title+'</a>' +
            '<div class="short-content">' +
            this.shortContent +
            '</div>' +
            '<a class="pull-left flip read-more" href="'+this.blogUrl+'">' +
            readMoreText +
            '</a>' +
            '</div>';
        });
        block.html(html);
    });
});