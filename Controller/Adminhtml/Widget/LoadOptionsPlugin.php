<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Controller\Adminhtml\Widget;

use Magento\Backend\App\Action;
use Magento\Framework\App\ObjectManager;
use Magento\Widget\Controller\Adminhtml\Widget\LoadOptions;
use SR\Widgets\Helper\EncodingData;

class LoadOptionsPlugin extends LoadOptions
{
    /**
     * @var \Magento\Widget\Helper\Conditions
     */
    private $conditionsHelper;

    /**
     * @var EncodingData
     */
    private $encodingDataHelper;

    public function __construct(
        Action\Context $context,
        EncodingData $encodingDataHelper
    ) {
        $this->encodingDataHelper = $encodingDataHelper;
        parent::__construct($context);
    }

    /**
     * Ajax responder for loading plugin options form
     *
     * @return void
     */
    public function execute()
    {
        try {
            $this->_view->loadLayout();
            if ($paramsJson = $this->getRequest()->getParam('widget')) {
                $request = $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)
                    ->jsonDecode($paramsJson);
                if (is_array($request)) {
                    $optionsBlock = $this->_view->getLayout()->getBlock('wysiwyg_widget.options');
                    if (isset($request['widget_type'])) {
                        $optionsBlock->setWidgetType($request['widget_type']);
                    }
                    if (isset($request['values'])) {
                        // widget params encoding
                        $request['values'] = $this->encodingDataHelper->decodeArray($request['values']);
                        $request['values'] = array_map('htmlspecialchars_decode', $request['values']);
                        if (isset($request['values']['conditions_encoded'])) {
                            $request['values']['conditions'] =
                                $this->getConditionsHelper()->decode($request['values']['conditions_encoded']);
                        }
                        $optionsBlock->setWidgetValues($request['values']);
                    }
                }
                $this->_view->renderLayout();
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $result = ['error' => true, 'message' => $e->getMessage()];
            $this->getResponse()->representJson(
                $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($result)
            );
        }
    }

    /**
     * @return \Magento\Widget\Helper\Conditions
     * @deprecated 101.0.0
     */
    private function getConditionsHelper()
    {
        if (!$this->conditionsHelper) {
            $this->conditionsHelper = ObjectManager::getInstance()->get(\Magento\Widget\Helper\Conditions::class);
        }

        return $this->conditionsHelper;
    }
}
