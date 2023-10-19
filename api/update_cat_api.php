<?php 
 header("Access-Control-Allow-Origin: PUT"); 
 header("Content-Type: application/json");
 
 include("../config/config.php");

 $config= new Config();

 $record = array();

 if($_SERVER["REQUEST_METHOD"] == "PUT" || $_SERVER["REQUEST_METHOD"] == "PATCH")
 
 {


    $str = file_get_contents('php://input');

    // echo $str;

    $data = array();

    parse_str($str,$data);

    $record['data'] = $data;

    $password = $data['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if(password_verify($password, $hashedPassword)) 
      {
       echo "Password is correct\n";
       $id = $data["id"];
       $categories = $data["categories"];
       $obj = $config-> updateCategory($id,$categories);
      
       if($obj)
       {
          echo "The Category is Updated Successfully\n";
          echo "\n Name: $id <br>";
          echo "\n Category: $categories <br>";
          echo "\n Password: $password <br>";
          $config->display_db();
       }
       else 
       {
          echo "Category is  not Updated Successfully";
       }
      } else 
      {
        echo "Password is incorrect";
      }
 }
 else
 {
    echo "Only POST and PUT Method is allowed";
 }
?>