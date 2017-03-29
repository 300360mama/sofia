<?php
class Setting{
    /* Количество записей на странице*/
    private $countPage=3;

    /* Путь к папке с альбомами фотогалереи*/
    private $path='/ItHub/sofiaOrig/imgs/content/galerey/';

    public function setPathAlbum($path){
        $this->path=is_dir($path)?$path:'/ItHub/sofiaOrig/imgs/content/galerey/';
    }

    public function getPathAlbum(){
        $path=(!empty($this->path))?$this->path:'/ItHub/sofiaOrig/imgs/content/galerey/';

        return $path;
    }

    /*дефолтный номер категории
        в базе данных для статьей блога*/
    private $defaultCatId=5;


    public function setCountPage($value){
        $this->countPage=$value;
    }

    public function getCountPage(){
        return $this->countPage;
    }
    public function setDefaultCateg($value){
        $this->countPage=$value;
    }

    public function getDefaultCateg(){
        return $this->defaultCatId;
    }





}