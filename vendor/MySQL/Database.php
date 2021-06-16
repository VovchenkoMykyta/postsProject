<?php

namespace MySQL;

/**
 * Basic class to work woth MySQL queries.
 */
class Database {

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

        // self::$db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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
     * @param int $id Id of the records to be returned. Returns all of the record if it was not provided.
     * @return array Result array with the specific record.
     */
    static public function selectOne (string $tableName, int $id = NULL) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];

        $tableName = addslashes($tableName);
        if ($id) $id = (int)addslashes($id);

        $query = "SELECT * FROM `$tableName`";

        if ($id) $query .= " WHERE `id` = '$id' LIMIT 1";

        $query .= ";";

        $result = self::$db->query($query);

        if ($result instanceof \mysqli_result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }

        if ($id) return $result[0];
        return $result;

    }

    /**
     * Select query to database. Returns all the records.
     * @param string $tableName Name of the table to send query.
     * @param string $order Name of the field to sort select query.
     * @return array Result array of the select query.
     */
    static public function selectAll (string $tableName, string $order = NULL) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];

        $tableName = addslashes($tableName);
        if ($order) $order = addslashes($order);

        $query = "SELECT * FROM `$tableName`";

        if ($order) $query .= " ORDER BY `$order`";

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
     * Select query to database with pagination.
     * @param string $tableName Name of the table to send query.
     * @param int $offset Number of the page.
     * @param int $maxRows Amount of records on one page.
     * @return array Result array of the select query.
     */
    static public function selectPage (string $tableName, int $offset, int $maxRows) {

        if (!self::$db) self::connect();
        if (!self::$connectionStatus) return [];

        $tableName = addslashes($tableName);
        $offset = (int)addslashes($offset);
        $maxRows = (int)addslashes($maxRows);

        $query = "SELECT * FROM `$tableName` LIMIT $maxRows OFFSET $offset;";

        $result = self::$db->query($query);

        if ($result instanceof \mysqli_result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }

        return $result;

    }

}
