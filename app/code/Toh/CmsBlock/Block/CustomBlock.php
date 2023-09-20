<?php

namespace Toh\CmsBlock\Block;

class CustomBlock extends \Magento\Framework\View\Element\Template
{
   
    public function getWelcomeText()
    {
        return 'CMS Block Created';
    }
}