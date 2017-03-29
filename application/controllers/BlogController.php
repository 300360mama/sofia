<?php
class BlogController implements ControllerInterface{

    private $view;
    private $db;
    private $model;
    private $controller;

    function __construct()
    {
        $this->db=new DBConnect();
        $this->model=new BlogModel();
        $this->controller='blog';
    }

    /*
     * Функция обработчик по умолчанию
     * $quantityPage Количество записей на одной странице
     * $article массив записей статтей полученных из базы данных
     * */
    public function indexAction($data=null){

        $this->view=new BlogView('listBlog','asideBlog');

        $userCategory=$data[0];
        $category=$this->model->setCategory($userCategory, $this->db);
        $this->view->setData('category',$category);

        $article=$this->model->getAllArticle('blog',$category['id']);
        $this->view->setData('article',$article);

        $news=$this->model->getParams('news',$category['id']);
        $this->view->setData('news',$news);

        $blog=$this->model->getParams('blog',$category['id']);
        $this->view->setData('blog', $blog);

        $listCategory=$this->db->getCategory();
        $this->view->setData('listCategory',$listCategory);

        $pageTemp=isset($data[2])?(int)$data[2]:1;
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

        $this->view=new BlogView('fullArticle','asideBlog');
        $userCategory=$data[0];
        $category=$this->model->setCategory($userCategory, $this->db);
        $this->view->setData('category',$category);

        $isAction=__FUNCTION__;
        $this->view->setData('isAction',$isAction);

        $article=$this->model->getAllArticle('blog', $category['id']);
        $this->view->setData('article',$article);

        $blog=$this->model->getParams('blog',$category['id']);
        $this->view->setData('blog', $blog);

        $listCategory=$this->db->getCategory();
        $this->view->setData('listCategory',$listCategory);

        $news=$this->model->getParams('news' ,$category['id']);
        $this->view->setData('news',$news);

        $this->view->setData('id',$data[0]);
        $this->view->setData('controller', $this->controller);
        $Alldata=$this->view->getData();
        include_once 'application/templates/templates.html';

    }
}