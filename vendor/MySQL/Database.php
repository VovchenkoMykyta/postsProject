<?php
  
namespace MySQL;
  
class Database {
  
  static private $db;
  static protected $connectionStatus;
  
  static protected function connect () {
  
      if (self::$db && self::$connectionStatus) return;
  
      self::$db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  
      if (self::$db->connect_errno) {
        self::$connectionStatus = false;
      } else {
        self::$connectionStatus = true;
      }
      
  }
  
  static protected function insert () {}
  static protected function update () {}
  static protected function delete () {}
  static protected function select () {}
  
}