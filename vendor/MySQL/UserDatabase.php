<?php

namespace MySQL;

final class UserDatabase extends Database {
  
    static public function addUser (string $login, string $password, string $repeat) {

      $errors = [];

      $passwordErrors = self::passwordVerify($password, $repeat);
      
      if ($passwordErrors) {
        $errors[] = $passwordErrors;
        return false;
      }
      
      $loginErrors = self::loginVerify($login);

      if ($loginErrors) {
        $errors[] = $loginErrors;
        return false;
      }

      static::connecct();

    }
    
    static public function removeUser (int $id, int $emitter) {

    }
    
    static private function passwordVerify (string $password, string $repeat) {
        $passErrors = [];

        if ($password !== $repeat){
            $passErrors[] = "Your password and confirm do not match";
        }
        return $passErrors;
    }
  
    static private function loginVerify (string $loginVerify) {
        $sql = static::select();
      return [];
    }

}