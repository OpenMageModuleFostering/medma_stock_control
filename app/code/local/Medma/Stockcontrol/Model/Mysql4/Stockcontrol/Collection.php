<?php

class Medma_Stockcontrol_Model_Mysql4_Stockcontrol_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('stockcontrol/stockcontrol');
    }
}
