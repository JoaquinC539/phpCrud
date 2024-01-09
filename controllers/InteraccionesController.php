<?php

    class InteraccionesController{
        public $routes;
        public $index;
        public $get;
        public $post;
        public $save;
        public $edit;
        public $update;
        public function __construct() {
            $this->index=function(){
                if(httpCheck()){
                    $params=getQueryParams(array("max","offset","nombre"));
                    $queryData=indexQuery("interacciones",($params),array("nombre"));
                    header("Content-Type:application/json");
                    echo json_encode($queryData);
                    exit();
                }else{
                    require dirname(__DIR__)."/views/interacciones/index.html";
                }
                
            };
            $this->routes=array(
                "GET"=>array("/interaccion"=>$this->index)
            );
        }

    }
?>