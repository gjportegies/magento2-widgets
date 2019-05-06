/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

var config = {
    deps: [
        'SR_Widgets/js/homepage-video'
    ],
    map: {
        '*': {
            owlCarousel2: 'SR_Widgets/OwlCarousel2/owl.carousel.js-adapter'
        }
    },
    shim: {
        'SR_Widgets/OwlCarousel2/owl.carousel': ['jquery']
    }
};
