<?php

class LCB_CustomMenu_Adminhtml_LinksController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu("custommenu/links")->_addBreadcrumb(Mage::helper("adminhtml")->__("Links  Manager"), Mage::helper("adminhtml")->__("Links Manager"));
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__("CustomMenu"));
        $this->_title($this->__("Manager Links"));

        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__("CustomMenu"));
        $this->_title($this->__("Links"));
        $this->_title($this->__("Edit Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("custommenu/links")->load($id);
        if ($model->getId()) {
            Mage::register("links_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("custommenu/links");
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Links Manager"), Mage::helper("adminhtml")->__("Links Manager"));
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Links Description"), Mage::helper("adminhtml")->__("Links Description"));
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("custommenu/adminhtml_links_edit"))->_addLeft($this->getLayout()->createBlock("custommenu/adminhtml_links_edit_tabs"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("custommenu")->__("Item does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function newAction()
    {

        $this->_title($this->__("CustomMenu"));
        $this->_title($this->__("Links"));
        $this->_title($this->__("New Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("custommenu/links")->load($id);

        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register("links_data", $model);

        $this->loadLayout();
        $this->_setActiveMenu("custommenu/links");

        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Links Manager"), Mage::helper("adminhtml")->__("Links Manager"));
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Links Description"), Mage::helper("adminhtml")->__("Links Description"));

        $this->_addContent($this->getLayout()->createBlock("custommenu/adminhtml_links_edit"))->_addLeft($this->getLayout()->createBlock("custommenu/adminhtml_links_edit_tabs"));

        $this->renderLayout();
    }

    public function saveAction()
    {

        $post_data = $this->getRequest()->getPost();

        if ($post_data) {
            try {

                if(isset($_FILES['image']['name']) and (file_exists($_FILES['image']['tmp_name']))) {
                    try {

                        $uploader = new Varien_File_Uploader('image');
                        $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); 
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS ;
                        $uploader->save($path, $_FILES['image']['name']);
                        $post_data['image'] = $_FILES['image']['name'];

                    }catch(Exception $e) {

                        Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                        Mage::getSingleton("adminhtml/session")->setLinksData($this->getRequest()->getPost());
                        $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                        return;
                        
                    }
                } 
                

                $model = Mage::getModel("custommenu/links")
                        ->addData($post_data)
                        ->setId($this->getRequest()->getParam("id"))
                        ->save();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Links was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setLinksData(false);

                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setLinksData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam("id") > 0) {
            try {
                $model = Mage::getModel("custommenu/links");
                $model->setId($this->getRequest()->getParam("id"))->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
                $this->_redirect("*/*/");
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel("custommenu/links");
                $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
        } catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

}
