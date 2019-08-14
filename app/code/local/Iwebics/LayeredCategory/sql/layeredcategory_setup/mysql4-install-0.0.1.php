<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */    
$installer = $this;
$installer->startSetup();
$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);

$installer->addAttribute($entityTypeId, 'available_filter_by', array(
    'input'         => 'multiselect',
    'type'          => 'text',
    'label'         => 'Available Product Listing Filter By',
    'source'        => 'layeredcategory/catalog_category_attribute_source_filterby',
    'backend'       => 'layeredcategory/catalog_category_attribute_backend_filterby',
    'required'      => 1,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'       => 1,
    'input_renderer'=> 'layeredcategory/catalog_category_helper_filterby_available',
));
$installer->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    'Display Settings',
    'available_filter_by',
    35
);
$installer->endSetup();