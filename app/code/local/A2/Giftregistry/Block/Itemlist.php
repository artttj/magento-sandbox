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
        if (is_null($this->_productCollection)) {
            $layer = $this->getLayer();
            /* @var $layer Mage_Catalog_Model_Layer */
            if ($this->getShowRootCategory()) {
                $this->setCategoryId(Mage::app()->getStore()->getRootCategoryId());
            }

            // if this is a product view page
            if (Mage::registry('product')) {
                // get collection of categories this product is associated with
                $categories = Mage::registry('product')->getCategoryCollection()
                    ->setPage(1, 1)
                    ->load();
                // if the product is associated with any category
                if ($categories->count()) {
                    // show products from this category
                    $this->setCategoryId(current($categories->getIterator()));
                }
            }

            $origCategory = null;
            if ($this->getCategoryId()) {
                $category = Mage::getModel('catalog/category')->load($this->getCategoryId());
                if ($category->getId()) {
                    $origCategory = $layer->getCurrentCategory();
                    $layer->setCurrentCategory($category);
                    $this->addModelTags($category);
                }
            }
            $this->_productCollection = $layer->getProductCollection()->addAttributeToFilter('entity_id', array('in' => $productIds));

            $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());

            if ($origCategory) {
                $layer->setCurrentCategory($origCategory);
            }
        }

        return $this->_productCollection;
    }
}