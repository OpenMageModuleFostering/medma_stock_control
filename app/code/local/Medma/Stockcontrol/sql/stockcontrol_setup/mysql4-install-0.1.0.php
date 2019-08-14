<?php

$installer = $this;

$installer->startSetup();

$installer->run("


CREATE TABLE IF NOT EXISTS {$this->getTable('stockcontrol')} (
  `stock_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `present_qty` varchar(255) NOT NULL DEFAULT '',
  `added_qty` varchar(255) NOT NULL DEFAULT '',
  `total_qty` varchar(255) NOT NULL,
  `operation` varchar(255) NOT NULL,	
  `qty_added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

");

$installer->endSetup(); 
