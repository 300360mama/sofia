<?php
class GalereyController implements ControllerInterface{

    private $view;
    private $db;
    private $model;
    private $controller;

    function __construct()
    {
        $this->db=new DBConnect();
        $this->model=new GalereyModel();
        $this->controller='galerey';
    }

    /*
     * Функция обработчик по умолчанию
     * $quantityPage Количество записей на одной странице
     * $article массив записей статтей полученных из базы данных
     * */
    public function indexAction($data=null){

        $this->view=new GalereyView('listAlbums','asideGalerey');

        $userCategory=$data[0];
        $category=$this->model->setCategory($userCategory, $this->db);
        $this->view->setData('category',$category);

        $listAlbums=$this->model->getListOfAlbums();
        $this->view->setData('listAlbums',$listAlbums);

        $news=$this->model->getParams('news',$category['id']);
        $this->view->setData('news',$news);

        $blog=$this->model->getParams('blog',$category['id']);
        $this->view->setData('blog', $blog);

        $listCategory=$this->db->getCategory();
        $this->view->setData('listCategory',$listCategory);

        $isAction=__FUNCTION__;
        $this->view->setData('isAction',$isAction);
        $this->view->setData('controller', $this->controller);
        $Alldata=$this->view->getData();

        include_once 'application/templates/templates.html';

    }


    /*
     * !!!!!$data[0] проверить на пустоту и заменить
     * в случае чего заглушкой
     *
     *
     * */
    public function albumAction($data){


        $this->view=new GalereyView('listPhoto','asideGalerey');
        $listPhoto=$this->model->getImgsAlbum($data[0]);
        $album=$this->model->issetAlbum($data[0]);
        if($album){
            $this->view->setData('album',$album);
        }
        $this->view->setData('listPhoto',$listPhoto);


        $isAction=__FUNCTION__;
        $this->view->setData('isAction',$isAction);

        $category=$this->model->setCategory(0, $this->db);
        $blog=$this->model->getParams('blog',$category['id']);
        $this->view->setData('blog', $blog);

        $listCategory=$this->db->getCategory();
        $this->view->setData('listCategory',$listCategory);

        $listAlbums=$this->model->getListOfAlbums();
        $this->view->setData('listAlbums',$listAlbums);

        $news=$this->model->getParams('news' ,$category['id']);
        $this->view->setData('news',$news);

        $this->view->setData('id',$data[0]);
        $this->view->setData('controller', $this->controller);
        $Alldata=$this->view->getData();
        include_once 'application/templates/templates.html';

    }
}