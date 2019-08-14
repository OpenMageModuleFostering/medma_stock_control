<?php

class Medma_Stockcontrol_Block_Adminhtml_Stockcontrol_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
	  $form = new Varien_Data_Form(array(
          'id' => 'edit_form',
          'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
          'method' => 'post'));

      $form->setUseContainer(true);
      $this->setForm($form);
      $hlp = Mage::helper('stockcontrol');


	
	$collection = Mage::getResourceModel('stockcontrol/stockcontrol');
 /************************Code to get the base URL*******************/

	

		$getbase_url = $this->getBaseUrl();	



	/******************************************************************/		



	/*****Code to get the Secret Key of an controller Action in magento admin panel**********/	




		$getPresentQty_key  = 	Mage::getSingleton('adminhtml/url')->getSecretKey("adminhtml_stockcontrol","getPresentQtyAction");



	/******************************************************************/
 	

	$products_model=Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect('*')->load();

		//print_r($products_model);exit;
	$products_values= array();

	$products_values[] = array(

                     'label' => 'Select Product',

                      'value' => ''
	);
	$operation_values= array();
	$operation_model=array('Stock In'=>'Stock In','Stock Out'=>'Stock Out');
	$operation_values[] = array(

                     'label' => 'Select Operation',
		     'value' => '',
			
	);
	foreach($operation_model as $key => $values)
	{
		$operation_values[] = array(
		'label' => $values,
		'value' => $key
		 );
	}

	foreach($products_model as $key => $values)
	{
		$products_values[] = array(
		'label' => $values['sku'],
		'value' => $values['entity_id']
		);
	}	

 	
	// Most Important Line for printing the above query //

 	//$collection->printlogquery(true);
      //exit(0); 

    $fldInfo = $form->addFieldset('stockcontrol_info', array('legend'=> $hlp->__('Stockcontrol')));

	$fldInfo->addField('product_id', 'select', array(

          'label'     => $hlp->__('Product Name'),

           'class'     => 'required-entry',

          'name'      => 'product_id',

	'values'    =>$products_values,

	'onchange'  => "getPresentQty('$getbase_url',this.value,'present_qty','$getPresentQty_key');"
      ));

	
	$fldInfo->addField('present_qty', 'text', array(
			'label'        => $hlp->__('Present Qty'),
			'name'         => 'present_qty',
			'readonly' =>'true',
			
	));
	$fldInfo->addField('operation', 'select', array(
          'label'     => $hlp->__('Operation'),
           'class'     => 'required-entry',
	'values'    =>$operation_values,
          'name'      => 'operation',
	
      ));
	$fldInfo->addField('added_qty', 'text', array(
          'label'     => $hlp->__('Qty(Qty(Stock In/Stock Out)'),
           'class'     => 'required-entry',
          'name'      => 'added_qty',
	
      ));
	$fldInfo->addField('reason', 'textarea', array(
          'label'     => $hlp->__('Reason For Stock Adjustment'),
           'class'     => 'required-entry',
          'name'      => 'reason',
	
      ));
	
	

	
?>

<?php	





	if ( Mage::registry('stockcontrol_data') ) {
          $form->setValues(Mage::registry('stockcontrol_data')->getData());
	  }
	
	
      return parent::_prepareForm();

  }
}
