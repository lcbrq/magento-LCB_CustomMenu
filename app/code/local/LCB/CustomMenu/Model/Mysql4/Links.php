<?php

class LCB_CustomMenu_Model_Mysql4_Links extends Mage_Core_Model_Mysql4_Abstract {

    protected function _construct()
    {
        $this->_init("custommenu/links", "id");
    }

}
