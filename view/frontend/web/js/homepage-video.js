/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery'
], function ($) {
    'use strict';

    var $videoContainer = $('.homepage-video-container');
    var $video = $('.homepage-video');

    $(document).ready(function () {
        compensateVideoHeight();

        $(window).resize(function () {
            compensateVideoHeight();
        });

        $video.on('play', function () {
            compensateVideoHeight();
        });
    });

    function compensateVideoHeight() {
        var eHeight = $video.height();
        var mainContentOffset = $('.page-main').offset();

        $videoContainer.height(eHeight - mainContentOffset.top);
    }
});
