<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Widget;

use Magento\Cms\Block\Widget\Block;
use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Template\Context;

class SRCMSStaticBlock extends Block
{
    /**
     * @var Widget
     */
    protected $widget;

    public function __construct(
        Context $context,
        FilterProvider $filterProvider,
        BlockFactory $blockFactory,
        Widget $widget,
        array $data = []
    ) {
        $this->widget = $widget;
        parent::__construct(
            $context,
            $filterProvider,
            $blockFactory,
            $data
        );
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
        return $this->widget->getMedia($image);
    }

    /**
     * Return widget param as css style declaration
     *
     * @param string $widgetParamName
     * @return string
     */
    public function getCssStyleDeclaration($widgetParamName)
    {
        return $this->widget->getCssStyleDeclaration($widgetParamName, $this);
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
        return $this->widget->convertCamelCaseToKebabCase($camelCase);
    }
}
