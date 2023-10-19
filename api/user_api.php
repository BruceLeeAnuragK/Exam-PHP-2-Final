<?php 
 header("Access-Control-Allow-Origin: POST"); 
 header("Content-Type: application/json");
 
 include("../config/config.php");

 $config= new Config();

 $record = array();

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
    
     $username = $_POST["username"];
     $email = $_POST["email"];
     $password = $_POST["password"];
     $obj = $config->addUser($username,$email,$password);
     
     if($obj)
     {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $password = $_POST['password'];
        if(password_verify($password, $hashedPassword)) 
          {
           echo "Password is correct";
           $config->display_user();
           echo "\n Userame: $username <br>";
           echo "\n Email: $email <br>";
           echo "\n Password: $password <br>";
           
          } else 
          {
            echo "Password is incorrect";
          }
            echo "The User Added Successfully";
     }
     else{
           
        echo "The User not Added Successfully";
        $config->display_user();
     }
 }
 else
 {
    echo "Only Post Method is allowed";
 }
?>
