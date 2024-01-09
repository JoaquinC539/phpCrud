<?php

     class IndexController{
        public $Iroutes;
        public $index;

        public function __construct() {
            $this->index=function(){
                require dirname(__DIR__)."/views/index.html";

            };
            $this->Iroutes=array(
                "GET"=>array("/"=>$this->index)
            );
        }
          
      }
     


?>