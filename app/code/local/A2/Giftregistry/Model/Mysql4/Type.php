<?php

/**
* 
*/
class A2_Giftregistry_Model_Mysql4_Type extends Mage_Core_Model_Mysql4_Abstract
{
    
    function _construct()
    {
        $this->_init('a2_giftregistry/type', 'type_id');
    }
}