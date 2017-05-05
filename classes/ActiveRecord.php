<?php
require("ActiveRecordInterface.php");

abstract class activeRecord implements ActiveRecordInterface {
    protected $id;
    protected static $db;
    public function __construct(){
        self::connect();
        $this->id = -1;
    }

    public static function connect(){
        if(!self::$db){
            self::$db = new Database();
            self::$db->changeDB('BitterApp');
        }
        return true;
    }

    public function save(){}
}