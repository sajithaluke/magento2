<?php

declare(strict_types=1);

namespace Eglobe\Helloworld\Controller\Index;


class Test extends \Magento\Framework\App\ActionInterface
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		echo "Hello World";
		exit;
		//die('Example');
	}
}
