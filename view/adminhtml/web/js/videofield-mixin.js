/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    return function (target) {
        $.widget('staempfli_widgetextrafields.videofield', target, {
            updateVideo: function () {
                var newVideoUrl = this.getVideoPathInput().val();
                this.getLinkElement().attr('href', newVideoUrl);
                this.getVideoElement().attr('src', newVideoUrl);
                this.getPreviewVideoDiv().show();
            }
        });

        return $.staempfli_widgetextrafields.videofield;
    };
});
