/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('sr_widgets.videofield', {
        options: {
            videoPathInputSelector: null,
            videoPreviewDivSelector: null,
            videoDeleteButtonSelector: null,
            mediaUrl: null
        },

        _create: function() {
            this.getVideoPathInput().on('change', $.proxy(this.updateVideo, this));
            this.getDeleteButton().on('click', $.proxy(this.deleteVideo, this));
        },

        getVideoPathInput: function() {
            return this.element.find(this.options.videoPathInputSelector).first();
        },

        getDeleteButton: function() {
            return this.element.find(this.options.videoDeleteButtonSelector).first();
        },

        getPreviewVideoDiv: function() {
            return this.element.find(this.options.videoPreviewDivSelector).first();
        },

        getLinkElement: function() {
            return this.getPreviewVideoDiv().find('a').first();
        },

        getVideoElement: function() {
            return this.getPreviewVideoDiv().find('video').first();
        },

        updateVideo: function() {
            var newVideoPath = this.getVideoPathInput().val();
            var newVideoUrl = this.options.mediaUrl + '/' + newVideoPath;
            this.getLinkElement().attr('href', newVideoUrl);
            this.getVideoElement().attr('src', newVideoUrl);
            this.getPreviewVideoDiv().show();
        },

        deleteVideo: function() {
            this.getVideoPathInput().val('');
            this.getLinkElement().attr('href', '');

            this.getVideoElement().find('source').each(
                function(num,val){
                    $(this).attr('src', '')
            });

            this.getPreviewVideoDiv().hide();
        }

    });

    return $.sr_widgets.videofield;
});
