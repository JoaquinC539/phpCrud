<?php
    function httpCheck(){
        if(isset($_SERVER["CONTENT_TYPE"])){
            $contentType=$_SERVER["CONTENT_TYPE"];
        
            if($contentType==="application/json" || $contentType==="application/x-www-form-urlencoded" || $contentType==="application/template" ){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        
    }

    function getQueryParams($paramsArray=array('max', 'offset')):array{
        $params=array();
        for($i=0;$i<count($paramsArray);$i++){
            if(isset($_GET[$paramsArray[$i]])){
                $params[$paramsArray[$i]]=$_GET[$paramsArray[$i]];
            }
        }
        if(!isset($_GET["max"])){
            $params["max"]=15;
        }else{
           $params["max"]=intval($params["max"]);
        }
        if(!isset($_GET["offset"])){
            $params["offset"]=0;
        }else{
            $params["offset"]=intval($params["offset"]);
         }
        return $params;
    }


?>