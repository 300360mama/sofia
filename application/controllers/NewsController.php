<?php

class NewsController implements ControllerInterface{

    private $view;
    private $db;
    private $model;
    private $controller;

      function __construct()
    {
       $this->db=new DBConnect();
        $this->model=new NewsModel();
        $this->controller='news';
    }

    /*
     * Функция обработчик по умолчанию
     * $quantityPage Количество записей на одной странице
     * $article массив записей статтей полученных из базы данных
     * */
    public function indexAction($data=null){

        $this->view=new NewsView('listNews','aside');

        $article=$this->model->getAllArticle('news');
        $this->view->setData('article',$article);


        $news=$this->model->getParams('news');
        $this->view->setData('news',$news);

        $blog=$this->model->getParams('blog');
        $this->view->setData('blog', $blog);

        $pageTemp=(int)$data[1];
        $page=($pageTemp>0&&$pageTemp<=count($article))?$pageTemp:1;
        $this->view->setData('page',$page);

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
    public function articleAction($data){

        $this->view=new NewsView('fullArticle','aside');


        $article=$this->model->getAllArticle('news');
        $this->view->setData('article',$article);

        $isAction=__FUNCTION__;
        $this->view->setData('isAction',$isAction);

        $news=$this->model->getParams('news');
        $this->view->setData('news',$news);

        $blog=$this->model->getParams('blog');
        $this->view->setData('blog', $blog);

        $this->view->setData('id',$data[0]);
        $this->view->setData('controller', $this->controller);
        $Alldata=$this->view->getData();


        include_once 'application/templates/templates.html';


    }

}