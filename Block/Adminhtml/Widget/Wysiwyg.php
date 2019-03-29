<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Element;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory;

/**
 * Class Editor
 * @package SR\Widgets\Block\Widget
 */
class Wysiwyg extends Element
{

    /**
     * @var Config
     */
    protected $_wysiwygConfig;

    /**
     * @var Factory
     */
    protected $_factoryElement;

    /**
     * Editor constructor.
     * @param Context $context
     * @param Factory $factoryElement
     * @param Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Factory $factoryElement,
        Config $wysiwygConfig,
        $data = []
    ) {
        $this->_factoryElement = $factoryElement;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $data);
    }

    /**
     * Prepare chooser element HTML
     *
     * @param AbstractElement $element Form Element
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element) {
        $editor = $this->_factoryElement->create('editor', ['data' => $element->getData()])
            ->setData('label', '')
            ->setForm($element->getForm())
            ->setData('wysiwyg', true)
            ->setData('config', $this->_wysiwygConfig->getConfig(['add_variables' => false, 'add_widgets' => false]));

        if ($element->getData('required')) {
            $editor->addClass('required-entry');
        }

        $element->setData(
            'after_element_html', $this->_getAfterElementHtml() . $editor->getElementHtml()
        );

        return $element;
    }

    /**
     * @return string
     */
    protected function _getAfterElementHtml() {
        $html = <<<HTML
    <style>
        .admin__field-control.control .control-value {
            display: none !important;
        }
    </style>
HTML;

        return $html;
    }

}
