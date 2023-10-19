<?php 
 header("Access-Control-Allow-Origin: POST"); 
 header("Content-Type: application/json");
 
 include("../config/config.php");

 $config= new Config();

 $record = array();
 
 if($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET")

 {
    //  $id = $_POST["id"];
     $name = $_POST["name"];
     $categories = $_POST["categories"];
     $image = $_FILES["image"]["tmp_name"];
     $obj = $config->insert_db( $name, $categories,$image);

     if($obj )
     {
        echo "The data Inserted Successfully\n";
        echo "\n Name: $name <br>";
        echo "\n Category: $categories <br>";
        echo "\n Image: $image <br>";
        
        $config->display_db();
     }
     else 
     {
        echo "The Data has some Error";
     }
 }
 else
 {
    echo "Only POST and GET Method is allowed";
 }
?>