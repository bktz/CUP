<?php

/**
 * ADODB Connection class
 * @author Benjamin Katznelson
 */
class Data {
    private static $_db = null;
    private static $_salt = 'odMyB5g#du';

    protected function __construct() {
    }

    /**
     * This function returns the database connection object
     * @return Object Database Connection
     */
    public static function DB() {
        if (null === self::$_db) {
            include_once(LIBRARY_PATH.'adodb5/adodb.inc.php');

            //$_conn = 'mysql://farm2fork:telephone@131.104.49.207/farm-to-fork';
            //$_conn = 'mysql://farm2fork:telephone@localhost/farm_db'; live version
            self::$_db = &ADONewConnection($_conn);
            if (self::$_db==false) {
                die('Could not connect to the database.');
            }

        }

        return self::$_db;
    }

    public static function SALT() {
        return self::$_salt;
    }
}

?>
