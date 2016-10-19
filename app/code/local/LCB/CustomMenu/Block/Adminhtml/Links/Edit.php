<?php

class LCB_CustomMenu_Block_Adminhtml_Links_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {

        parent::__construct();
        $this->_objectId   = "id";
        $this->_blockGroup = "custommenu";
        $this->_controller = "adminhtml_links";
        $this->_updateButton("save", "label", Mage::helper("custommenu")->__("Save Item"));
        $this->_updateButton("delete", "label", Mage::helper("custommenu")->__("Delete Item"));

        $this->_addButton("saveandcontinue", array(
            "label"   => Mage::helper("custommenu")->__("Save And Continue Edit"),
            "onclick" => "saveAndContinueEdit()",
            "class"   => "save",
        ), -100);

        $this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
    }

    public function getHeaderText()
    {
        if (Mage::registry("links_data") && Mage::registry("links_data")->getId()) {

            return Mage::helper("custommenu")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("links_data")->getId()));

        } else {

            return Mage::helper("custommenu")->__("Add Item");

        }
    }
}
