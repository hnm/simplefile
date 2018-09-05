<?php
namespace simplefile\model;

use n2n\web\http\Request;
use n2n\util\StringUtils;
use rocket\impl\ei\component\prop\string\wysiwyg\WysiwygLinkConfigAdapter;
use rocket\impl\ei\component\prop\string\wysiwyg\DynamicWysiwygLinkConfig;
use n2n\core\container\N2nContext;
use n2n\l10n\DynamicTextCollection;
use n2n\l10n\N2nLocale;

class SimpleFileWysiwygLinkConfig extends WysiwygLinkConfigAdapter 
		implements DynamicWysiwygLinkConfig {

    private $simpleFileDao;
    private $request;
    private $n2nContext;
    
    private function _init(SimpleFileDao $simpleFileDao, Request $request, N2nContext $n2nContext) {
    	$this->simpleFileDao = $simpleFileDao;
    	$this->request = $request;
    	$this->n2nContext = $n2nContext;
    }
    
	public function getTitle() {
		$dtc = new DynamicTextCollection('simplefile', array($this->request->getN2nLocale(), 
				N2nLocale::getDefault(), N2nLocale::getFallback()));
		return $dtc->translate('wysiwyg_link_config_title');
	}

	public function getLinkPaths(N2nLocale $n2nLocale) {
		$linkPaths = array();
		foreach ($this->simpleFileDao->getFiles() as $simpleFile) {
			if (null === ($file = $simpleFile->getFile())) continue; 
		    $linkPaths[$simpleFile->getName()] = StringUtils::jsonEncode(array('id' => $simpleFile->getId())); 
		}
		return $linkPaths;
	}
	
	public function isOpenInNewWindow() {
		return true;
	}
	
	public function getLinkBuilderClass() {
		return new \ReflectionClass(SimpleFileLinkBuilder::class);
	}
}