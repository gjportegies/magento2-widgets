<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Block\Widget;

class Banners extends AbstractWidget
{
    /**
     * Return banners defined for widgets
     *
     * @return array
     */
    public function getItems()
    {
        $banners = [];

        for ($i = 1; ; $i++) {
            if (!$this->getData('banner' . $i . 'Title') &&
                !$this->getData('banner' . $i . 'LinkDescription') &&
                !$this->getData('banner' . $i . 'LinkLabel') &&
                !$this->getData('banner' . $i . 'ImagePath')) {
                break;
            }

            $banners[$i - 1] = [
                'title' => $this->getData('banner' . $i . 'Title'),
                'description' => $this->getData('banner' . $i . 'Description'),
                'link_label' => $this->getData('banner' . $i . 'LinkLabel'),
                'link_address' => $this->getData('banner' . $i . 'LinkURL'),
                'link_open_link_in_new_tab' => $this->getData('banner' . $i . 'LinkOpenLinkInNewTab'),
                'image_path' => $this->getData('banner' . $i . 'ImagePath')
            ];
        }

        return $banners;
    }

    /**
     * @return bool
     */
    public function hasPrimaryBanner()
    {
        return
            $this->getData('primaryBannerTitle') ||
            $this->getData('primaryBannerDescription') ||
            ($this->getData('primaryBannerLinkLabel') && $this->getData('primaryBannerLinkURL')) ||
            $this->getData('primaryBannerImagePath');
    }

    /**
     * @param $banner array
     * 
     * @return bool
     */
    public function hasBannerTextContent($banner)
    {
        return $banner['title'] || ($banner['link_label'] && $banner['link_address']);

    }

    /**
     * Return amount of non empty items
     *
     * @return number
     */
    public function getItemsAmount()
    {
        $items = $this->getItems();
        $counter = 0;

        foreach ($items as $item) {
            if ($this->isItemValid($item)) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Return true if item has at least one non empty data field
     *
     * @param array
     *
     * @return bool
     */
    public function isItemValid($item)
    {
        foreach ($item as $itemDataField) {
            if ($itemDataField) {
                return true;
            }
        }

        return false;
    }
}
