<?php

class database
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;


    //constructor
    public function __construct(
        $dbname="if19_taavi_ve_3",
        $tablename="producttb",
        $servername="localhost",
        $username="if19",
        $password="ifikas2019"
        )
        {
            $this->dbname=$dbname;
            $this->tablename=$tablename;
            $this->servername=$servername;
            $this->username=$username;
            $this->password=$password;



          // create connection
          $this->con = mysqli_connect($servername, $username, $password);

          // Check connection
          if (!$this->con){
              die("Connection failed : " . mysqli_connect_error());
          }
  
          // query
          $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
  
          // execute query
          if(mysqli_query($this->con, $sql)){
  
              $this->con = mysqli_connect($servername, $username, $password, $dbname);
  
            //create new table
            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             product_name VARCHAR (25) NOT NULL,
                             product_price FLOAT,
                             product_image VARCHAR (100)
                            );";

            if (!mysqli_query($this->con, $sql)){
                echo "Error creating table : " . mysqli_error($this->con);
            }

        }else{
            return false;
        }
    }
    // get product from database
    public function getData(){

        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}