<?php

class A2_Giftregistry_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getEventTypes()
    {
        $collection = Mage::getModel('a2_giftregistry/type')->getCollection();
        return $collection;
    }

    public function isItemInRegistry($itemId, $registryId)
    {
        return $itemCollection = Mage::getModel('a2_giftregistry/item')->getCollection()
            ->addFieldToFilter('product_id', $itemId)
            ->addFieldToFilter('registry_id', $registryId)
            ->count();
    }

    public function isRegistryOwner($registryCustomerId)
    {
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        if($currentCustomer && $currentCustomer->getId() == $registryCustomerId) {
            return true;
        }
        return false;
    }

}
