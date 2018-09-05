<?php
namespace simplefile\model;

use n2n\web\http\Request;
use n2n\core\container\N2nContext;
use n2n\l10n\DynamicTextCollection;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\string\cke\model\CkeLinkProviderAdapter;
use n2n\context\RequestScoped;
use n2n\web\ui\view\View;

class SimpleFileCkeLinkProvider extends CkeLinkProviderAdapter implements RequestScoped {

    private $simpleFileDao;
    private $request;
    private $n2nContext;
    
    private function _init(SimpleFileDao $simpleFileDao, Request $request, N2nContext $n2nContext) {
    	$this->simpleFileDao = $simpleFileDao;
    	$this->request = $request;
    	$this->n2nContext = $n2nContext;
    }
    
    public function getTitle(): string {
		$dtc = new DynamicTextCollection('simplefile', array($this->request->getN2nLocale(), 
				N2nLocale::getDefault(), N2nLocale::getFallback()));
		return $dtc->translate('wysiwyg_link_config_title');
	}

	public function getLinkOptions(N2nLocale $n2nLocale): array {
		$linkPaths = array();
		foreach ($this->simpleFileDao->getFiles() as $simpleFile) {
			if (null === ($file = $simpleFile->getFile())) continue; 
// 		    $linkPaths[$simpleFile->getName()] = StringUtils::jsonEncode(array('id' => $simpleFile->getId())); 
 		    $linkPaths[$simpleFile->getId()] = $simpleFile->getName(); 
		}
		return $linkPaths;
	}
	
	public function buildUrl(string $key, View $view, N2nLocale $n2nLocale) {
		$simpleFile = $this->simpleFileDao->getFileById($key);
		if (null === $simpleFile) return null;
		
		$file = $simpleFile->getFile();
		if (!$file->isValid()) return null;
		
		return $file->getFileSource()->getUrl();
	}
	
	public function isOpenInNewWindow(): bool {
		return true;
	}
}