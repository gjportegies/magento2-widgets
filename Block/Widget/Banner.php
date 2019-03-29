<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Widget;

class Banner extends AbstractWidget
{
    /**
     * Check if widget has content
     *
     * @return boolean
     */
    public function hasContent()
    {
        $title = $this->getData('title');
        $description = $this->getData('description');
        $link1Label = $this->getData('link1Label');
        $link1URL = $this->getData('link1URL');
        $link2Label = $this->getData('link2Label');
        $link2URL = $this->getData('link2URL');
        $link3Label = $this->getData('link3Label');
        $link3URL = $this->getData('link3URL');
        $link4Label = $this->getData('link4Label');
        $link4URL = $this->getData('link4URL');

        return $title || $description ||
            $link1Label || $link1URL ||
            $link2Label || $link2URL ||
            $link3Label || $link3URL ||
            $link4Label || $link4URL;
    }

    /**
     * Return links defined for widgets
     *
     * @return array
     */
    public function getLinks()
    {
        return [
            [
                'label' => $this->getData('link1Label'),
                'target' => $this->getData('link1URL')
            ],
            [
                'label' => $this->getData('link2Label'),
                'target' => $this->getData('link2URL')
            ],
            [
                'label' => $this->getData('link3Label'),
                'target' => $this->getData('link3URL')
            ],
            [
                'label' => $this->getData('link4Label'),
                'target' => $this->getData('link4URL')
            ]
        ];
    }
}
