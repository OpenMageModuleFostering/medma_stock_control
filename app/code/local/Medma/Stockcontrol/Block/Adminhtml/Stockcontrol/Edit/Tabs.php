<?php

class Medma_Groups_Block_Adminhtml_Groups_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
	  parent::__construct();
	  $this->setId('groups_tabs');
	  $this->setDestElementId('edit_form');
	  $this->setTitle(Mage::helper('groups')->__('Manage Lens Groups'));
  }

  protected function _beforeToHtml()
  {
	  $this->addTab('form_section', array(
		  'label'     => Mage::helper('groups')->__('Item Information'),
		  'title'     => Mage::helper('groups')->__('Item Information'),
		  'content'   => $this->getLayout()->createBlock('groups/adminhtml_groups_edit_tab_form')->toHtml(),
	  ));
	 
	  return parent::_beforeToHtml();
  }
}