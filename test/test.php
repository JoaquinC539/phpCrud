<?php
    require dirname(__DIR__).'/router/router.php';
    require dirname(__DIR__).'/environment/environment.php';
    require dirname(__DIR__).'/functions/'."utils.php";
    require dirname(__DIR__).'/functions/'."queries.php";
    require dirname(__DIR__)."/controllers/IndexController.php";
    require dirname(__DIR__)."/controllers/InteraccionesController.php";
    require dirname(__DIR__)."/controllers/VendedorController.php";
    require dirname(__DIR__)."/controllers/TemplateController.php";
    $route=$_SERVER['REQUEST_URI'];
    $method=$_SERVER['REQUEST_METHOD'];
    $router=new Router($_SERVER);
    $router->controllerAndRoutes(new IndexController(),"Iroutes");
    $router->controllerAndRoutes(new InteraccionesController(),"routes");
    $router->controllerAndRoutes(new VendedorController(),"routes");
    $router->controllerAndRoutes(new TemplateController(),"routes");
    if(httpCheck()){
        $router->handleReq($method, $route);
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.8/handlebars.min.js" integrity="sha512-E1dSFxg+wsfJ4HKjutk/WaCzK7S2wv1POn1RRPGh8ZK+ag9l244Vqxji3r6wgz9YBf6+vhQEYJZpSjqWFPg9gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
html { color-scheme: light dark; }

</style>
</head>

<body>Este es test</body>
<?php
    $router->handleReq($method, $route,$_SERVER["QUERY_STRING"]);
?>
</html>


