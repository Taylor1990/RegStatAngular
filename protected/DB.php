<?php
require_once 'protectedFunctions.php';
try{
    class DB{
        
        private $PDO;
        private static $instance;
        
        public static function getDB()
        {
            /*singleton*/
            if (!(self::$instance instanceof self)) {
                self::$instance = new self();
                self::$instance->connectDB();
            }
            return self::$instance;
        }
        
        private static function connectDB(){
            //$this->PDO = new PDO("mysql:host=localhost;dbname=reg_stat", 'root', '');
            self::$PDO = new PDO("mysql:host=regstat.e-mordovia.ru;dbname=ncsam", 'ncsam', 'nRcsam@95');
            self::$PDO->exec('SET NAMES utf8'); 
            self::$PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        
        private function __construct(){}
        private function __clone(){}
        private function __sleep(){}
        private function __wakeup(){}
        
        public function query($query, $mass_values = false){/*функция делает запрос к базе данных*/
            /*$mass_values массив параметров, отправляемые в запрос*/
            if(!is_string($query)){throw new Exception('$query isn\'t string');}         
            
            if(is_array($mass_values)){
                $query_prepare = $this->PDO->prepare($query);
                foreach($mass_values as $value){
                    $query_prepare->execute($value);
                }
            }
            else{
                $this->PDO->query($query);
            }
            
            if(strpos($query,'CREATE TABLE') !== false || strpos($query,'INSERT') !== false || strpos($query,'UPDATE') !== false){
                $response = true; // Если выполняются запросы CREATE TABLE, INSERT, UPDATE
            }
            else{
                $response = $query_prepare->fetchAll(PDO::FETCH_ASSOC);
            }
            return $response;
        }
        
    }
} 
catch (Exception $ex) {
    protectedFunctions::sendResponse($ex);
}
catch (PDOException $ex){
    protectedFunctions::sendResponse($ex);
}

