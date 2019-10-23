<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\Information;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Asset\Minification;
use Magento\Cms\Model\Template\FilterProvider;

class Data extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Context
     */
    protected $_scopeConfigInterface;

    /**
     * @var Minification
     */
    protected $minification;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $filterProvider;

    /**
     * Data constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Minification $minification
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Minification $minification,
        FilterProvider $filterProvider
    ) {
        $this->_scopeConfigInterface = $context->getScopeConfig();
        $this->_storeManager = $storeManager;
        $this->minification = $minification;
        $this->filterProvider = $filterProvider;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getMediaBaseDirectory()
    {
        /**
         * @var Store $store
         */
        try {
            $store = $this->_storeManager->getStore();
        } catch (NoSuchEntityException $e) {
        }
        return $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * @param string $path
     * @return string
     */
    public function getConfigValue($path)
    {
        return $this->_scopeConfigInterface->getValue(
            $path,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve Store Name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->getConfigValue(Information::XML_PATH_STORE_INFO_NAME);
    }

    /**
     * Retrieve "<store name> design image" phrase
     *
     * @return string
     */
    public function getSimpleImageAlt()
    {
        return $this->getStoreName() . ' ' . __('design image');
    }

    /**
     * @param mixed $data
     * @return string
     */
    public function getWysiwygMedia($data)
    {
        if (!is_string($data)) return $data;

        $hasImageDirective = strpos($data, '{{media url=') !== false;

        if (!$hasImageDirective) return $data;

        /* SR-TODO: use filterProvider to decode directive (see getWysiwygStoreVariable()) */

        $mediaDir = $this->getMediaBaseDirectory();
        $htmlDecodedData = htmlspecialchars_decode($data);

        return str_replace(['{{media url="', '"}}'], [$mediaDir, ''], $htmlDecodedData);
    }

    /**
     * @param string $data
     * @return string
     * @throws \Exception
     */
    public function getWysiwygStoreVariable($data)
    {
        if (!is_string($data)) return $data;

        $hasStoreVariable = strpos($data, '{{config path=') !== false;

        if (!$hasStoreVariable) return $data;

        return $this->filterProvider->getPageFilter()->filter($data);
    }

    /**
     * @param string $fileType
     * @return bool
     */
    public function isMinificationEnabled($fileType = 'css')
    {
        return $this->minification->isEnabled($fileType);
    }
}
