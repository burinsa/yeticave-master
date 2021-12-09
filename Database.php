<?php

class Database {
  private $db_resourse;
  private $last_error = null;
  private $last_result;

  public function __construct() {
    $this->db_resourse = mysqli_connect(DB_CONFIG['host'], DB_CONFIG['user'], DB_CONFIG['password'], DB_CONFIG['database'], DB_CONFIG['port']);
    mysqli_set_charset($this->db_resourse, "utf8");

    if (!$this->db_resourse) {
      $this->last_error = mysqli_connect_error();
    }
  }

  public function executeQuery($sql, $data = []) {
    $this->last_error = null;
    $stmt = db_get_prepare_stmt($this->db_resourse, $sql, $data);

    if (mysqli_stmt_execute($stmt) && $r = mysqli_stmt_bind_result($stmt)) {
      $this->last_result = $r;
      $res = true;
    } else {
      $this->last_error = mysqli_error($this->db_resourse);
      $res = false;
    }
    return $res;
  } 
  public function getLastError() {
    return $this->last_error;
  }

  public function getResultsAsArray(){
    return mysqli_fetch_all($this->last_result, MYSQLI_ASSOC);
  }

  public function getResultAsArray() {
    return mysqli_fetch_assoc($this->last_result);
  }

  public function getLastId(){
    return mysqli_insert_id($this->db_resourse);
  }
  
	public function getNumRows() {
		return mysqli_num_rows($this->last_result);
	}
  
}
