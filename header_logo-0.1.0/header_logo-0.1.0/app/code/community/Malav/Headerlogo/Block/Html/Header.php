<?php
class Malav_Headerlogo_Block_html_Header extends Mage_Core_Block_Template
{
    public function _construct()
    {
        $this->setTemplate('page/html/header.phtml');
    }
	
    public function getIsHomePage()
    {
        return $this->getUrl('') == $this->getUrl('*/*/*', array('_current'=>true, '_use_rewrite'=>true));
    }

    public function setLogo($logo_src, $logo_alt)
    {
        $this->setLogoSrc($logo_src);
        $this->setLogoAlt($logo_alt);
        return $this;
    }
	
    public function getLogoSrc()
    {

        if (empty($this->_data['logo_src'])) {
            $this->_data['logo_src'] = $this->_getLogoFile();
        }
        return $this->_data['logo_src'];
    }
	
	protected function _getLogoFile()
    {
        $folderName =  Malav_Headerlogo_Model_System_Config_Backend_Image_Logo::UPLOAD_DIR;
        $storeConfig = Mage::getStoreConfig('design/header/logo_src');
        $logoFile = Mage::getBaseUrl('media') . $folderName . '/' . $storeConfig;
        $absolutePath = Mage::getBaseDir('media') . '/' . $folderName . '/' . $storeConfig;

        if(!is_null($storeConfig) && $this->_isFile($absolutePath)) {
            $url = $logoFile;
        } else {
            $url = $this->getSkinUrl('images/media/logo.png');
        }
        return $url;
     }
	  
	   protected function _isFile($filename) {
        if (Mage::helper('core/file_storage_database')->checkDbUsage() && !is_file($filename)) {
            Mage::helper('core/file_storage_database')->saveFileToFilesystem($filename);
        }
        return is_file($filename);
    }
}
