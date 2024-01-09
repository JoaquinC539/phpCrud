<?php
    class Router {
        public $routeTable = array(
            "GET"=>null,
            "POST"=>null,
            "PUT"=>null,
            "DELETE"=>null
        );
        public $request;

        public function __construct($request) {
            $this->request=array_values($request);
            // print_r($this->request);
        }
    
        public function routeReq($method, $route, $handler) {
            $this->routeTable[$method][$route] = $handler;
        }
    
        public function handleReq($method, $route) {
            $found = false;
            $parsedUrl=parse_url($route);

            // parse_str($parsedUrl['query'],$query);
            
            // print_r($parsedUrl);
            // print_r($query["max"]);

            if (isset($this->routeTable[$method][$parsedUrl["path"]])) {
                call_user_func($this->routeTable[$method][$parsedUrl["path"]]);
            } else {
                header('HTTP/1.0 404 Not Found');
                require dirname(__DIR__)."/views/50x.html";
            }
        }
        public function addRoutes($array){
            foreach($array as $method=>$routes){
                if(!isset($this->routeTable[$method])){
                    $this->routeTable[$method]=$routes;
                }else{
                    $this->routeTable[$method]=$routes+$this->routeTable[$method];
                }
            }
        }
        public function controllerAndRoutes($controller,$routeName){
        //     print_r($controller->$routeName);
            $this->addRoutes($controller->$routeName);

        }
    }
?>