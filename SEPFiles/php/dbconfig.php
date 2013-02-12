<?php
class DBConnection{
  function getConnection(){
    //change to your database server/user name/password
    mysql_connect("mysql.berkeleysep.com","sepdbadmin","SepDBAdmin$") or
         die("Could not connect: " . mysql_error());
    //change to your database name
    mysql_select_db("sep_main") or 
         die("Could not select database: " . mysql_error());
  }
}
?>