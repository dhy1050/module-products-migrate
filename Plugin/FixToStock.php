<?php
namespace MaggyLondon\ProductsMigrate\Plugin;

use Hanying\HelloWorld\Helper\Data;
use Magento\CatalogInventory\Helper\Stock;

class FixToStock extends Stock
{
	public function aroundAddIsInStockFilterToCollection($subject, $procede, $collection)
    {

        if(true === Data::$isOverride) {
            $stockFlag = 'has_stock_status_filter';
            if (!$collection->hasFlag($stockFlag)) {
                $isShowOutOfStock = true;
                $resource = $this->getStockStatusResource();
                $resource->addStockDataToCollection(
                    $collection,
                    !$isShowOutOfStock || $collection->getFlag('require_stock_items')
                );
                $collection->setFlag($stockFlag, true);
                
            }
            Data::$isOverride = false;
        } else {
            
            return $procede($collection);
        }
    }
}