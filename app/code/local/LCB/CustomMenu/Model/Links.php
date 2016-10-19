<?php

class LCB_CustomMenu_Model_Links extends Mage_Core_Model_Abstract {

    protected function _construct()
    {

        $this->_init("custommenu/links");
    }

    /**
      @todo add link types
     * */
    public function getUrl()
    {
        return $this->getValue();
    }
    
}
