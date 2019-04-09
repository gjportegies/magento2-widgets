/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'jquery/colorpicker/js/colorpicker'
], function ($) {
    'use strict';

    $.widget('sr_widgets.colorpicker', {
        options: {
            fieldId: null,
            value: null
        },

        _create: function () {
            var self = this;
            var $e = $('#' + this.options.fieldId);
            $e.attr('autocomplete', 'off');
            $e.css('color', self.getContrastTextColor(this.options.value));
            $e.css('backgroundColor', this.options.value);

            $e.ColorPicker({
                color: this.options.value,
                onChange: function (hsb, hex, rgb) {
                    $e.css('color', self.getContrastTextColor('#' + hex));
                    $e.css('backgroundColor', '#' + hex);
                    $e.val('#' + hex);
                }
            });
        },

        getContrastTextColor: function (hex) {
            var threshold = 130; /* about half of 256. Lower threshold equals more dark text on dark background  */
            var hRed = hexToR(hex);
            var hGreen = hexToG(hex);
            var hBlue = hexToB(hex);

            function hexToR(h) {
                return parseInt((cutHex(h)).substring(0, 2), 16)
            }

            function hexToG(h) {
                return parseInt((cutHex(h)).substring(2, 4), 16)
            }

            function hexToB(h) {
                return parseInt((cutHex(h)).substring(4, 6), 16)
            }

            function cutHex(h) {
                return (h.charAt(0) === '#') ? h.substring(1, 7) : h
            }

            var cBrightness = ((hRed * 299) + (hGreen * 587) + (hBlue * 114)) / 1000;

            if (cBrightness > threshold) {
                return '#000000';
            } else {
                return '#ffffff';
            }
        }
    });

    return $.sr_widgets.colorpicker;
});
