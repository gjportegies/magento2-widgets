/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

var config = {
    config: {
        mixins: {
            'SR_Widgets/js/imagefield': {
                'SR_Widgets/js/imagefield-mixin': true
            },
            'SR_Widgets/js/videofield': {
                'SR_Widgets/js/videofield-mixin': true
            }
        }
    },
    map: {
        '*': {
            widgetImageField: 'SR_Widgets/js/imagefield',
            widgetVideoField: 'SR_Widgets/js/videofield',
            widgetSwitcherField: 'SR_Widgets/js/switcher-field',
            widgetColorPickerField: 'SR_Widgets/js/colorpicker-field'
        }
    }
};
