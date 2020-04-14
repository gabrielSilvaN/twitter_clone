<?php
    
    namespace MF\Init;
    
    abstract Class Bootstrap {

        // array de rotas
        private $routes;

        //faz com que a classe que herde desta classe implemente o método initRoutes obrigatoriamente
        abstract protected function initRoutes();

        //inicia as rotas e chama o controller específico
        public function __construct(){
            $this->initRoutes();
            $this->run($this->getUrl());
        }

        //retorna a lista de rotas
        public function getRoutes(){
            return $this->routes;
        }

        // cria as rotas
        public function setRoutes(array $routes){
            $this->routes = $routes;
        }

        protected function run($url){
            
            /**
             * verifica se a rota passada no navegador é válida
             * caso seja, cria uma classe dinâmica que executa uma função específica no controller
             * essa função é a responsável por renderizar a view no navegador
             */
            forEach($this->getRoutes() as $key => $route){
                
                if($url == $route['route']){
                    
                    //montando a string para a classe de rota
                    $class = "App\\Controllers\\".$route['controller'];
                    
                    //criando a classe
                    $controller = new $class;

                    //criando o método de acordo com a string presente no array route
                    $action = $route['action'];

                    //executando o método (que chama o controller, que por sua vez renderiza a view)
                    $controller->$action();

                } 
            }    
            // por enquanto deixar assim, posteriormente mudar para uma págna não encontrada personalizada
            // echo 'rota não encontrada';
        }

        // método que retorna a url da requisição feita pelo navegador
        protected function getUrl(){

            // $_SERVER retorna os detalhes do servidor da sessão
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        }
    }
?>