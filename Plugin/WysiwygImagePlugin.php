<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Plugin;

use Magento\Cms\Block\Adminhtml\Wysiwyg\Images\Content as WysiwygImageContent;
use Magento\Cms\Helper\Wysiwyg\Images as WysiwygImageHelper;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\FileSystem;
use Magento\Framework\Filesystem\Directory\ReadInterface;

class WysiwygImagePlugin
{
    /**
     * @var ReadInterface
     */
    private $mediaDir;

    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(
        FileSystem $fileSystem,
        RequestInterface $request
    ) {
        $this->mediaDir = $fileSystem->getDirectoryRead(DirectoryList::MEDIA);
        $this->request = $request;
    }

    /**
     * @param WysiwygImageHelper $subject
     * @param callable $proceed
     * @param $filename
     * @param bool $renderAsTag
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundGetImageHtmlDeclaration(
        WysiwygImageHelper $subject,
        callable $proceed,
        $filename,
        $renderAsTag = false
    ) {
        if ($this->returnRelativePath($renderAsTag)) {
            $absolutePath = $subject->getCurrentPath() . '/' . $filename;
            return $this->mediaDir->getRelativePath($absolutePath);
        }
        $result = $proceed($filename, $renderAsTag);
        return $result;
    }

    /**
     * set widget info for on insert
     * @param WysiwygImageContent $subject
     * @param callable $proceed
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundGetOnInsertUrl(
        WysiwygImageContent $subject,
        callable $proceed
    ) {
        return $subject->getUrl(
            'cms/*/onInsert',
            ['widget' => $this->request->getParam('widget')]);
    }

    /**
     * check if result should be a relativ path
     * @param $renderAsTag
     * @return bool
     */
    private function returnRelativePath($renderAsTag): bool
    {
        if (!$renderAsTag && $this->request->getParam('widget')) {
            return true;
        }
        return false;
    }
}