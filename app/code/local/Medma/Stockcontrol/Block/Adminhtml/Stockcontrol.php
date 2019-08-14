<?php
class Medma_Stockcontrol_Block_Adminhtml_Stockcontrol extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    parent::__construct();
    $this->_controller = 'adminhtml_stockcontrol';
    $this->_blockGroup = 'stockcontrol';
    $this->_headerText = Mage::helper('stockcontrol')->__('Enter Stock');
    //$this->_removeButton('add'); 
    //d($this);

  }
}
