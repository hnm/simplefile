<?php
namespace simplefile\model;

use n2n\context\RequestScoped;
use simplefile\bo\SimpleFile;
use n2n\persistence\orm\EntityManager;

class SimpleFileDao implements RequestScoped {
    
    private $em;
    
    private function _init(EntityManager $em) {
    	$this->em = $em;
    }
    /**
     * @return SimpleFile
     */
    public function getFiles() {
        return $this->em->createSimpleCriteria(SimpleFile::getClass(), 
            array('linkable' => true), array('name' => 'ASC'))->toQuery()->fetchArray();
    } 
    /**
     * @param int $id
     * @return SimpleFile
     */
    public function getFileById($id) {
    	return $this->em->find(SimpleFile::getClass(), $id);
    }
}