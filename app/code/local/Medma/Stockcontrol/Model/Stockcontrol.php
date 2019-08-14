<?php

class Medma_Stockcontrol_Model_Stockcontrol extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('stockcontrol/stockcontrol');
    }
}
