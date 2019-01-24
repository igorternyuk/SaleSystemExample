<?php
  class Connection{
    public function __construct($server, $dbName, $user, $password){
      $connection = mysql_connect($server, $user, $password);
    }
  }
?>
