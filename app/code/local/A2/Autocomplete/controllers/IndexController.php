<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Zopimlivechat
 * @author     info@magepsycho.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class A2_Autocomplete_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $searchedProducts = array();
        $searchedProduct = array(
            'link' => '',
            'image' => '',
            'price' => '',
        );
        $links = array();
        $q = $this->getRequest()->getParam('q');
        if (empty($q)) {
            return;
        }
        // Code to Search Product by $searchstring and get Product IDs
        $product_collection = Mage::getResourceModel('catalog/product_collection')
                  ->addAttributeToSelect('*')
                  ->addAttributeToFilter('name', array('like' => '%'.$q.'%'))
                  ->load();

        foreach ($product_collection as $product) {
            $productId = $product->getId();
            $productEntity = Mage::getResourceSingleton('catalog/product');
            $link = $productEntity
                ->getAttributeRawValue($productId, 'url_path', Mage::app()->getStore());
            $image = $productEntity
                ->getAttributeRawValue($productId, 'small_image', Mage::app()->getStore());
            $price = $productEntity
                ->getAttributeRawValue($productId, 'price', Mage::app()->getStore());                
            $searchedProduct['link'] = '/' . $link;
            $searchedProduct['image'] = '/media/catalog/product/' . $image;
            $searchedProduct['price'] = '/' . $price;
            $searchedProducts[] = $searchedProduct;
        }
        //return array of product ids
        echo $json = Mage::helper('core')->jsonEncode($searchedProducts);
        return;
    }
}