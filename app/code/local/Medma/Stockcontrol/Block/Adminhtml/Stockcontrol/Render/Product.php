<?php 
class Medma_Stockcontrol_Block_Adminhtml_Stockcontrol_Render_Product extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row){
        $product_id =  $row->getData($this->getColumn()->getIndex());
        return Mage::getModel('catalog/product')->load($product_id)->getName();
    }

}

?>
