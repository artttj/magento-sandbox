<?php

class A2_Giftregistry_Block_List extends Mage_Core_Block_Template
{
    public function getCustomerRegistries()
    {
        $collection = null;
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        if($currentCustomer) {
            $collection = Mage::getModel('a2_giftregistry/entity')->getCollection()
                ->addFieldToFilter('customer_id', $currentCustomer->getId());
        }
        return $collection;
    }
}