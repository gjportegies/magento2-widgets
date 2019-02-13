<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Plugin\Model;

class WidgetPlugin
{
    /**
     * on widget generation it's replace {{media url=""}}, to prevent inappropriate chars in the widget values,
     * in our case for images
     *
     * discussion https://gist.github.com/cedricblondeau/6174911fb4bba6cb4943
     *
     * @param \Magento\Widget\Model\Widget $subject
     * @param $type
     * @param array $params
     * @param bool $asIs
     * @return array
     */
    public function beforeGetWidgetDeclaration(
        \Magento\Widget\Model\Widget $subject,
        $type,
        $params = [],
        $asIs = true
    ) {
        foreach ($params as $name => $value) {
            if (!is_string($value)) {
                continue;
            }

            if (preg_match('/(___directive\/)([a-zA-Z0-9,_-]+)/', $value, $matches)) {
                $directive = base64_decode(strtr($matches[2], '-_,', '+/='));
                $params[$name] = str_replace(['{{media url="', '"}}'], ['', ''], $directive);
            }
        }

        return [$type, $params, $asIs];
    }
}
