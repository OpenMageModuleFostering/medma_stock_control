<?php

/**
 * @author Adjustware
 */
class Medma_Stockcontrol_Block_Adminhtml_Stockcontrol_Grid extends Mage_Adminhtml_Block_Widget_Grid {

   public function __construct() {
      parent::__construct();
      $this->setId('stockcontrolGrid');
      $this->setDefaultSort('id');
      //$this->_removeButton('add_new');
   }

   protected function _prepareCollection() {
//      if (Mage::helper('catalog/product_flat')->isEnabled()) {
//         $collection = Mage::getModel('stockcontrol/stockcontrol')->getCollection();
//         $catalogTable = Mage::getSingleton('core/resource')->getTableName('catalog_product_flat_1');
//
//         $collection->getSelect()->join(
//                 array('pc' => $catalogTable), 'main_table.product_id = pc.entity_id', array('product_name' => 'pc.name'));
//         $collection->getSelect()->join(
//                 array('cisi' => $catalogTable), 'main_table.product_id = cisi.entity_id', array('sku' => 'cisi.sku'));
//         $this->setCollection($collection);
//         return parent::_prepareCollection();
//      }
//      $everyStore = Mage::app()->getStores();
//      foreach ($everyStore as $eachStore => $val) {
//         $storeCode = Mage::app()->getStore($eachStore)->getCode();
//         $storeName = Mage::app()->getStore($eachStore)->getName();
//         $storeID = Mage::app()->getStore($eachStore)->getId();
//         echo "Code : " . $storeCode . "</br>Name : " . $storeName . "</br>ID : " . $storeID . "</br>&nbsp</br>";
//      }
      $collection = Mage::getModel('stockcontrol/stockcontrol')->getCollection()->join(array('productTable' => 'catalog/product'), 'main_table.product_id = productTable.entity_id');
      $this->setCollection($collection);
      return parent::_prepareCollection();
   }

   protected function _prepareColumns() {
      $this->addColumn('product_id', array(
          'header' => Mage::helper('stockcontrol')->__('Product Name'),
          'width' => '80px',
          'type' => 'text',
          'index' => 'product_id',
          'renderer' => 'stockcontrol/adminhtml_stockcontrol_render_product'
      ));

      $this->addColumn('sku', array(
          'header' => Mage::helper('stockcontrol')->__('Sku'),
          'width' => '80px',
          'type' => 'text',
          'index' => 'sku'
      ));

      $this->addColumn('old_qty', array(
          'header' => Mage::helper('stockcontrol')->__('Old Qty'),
          'index' => 'present_qty',
          'type' => 'text',
          'width' => '100px',
          'filter_index' => 'main_table.present_qty'
      ));

      $this->addColumn('added_qty', array(
          'header' => Mage::helper('stockcontrol')->__('Qty(Stock In/Stock Out)'),
          'index' => 'added_qty',
          'type' => 'text',
          'width' => '100px',
      ));
      $this->addColumn('present_qty', array(
          'header' => Mage::helper('stockcontrol')->__('Present Qty'),
          'index' => 'total_qty',
          'type' => 'text',
          'width' => '100px',
      ));
      $this->addColumn('operation', array(
          'header' => Mage::helper('stockcontrol')->__('Operation'),
          'index' => 'operation',
          'type' => 'text',
          'width' => '100px',
      ));
      $this->addColumn('qty_added_date', array(
          'header' => Mage::helper('stockcontrol')->__('Qty(Stock In/Stock Out) Date'),
          'index' => 'qty_added_date',
          'type' => 'text',
          'width' => '100px',
      ));
      $this->addColumn('added_by', array(
          'header' => Mage::helper('stockcontrol')->__('Added By'),
          'index' => 'added_by',
          'type' => 'text',
          'width' => '100px',
      ));

      return $this;
   }

}
