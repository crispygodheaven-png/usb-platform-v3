
jQuery(document).ready(function($){

    $('.ubs-follow-btn').on('click', function(){

        var button = $(this);
        var author = button.data('author');

        $.post(ubs_follow.ajax_url, {
            action: 'ubs_follow_author',
            author_id: author,
            nonce: ubs_follow.nonce
        }, function(response){

            if(response.success){
                button.text('Following');
            } else {
                alert(response.data);
            }

        });

    });

});
