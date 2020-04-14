<?php
    
    namespace App;

    class Connection{
        
        public static function getDb(){

            try{
                $conn = new \PDO(
                    "mysql:host=mysql669.umbler.com;dbname=twitter_clone;charset=utf8",
                    "gabriel.silva",
                    "gabriel.silva003316"
                );

                return $conn;
            }catch(\PDOException $e){
                //tratar de alguma forma
            }

        }
    } 
?>
