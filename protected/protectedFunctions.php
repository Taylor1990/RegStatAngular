<?php
try{
    class protectedFunctions{
        public static function sendResponse($response){
            if($response instanceof PDOException || $response instanceof Exception){
                echo json_encode(array('error' => 1));
                $log_error = fopen('errors.txt', 'a+');
                fwrite($log_error, date('d M y G:i').' '.$response->getMessage().'\r\n');
                fclose($log_error);
            }
        }
    }
}
catch(Exception $ex){
    
}

