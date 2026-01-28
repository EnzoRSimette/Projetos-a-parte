<?php

namespace sys4soft;

use PDO;
use PDOException;
use stdClass;

//* ========================
//* = CONECTION WITH MYSQL =
//* ========================

class Database
{
    // PROPERTIES
    private $_host;
    private $_database;
    private $_username;
    private $_password;
    private $_charset;
    private $return_type;

    public function __construct($cfg_options, $return_type = 'object')
    {
        // SET CONECTION CONFIGURATIONS
        $this->_host = $cfg_options['host'];
        $this->_database = $cfg_options['database'];
        $this->_username = $cfg_options['username'];
        $this->_password = $cfg_options['password'];
        $this->_charset = $cfg_options['charset'];

        // SET THE RETURN TYPE
        if (!empty($return_type) && $return_type == 'object') { // VERIFY IF THE RETURN IS A OBJECT
            $this->return_type = PDO::FETCH_OBJ; // RETURN OBJECT
        } else {
            $this->return_type = PDO::FETCH_ASSOC; // RETURN ASSOCIATIVE ARRAY
        }
    }

    private function _result($status, $message, $sql, $results, $affected_rows, $last_id)
    {
        $tmp = new stdClass();
        $tmp->status = $status;
        $tmp->message = $message;
        $tmp->query = $sql;
        $tmp->results = $results;
        $tmp->affected_rows = $affected_rows;
        $tmp->last_id = $last_id;
        return $tmp;
    }

    public function execute_non_query($sql, $parameters = null)
    {

        // EXECUTES A QUERY WITHOUT RESULTS
        // CONECTION
        $conection = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=' . $this->_charset,
            $this->_username,
            $this->_password,
            [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true]
        );

        // INIT TRANSACTION
        $conection->beginTransaction();

        // PREPARE AND EXECUTE THE QUERY
        try {
            $db = $conection->prepare($sql);
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }

            // LAST INSERTED ID
            $last_inserted_id = $conection->lastInsertId();

            // FINISH TRANSACTION
            $conection->commit();
        } catch (PDOException $ex) {
            // UNDO ALL SQL OPERATIONS ON ERROR
            $conection->rollBack();
            $conection = null;
            return $this->_result('Error:', $ex->getMessage(), $sql, null, 0, null);
        }
        // CLOSE CONNECTION
        $conection = null;
        return $this->_result('SUCESS', 'sucess', $sql, null, $db->rowCount(), $last_inserted_id);
    }

    public function execute_query($sql, $parameters = null)
    {
        // EXECUTE A QUERY WITH RESULTS
        // CONECTION
        $conection = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=' . $this->_charset,
            $this->_username,
            $this->_password,
            [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true]
        );

        $results = null;

        try {
            $db = $conection->prepare($sql);
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }
            $results = $db->fetchAll($this->return_type);
        } catch (PDOException $ex) {
            $conection = null;
            return $this->_result('Error:', $ex->getMessage(), $sql, null, 0, null);
        }

        // CLOSE CONNECTION
        $conection = null;
        return $this->_result('SUCESS', 'sucess', $sql, $results, $db->rowCount(), null);
    }
}
