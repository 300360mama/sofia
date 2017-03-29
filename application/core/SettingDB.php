<?php

class  SettingDB{

    const HOST='localhost';
    const USER='root';
    const DBNAME='sofia';
    const PASSWD='2501';





    private static $instance=null;

    static function getInstance(){
        if (self::$instance==null){
            self::$instance=new self();
        }

        return self::$instance;
    }

    public function getSetting(){
        $setting=[];
        $setting['host']=self::HOST;
        $setting['user']=self::USER;
        $setting['dbname']=self::DBNAME;
        $setting['passwd']=self::PASSWD;

        return $setting;

    }

    private function __construct(){
    }

    private function __clone(){}


}