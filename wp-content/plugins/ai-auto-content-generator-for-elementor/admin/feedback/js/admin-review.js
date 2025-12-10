
jQuery(document).ready(function ($) {
    Object.keys(window).forEach(function (key) {
        if (key.startsWith('AACGFENoticeData_')) {
            var noticeData = window[key];

            $(document).on("click",
                "#" + noticeData.id + " .notice-dismiss, " +
                "#" + noticeData.id + " ." + noticeData.plugin_slug + "_dismiss_notice",
                function (e) {
                    e.preventDefault();

                    var $wrapper = $(this).closest(".notice");

                    if ($wrapper.length) {
                        $.post(noticeData.ajax_url, {
                            action: noticeData.ajax_callback,
                            slug: noticeData.plugin_slug,
                            id: noticeData.id,
                            _nonce: noticeData.wp_nonce
                        }, function () {
                            $wrapper.slideUp("fast");
                        }, "json");
                    }
                });
        }
    });
});
