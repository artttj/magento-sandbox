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
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
    public function newPostAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
    public function editPostAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }       
}