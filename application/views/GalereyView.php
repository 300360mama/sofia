<?php
class GalereyView extends View{

    private $model;
    private $contentView;
    private $asideView;


    public function __construct($content,$aside)
    {
        $this->model=new GalereyModel();
        $this->contentView=$content.'.html';
        $this->asideView=$aside.'.html';
    }

    /*
     * Возвращает контент страницы
     * в зависимости от запрашиваемой страницы
     * */

    function getAllContent(array $data=null){
        $this->getAllAlbum($data);
        $this->getAside($data);
    }


    /*
     * array $article статьи полученные с БД
     * $page текущая страница переданная пользователем
     * $controller текущий контроллер для передачи в ссылки страниц
     *      */
    private function getAllAlbum($data){

        include_once 'application/templates/'.$this->contentView;

    }

    /*
     * Подключение Html шаблона сайдбара
     *
     * */
    private function getAside(array $data){
        include_once 'application/templates/'.$this->asideView;
    }





}