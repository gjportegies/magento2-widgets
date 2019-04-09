<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml\Widget\Renderer;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as FormElementFactory;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface as FormElementRenderer;

class ColorPickerRenderer extends Template implements FormElementRenderer
{
    /**
     * @var string
     */
    protected $_template = 'SR_Widgets::renderer/colorpicker.phtml';

    /**
     * @var AbstractElement
     */
    private $element;

    /**
     * @var FormElementFactory
     */
    private $formElementFactory;

    public function __construct(
        FormElementFactory $formElementFactory,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formElementFactory = $formElementFactory;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $this->element = $element;
        $element->setData('css_class', $element->getData('css_class') . ' field-colorpicker');
        return $this->toHtml();
    }

    public function getElement(): AbstractElement
    {
        return $this->element;
    }
}
