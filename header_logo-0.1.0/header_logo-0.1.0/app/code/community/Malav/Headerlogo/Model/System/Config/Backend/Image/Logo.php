<?php
class Malav_Headerlogo_Model_System_Config_Backend_Image_Logo extends Mage_Adminhtml_Model_System_Config_Backend_Image
{
    const UPLOAD_DIR = 'logoimage';
    const UPLOAD_ROOT = 'media';
	
    protected function _getUploadDir()
    {
	    $newdirPath = Mage::getBaseDir('media') . DS . "logoimage";
		if (!file_exists($newdirPath)) {
							mkdir($newdirPath, 0777);
		   }
        $uploadDir = $this->_appendScopeInfo(self::UPLOAD_DIR);
        $uploadRoot = $this->_getUploadRoot(self::UPLOAD_ROOT);
        $uploadDir = $uploadRoot . '/' . $uploadDir;
        return $uploadDir;
    }
	
    protected function _addWhetherScopeInfo()
    {
        return true;
    }
	
    protected function _getAllowedExtensions()
    {
        return array('ico', 'png', 'gif', 'jpg', 'jpeg', 'apng', 'svg');
    }
	
    protected function _getUploadRoot($token) {
        return Mage::getBaseDir($token);
    }
	
}