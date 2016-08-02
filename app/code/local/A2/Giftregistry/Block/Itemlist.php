<?php

class A2_Giftregistry_Block_Itemlist extends Mage_Catalog_Block_Product_List
{
    protected function _getProductCollection()
    {
        $registryId = Mage::registry('loaded_registry')->getId();
        $productIds = array();
        $itemCollection = Mage::getModel('a2_giftregistry/item')->getCollection()->addFieldToSelect('product_id')
            ->addFieldToFilter('registry_id', $registryId);
        foreach ($itemCollection as $item) {
            $productIds[] = $item->product_id;
        }

        $this->_productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addAttributeToFilter('entity_id', array('in' => $productIds));

        return $this->_productCollection;
    }
}