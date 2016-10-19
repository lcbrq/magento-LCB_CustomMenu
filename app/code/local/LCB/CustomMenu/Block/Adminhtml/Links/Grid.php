<?php

class LCB_CustomMenu_Block_Adminhtml_Links_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId("linksGrid");
        $this->setDefaultSort("id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel("custommenu/links")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn("id", array(
            "header" => Mage::helper("custommenu")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "id",
        ));

        $this->addColumn("name", array(
            "header" => Mage::helper("custommenu")->__("Name"),
            "index" => "name",
        ));
        $this->addColumn("value", array(
            "header" => Mage::helper("custommenu")->__("Url"),
            "index" => "value",
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_links', array(
            'label' => Mage::helper('custommenu')->__('Remove Links'),
            'url' => $this->getUrl('*/adminhtml_links/massRemove'),
            'confirm' => Mage::helper('custommenu')->__('Are you sure?'),
        ));
        return $this;
    }

}
