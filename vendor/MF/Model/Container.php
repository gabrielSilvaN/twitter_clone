<?php

    namespace MF\Model;

    use App\Connection;

    class Container{        
        
        public static function getModel($model){
            // retornar o modelo solicitado já instanciado, inclusive com a conexão estabelecida
            
            $conn = Connection::getDb();
            
            $class = "App\\Models\\".ucfirst($model); 
            return new $class($conn);
        }
        
    }
?>
