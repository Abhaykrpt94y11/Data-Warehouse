<?php
$con=mysqli_connect("localhost","root","root");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create database
$sql = "DROP DATABASE IF EXISTS warehouse";
mysqli_query($con,$sql);
$sql="CREATE DATABASE warehouse";
if (mysqli_query($con,$sql))
  {
  echo "Database my_db created successfully <br/>";

  }
else  
  {
  echo "Error creating database: " . mysqli_error($con);
  }
// Create table
$sql="USE warehouse";
mysqli_query($con,$sql);
$sql="CREATE TABLE central_storage(
        ID INT PRIMARY KEY AUTO_INCREMENT,
				product_ID INT NOT NULL,
				quantity INT DEFAULT 0,
        batch_no varchar(10),
        mfg_date DATE,
        valid INT DEFAULT 1,
        t_stamp DATE ,
        check(quantity>=0) )";

// Execute query
if (mysqli_query($con,$sql)){
  echo "Table central_storage created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

 //table product details
 
 $sql = "CREATE TABLE product_details(
                        product_ID INT PRIMARY KEY,
                        product_name varchar(10),
                        rate INT ,
                        period INT NOT NULL
                        check(rate>=0),
                        check(quantity>=0))"; 

if (mysqli_query($con,$sql)){
  echo "Table product_details created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

$sql = "CREATE TABLE sales(
                        ID INT PRIMARY KEY AUTO_INCREMENT,
                        store_ID INT NOT NULL,
                        product_ID INT NOT NULL,
                        quantity INT,
                        t_stamp DATE,
                        check(quantity>=0),
                        check(product_ID>=1 and product_ID<=4))";

if (mysqli_query($con,$sql)){
  echo "Table sales created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

$sql = "CREATE TABLE requests(
                        ID INT PRIMARY KEY AUTO_INCREMENT,
                        store_ID INT NOT NULL,
                        product_name varchar(10),
                        quantity INT,
                        fulfilled INT DEFAULT 0,
                        check(quantity>=0))";


if (mysqli_query($con,$sql)){
  echo "Table  requests created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

  $sql =  "CREATE TABLE store_1(
                       ID INT PRIMARY KEY AUTO_INCREMENT,
                       product_name varchar(10),
                       quantity INT,
                       batch_no varchar(10),
                       expiry_date DATE,
                       received_date DATE,
                       check(quantity>=0)
                       )";
  if (mysqli_query($con,$sql)){
  echo "Table  store_1 created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

  $sql =  "CREATE TABLE store_2(
                       ID INT PRIMARY KEY AUTO_INCREMENT,
                       product_name varchar(10),
                       quantity INT,
                       batch_no varchar(10),
                       expiry_date DATE,
                       received_date DATE,
                       check(quantity>=0)
                       )";
  if (mysqli_query($con,$sql)){
  echo "Table  store_2 created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

  $sql =  "CREATE TABLE store_3(
                       ID INT PRIMARY KEY AUTO_INCREMENT,
                       product_name varchar(10),
                       quantity INT,
                       batch_no varchar(10),
                       expiry_date DATE,
                       received_date DATE,
                       check(quantity>=0)
                       )";
  if (mysqli_query($con,$sql)){
  echo "Table  store_3 created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

  $sql =  "CREATE TABLE store_4(
                       ID INT PRIMARY KEY AUTO_INCREMENT,
                       product_name varchar(10),
                       quantity INT,
                       batch_no varchar(10),
                       expiry_date DATE,
                       received_date DATE,
                       check(quantity>=0)
                       )";
  if (mysqli_query($con,$sql)){
  echo "Table  store_4 created successfully <br/>";
  }
else{
  echo "Error creating table: " . mysqli_error($con);
  }

  mysqli_close($con);
?>
