<?php
    class TemplateController{
        public $serve;
        public $routes;

        public function __construct(){
            $this->serve=function(){
                if(!isset($_GET["file"])){
                    header("Content-Type:application/text" );
                    echo "";
                    exit();
                }
                $fileName=$_GET["file"];
                $fileRoute=dirname(__DIR__)."/views/templates/".$fileName;
                $content=file_get_contents($fileRoute);
                header("Content-Type:application/text");
                echo $content;
            };
            $this->routes=array(
                "GET"=>array("/template"=>$this->serve)
            );
        }
    }
 ?>