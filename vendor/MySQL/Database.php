<?php
  
namespace MySQL;
  
class Database {
  
  static private $db;
  static protected $connectionStatus;
  
  static private function connect () {
  
      if (self::$db && self::$connectionStatus) return;
  
      self::$db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  
      if (self::$db->connect_errno) {
        self::$connectionStatus = false;
      } else {
        self::$connectionStatus = true;
      }

  }
  
  static public function insert ( string $tableName, array $values) {
    
    if (!self::$db) self::connect();
    if (!self::$connectionStatus) return false;
    
    $query = "INSERT INTO `$tableName` ";

    $fieldList = array_keys($values);
    
    $query .= "(";
    
    foreach ($fieldList as $field) {
      $query .= "`$field`, ";
    }
    
    $query = substr($query, 0, -2).") ";
    
    $query .= "VALUES (";
    
    foreach ($values as $value) {
      $query .= "'".addslashes($value)."', ";
    }
    
    $query = substr($query, 0, -2).");";
    
    return self::$db->query($query);
    
  }
  
    static public function update (
          
            string $tableName,
            array $values,
            string $conditions,
            string $order = NULL,
            int $limit = NULL
  
    ) {
    
      if (!self::$db) self::connect();
      if (!self::$connectionStatus) return false;
    
      $query = "UPDATE `$tableName` SET ";
    
      foreach ($values as $fieldName => $fieldValue) {
        $query .= "`$fieldName` = '$fieldValue', ";
      }
    
      $query = substr($query, 0, -2);
    
      if ($conditions) $query .= " WHERE $conditions";
      if ($order) $query .= " ORDER BY `$order`";
      if ($limit) $query .= " LIMIT $limit";
    
      $query .= ";";
    
      self::$lastQuery = $query;
    
      $result = self::$db->query($query);
    
      self::$lastQueryStatus = $result;
    
      return $result;
    
    }
  
  static protected function delete () {}
  static protected function select () {}
  
}