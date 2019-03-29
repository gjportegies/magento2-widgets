<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;
use SR\Widgets\Block\Adminhtml\Widget\Renderer\SwitcherRenderer;

class Switcher extends Template
{
    public function prepareElementHtml(AbstractElement $element)
    {
        /** @var SwitcherRenderer $fieldRenderer */
        try {
            $layout = $this->getLayout();
        } catch (LocalizedException $e) {
        }

        $fieldRenderer = $layout->createBlock(SwitcherRenderer::class);
        $element->setRenderer($fieldRenderer);
    }
}
