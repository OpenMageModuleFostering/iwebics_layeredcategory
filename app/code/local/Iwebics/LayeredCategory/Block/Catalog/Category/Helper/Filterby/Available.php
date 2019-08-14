<?php
/**
 * Magento
 *
 * @category   Iwebics
 * @package    Iwebics_LayeredCategory
 * @author     CAB.
 */
 class Iwebics_LayeredCategory_Block_Catalog_Category_Helper_Filterby_Available extends Varien_Data_Form_Element_Multiselect
 {
     /**
     * Retrieve Element HTML fragment
     *
     * @return string
     */
    public function getElementHtml()
    {
        $disabled = false;
        if (!$this->getValue()) {
            $this->setData('disabled', 'disabled');
            $disabled = true;
        }
        $html = parent::getElementHtml();
        $htmlId = 'use_config_' . $this->getHtmlId();
        $html .= '<input id="'.$htmlId.'" name="use_config[]" value="' . $this->getId() . '"';
        $html .= ($disabled ? ' checked="checked"' : '');

        if ($this->getReadonly()) {
            $html .= ' disabled="disabled"';
        }

        $html .= ' onclick="toggleValueElements(this, this.parentNode);" class="checkbox" type="checkbox" />';

        $html .= ' <label for="'.$htmlId.'" class="normal">'
            . Mage::helper('adminhtml')->__('Use Config Settings').'</label>';
        $html .= '<script type="text/javascript">toggleValueElements($(\''.$htmlId.'\'), $(\''.$htmlId.'\').parentNode);</script>';

        return $html;
    }
 }