<?php
class Medma_Groups_Block_Adminhtml_Groups_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
	  	  $form = new Varien_Data_Form(array(
          'id' => 'edit_form',
          'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
          'method' => 'post'));

      $form->setUseContainer(true);
      $this->setForm($form);
      $hlp = Mage::helper('groups');

/*******************Code to display values from multiple tables*********************/

	$id = Mage::registry('brands_data')->getId();

	$brand_model = Mage::registry('brands_data')->getData();
	
      	$power_model = Mage::getModel('brands/power')->getCollection()->addFieldToFilter('brand_id',array('eq'=>$id))->getData();
	
// 	$diameter_model = Mage::getModel('brands/power')->getCollection()->addFieldToFilter('brand_id',array('eq'=>$id))->getData();
// 
// 	$power_model = Mage::getModel('brands/power')->getCollection()->addFieldToFilter('brand_id',array('eq'=>$id))->getData();
// 
// 	$power_model = Mage::getModel('brands/power')->getCollection()->addFieldToFilter('brand_id',array('eq'=>$id))->getData();
// 
// 	$power_model = Mage::getModel('brands/power')->getCollection()->addFieldToFilter('brand_id',array('eq'=>$id))->getData();
	
/*******************Code to display values from multiple tables*********************/
	

      $fldInfo = $form->addFieldset('brands_info', array('legend'=> $hlp->__('Brands Details')));
      
//       $fldInfo->addField('store_id', 'select', array(
//           'label'     => $hlp->__('Store View'),
//           'class'     => 'required-entry',
//           'required'  => true,
//           'name'      => 'store_id',
// //           'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm()
//       ));
//       
//       $fldInfo->addField('follow_up', 'select', array(
//           'label'        => $hlp->__('Follow Up'),
//           'name'         => 'follow_up',
//           'options'      => array(
//      		'first' 	=> $hlp->__('First'),
//     		'second' 	=> $hlp->__('Second'),
//     		'third' 	=> $hlp->__('Third'),
//           ),
//       ));

//       $fldInfo->addField('sheduled_at', 'date', array(
//           'label'        => $hlp->__('Alert Will Be Sent On'),
//           'image'        => $this->getSkinUrl('images/grid-cal.gif'),
//           'format'       => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
//           'name'         => 'sheduled_at',
//       ));
//      
//       $fldInfo->addField('customer_email', 'text', array(
//           'label'     => $hlp->__('Customer E-mail'),
//           'class'     => 'required-entry validate-email',
//           'required'  => true,
//           'name'      => 'customer_email',
//       ));
//       $fldInfo->addField('brand_id', 'text', array(
//           'label'     => $hlp->__('Brand ID'),
//           'class'     => 'required-entry',
//           'required'  => true,
//           'name'      => 'brand_id',
//       ));
      $fldInfo->addField('brand_name', 'text', array(
          'label'     => $hlp->__('Brand Name'),
	  'class'     => 'required-entry',
          'required'  => true,	
          'name'      => 'brand_name',
      ));

	$fldInfo->addField('power_value', 'text', array(
          'label'     => $hlp->__('Power Value'),
	  'class'     => 'required-entry',
          'required'  => true,	
          'name'      => 'power_value',
      ));
// 	$fldInfo->addField('power_value', 'select', array(
//           'label'     => $hlp->__('Power Value'),
// 	  'options'      => array(
// 	'first' 	=> $hlp->__('First'),
// 	'second' 	=> $hlp->__('Second'),
// 	'third' 	=> $hlp->__('Third')),
//           'name'      => 'power_value',
//       ));
//       
//       $fldInfo->addField('products', 'textarea', array(
//           'label'     => $hlp->__('Produsts'),
//           'class'     => 'required-entry',
//           'required'  => true,
//           'name'      => 'products',
//           'style'     => 'width:35em;height:15em;',
//       ));
//       $fldInfo->addField('is_preprocessed', 'hidden', array(
//           'name'      => 'is_preprocessed',
//           'value'     => 1,
//       ));

      if ( Mage::registry('brands_data') ) {
          //$form->setValues(Mage::registry('brands_data')->getData());
	  $form->setValues(array_merge($power_model[0],$brand_model));
		

      }
      
      return parent::_prepareForm();
  }
}

?>

