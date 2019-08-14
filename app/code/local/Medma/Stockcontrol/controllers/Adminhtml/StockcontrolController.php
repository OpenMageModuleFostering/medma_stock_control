<?php

class Medma_Stockcontrol_Adminhtml_StockcontrolController extends Mage_Adminhtml_Controller_action
{
	public function indexAction() {

		
	    	$this->loadLayout(); 
		$this->_setActiveMenu('catalog/stockcontrol');
		//$this->_addBreadcrumb($this->__('Manage Grouped Product Discount Rule'), $this->__('Discount')); 
		$this->_addContent($this->getLayout()->createBlock('stockcontrol/adminhtml_stockcontrol'));
 	    	$this->renderLayout();

	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');

		$model  = Mage::getModel('stockcontrol/stockcontrol')->load($id);
		
		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('stockcontrol_data', $model);
			$this->loadLayout();
			$this->_setActiveMenu('catalog/stockcontrol');

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('stockcontrol/adminhtml_stockcontrol_edit'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('stockcontrol')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 	
	

	
	public function newAction() {
		$this->editAction();
	}
 
	public function saveAction() {
 	$id= $this->getRequest()->getParam('id');
	$user = Mage::getSingleton('admin/session');
	$userId = $user->getUser()->getUserId();
	$model_user= Mage::getModel('admin/user')->load($userId);
	$addedby = $model_user['username'];
	

	    $model= Mage::getModel('stockcontrol/stockcontrol');	

		if ($data = $this->getRequest()->getPost()) {
		if($data['operation']=='Stock In'){
		$total_qty=$data['present_qty']+$data['added_qty'];
		}elseif($data['operation']=='Stock Out'){
		if($data['present_qty']<='0'){
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('stockcontrol')->__('Quantity is less to perform Stock Out operation'));
        	$this->_redirect('*/*/');
		return;
		}else{
		$total_qty=$data['present_qty']-$data['added_qty'];
		}
		}		
		$model_product= Mage::getModel('catalog/product'); 
		$_product = $model_product->load($data['product_id']); 
		$stockData = $_product->getStockData();
		$stockData['qty'] = $total_qty;
		if($total_qty>0){
		$stockData['is_in_stock'] = 1;
		}else{
		$stockData['is_in_stock'] = 0;
		}
		$_product->setStockData($stockData);
		$_product->save();
		$user = Mage::getSingleton('admin/session')->getData();
		$userId = $user['user']['user_id'];
		$data['total_qty']=$total_qty;
		$data['added_by']=$userId ;
// 		$stocklevel = (int)Mage::getModel('cataloginventory/stock_item')
//                 ->loadByProduct($_product)->getQty();
// echo $stocklevel;exit;
			try {
				$data['added_by']=$addedby;
				$model->setData($data)->setId($id);
				$model->save();

				 Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('stockcontrol')->__('Quantity Update Operation Perform successfully'));
				
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('stockcontrol')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
        }
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('stockcontrol/stockcontrol');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

	public function getPresentQtyAction(){
		$product_id = $this->getRequest()->getParam('product_id');

		$model = Mage::getModel('catalog/product'); 
		$_product = $model->load($product_id); 
		$stocklevel = (int)Mage::getModel('cataloginventory/stock_item')
                ->loadByProduct($_product)->getQty();


		echo $stocklevel;
	}

	/*
	   This function use for get SKU
	*/
	public function getSkuuAction(){
		
		$product_id = $this->getRequest()->getParam('product_id');

		$model = Mage::getModel('catalog/product'); 
		$_product = $model->load($product_id); 
		$prdsku = $_product->getSku();


		echo $prdsku;
	}	
	

}
