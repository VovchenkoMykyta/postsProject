<?php

namespace MySQL;

final class UserDatabase extends Database {

    static private $tableName = "users";

    static public function addUser(string $login, string $password, string $repeat) {

        $errors = [];

        $passwordErrors = self::passwordVerify($password, $repeat);
        if ($passwordErrors) $errors[] = $passwordErrors;

        $loginErrors = self::loginVerify($login);
        if ($loginErrors) $errors[] = $loginErrors;

        if ($errors) return $errors;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $insertResult = static::insert(
            self::$tableName,
            ["login" => $login, "password" => $passwordHash]
        );

        if (!$insertResult) $errors[] = "Server database error";

        return $errors;

    }

    static public function removeUser(int $id, int $emitterId) {

        if ($id = $emitterId) return ["You can not delete yourself"];

        $deleteResult = static::delete( self::$tableName, $id);

        if (!$deleteResult) return ["Server database error"];

        return [];

    }

    static public function getUserList() {

        $selectResult = static::select(self::$tableName);

        if (!$selectResult) return [];

        return $selectResult;

    }

    static private function passwordVerify(string $password, string $repeat) {
        return [];
    }

    static private function loginVerify(string $login) {
        return [];
    }

}
