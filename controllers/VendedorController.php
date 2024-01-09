<?php
    class VendedorController{
        public $routes;
        public $index;
        public $get;
        public $post;
        public $update;
        public $delete;

        function get($id){
            $_id=(int)$id;
            if(httpCheck()){
                $queryData=getQuery("vendedores",$id);
                header("Content-Type:application/json");
                echo json_encode($queryData);
                exit();
            }else{
                require dirname(__DIR__)."/views/vendedores/index.html";
                exit();
            }
        }

        public function __construct(){
            $this->index=function(){
                if(isset($_GET["_id"])){
                    $this->get($_GET["_id"]);
                }
                if(httpCheck()){
                    $params=getQueryParams(array("max","offset","nombre"));
                    $queryData=indexQuery("vendedores",($params),array("nombre"));
                    header("Content-Type:application/json");
                    echo json_encode($queryData);
                    exit();
                }else{
                    require dirname(__DIR__)."/views/vendedores/index.html";
                    exit();
                }
                
            };

            $this->post=function(){
                if(httpCheck()){
                    $json=file_get_contents("php://input");
                    $data=json_decode($json,true);
                    $queryData=postQuery("vendedores",$data);
                    header("Content-Type:application/json");
                    echo json_encode($queryData);
                }else{
                    require dirname(__DIR__)."/views/vendedores/post.html";
                    exit();
                }
            };

            $this->update=function(){
                if(httpCheck()){
                    $json=file_get_contents("php://input");
                    $data=json_decode($json,true);
                    $queryData=putQuery("vendedores",$data,(int)$_GET["_id"]);
                    header("Content-Type:application/json");
                    echo json_encode($queryData);
                }else{
                    $id=(int)$_GET["_id"];
                    $queryData=getQuery("vendedores",$id);
                    require dirname(__DIR__)."/views/vendedores/edit.php";
                    exit();
                }
            };
            $this->delete=function(){
                if(httpCheck()){
                    $queryData=deleteQuery("vendedores",(int)$_GET["_id"]);
                    header("Content-Type:application/json");
                    echo json_encode($queryData);
                }
            };
            $this->routes=array(
                "GET"=>array(
                    "/vendedor"=>$this->index,
                    "/vendedor/post"=>$this->post,
                    "/vendedor/update"=>$this->update
                ),
                "POST"=>array(
                    "/vendedor"=>$this->post,
                    "/vendedor/post"=>$this->post
                ),
                "PUT"=>array(
                    "/vendedor"=>$this->update,
                    "/vendedor/update"=>$this->update
                ),
                "DELETE"=>array(
                    "/vendedor"=>$this->delete,
                    "/vendedor/delete"=>$this->delete,
                )
            );
        }
    }

    
?>