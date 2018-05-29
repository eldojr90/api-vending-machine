<?php

namespace App\Aux;

use PDO,PDOException;

class Connection{

    public static function getConnection(){
        
        $ddb = self::getDataDB();
        
        try{
            return new PDO($ddb["dsn"],$ddb["username"],$ddb["password"]);
        }catch(PDOException $e){
            return "ebc ".$e->getMessage();
        }
        
    }

    public static function getDataDB(){
        return [
            "dsn"=>"mysql:host=localhost;dbname=sm;charset=utf8",
            "username"=>"root",
            "password"=>""
        ];
    }

}