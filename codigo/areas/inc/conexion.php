<?php 
class conexion{

  private $con;

  public function conexion(){ 
    if(!isset($this->con)){
      $this->con = (mysql_connect('localhost','gfs','lds2012'))
        or die(mysql_error());
      mysql_select_db('gfs',$this->con) or die(mysql_error());
    }
  }
  
}

?>