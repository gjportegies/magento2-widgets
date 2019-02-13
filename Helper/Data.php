<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;

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
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    ) {
        $this->_scopeConfigInterface = $context->getScopeConfig();
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException If given store doesn't exist.
     */
    public function getMediaBaseDirectory()
    {
        /**
         * @var \Magento\Store\Model\Store $store
         */
        $store = (string)$this->_storeManager->getStore();
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
        return $this->getConfigValue('general/store_information/name');
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
}
