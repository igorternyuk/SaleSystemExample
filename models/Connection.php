<?php
  class Connection{
    private $connection;
    public function __construct($server, $dbName, $user, $password){
      $this->connection = mysqli_connect($server, $user, $password, $dbName);
      mysqli_set_charset($this->connection, "utf8");
      if(mysqli_connect_errno()){
        echo "Could not connect to the database ".mysqli_connect_error();
      }
    }

    public function execute($query){
      return $this->connection->query($query);
    }
  }
?>
