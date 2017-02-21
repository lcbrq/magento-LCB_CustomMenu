<?php

Class LCB_CustomMenu_Block_Links extends Mage_Core_Block_Template {

    public function getLinks()
    {
        return Mage::getModel('custommenu/links')->getCollection()
            ->addFieldToFilter('type_id','1');
    }

}
