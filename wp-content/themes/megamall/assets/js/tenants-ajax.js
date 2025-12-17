jQuery(function ($) {

    let page = 1;

    function fetchTenants(reset = true) {

        if (reset) page = 1;

        const data = {
            action: 'mm_filter_tenants',
            search: $('input[name="tenant-search"]').val(),
            category: $('select[name="tenant-category"]').val(),
            order: $('select[name="tenant-order"]').val(),
            page: page
        };

        $.post(mmTenants.ajaxurl, data, function (response) {
            if (reset) {
                $('.mm-tenants-grid').html(response.html);
            } else {
                $('.mm-tenants-grid').append(response.html);
            }
        });
    }

    // Search (debounced)
    let typingTimer;
    $('input[name="tenant-search"]').on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => fetchTenants(true), 400);
    });

    // Filters
    $('select[name="tenant-category"], select[name="tenant-order"]').on('change', function () {
        fetchTenants(true);
    });

});
