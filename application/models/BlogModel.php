<?php
class BlogModel{
    private $dbConnect;
    private $category;

    function __construct()
    {
        $this->dbConnect=new DBConnect();

    }

    /*
     * Функция возвращающая параметры из конкретной таблицы
     *
     *$method метод для получения статтей из таблицы блога или новостей
     * */
    function  getParams($method, $category){

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
    public  function getAllArticle($method, $category){

        $isMethod='get'.ucfirst($method);
        if(method_exists('DBConnect',$isMethod)){
            $article=$this->dbConnect->$isMethod($category);
            return $article;
        }

        return false;
    }

    /*
     *  Функция проверяющая текущую категорию на соответствие
    тем что существуют в БД. Если ее нет,
    то возвращает категорию первую присутствующую
    в базе данных иначе возвращает полученную..
     * */

    public function setCategory($category, DBConnect $connect){
        $allCategory=$connect->getCategory();

        if(!$category){
           if(is_array($allCategory)&&count($allCategory)>0){

               return $allCategory[0];
           }
        }else{
            foreach ($allCategory as $key=>$value){

                if(in_array($category,$value)){
                    return $allCategory[$key];
                }
            }
            return $allCategory[0];
        }




    }


}