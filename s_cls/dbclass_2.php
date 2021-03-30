<?php
class Database {
  /*This is a modular class that masks the underlying MySQL calls and provides a generic interface to its client. */
  function __construct($host, $port, $dbname, $user, $password, $transactional = true) {
    /* Ignore SSL since MySQL does not support it */
    if ($port) {
      $host = "$host:$port";
    }
    $this->Connection = mysql_connect($host, $user, $password);
    mysql_select_db($dbname, $this->Connection);
    if ($transactional){
      $this->Query("SET AUTOCOMMIT=0");
    }
  }

  function Query($sql){
    $this->Result = @mysql_query($sql, $this->Connection);
    if ($this->Result === false){
      $this->HandleError($sql);
    }
  }

  function Select($sql){
    $this->Query($sql);
  }

  function Update($sql){
    /* Right now this does the same thing as select...but it leaves room for expansion with replication */
    $this->Query($sql);
  }

  function Next($associative = True){
    /* Return the next row in the result set */
    if($associative){
      return mysql_fetch_assoc($this->Result);
    }
    else {
      return mysql_fetch_row($this->Result);
    }
  }

  function ResultLength(){
    return mysql_num_rows($this->Result);
  }

  function HandleError($sql) {
    /* This function should be overridden to provide custom error handling for the application */
    die(ErrorMessage("mysql", "MySQL Error in $sql: " . mysql_error($this->Connection)));
  }

  function Commit(){
    $this->Query("COMMIT");
  }

  function Rollback(){
    $this->Query("ROLLBACK");
  }
}

?>