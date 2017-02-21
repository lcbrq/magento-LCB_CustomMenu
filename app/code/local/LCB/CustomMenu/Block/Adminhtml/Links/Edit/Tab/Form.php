<?php
class LCB_CustomMenu_Block_Adminhtml_Links_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {

        $form = new Varien_Data_Form(array(
            'method' => 'post',
            'enctype' => 'multipart/form-data'
            ));
        $this->setForm($form);
        $fieldset = $form->addFieldset("custommenu_form", array("legend" => Mage::helper("custommenu")->__("Item information")));

        $fieldset->addField("name", "text", array(
            "label"    => Mage::helper("custommenu")->__("Name"),
            "class"    => "required-entry",
            "required" => true,
            "name"     => "name",
        ));

        $fieldset->addField("value", "text", array(
            "label"    => Mage::helper("custommenu")->__("Url"),
            "class"    => "required-entry",
            "required" => true,
            "name"     => "value",
        ));

        $afterElementHtml = '<p><small>' . ' Chose 1 to show in top links , chose 2 for faq link ' . '</small></p>';

        $fieldset->addField("type_id", "select", array(
            "label"    => Mage::helper("custommenu")->__("Type"),
            "class"    => "required-entry",
            "required" => true,
            "values"   => array('1'=>1,'2'=>2),
            "name"     => "type_id",
            "after_element_html"=> $afterElementHtml
        ));

         $fieldset->addField('image', 'file', array(
            'label'     => Mage::helper("custommenu")->__('Image'),
            'required'  => false,
            'name'      => 'image',
        ));

        if (Mage::getSingleton("adminhtml/session")->getLinksData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getLinksData());
            Mage::getSingleton("adminhtml/session")->setLinksData(null);
        } elseif (Mage::registry("links_data")) {
            $form->setValues(Mage::registry("links_data")->getData());
        }
        return parent::_prepareForm();
    }
}
