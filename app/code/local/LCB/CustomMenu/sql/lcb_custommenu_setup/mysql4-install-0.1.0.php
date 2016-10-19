<?php
$installer = $this;
$installer->startSetup();
$sql = <<<SQLTEXT
DROP TABLE IF EXISTS `{$this->getTable('lcb_custommenu_links')}`;
CREATE TABLE `{$this->getTable('lcb_custommenu_links')}` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(6) NULL,
  `type_id` smallint(6) NULL,
  `store_id` smallint(5) NULL,
  `position` smallint(5) NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
SQLTEXT;
$installer->run($sql);
$installer->endSetup();
