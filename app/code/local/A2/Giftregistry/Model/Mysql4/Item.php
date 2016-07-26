<?php

/**
* 
*/
class A2_Giftregistry_Model_Mysql4_Item extends Mage_Core_Model_Mysql4_Abstract
{
    
    public function _construct(argument)
    {
        $this->_init('a2_giftregistry/item', 'item_id');
    }
}