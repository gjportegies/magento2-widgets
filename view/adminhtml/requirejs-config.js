/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

var config = {
    config: {
        mixins: {
            'Staempfli_WidgetExtraFields/js/imagefield': {
                'SR_Widgets/js/imagefield-mixin': true
            },
            'Staempfli_WidgetExtraFields/js/videofield': {
                'SR_Widgets/js/videofield-mixin': true
            }
        }
    },
    map: {
        '*': {
            widgetSwitcherField: 'SR_Widgets/js/switcher-field'
        }
    }
};
