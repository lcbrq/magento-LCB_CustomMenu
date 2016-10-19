<?php

class LCB_CustomMenu_Block_Adminhtml_Links extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {

        $this->_controller = "adminhtml_links";
        $this->_blockGroup = "custommenu";
        $this->_headerText = Mage::helper("custommenu")->__("Links Manager");
        $this->_addButtonLabel = Mage::helper("custommenu")->__("Add New Item");
        parent::__construct();
    }

}
