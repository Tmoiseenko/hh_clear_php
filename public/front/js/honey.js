$(window).on('load', function() {
    $('html').find('#js_form').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        let data = {
            name: $form.find('input#inputName').val(),
            email: $form.find('input#inputEmail').val(),
            comment: $form.find('textarea#inputComment').val(),
        };
        if ($form.valid) return true;
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: data,
            success: function (response) {
                // console.log(response)
                $form.trigger('reset');
                $('html').find('.js-no-content').remove();
                $('html').find('.js-card-box').html(response);
            }
        });
    })
});