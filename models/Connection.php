<?php
  class Connection{
    private $server;
    private $dbName;
    private $user;
    private $password;
    private $connection;

    public function __construct($server, $dbName, $user, $password){
      $this->server = $server;
      $this->dbName = $dbName;
      $this->user = $user;
      $this->password = $password;
    }

    public function connect(){
      $this->connection = mysqli_connect($this->server, $this->user,
       $this->password, $this->dbName);
      mysqli_set_charset($this->connection, "utf8");
      if(mysqli_connect_errno()){
        echo "Could not connect to the database ".mysqli_connect_error();
      }
    }

    public function disconnect(){
      $this->connection->close();
    }

    public function execute($query){
      return $this->connection->query($query);
    }
  }
?>
