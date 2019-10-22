<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Widget\Product;

use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogWidget\Model\Rule;
use Magento\Framework\App\Http\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Rule\Model\Condition\Sql\Builder;
use Magento\Widget\Helper\Conditions;
use SR\Widgets\Block\Widget\Widget;

class ProductsList extends \Magento\CatalogWidget\Block\Product\ProductsList
{
    /**
     * @var Widget
     */
    protected $widget;

    /**
     * ProductsList constructor.
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param CollectionFactory $productCollectionFactory
     * @param Visibility $catalogProductVisibility
     * @param Context $httpContext
     * @param Builder $sqlBuilder
     * @param Rule $rule
     * @param Conditions $conditionsHelper
     * @param Widget $widget
     * @param array $data
     * @param Json|null $json
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        CollectionFactory $productCollectionFactory,
        Visibility $catalogProductVisibility,
        Context $httpContext,
        Builder $sqlBuilder,
        Rule $rule,
        Conditions $conditionsHelper,
        Widget $widget,
        array $data = [],
        Json $json = null
    ) {
        $this->widget = $widget;
        parent::__construct(
            $context,
            $productCollectionFactory,
            $catalogProductVisibility,
            $httpContext,
            $sqlBuilder,
            $rule,
            $conditionsHelper,
            $data,
            $json
        );
    }

    /**
     * Object data getter (for data that may be encoded)
     *
     * @param string $key
     * @param string|int $index
     * @return string|array
     */
    public function getData($key = '', $index = null)
    {
        return $this->widget->getData($key, $index, $this);
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
