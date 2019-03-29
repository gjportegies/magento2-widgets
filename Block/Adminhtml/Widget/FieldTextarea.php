<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory;

Class FieldTextarea extends Template
{
    protected $_elementFactory;

    /**
     * @param Context $context
     * @param Factory $elementFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Factory $elementFactory,
        array $data = []
    ) {
        $this->_elementFactory = $elementFactory;
        parent::__construct($context, $data);
    }

    /**
     * Prepare textarea element HTML
     *
     * @param AbstractElement $element Form Element
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $input = $this->_elementFactory->create('textarea', ['data' => $element->getData()]);
        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setData('class', 'widget-option input-textarea admin__control-text');

        if ($element->getData('required')) {
            $input->addClass('required-entry');
        }

        $styles = '
            <style>
                .field-' . $element->getId() . ' .control-value {
                    display: none;                    
                }
                
                .field-' . $element->getId() . ' .input-textarea {
                    min-height: 160px;                    
                }
            </style>
        ';

        $element->setData('after_element_html', $input->getElementHtml() . $styles);

        return $element;
    }
}
