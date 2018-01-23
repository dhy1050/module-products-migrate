<?php
namespace MaggyLondon\ProductsMigrate\Block;
     
use Magento\Framework\View\Element\Template;
use Hanying\HelloWorld\Helper\Data;
      
class Product extends Template
{    
    protected $productCollect;
    protected $productStock;
    protected $_categoryFactory;
    protected $_helperData;
     
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,  
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,   
        Data $helperData,   
        array $data = []
    )
    {
        $this->productCollect = $productCollectionFactory;   
        $this->productStock = $stockItemRepository; 
        $this->_categoryFactory = $categoryFactory;
        $this->_helperData = $helperData;
        parent::__construct($context, $data);
    }
    /*
    college all product include out of stock
    use $isOverride to remove the filter in core team 
    there is a puglin to override Stock
    */
    public function getProductCollect()
    {
        $this->_helperData::$isOverride = true;
    	$collection = $this->productCollect->create();

        $collection->addAttributeToSelect('*')->load();

        return $collection;
    }

    /*
    to get product quty 
    
    */
    // public function getProductQty()
    // {
    //     return $this->productStock->get();
    // }

    public function getCategory($categoryId)
    {
        $category = $this->_categoryFactory->create();
        $category = $category->load($categoryId);

        return $category;
    }

    public function getCategoryProducts($categoryId)
    {
        $category = $this->getCategory($categoryId);


        $products = $category->getProductCollection()->addAttributeToSelect('*');

        return $products;
    }

    public function getProductByObject()
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

        $productCollectionFactory = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        $collection = $productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(3); // selecting only 3 products

        return $collection;
    }

    public function addCategoriesToProduct($product, $categoryId)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $categoryLinkManagement = $objectManager->get('\Magento\Catalog\Api\CategoryLinkManagementInterface');

        $categoryLinkManagement->assignProductToCategories($product, $categoryId);

    }

  
}