<?php
/**
*
*/
class A2_Giftregistry_IndexController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch() {
        parent::preDispatch();
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->getResponse()->setRedirect(Mage::helper('customer')->getLoginUrl());
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function deleteAction()
    {
        try {
            $registryId = $this->getRequest()->getParam('registry_id');
            if($registryId){
                if($registry = Mage::getModel('a2_giftregistry/entity')->load($registryId)) {
                    $registry->delete();
                    $successMessage =  Mage::helper('a2_giftregistry')->__('Gift registry has been succesfully deleted.');
                    Mage::getSingleton('core/session')->addSuccess($successMessage);
                    $this->_redirect('*/*/');

                }else{
                    throw new Exception("There was a problem deleting the registry");
                }
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
    public function editAction()
    {
        $registryId = $this->getRequest()->getParam('registry_id');
        if($registryId){
            $entity = Mage::getModel('a2_giftregistry/entity');
            if($entity->load($registryId))
            {
                Mage::register('loaded_registry', $entity);
                $this->loadLayout();
                $this->_initLayoutMessages('customer/session');
                $this->renderLayout();
                return $this;
            } else {
                $this->_forward('noroute');
                return $this;
            }
        }
        $this->_redirect('*/*/');
    }
    public function newPostAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('a2_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if ($this->getRequest()->getPost() && !empty($data)) {
                $registry->updateRegistryData($customer, $data);
                $registry->created_at = date('Y-m-d H:i:s', time());
                $registry->save();
                $successMessage = Mage::helper('a2_giftregistry')->__('Registry successfully created');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
                $this->_redirect('*/*/');
            } else {
                throw new Exception("Wrong data provided", 1);

            }

        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }
    public function newItemAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('a2_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $registryIds = explode(',', $data['registry_id']);
            if ($this->getRequest()->getPost() && !empty($data)) {
                foreach ($registryIds as $registryId) {
                    $item = Mage::getModel('a2_giftregistry/item');                    
                    if(empty(
                        $item->getCollection()
                        ->addFieldToFilter('product_id', $data['product_id'])
                        ->addFieldToFilter('registry_id', $registryId)
                        ->getSize())
                    ) {
                        $item->product_id = $data['product_id'];
                        $item->registry_id = $registryId;
                        $item->added_at = date('Y-m-d H:i:s', time());
                        $item->save(); 
                    }
                }
                $success = array('success' => true);
                $this->getResponse()->setHeader('Content-type', 'application/json');
                $this->getResponse()->setBody(json_encode($success));
            }
        } catch (Mage_Core_Exception $e) {
        }
    }
    public function editPostAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('a2_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            if($this->getRequest()->getPost() && !empty($data) )
            {
                $registry->load($data['registry_id']);
                if($registry){
                    $registry->updateRegistryData($customer, $data);
                    $registry->save();
                    $successMessage =  Mage::helper('a2_giftregistry')->__('Registry Successfully Saved');
                    Mage::getSingleton('core/session')->addSuccess($successMessage);
                }else {
                    throw new Exception("Invalid Registry Specified");
                }
            }else {
                throw new Exception("Wrong data provided", 1);
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirect('*/*/');
    }

}