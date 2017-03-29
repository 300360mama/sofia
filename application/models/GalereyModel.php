<?php
class GalereyModel{
    private $dbConnect;
    private $pathToAlbum;

    function __construct()
    {
        $this->dbConnect=new DBConnect();
        $path=new Setting();
        $this->pathToAlbum=$path->getPathAlbum();

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
     *
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




    /*
     * Функция сканирования определенного альбома с фотографиями
     * Возврат массива с именами фото
     *
     * $album сканируемый альбом
     * $gaдereyFolder папка с
     * */
    public function getImgsAlbum($album){

        if(empty($album)){
           return false;
        }
        $pathToAlbum=is_dir($_SERVER['DOCUMENT_ROOT'].$this->pathToAlbum.$album)?$_SERVER['DOCUMENT_ROOT'].$this->pathToAlbum.$album:false;

        if(!$pathToAlbum) return false;

        $list=scandir($pathToAlbum);

        $listImgs=[];
        foreach ($list as $nameImgs) {
            if($nameImgs=='.'|| $nameImgs=='..'){
                continue;
            }

            $listImgs[]=$nameImgs;

        }
        return $listImgs;

    }

    /*
     * Функция возвращающая полный путь к папкам в альбоме галерей
     * */

    public function getListOfAlbums(){
        $path=$_SERVER['DOCUMENT_ROOT'].$this->pathToAlbum;
        if(is_dir($path)){
            $listFiles=scandir($path);
            $listAlbums=[];
            foreach($listFiles as $name){
                if(!is_dir($path.$name)||$name=='.'||$name=='..'){
                    continue;
                }
                $listAlbums[]=$name;
            }
            return $listAlbums;
        }

        return false;

    }

    /*
     * Функция проверяющая существует ли конкретный альбом
     * в папке с галереей
     *
     * */

    public function issetAlbum($album){
        $pathToAlbum=is_dir($_SERVER['DOCUMENT_ROOT'].$this->pathToAlbum.$album)?$_SERVER['DOCUMENT_ROOT'].$this->pathToAlbum.$album:false;

        if(!$pathToAlbum) return false;

        return $album;

    }
}