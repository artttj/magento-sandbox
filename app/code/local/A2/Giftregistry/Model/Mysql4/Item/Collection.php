<?php

/**
* 
*/
class A2_Giftregistry_Model_Mysql4_Item_Colelction extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    
    public function _construct()
    {
        $this->_init('a2_giftregistry/item');
        parent::_construct();
    }
}