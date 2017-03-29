<?php
class BlogView extends View{

    private $model;
    private $contentView;
    private $asideView;
    private $quantityPage;

    public function __construct($content,$aside)
    {
        $this->model=new BlogModel();
        $quantityPage=new Setting();
        $this->quantityPage=$quantityPage->getCountPage();
        $this->contentView=$content.'.html';
        $this->asideView=$aside.'.html';
    }

    /*
     * Возвращает контент страницы
     * в зависимости от запрашиваемой страницы
     * */

    function getAllContent(array $data=null){
        $isAction=!empty($data['isAction'])?$data['isAction']:'index';
        $action=substr($isAction,0,(strlen($isAction)-6));


        switch ($action){
            case 'index':
                $this->getAllArticle($data);
                $this->getAside($data);
                break;
            case 'article':
                $this->getSingleArticle($data['article'],$data['id']);
                $this->getAside($data);
                break;
            default:
                $this->getAllArticle($data);
                $this->getAside($data);
        }


    }


    /*
     * array $article статьи полученные с БД
     * $page текущая страница переданная пользователем
     * $controller текущий контроллер для передачи в ссылки страниц
     *      */
    private function getAllArticle($data){
        $article=$data['article'];
        $category=$data['category']['category'];
        $page=$data['page'];
        $controller=$data['controller'];
        $quantityPage=$this->quantityPage;
        include_once 'application/templates/'.$this->contentView;

    }


   private function getAside(array $data){
        include_once 'application/templates/'.$this->asideView;
    }

    /*
     * Подключение Html шаблона меню страниц
     *
     * $article общее количество статей
     * $page текущая страница
     *
     * */
    public function getPage($article,$page=1, $controller, $category){


        $quantityPage=$this->quantityPage;
        $countPage=ceil(count($article)/$quantityPage);
        include_once 'application/templates/page.html';

    }

    /*
        * array $article полученные статьи из БД
        * $id уникальный номер статьи
        * */
    /* private function getSingleArticle(array $article,$id){
         $keyArticle=1;
         foreach ($article as $key=>$value ){

             if(in_array($id,$value)){
                 $keyArticle=$key;
                 break;
             }
         }
         include_once 'application/templates/fullArticle.html';

     }*/
    /*
     * Подключение Html шаблона сайдбара
     *
     * */
    /*
     * Получаем случайные фото из списка альбомов
     * */
    /*private function getRandomImg($path){


        $fullPath=$_SERVER['DOCUMENT_ROOT'].$path;
        $dir=$this->getRandomPath($fullPath,2);
        $listImg=[];

        foreach ($dir as $v){
            $imgsList=scandir($fullPath.'/'.$v);

            foreach ($imgsList as $value){
                if($value=='.' || $value=='..'){
                    continue;
                }
                $list[]=$value;
            }
            $randKey=array_rand($list);
            $listImg[$v]=$list[$randKey];

        }

        return $listImg;
    }*/


    /*
     *
     * функция выбирает 2 случайных альбома
     * $path путь к общей папке с альбомами фотогалереи
     * $quantityPath количество случайных альбомов
     *
     *
     * */
   /* private function getRandomPath($path,$quantityPath){


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

    }*/



}