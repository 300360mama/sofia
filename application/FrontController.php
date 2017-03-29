<?php

class FrontController{

    private $contloller;
    private $action;
    private $param;
    static $instance=null;
    private $prefixController='Controller';
    private $prefixAction='Action';
    private $folderController=__DIR__.'\contollers\\';
/*
 * Разбираем адресную строку и выделяем контроллер, функцию обработчик и массив параметров
 *
 * */
    private function __construct(){
       $this->contloller='IndexController';
        $this->action='indexAction';
       $requestStr=explode('/',trim($_SERVER['REQUEST_URI'],'/'));

       if(!empty($requestStr[2])){
           $put=stream_resolve_include_path(ucfirst($requestStr[2]).$this->prefixController.'.php');
           if(file_exists($put)){
               $this->contloller=ucfirst($requestStr[2]).$this->prefixController;
           }
       }

        if(!empty($requestStr[3])){
            $this->action=$requestStr[3].$this->prefixAction;
        }
        if(!empty($requestStr[4])){
            $this->param=array_slice($requestStr, 4);

        }

    }

    /*Возвращает единственный экземпляр объекта
     *
     * */
    public static function getInstance()
    {
      if(is_null(self::$instance)){
          self::$instance=new self();
      }

      return self::$instance;
    }

    public  function  run(){

        $b=new $this->contloller();
        $action='indexAction';
        if(method_exists($b, $this->action)){
            $action=$this->action;
        }

        $b->$action($this->param);

    }


}