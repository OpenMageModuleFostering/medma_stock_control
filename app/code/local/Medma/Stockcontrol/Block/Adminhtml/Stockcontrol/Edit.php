<?php 
class Medma_Stockcontrol_Block_Adminhtml_Stockcontrol_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
  public function __construct()
  { 
	parent::__construct();
        $this->_objectId = 'id'; 
        $this->_blockGroup = 'stockcontrol';
        $this->_controller = 'adminhtml_stockcontrol';
	$this->_formScripts[] = "

	function getSku(base_url,product_id,next_quantity_id,secret_key){


 				//alert(base_url+product_id+next_quantity_id+secret_key);
				new Ajax.Request(base_url+'stockcontrol/adminhtml_stockcontrol/getSkuu/product_id/'+product_id+'/key/',


				{


					method:'Post',


					onSuccess: function(transport){


						var response = transport.responseText || 'no response text';
						//alert('success'+response);

					document.getElementById(next_quantity_id).value=response;
						
					},


					onFailure: function(){ 


	


						alert('Failure in Ajax');


					}


				}); 	


	}

	function getPresentQty(base_url,product_id,next_quantity_id,secret_key){


 				//alert(base_url+product_id+next_quantity_id+secret_key);
				new Ajax.Request(base_url+'stockcontrol/adminhtml_stockcontrol/getPresentQty/product_id/'+product_id+'/key/'+secret_key,


				{


					method:'Post',


					onSuccess: function(transport){


						var response = transport.responseText || 'no response text';
						//alert('success'+response);

					document.getElementById(next_quantity_id).value=response;
						
					},


					onFailure: function(){ 


	


						alert('Failure in Ajax');


					}


				}); 	


		}


	   	
		
        ";

  }

  
public function getHeaderText()

  {

	  if( Mage::registry('stockcontrol_data') && Mage::registry('stockcontrol_data')->getId() ) {

		  return Mage::helper('stockcontrol')->__("Edit Stock '%s'", $this->htmlEscape(Mage::registry('stockcontrol_data')->getName()));


	  } else {

		  return Mage::helper('stockcontrol')->__('Add Stock');

	  }

  }
}
