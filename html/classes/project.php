<?php

/**
 * This is the project class that contains all of the functions needed to manipulate a project accepted into the database
 */
class Project {

    /**
     * @var Array A single project and all of its information.
     */
    private static $project = null;

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
    public static function getProject($project_id){
        $sql = "SELECT * FROM Project where project_id = ".$project_id;
    
        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$project = self::$rs->fields;
            return self::$project;
        }
        else {
            self::$rs = null;
        }
    }
}
?>