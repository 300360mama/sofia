<?php
class NewsModel{

    private $dbConnect;

    function __construct()
    {
      $this->dbConnect=new DBConnect();
    }

/*
 * Функция возвращающая параметры из конкретной таблицы
 * для вывода в асайде
 *
 *$method метод для получения статтей из таблицы блога
 *  или новостей
 * */
    function  getParams($method, $category=null){

        $isMethod='get'.ucfirst($method);
        if(method_exists('DBConnect',$isMethod)){
            $result=$this->dbConnect->$isMethod($category);
            $article=$this->dbConnect->getArticle($result,2);
            return $article;
        }

       return false;
    }
/*
 * Функция получения всех статтей из конкретной таблицы
 *
 * $method метод получения
 * */
public  function getAllArticle($method, $category=null){

    $isMethod='get'.ucfirst($method);
    if(method_exists('DBConnect',$isMethod)){
        $article=$this->dbConnect->$isMethod($category);
        return $article;
    }

    return false;
}

}