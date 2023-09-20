<?php
namespace Login\Customer\Plugin;

use Magento\Catalog\Model\Product;

class AppendWebsiteName
{
    public function aftergetName(Product $subject, $result)
    {

         // Get the current store
         $store = $subject->getStore();

         // Get the website name
         $websiteName = $store->getWebsite()->getName();
        //print_r($result);
        //$websiteName = 'http://sajitha.magento2.com/'; // Replace with your website name
        return $websiteName . ' - ' . $result;
    }
}
