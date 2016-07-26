<?php
/**
*
*/
class A2_Giftregistry_SearchController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function resultsAction() {
        $this->loadLayout();
        $this->renderLayout();
        return $this;        
    }    
}