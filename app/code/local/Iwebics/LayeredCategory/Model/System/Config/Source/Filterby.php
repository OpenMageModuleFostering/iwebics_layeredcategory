<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */
 class Iwebics_LayeredCategory_Model_System_Config_Source_Filterby
 {
     protected $_options;
     public function toOptionArray($isMultiselect=false)
     {
        if (!$this->_options) {
            $this->_options = Mage::getModel('layeredcategory/catalog_category_attribute_source_filterby')->getAllOptions();
        }

        $options = $this->_options;
        if(!$isMultiselect){
            array_unshift($options, array('value'=>'', 'label'=> Mage::helper('adminhtml')->__('--Please Select--')));
        }

        return $options;
     }
 }