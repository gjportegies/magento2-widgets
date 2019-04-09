<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;
use SR\Widgets\Block\Adminhtml\Widget\Renderer\ColorPickerRenderer;

class ColorPickerField extends Template
{
    public function prepareElementHtml(AbstractElement $element)
    {
        /** @var ColorPickerRenderer $fieldRenderer */
        try {
            $layout = $this->getLayout();
        } catch (LocalizedException $exception) {
            $this->_logger->error($exception->getLogMessage(), ['exception' => $exception]);
            return;
        }

        $fieldRenderer = $layout->createBlock(ColorPickerRenderer::class);
        $element->setRenderer($fieldRenderer);
    }
}
