<?php
class IndexView{



    public function getAllContent(array $data=null){
        $this->getContent();
    }
   private function getContent(){
        include_once 'application/templates/aboutUs.html';
    }

   private function getAside(){
    }
}