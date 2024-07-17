<title>Interacciones</title>

<body class="dark">
    Interacciones Php
    
</body>
<?php 
    for($i=0;$i<11;$i++){
        echo "<p class='txt'>$i</p>";
    }
    
?>
<hr>
<?php
    $var=8;
?>
<?php
    if($var>9){
        echo "<p>Greater than 9</p>";
    }
    else{
        echo "<p>Not greater than 9</p>";
    }
?>
<hr>
<?php 
    foreach($queryData as $vendedor ){
        
        echo "<br>";
        echo "<p>";
        foreach($vendedor[0] as $key=>$value){
            echo " ".$key.":". $value." ";
        }
        echo "</p>";
    }
?>
