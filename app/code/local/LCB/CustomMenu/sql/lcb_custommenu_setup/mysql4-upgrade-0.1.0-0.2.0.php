<?php

/**
 * Add image column to lcb_custommenu_links table
 * @author Jigsaw Marcin Gieurs <martin@silpion.io>
 */
$installer = $this;
$installer->startSetup();

$sql = <<<SQLTEXT
	ALTER TABLE {$this->getTable('lcb_custommenu_links')} 
	ADD COLUMN image VARCHAR(255);
SQLTEXT;

$installer->run($sql);
$installer->endSetup();