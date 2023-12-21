<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.8/handlebars.min.js" integrity="sha512-E1dSFxg+wsfJ4HKjutk/WaCzK7S2wv1POn1RRPGh8ZK+ag9l244Vqxji3r6wgz9YBf6+vhQEYJZpSjqWFPg9gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
html { color-scheme: light dark; }
body { width: 35em; margin: 0 auto;
font-family: Tahoma, Verdana, Arial, sans-serif; }
</style>
</head>
<!-- <body class="dark"> -->
<?php
    require __DIR__.'/environment/environment.php';
    require __DIR__.'/functions/'."HTTPChecker.php";
    $request=$_SERVER['REQUEST_URI'];
    $method=$_SERVER['REQUEST_METHOD'];
    $contentType=$_SERVER['CONTENT_TYPE'];
    $viewDir='/views/';
    switch($request){
        case '':
        case "/":
            require __DIR__.$viewDir.'index.html';
            break;
        default:
            http_response_code(404);
            require __DIR__.$viewDir.'50x.html';

    }
?>
<!-- </body> -->
</html>


