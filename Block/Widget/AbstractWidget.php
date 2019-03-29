<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
use SR\Widgets\Helper\Data;

/**
 * Class AbstractWidget
 * @package SR\Widgets\Block\Widget
 */
abstract class AbstractWidget extends Template implements BlockInterface
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * return image url
     *
     * format base url + pub/media + path to the image
     *
     * @param $image
     * @return string
     * @throws
     */
    public function getMedia($image)
    {
        return $this->helper->getMediaBaseDirectory() . $image;
    }

    /**
     * Return widget param as css style declaration
     *
     * @param string $widgetParamName
     * @param Template $widget|null
     * @return string
     */
    public function getCssStyleDeclaration($widgetParamName, Template $widget = null)
    {
        $widget = $widget ?: $this;

        if (!$cssPropValue = $widget->getData($widgetParamName)) return null;

        $cssPropName = str_replace(['widget', 'Mobile'], '', $widgetParamName);
        $cssPropName = $this->convertCamelCaseToKebabCase($cssPropName);

        return $cssPropName . ': ' . $cssPropValue . ';' . PHP_EOL;
    }

    /**
     * Converts camel case string to kebab case
     *
     * camelCase => kebab-case
     *
     * taken from  https://github.com/joachim-n/case-converter
     *
     * @param string $camelCase
     * @return string
     */
    public function convertCamelCaseToKebabCase($camelCase)
    {
        $pieces = preg_split('@((?<=.)(?=[[:upper:]][[:lower:]])|(?<=[[:lower:]])(?=[[:upper:]]))@', $camelCase);

        foreach ($pieces as &$piece) {
            if (preg_match('@^[[:upper:]]+$@', $piece)) {
                continue;
            }

            $piece = lcfirst($piece);
        }

        $kebabCase = implode('-', $pieces);

        return $kebabCase;
    }
}
