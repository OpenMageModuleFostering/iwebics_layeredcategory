<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */
 class Iwebics_LayeredCategory_Model_Catalog_Category_Attribute_Source_Filterby extends  Mage_Eav_Model_Entity_Attribute_Source_Abstract
 {
     protected $_usedForFilterBy;
     /**
     * Retrieve Catalog Config Singleton
     *
     * @return Mage_Catalog_Model_Config
     */
    protected function _getCatalogConfig() {
        return Mage::getSingleton('catalog/config');
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (is_null($this->_options)) {
            
            foreach ($this->getAttributesUsedForFilterBy() as $attribute) {
                $this->_options[] = array(
                    'label' => Mage::helper('catalog')->__($attribute['frontend_label']),
                    'value' => $attribute['attribute_code']
                );
            }
        }
        return $this->_options;
    }
    
    public function getAttributesUsedForFilterBy() {
        if (is_null($this->_usedForFilterBy)) {
            $this->_usedForFilterBy = array();
            $entityType     = Mage_Catalog_Model_Product::ENTITY;
            $attributesData = $this->getAttributesUsedForFilterByData();
            Mage::getSingleton('eav/config')
                ->importAttributesData($entityType, $attributesData);
            foreach ($attributesData as $attributeData) {
                $attributeCode = $attributeData['attribute_code'];
                $this->_usedForFilterBy[$attributeCode] = Mage::getSingleton('eav/config')
                    ->getAttribute($entityType, $attributeCode);
            }
        }
        return $this->_usedForFilterBy;
    }
    
    protected function getAttributesUsedForFilterByData()
    {
        $resource = Mage::getModel('core/resource');
        $readAdaptor = $resource->getConnection('core_read');
        
        //$readAdaptor = $this->_getReadAdapter();
        $storeLabelExpr = $readAdaptor->getCheckSql('al.value IS NULL', 'main_table.frontend_label','al.value');
        $select = $readAdaptor->select()
            ->from(array('main_table' => $resource->getTableName('eav/attribute')))
            ->join(
                array('additional_table' => $resource->getTableName('catalog/eav_attribute')),
                'main_table.attribute_id = additional_table.attribute_id',
                array()
            )
            ->joinLeft(
                array('al' => $resource->getTableName('eav/attribute_label')),
                'al.attribute_id = main_table.attribute_id AND al.store_id = 0',
                array('store_label' => $storeLabelExpr)
            )
            ->where('main_table.entity_type_id = 4')
            ->where('additional_table.is_filterable = ?', 1);

        return $readAdaptor->fetchAll($select);
    }
 }