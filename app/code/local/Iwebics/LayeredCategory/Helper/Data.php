<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */
 class Iwebics_LayeredCategory_Helper_Data extends Mage_Core_Helper_Abstract
 {
    protected function getCurrentCategory()
    {
         return Mage::registry('current_category');
    }
    public function getAvailableFilter()
    {
         if($category = $this->getCurrentCategory()){
             if($category->getAvailableFilterBy())
                return $category->getAvailableFilterBy();
         }
         return explode(',',Mage::getStoreConfig('catalog/layered_navigation/default_layered_attribute'));
    }
 }