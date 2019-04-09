/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('sr_widgets.switcherField', {
        _create: function () {
            var self = this;
            var $widgetOptions = $('#widget_options, #edit_form');

            $widgetOptions.on('contentUpdated', function () {
                self.updateWidgetParamsSectionsVisibility();
            });

            $('input[name="widget-params-sections-switcher"]').on('click', function () {
                self.updateWidgetParamsSectionsVisibility();
            });

            $widgetOptions.trigger('contentUpdated');
        },

        updateWidgetParamsSectionsVisibility: function () {
            var self = this;
            var selectedSection = $('input[name="widget-params-sections-switcher"]:checked').val();
            var $widgetOptions = $('.fieldset-widget-options > .admin__field');

            $widgetOptions.each(function () {
                var $widgetOption = $(this);

                if (selectedSection === 'content') {
                    if (self.isFieldInScope($widgetOption, 'design')) {
                        $widgetOption.hide();
                    }

                    if (self.isFieldInScope($widgetOption, 'content')) {
                        $widgetOption.show();
                    }

                    self.toggleSpecificFieldVisibility($widgetOption, '.rule-tree', 'show');
                    self.toggleSpecificFieldVisibility($widgetOption, '[data-ui-id=widget-instance-edit-tab-properties-fieldset-element-label-parameters-block-id-label]', 'show');
                    self.toggleSpecificFieldVisibility($widgetOption, '[data-ui-id=widget-instance-edit-tab-properties-element-hidden-parameters-block-id]', 'show');
                }

                if (selectedSection === 'design') {
                    if (self.isFieldInScope($widgetOption, 'content')) {
                        $widgetOption.hide();
                    }

                    if (self.isFieldInScope($widgetOption, 'design')) {
                        $widgetOption.show();
                    }

                    self.toggleSpecificFieldVisibility($widgetOption, '.rule-tree', 'hide');
                    self.toggleSpecificFieldVisibility($widgetOption, '[data-ui-id=widget-instance-edit-tab-properties-fieldset-element-label-parameters-block-id-label]', 'hide');
                    self.toggleSpecificFieldVisibility($widgetOption, '[data-ui-id=widget-instance-edit-tab-properties-element-hidden-parameters-block-id]', 'hide');
                }
            });
        },

        /**
         * @param $e {jQuery|HTMLElement}
         * @param scope {String}
         * @returns {Boolean}
         */
        isFieldInScope: function ($e, scope) {
            return !!$e.find('[data-section-scope="' + scope + '"]').length;
        },

        /**
         * @param $field {jQuery|HTMLElement}
         * @param key {String}
         * @param action {String}
         */
        toggleSpecificFieldVisibility: function ($field, key, action) {
            if ($field.find(key).length) {
                $field[action]();
            }
        }
    });

    return $.sr_widgets.switcherField;
});