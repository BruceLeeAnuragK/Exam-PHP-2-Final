<?php 
 header("Access-Control-Allow-Origin: PUT"); 
 header("Content-Type: application/json");
 
 include("../config/config.php");

 $config= new Config();

 $record = array();

 if($_SERVER["REQUEST_METHOD"]== "PATCH" 
//  $_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "PATCH"
 )

 {

    $obj = $config-> selectCategory();
      
    if($obj)
    {
       echo "The Category is Selected by User Successfully";
       $config->display_db();
    }
    else 
    {
       echo "No such Category is Selected by User";
    }
    
 }
 else
 {
    echo "Only POST,PUT,GET Method is allowed";
 }
?>