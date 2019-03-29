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
        $.widget('staempfli_widgetextrafields.imagefield', target, {
            updateImage: function () {
                var newImageUrl = this.getImagePathInput().val();
                this.getLinkElement().attr('href', newImageUrl);
                this.getImgElement().attr('src', newImageUrl);
                this.getPreviewImageDiv().show();
            }
        });

        return $.staempfli_widgetextrafields.imagefield;
    };
});
