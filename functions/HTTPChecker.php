<?php
    function httpCheck($contentType){
        if($contentType==="application/json" || $contentType==="x-www-form-urlencoded"){
            return true;
        }else{
            return false;
        }
    }
?>