<?php

/**
* 
*/
class A2_Giftregistry_Model_Mysql4_Type extends Mage_Core_Model_Mysql4_Abstract
{
    
    function __construct()
    {
        $this->init('mdg_giftregistry/type', 'type_id');
    }
}