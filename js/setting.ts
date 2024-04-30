document.querySelectorAll('.leftpanel li').forEach((element, index) => {
    element.addEventListener('click', (event) => {
        document.querySelectorAll('.leftpanel li').forEach((element) => {
            element.classList.remove('active');
        });
        element.classList.add('active');
        document.querySelectorAll('.div-tab').forEach((element) => {
            element.classList.add('hidden');
        });
        document.querySelectorAll('.div-tab')[index].classList.remove('hidden');
    });
});

document.querySelector('#upload-categoryCover')?.addEventListener('click', (event) => {
    event.preventDefault();
    //@ts-ignore
    const image = wp
        .media({
            //@ts-ignore
            title: obvInit.upload_title,
            multiple: false,
            button: {
                //@ts-ignore
                text: obvInit.upload_button,
            },
        })
        .open()
        .on('select', function () {
            const uploaded_image = image.state().get('selection').first();
            const image_url = uploaded_image.toJSON().url;
            document.querySelector('#_category_cover')?.setAttribute('value', image_url);
        });
});

document.querySelector('#pure-save')?.addEventListener('click', (event) => {
    event.preventDefault();
    const form = document.querySelector('#pure-form') as HTMLFormElement;
    // @ts-ignore
    const formData = new FormData(form);
    // @ts-ignore
    const data = new URLSearchParams(formData);

    // const emailElement = document.querySelector('#pure-setting-email');
    // const email = emailElement?.getAttribute('value');
    // if (email && !isEmailValid(email)) {
    //     return alert('Email is not valid');
    // }

    //@ts-ignore
    jQuery.ajax({
        //@ts-ignore
        url: obvInit.ajaxurl,
        data: data + '&action=farallon_setting',
        type: 'POST',
        success: function () {
            //@ts-ignore
            const html = `<div id="farallon-settings_updated" class="notice notice-success settings-error is-dismissible"><p><strong>${obvInit.success_message}</strong></p><button type="button" class="notice-dismiss"></button></div>`;
            //@ts-ignore
            jQuery('.pure-wrap').before(html);
            window.scrollTo(0, 0);
        },
    });
});
+(function ($) {
    $(document).on('click', '#farallon-settings_updated .notice-dismiss', function () {
        $('#farallon-settings_updated').remove();
    });
    let $switch = $('.pure-setting-switch');
    $switch.click(function () {
        var $this = $(this),
            $input = $('#' + $this.attr('data-id'));

        if (!$this.hasClass('active')) {
            $this.addClass('active');
            $input.val(1);
        } else {
            $this.removeClass('active');
            $input.val(0);
        }

        $input.change();
    });
    //@ts-ignore
})(jQuery);
