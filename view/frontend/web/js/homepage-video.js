/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery'
], function ($) {
    'use strict';

    var $videoContainer = $('.homepage-video-container'),
        $video = $videoContainer.find('.homepage-video'),
        $pageContent = $('.page-main .column.main');

    if (!$videoContainer.length) return;

    $('body').addClass('has-homepage-video');

    $(document).ready(function () {
        compensateVideoHeight();
    });

    $(window).resize(function () {
        compensateVideoHeight();
    });

    $video.on('play', function () {
        compensateVideoHeight();
    });

    function compensateVideoHeight() {
        var videoHeight = $video.height(),
            pageContentOffset = $pageContent.offset().top;

        $videoContainer.height(videoHeight - pageContentOffset);
    }
});
