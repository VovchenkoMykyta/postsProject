<?php

namespace MySQL;

/**
 * Basic class to work woth MySQL queries.
 */
abstract class Database {

    /**
     * Connection to database.
     * @var mysqli $db
     */
    static private $db;

    /**
     * Bool status of any errors due to connection to database.
     * @var bool $connectionStatus 
     */
    static protected $connectionStatus;

    /**
     * Connerct to database if connection was not made before.
     * @return void
     */
    static private function connect() {

        if (self::$db && self::$connectionStatus) return;

        self::$db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (self::$db->connect_errno) {
            self::$connectionStatus = false;
        } else {
            self::$connectionStatus = true;
        }

    }

    /**
     * Insert query to database. Only one insert item per query.
     * @param string $tableName Name of the table to send query.
     * @param array $values Keys of the array will become names of the fields.
     * @return bool Result of the query.
     */
    static public function insert (string $tableName, array $values) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return false;

        $tableName = addslashes($tableName);

        $query = "INSERT INTO `$tableName` ";

        $fieldList = array_keys($values);

        $query .= "(";

        foreach ($fieldList as $field) {
            $query .= "`$field`, ";
        }

        $query = substr($query, 0, -2) . ") ";

        $query .= "VALUES (";

        foreach ($values as $value) {
            $query .= "'" . addslashes($value) . "', ";
        }

        $query = substr($query, 0, -2) . ");";

        return self::$db->query($query);

    }

    /**
     * Update query to database.
     * @param string $tableName Name of the table to send query.
     * @param array $values Values of the query. Keys of the array will become names of the fields.
     * @param int $id Id of the records to be updated by the query.
     * @return bool Result of the query.
     */
    static public function update (string $tableName, array $values, int $id) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return false;

        $tableName = addslashes($tableName);
        $id = addslashes($id);

        $query = "UPDATE `$tableName` SET ";

        foreach ($values as $fieldName => $fieldValue) {
            $query .= "`$fieldName` = '" . addslashes($fieldValue) . "', ";
        }

        $query = substr($query, 0, -2);

        $query .= " WHERE `id` = '$id' LIMIT 1;";

        $result = self::$db->query($query);

        return $result;

    }

    /**
     * Delete query to database.
     * @param string $tableName Name of the table to send query.
     * @param int $id Id of the records to be deleted by the query.
     * @return bool Result of the query.
     */
    static public function delete (string $tableName, int $id) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return false;

        $tableName = addslashes($tableName);
        $id = (int)addslashes($id);

        $query = "DELETE FROM `$tableName` WHERE `id` = '$id' LIMIT 1;";

        $result = self::$db->query($query);

        return $result;

    }

    /**
     * Select query to database. Returns one record only.
     * @param string $tableName Name of the table to send query.
     * @param string $fieldName Name of the field to limit result. Can be used only with $fieldValue.
     * @param string $fieldValue Value of the field to limit resuld. Can be used only with $fieldName.
     * @return array Result array with the specific record.
     */
    static public function selectOne (string $tableName, string $fieldName, string $fieldValue) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];

        $tableName = addslashes($tableName);
        $fieldName = addslashes($fieldName);
        $fieldValue = addslashes($fieldValue);

        $query = "SELECT * FROM `$tableName` WHERE `$fieldName` = '$fieldValue' LIMIT 1;";

        $result = self::$db->query($query);

        if ($result instanceof \mysqli_result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }

        return $result ? $result[0] : [];

    }

    /**
     * Select query to database. Returns all the records.
     * @param string $tableName Name of the table to send query.
     * @param string $orderField Name of the field to sort select query.
     * @param string $orderDirection ASC or DESC direction of the result.
     * @return array Result array of the select query.
     */
    static public function selectAll (string $tableName, string $orderField = NULL, string $orderDirection = NULL) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];

        $tableName = addslashes($tableName);
        if ($orderField) $orderField = addslashes($orderField);
        if ($orderDirection) $orderDirection = addslashes($orderDirection);

        $query = "SELECT * FROM `$tableName`";

        if ($orderField && $orderDirection) {
            $query .= " ORDER BY `$orderField` $orderDirection";
        } else if ($orderField) {
            $query .= " ORDER BY `$orderField`";
        }

        $query .= ";";

        $result = self::$db->query($query);

        if ($result instanceof \mysqli_result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }

        return $result;

    }
    
    /**
     * Select query to database. Returns all the records matching conditions.
     * @param string $tableName Name of the table to send query.
     * @param string $fieldName Name of the field to restrict result.
     * @param string $fieldValue Value of the field to restrict result.
     * @return array Result array of the select query. Or empty array.
     */
    static public function selectByField (string $tableName, string $fieldName, string $fieldValue) {
        
        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];
        
        $tableName = addslashes($tableName);
        $fieldName = addslashes($fieldName);
        $fieldValue = addslashes($fieldValue);
        
        $query = "SELECT * FROM `$tableName` WHERE `$fieldName` = '$fieldValue';";
        
        $result = self::$db->query($query);
        
        if ($result instanceof \mysqli_result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
        
        return $result;
        
    }

    /**
     * Select query to database with pagination.
     * @param string $tableName Name of the table to send query.
     * @param string $orderField Name of the field to sort select query.
     * @param string $orderDirection ASC or DESC direction of the result.
     * @param int $offset Number of the page.
     * @param int $maxRows Amount of records on one page.
     * @return array Result array of the select query.
     */
    static public function selectPage (

        string $tableName,
        string $orderField,
        string $orderDirection,
        int $offset,
        int $maxRows

    ) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];

        $tableName = addslashes($tableName);
        $offset = (int)addslashes($offset);
        $maxRows = (int)addslashes($maxRows);

        $query = "SELECT * FROM `$tableName` ORDER BY `$orderField` $orderDirection LIMIT $maxRows OFFSET $offset;";

        $result = self::$db->query($query);

        if ($result instanceof \mysqli_result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }

        return $result;

    }

}
