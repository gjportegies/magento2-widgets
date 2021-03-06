<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use SR\Widgets\Helper\Data;
use SR\Widgets\Helper\EncodingData;

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
     * @var EncodingData
     */
    protected $encodingDataHelper;

    /**
     * @param Context $context
     * @param Data $helper
     * @param EncodingData $encodingDataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        EncodingData $encodingDataHelper,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->encodingDataHelper = $encodingDataHelper;
        parent::__construct($context, $data);
    }

    /**
     * Object data getter (for data that may be encoded)
     *
     * @param string $key
     * @param string|int $index
     * @param object|null $widget
     * @return string|array
     * @throws \Exception
     */
    public function getData($key = '', $index = null, $widget = null)
    {
        $widget = $widget ?: $this;

        $widgetParams = $widget->_data;

        if ('' === $key) {
            $data = $this->encodingDataHelper->decodeArray($widgetParams);

            foreach ($data as $key => $value) {
                $data[$key] = $this->helper->getWysiwygMedia($value);
                $data[$key] = $this->helper->getWysiwygStoreVariable($value);
            }

            return $data;
        }

        $data = parent::getData($key, $index);

        if (isset($widgetParams[$key])) {
            $data = $this->encodingDataHelper->decodeParam($widgetParams, $key);
        }

        $data = $this->helper->getWysiwygMedia($data);
        $data = $this->helper->getWysiwygStoreVariable($data);

        return $data;
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
     * @param string $url
     * @return string
     */
    public function _getUrl($url)
    {
        if ($this->getIsExternalUrl($url)) {
            return $url;
        }

        return $this->getProcessNonUrlLink($url) ?: $this->getUrl() . $url;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function getIsExternalUrl($url)
    {
        $isHttp = strpos($url, 'http://') === 0;
        $isHttps = strpos($url, 'https://') === 0;

        return $isHttp || $isHttps;
    }

    /**
     * @param string $url
     * @return string|null
     */
    public function getProcessNonUrlLink($url)
    {
        $isTelephoneNumber = strpos($url, 'tel:') === 0;
        $isMailAddress = strpos($url, 'mailto:') === 0;

        if ($isTelephoneNumber) {
            return $this->getProcessedTelLink($url);
        }

        if ($isMailAddress) {
            return $this->getProcessedMailLink($url);
        }

        return null;
    }

    /**
     * @param string $link
     * @return string
     */
    public function getProcessedTelLink($link)
    {
        return str_replace([' ', '-', '.', ',', '(', ')'], [''], $link);
    }

    /**
     * @param string $link
     * @return string
     */
    public function getProcessedMailLink($link)
    {
        return $link;
    }

    /**
     * Return widget param as css style declaration
     *
     * @param string $widgetParamName
     * @param Template $widget | null
     * @return string
     * @throws \Exception
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
