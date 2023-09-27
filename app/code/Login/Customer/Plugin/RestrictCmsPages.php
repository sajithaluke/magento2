<?php
namespace Login\Customer\Plugin;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\UrlInterface;

class RestrictCmsPages

    {
        protected $customerSession;
        protected $url;
    
        public function __construct(
            \Magento\Customer\Model\Session $customerSession,
            \Magento\Framework\UrlInterface $url
        ) {
            $this->customerSession = $customerSession;
            $this->url = $url;
        }
    
        public function beforeDispatch(
            \Magento\Cms\Controller\Page\View $subject,
            $request
        ) {
            $pageId = $request->getParam('page_id');
            //echo $pageId;
            // Define an array of restricted page IDs
            $restrictedPages = [8, 2, 5]; // Add the IDs of restricted pages here
    
            if (in_array($pageId, $restrictedPages)) {
                if ($this->customerSession->isLoggedIn()) {
                    $this->customerSession->logout();
                    $url = $this->url->getUrl('customer/account/login');
                    $subject->getResponse()->setRedirect($url);
                }
            }
        }
    }
