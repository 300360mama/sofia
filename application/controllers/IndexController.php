<?php
class IndexController implements ControllerInterface{

    private $view;
    private $model;

    function __construct()
    {
        $this->view=new IndexView();
        $this->model=new IndexModel();
    }

    public function indexAction($data=null){

        include_once 'application/templates/templates.html';

    }




}