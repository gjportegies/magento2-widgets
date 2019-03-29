<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml\Widget;

use Magento\Backend\Block\Widget\Button;
use Magento\Framework\Data\Form\Element\AbstractElement as Element;
use Magento\Backend\Block\Template\Context as TemplateContext;
use Magento\Framework\Data\Form\Element\Factory as FormElementFactory;
use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\Text;
use Magento\Framework\Exception\LocalizedException;

/**
 * @deprecated
 *
 * Use Staempfli\WidgetExtraFields\Block\Adminhtml\ImageField instead
 */
class ImageChooser extends Template
{
    /**
     * @var FormElementFactory
     */
    protected $elementFactory;

    /**
     * ImageChooser constructor.
     * @param TemplateContext $context
     * @param FormElementFactory $elementFactory
     * @param array $data
     */
    public function __construct(
        TemplateContext $context,
        FormElementFactory $elementFactory,
        $data = []
    ) {
        $this->elementFactory = $elementFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param Element $element
     * @return Element
     * @throws LocalizedException
     */
    public function prepareElementHtml(Element $element)
    {
        $config = $this->_getData('config');
        $sourceUrl = $this->getUrl('cms/wysiwyg_images/index', ['target_element_id' => $element->getId(), 'type' => 'file']);

        /** @var Button $chooser */
        $chooser = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button');
        $chooser->setData('type', 'button')
            ->setData('class', 'btn-chooser')
            ->setData('label', $config['button']['open'])
            ->setData('onclick', 'MediabrowserUtility.openDialog(\'' . $sourceUrl . '\')')
            ->setData('disabled', $element->getReadonly());

        /** @var Text $input */
        $input = $this->elementFactory->create('text', ['data' => $element->getData()]);
        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setData('class', 'widget-option input-text admin__control-text');
        if ($element->getData('required')) {
            $input->addClass('required-entry');
        }

        $element->setData('after_element_html', $input->getElementHtml() . $chooser->toHtml());
        return $element;
    }

}
