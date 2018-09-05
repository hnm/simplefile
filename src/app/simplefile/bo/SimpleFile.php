<?php
namespace simplefile\bo;

use n2n\reflection\ObjectAdapter;
use n2n\io\managed\File;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManagedFile;
class SimpleFile extends ObjectAdapter {
    private static function _annos(AnnoInit $ai) {
    	$ai->p('file', new AnnoManagedFile());
    }
    
    private $id;
    private $name;
    private $file;
    private $linkable = true;
    private $created;
    
    public function __construct() {
    	$this->created = new \DateTime();
    }
    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function getName() {
	    return $this->name;
	}
	
	public function setName($name) {
	    $this->name = $name;
	}

	public function getFile() {
		return $this->file;
	}

	public function setFile(File $file) {
		$this->file = $file;
	}

	public function getLinkable() {
		return $this->linkable;
	}

	public function setLinkable($linkable) {
		$this->linkable = $linkable;
	}
	
	public function getCreated() {
		return $this->created;
	}

	public function setCreated(\DateTime $created) {
		$this->created = $created;
	}
}