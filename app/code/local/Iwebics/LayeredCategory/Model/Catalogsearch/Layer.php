<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */
 class Iwebics_LayeredCategory_Model_Catalogsearch_Layer extends Mage_CatalogSearch_Model_Layer
 {
     /**
     * Add filters to attribute collection
     *
     * @param   Mage_Catalog_Model_Resource_Eav_Resource_Product_Attribute_Collection $collection
     * @return  Mage_Catalog_Model_Resource_Eav_Resource_Product_Attribute_Collection
     */
    protected function _prepareAttributeCollection($collection)
    {
        $availableFilter = Mage::helper('layeredcategory')->getAvailableFilter();
        
        $collection ->addFieldToFilter('attribute_code',array('in'=>$availableFilter))
                    ->addIsFilterableInSearchFilter()
                    ->addVisibleFilter();
        return $collection;
    }
 }