(function($) {
    $(document).on('click', '.pxl-upload-svg', function (e) {
        e.preventDefault();

        const button = $(this);
        const container = button.closest('.menu-item-settings');

        const field   = container.find('.pxl-menu-svg-id');
        const preview = container.find('.pxl-svg-preview');
        const remove  = container.find('.pxl-remove-svg');

        let frame = wp.media({
            title: 'Select SVG Icon',
            library: { type: 'image/svg+xml' },
            button: { text: 'Use this SVG' },
            multiple: false
        });

        frame.on('select', function () {
            const attachment = frame.state().get('selection').first().toJSON();

            field.val(attachment.id);

            $.get(attachment.url, function (svg) {
                preview.empty().append(svg);
                remove.removeClass('hidden');
            }, 'text');
        });

        frame.open();
    });

    $(document).on('click', '.pxl-remove-svg', function (e) {
        e.preventDefault();

        const button    = $(this);
        const container = button.closest('.menu-item-settings');

        container.find('.pxl-menu-svg-id').val('');
        container.find('.pxl-svg-preview').empty();

        button.addClass('hidden');
    });

}(jQuery));