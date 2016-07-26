<?php

class A2_Giftregistry_Model_Item extends Mage_Core_Model_Abstract
{
    public function __construct() 
    {
        $this->_init('a2_giftregistry/item');
        parent::_construct();
    }
}