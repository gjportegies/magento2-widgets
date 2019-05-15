<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Controller\Adminhtml\Widget;

use Magento\Widget\Controller\Adminhtml\Widget\BuildWidget;
use SR\Widgets\Helper\EncodingData;

class BuildWidgetPlugin extends BuildWidget
{
    /**
     * @var \Magento\Widget\Model\Widget
     */
    protected $_widget;

    /**
     * @var EncodingData
     */
    protected $encodingDataHelper;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Widget\Model\Widget $widget,
        EncodingData $encodingDataHelper
    ) {
        $this->encodingDataHelper = $encodingDataHelper;
        parent::__construct($context, $widget);
    }

    /**
     * Format widget pseudo-code for inserting into wysiwyg editor
     *
     * @return void
     */
    public function execute()
    {
        $type = $this->getRequest()->getPost('widget_type');
        $params = $this->getRequest()->getPost('parameters', []);
        $asIs = $this->getRequest()->getPost('as_is');

        // widget params encoding
        $params = $this->encodingDataHelper->encodeArray($params);

        $html = $this->_widget->getWidgetDeclaration($type, $params, $asIs);
        $this->getResponse()->setBody($html);
    }
}
