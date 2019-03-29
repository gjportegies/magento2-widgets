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

class SwitcherRenderer extends Template implements FormElementRenderer
{
    /**
     * @var AbstractElement
     */
    private $element;

    /**
     * @var string
     */
    protected $_template = 'SR_Widgets::renderer/switcher-field-renderer.phtml';
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
        return $this->toHtml();
    }

    public function getElement(): AbstractElement
    {
        return $this->element;
    }
}