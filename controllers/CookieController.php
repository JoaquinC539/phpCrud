<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
    class CookieController{
        public $routes;
        public $set;
        public function __construct(){
            $this->set=function(){
                $payload=array(
                    "user_id"=>'123456',
                    "username"=>"Bobby Pulido"
                );
                $json=file_get_contents("php://input");
                $data=json_decode($json,true);
                print_r($data);
                $password="contrasena123";
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $otherPassword="contrasena1234";
                if(password_verify($otherPassword,$hash)){
                    echo "La contraseña coincide\n";
                }else{
                    echo "La contrseña no coincide\n";
                }

                $jwt=JWT::encode($payload,$_ENV["JWT"],"HS256");
                print_r($jwt."\n");
                header("Test-Header:applicaction/test");
                header("Set-Cookie: sessionId=".$jwt.";SameSite=Strict; secure; HttpOnly; Max-Age=1 ");
                if(isset($_COOKIE["sessionId"])){
                    $cook=$_COOKIE["sessionId"];
                    $decoded=JWT::decode($cook,new Key($_ENV["JWT"],"HS256"));
                    print_r($decoded);
                }else{
                    print_r("no hay cookie");
                }
                
                
                // setcookie("jwt_cookie",$jwt,ti)
            };
            $this->routes=array(
                "GET"=>array(
                    "/cook"=>$this->set
                )
            );            
        }
    }