<?php

/**
 * This is the application class that contains all of the functions needed to manipulate a project application not visible in the database except to brokers
 */
class Application {

    /**
     * @var Array A single application and all of its information.
     */
    private static $application = null;

    /**
     *  @var Object Connection object that contains the prototype of the object (before update) so that we know what has changed when updating.
     */
    private static $rs = null;

    public function __construct() {
    }
    
    /**
     * Retrieves a specific project from the database
     * @param unknown $project_id
     */
    public static function getApplication($app_id){
        $sql = "SELECT * FROM Application where app_id = ".$app_id;
    
        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$application = self::$rs->fields;
            return self::$application;
        }
        else {
            self::$rs = null;
        }
    }
}
?>