<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use SR\Widgets\Block\Adminhtml\Renderer\VideoFieldRenderer;

class VideoField extends Template
{
    public function prepareElementHtml(AbstractElement $element)
    {
        $fieldRenderer = $this->getLayout()->createBlock(VideoFieldRenderer::class);
        $element->setRenderer($fieldRenderer);
    }
}
