<?php
abstract class View{

   private $data=[];


    public function setData($key,$value){
        if(empty($this->data[$key])){
            $this->data[$key]=$value;
            return true;
        }

        return false;
    }

    public function getData(){

        return $this->data;
    }



    /*
    * Получаем случайные фото из списка альбомов
    * */
    protected function getRandomImg($path){


        $fullPath=$_SERVER['DOCUMENT_ROOT'].$path;
        $dir=$this->getRandomPath($fullPath,2);
        $listImg=[];
        $list=[];

        foreach ($dir as $v){
            $imgsList=scandir($fullPath.'/'.$v);

            foreach ($imgsList as $value){
                if($value=='.' || $value=='..'){
                    continue;
                }

                $list[]=$value;
            }
            if(!empty($list)){
                $randKey=array_rand($list);
                $listImg[$v]=$list[$randKey];
            }


        }

        return $listImg;
    }


    /*
     *
     * функция выбирает 2 случайных альбома
     * $path путь к общей папке с альбомами фотогалереи
     * $quantityPath количество случайных альбомов
     *
     *
     * */
    protected function getRandomPath($path,$quantityPath){


        if(is_dir($path)) {
            $dir = scandir($path);
        }else{
            return false;
        }

        foreach ($dir as $value){
            if($value=='.' || $value=='..'){
                continue;
            }
            if(is_dir($path)) {
                $list[]=$value;
            }
        }

        if(!empty($list)){

            $keyDir=array_rand($list,$quantityPath);
            $count=count($keyDir);
            for($i=0;$i<$count;$i++){
                $listDir[]=$list[$keyDir[$i]];
            }


            return $listDir;
        }

        return false;

    }

    /*
	 * array $article полученные статьи из БД
	 * $id уникальный номер статьи
	 * */

    protected function getSingleArticle(array $article,$id){

        $keyArticle=1;
        foreach ($article as $key=>$value ){

            if(in_array($id,$value)){
                $keyArticle=$key;
                break;
            }
        }
        include_once 'application/templates/fullArticle.html';


    }




}

