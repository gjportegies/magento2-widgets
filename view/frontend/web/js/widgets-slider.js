/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery'
], function ($) {
    'use strict';

    return function ($sliderContent) {
        return prepareSliderContent($sliderContent);
    };

    function prepareSliderContent($sliderContent) {
        var $widgets = $sliderContent.find('.widget'),
            $slidesHtml = '',
            $slidesStylesHtml = '';

        if ($widgets.length === 0) return;

        $widgets.each(function () {
            var $widget = $(this),
                $widgetHtml = $widget[0].outerHTML,
                widgetId = $widget.attr('data-widget-id'),
                $widgetStylesBlockHtml = $('style[data-styles-for="' + widgetId + '"]')[0].outerHTML;

            $slidesStylesHtml += $widgetStylesBlockHtml;
            $slidesHtml += $widgetHtml;
        });

        $sliderContent.empty();
        $sliderContent.append($('<div class="head" hidden>' + $slidesStylesHtml + '</div>'));
        $sliderContent.append($('<div class="owl-carousel">' + $slidesHtml + '</div>'));
    }
});
