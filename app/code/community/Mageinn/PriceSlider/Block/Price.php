<?php 
/**
 * Mageinn_PriceSlider extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Mageinn
 * @package     Mageinn_PriceSlider
 * @copyright   Copyright (c) 2016 Mageinn. (http://mageinn.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Ajax Block
 *
 * @category   Mageinn
 * @package    Mageinn_PriceSlider
 * @author     Mageinn
 */
class Mageinn_PriceSlider_Block_Price extends Mage_Core_Block_Template
{
    protected $_productCollection;
    protected $_toPrice;
    protected $_fromPrice;
    protected $_currFromPrice;
    protected $_currToPrice;
    protected $_isEnabled;

    
    public function __construct()
    {
        $this->setProductCollection()->setPrices();
        parent::__construct();
    }
    
    /**
     * Set product collection depending on the page
     * 
     * @return  Mageinn_PriceSlider_Block_Price
     */
    public function setProductCollection()
    {
        $attribute = Mage::getModel('eav/entity_attribute')
                ->loadByCode('catalog_product', 'price');
        $_category = Mage::registry('current_category');
        if($_category) {
            $this->_isEnabled = $attribute->getIsFilterable();
            if(!$this->_isEnabled){
                return $this;
            }
            
            $this->_productCollection = $_category
                    ->getProductCollection()
                    ->setOrder('price', 'ASC');
        } else {
            $this->_isEnabled =  $attribute->getIsFilterableInSearch();
            if(!$this->_isEnabled){
                return $this;
            }
            
            $collection = Mage::getResourceModel('catalogsearch/fulltext_collection');
            Mage::getSingleton('catalogsearch/layer')
                    ->prepareProductCollection($collection);
            
            $this->_productCollection = $collection;
        }
             
        return $this;
    }
    
    /*
    * Set prices
     * 
    * @return  Mageinn_PriceSlider_Block_Price
    */
    public function setPrices()
    {
        // Get selected prices
        $priceRange = $this->getRequest()->getParam('price');
        
        if($priceRange) {
            $filterParams = explode('-', $this->getRequest()->getParam('price'));
            
            $this->_currFromPrice   = $filterParams[0];
            $this->_currToPrice     = $filterParams[1];
        }
        
        return $this;
    }

    /*
    * 
    * @return int
    */
    public function getCurrFromPrice()
    {
        if($this->_currFromPrice > 0) {
            $min = $this->_currFromPrice;
        } else {
            $min = $this->getFromPrice();
        }
        return $min;
    }

    /*
    * 
    * @return int
    */
    public function getCurrToPrice()
    {
        if($this->_currToPrice > 0) {
            $max = $this->_currToPrice;
        } else{
            $max = $this->getToPrice();
        }
        return $max;
    }
    
    /**
     * Get the actual From price
     * @return number
     */
    public function getFromPrice()
    {
        return floor($this->_productCollection->getMinPrice());
    }
    
    /**
     * Get the actual To price
     * @return number
     */
    public function getToPrice()
    {
        return ceil($this->_productCollection->getMaxPrice());
    }
    
    /**
     * 
     * @return string
     */
    public function getCurrencyPattern()
    {
        return Mage::app()->getStore()->formatPrice(123, false);
    }
    
    /**
     * 
     * @return int
     */
    public function getStep()
    {
        return Mage::helper('mageinn_priceslider')->getStep();
    }
    
    /**
     * Check if price attribute is filterable
     * 
     * @return type
     */
    public function getIsEnabled()
    {
        return $this->_isEnabled;
    }
}