<?php

Class LCB_CustomMenu_Block_Links extends Mage_Core_Block_Template {

    CONST TYPE_TOPMENU = 1;

    public function getLinks()
    {
        return Mage::getModel('custommenu/links')->getCollection()
            ->addFieldToFilter('type_id',self::TYPE_TOPMENU);
    }

}
