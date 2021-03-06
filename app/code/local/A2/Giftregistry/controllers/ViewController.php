<?php
/**
*
*/
class A2_Giftregistry_ViewController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $registryId = $this->getRequest()->getParam('registry_id');
        if ($registryId) {
            $entity = Mage::getModel('a2_giftregistry/entity');
            if ($registryId) {
                $entity = Mage::getModel('a2_giftregistry/entity');
                if ($entity->load($registryId)) {
                    Mage::register('loaded_registry', $entity);
                    $this->loadLayout();
                    $this->_initLayoutMessages('customer/session');
                    $this->renderLayout();
                    return $this;
                }
                $this->_forward('noroute');
                return $this;
            }
        }
    }
}