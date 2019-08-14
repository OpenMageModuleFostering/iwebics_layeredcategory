<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */
 class Iwebics_LayeredCategory_Model_Catalog_Layer extends Mage_Catalog_Model_Layer
 {
     /**
     * Add filters to attribute collection
     *
     * @param   Mage_Catalog_Model_Resource_Eav_Mysql4_Attribute_Collection $collection
     * @return  Mage_Catalog_Model_Resource_Eav_Mysql4_Attribute_Collection
     */
    protected function _prepareAttributeCollection($collection)
    {
        $availableFilter = Mage::helper('layeredcategory')->getAvailableFilter();
        
        $collection ->addFieldToFilter('attribute_code',array('in'=>$availableFilter))
                    ->addIsFilterableFilter();
        return $collection;
    }
 }