<?php
namespace MaggyLondon\ProductsMigrate\Controller\Migrate;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class GetProduct extends \Magento\Framework\App\Action\Action
{
	public function __construct(Context $context, PageFactory $pageFactory)
	{
		$this->pageFactory = $pageFactory;
	    return parent::__construct($context);
	}

    public function execute()
    {
        echo '<p>you are in GetProduct Action!</p>';
        // var_dump(__METHOD__);
        $page_object = $this->pageFactory->create();

        return $page_object;
    }    
}