<?php
class DBConnect{

    private $dbh;
    const COUNTPOST=2;
    function __construct(){
      $param=SettingDB::getInstance()->getSetting();
      $data='mysql:host='.$param['host'].';dbname='.$param['dbname'];
        try{
            $this->dbh=new PDO($data,$param['user'],$param['passwd']);
            $this->dbh->exec('SET NAMES utf8');
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
/*
 * Функция возвращающая записи из таблицы статтей новостей
 * */
    function getNews($category=null){
        $zapros="SELECT id, title, content, imgpath,date FROM newssof  ORDER BY date DESC";
        $sth=$this->dbh->prepare($zapros);
        $sth->execute();
        $params=$sth->fetchAll(PDO::FETCH_ASSOC);

        return $params;
    }

    /*
     *
     * Функция возвращающая записи из таблицы статтей блога
     * */
    function getBlog($category){
        $setting=new Setting();
        $defaultCateg=$setting->getDefaultCateg();
        if($category==$defaultCateg){
            $zapros="SELECT id, title, content, imgpath, date FROM postsof  ORDER BY date DESC";
        }else{
            $zapros="SELECT id, title, content, imgpath, date FROM postsof  WHERE categoryId=$category ORDER BY date DESC";
        }

        $sth=$this->dbh->prepare($zapros);
        $sth->execute();
        $params=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $params;
    }

    /*
     * Функция возвращающая определенное количество статтей из масива
     * array $article полученные данные из БД
     *  $num количество нужных статтей
     *
     * @return array $article or false
     * */
    public function getArticle(array $article,$num){

        if(!empty($article)){
            $myArticle=[];
            $count=count($article);

            for($i=0;$i<$num;$i++){
                if(isset($article[$i])){
                    $myArticle[]=$article[$i];
                }

            }

            return $myArticle;
        }

        return false;

    }

    /*
     *
     * Функция возвращающая  все существующие
     * категории статтей блога
     * */

    public function getCategory(){
        $zapros="SELECT id, category FROM postcategory ";
        $sth=$this->dbh->prepare($zapros);
        $sth->execute();
        $params=$sth->fetchAll(PDO::FETCH_ASSOC);

        return $params;
    }







}