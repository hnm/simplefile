<?php
namespace simplefile\model;

use rocket\impl\ei\component\prop\string\wysiwyg\DynamicUrlBuilder;
use n2n\web\http\HttpContext;

class SimpleFileLinkBuilder implements DynamicUrlBuilder {

	private $simpleFileDao;
	private $httpContext;
	
	private function _init(SimpleFileDao $simpleFileDao, HttpContext $httpContext) {
		$this->simpleFileDao = $simpleFileDao;
		$this->httpContext = $httpContext;
	}
	
	public function buildUrl(HttpContext $httpContext, $characteristics) {
		$simplefile = $this->simpleFileDao->getFileById($characteristics['id']);
		if (null === $simplefile) return null;
		
		$file = $simplefile->getFile();
		if (null === $file) return null;
		if (!$file->isValid()) return null;
		return $file->getFileSource()->getUrl();
	}

}