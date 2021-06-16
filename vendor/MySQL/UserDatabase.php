<?php

namespace MySQL;

/**
 * Extended class to work with users database.
 */
final class UserDatabase extends Database {

    /**
     * Name of the current table.
     * @var string $tableName
     */
    static private $tableName = "users";

    /**
     * Adding a new user to database.
     * @param string $login Login of the future user.
     * @param string $password Password of the future user.
     * @param string $repeat Password verification.
     */
    static public function addUser (string $login, string $password, string $repeat) {

        $errors = [];

        $passwordErrors = self::passwordVerify($password, $repeat);
        if ($passwordErrors) $errors[] = $passwordErrors;

        $loginErrors = self::loginVerify($login);
        if ($loginErrors) $errors[] = $loginErrors;

        $isUserExist = self::getUserByLogin($login);
        if ($isUserExist) $errors[] = "User with this name already exists";

        if ($errors) return $errors;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $insertResult = static::insert(
            self::$tableName,
            ["login" => $login, "password" => $passwordHash]
        );

        if (!$insertResult) $errors[] = "Server database error";

        return $errors;

    }

    /**
     * Remove user from database by id.
     * @param int $id Id of the user to be deleted.
     * @param int $emitterId Id of the user who trying to delete.
     * @return array Returns empty array in case of successfull delete. Or array with error.
     */
    static public function removeUser (int $id, int $emitterId) {

        if ($id === $emitterId) return ["You can not delete yourself"];

        $isUserExist = self::getUserById($id);

        if (!$isUserExist) return ["This user does not exist"];

        $deleteResult = static::delete( self::$tableName, $id);

        if (!$deleteResult) return ["Server database error"];

        return [];

    }

    /**
     * Get list of all users in database.
     * @param string $orderField Name of the field to sort result.
     * @param string $orderDirection Direction of the sorted result. ASC or DESC only.
     * @return array Returns result array or empty array.
     */
    static public function getUserList (string $orderField = NULL, string $orderDirection = NULL) {

        if ($orderDirection !== "DESC" && $orderDirection !== "ASC") return [];

        if ($orderField && $orderDirection) {
            $selectResult = static::selectAll(self::$tableName, $orderField, $orderDirection);
        } else if ($orderField) {
            $selectResult = static::selectAll(self::$tableName, $orderField);
        } else {
            $selectResult = static::selectAll(self::$tableName);
        }

        if (!$selectResult) return [];

        return $selectResult;

    }

    /**
     * Get one user by id.
     * @param int $id Id of the user to search.
     * @return array Returns array with user data or empty array.
     */
    static private function getUserById (int $id) {
        
        return static::selectOne(self::$tableName, "id", $id);

    }

    /**
     * Get one user by login.
     * @param string $login Login of the user to search.
     * @return array Returns array with user data or empty array.
     */
    static private function getUserByLogin (string $login) {
        
        return static::selectOne(self::$tableName, "login", $login);

    }

    /**
     * Verification of the user password.
     * @param string $password Password to verificate.
     * @param string $repeat Repeat of the password to verificate.
     * @return array Return array with errors or empty array.
     */
    static private function passwordVerify (string $password, string $repeat) {

        $errors = [];

        if ($password !== $repeat) $errors[] = "Passwords do not match";

        if (strlen($password) < 6) $errors[] = "Password is too short";

        $passwordArray = explode("", $password);

        $oneLowerCase = false;
        foreach ($passwordArray as $letter) {
            if ($letter === strtolower($letter)) {
                $oneLowerCase = true;
                break;
            }
        }

        if (!$oneLowerCase) $errors[] = "Password needs to contain one lower case letter";

        $oneUpperCase = false;
        foreach ($passwordArray as $letter) {
            if ($letter === strtoupper($letter)) {
                $oneUpperCase = true;
                break;
            }
        }

        if (!$oneUpperCase) $errors[] = "Password needs to contain one upper case letter";

        $oneNumber = false;
        foreach ($passwordArray as $letter) {
            if ($letter === intval($letter)) {
                $oneNumber = true;
                break;
            }
        }

        if (!$oneNumber) $errors[] = "Password needs to contain one upper case letter";

        return $errors;
    }

    /**
     * Verification of the user login.
     * @param string $password Login to verificate.
     * @return array Return array with errors or empty array.
     */
    static private function loginVerify (string $login) {
        
        $errors = [];

        if (strlen($login) < 6) $errors[] = "Login is too short";

        return $errors;

    }

}
