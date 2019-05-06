/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

/**
 * This script is a simple wrapper that allows you to use jQuery plugin with Magento 2
 */

define([
    'jquery',
    'SR_Widgets/OwlCarousel2/owl.carousel'
], function ($) {
    return function (config, element) {
        return $(element).owlCarousel(config);
    };
});
