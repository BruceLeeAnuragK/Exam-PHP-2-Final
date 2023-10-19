<?php 

     class Config
     {
        private $path ="127.0.0.1";
        private $username ="root";
        private $db_name ="mysql";
        private $password ="";
        private $table_name ="industries";
        private $user_table ="users";
        private $conn;
         
        public function __construct()
        {
            $this->conn = mysqli_connect($this->path, $this->username, $this->password, $this->db_name);

            if ($this->conn->connect_error) {
                print_r("Connection failed:\n " . $this->conn->connect_error);
            }
            else
            {
               print_r("Connection is Suceessfull\n");
            } 
        }

        public function insert_db( $name, $categories,$image)
        {
           $query = "INSERT INTO $this->table_name(name,categories,image) VALUES('$name','$categories','$image')";
           $result = mysqli_query($this->conn,$query);
           
           return $result;

        }
        
        public function display_db()
        {
             $query = "SELECT * FROM $this->table_name";
             $result = mysqli_query($this->conn,$query);
             if($result)
             {
                return "Data Displayed";
             }
             else
             { 
                return "Data not Displayed";
             }
        }


        public function addUser($username,$email,$password)
        {
            $query = "INSERT INTO $this->user_table(username,email,password) VALUES('$username','$email','$password')";
            $result = mysqli_query($this->conn,$query);
            if($result)
            {
               return "User Added";
            }
            else
            { 
               return "User not Added";
            }
 
        }

        public function display_user()
        {
            $query = "SELECT * FROM $this->user_table";
            $result = mysqli_query($this->conn,$query);
            if($result)
            {
               return "User Displayed";
            }
            else
            { 
               return "User not Displayed";
            }
 
        }
        
        public function updateCategory($id,$categories)
        {
            $query = "UPDATE $this->table_name SET categories = '$categories' WHERE id = $id";
            $result = mysqli_query($this->conn,$query);
            return $result;
 
        }

        public function selectCategory()
        {
            $query ="ALTER TABLE $this->table_name ADD CONSTRAINT categories FOREIGN KEY (id) REFERENCES $this->user_table(id)";
            $result = mysqli_query($this->conn,$query);
           return $result;
        }
    }
     
?>