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
     * This function is used to create new application, most of these arguments mirror the fields of the projectInfo table and hand over the projectInfo class for
     * insertion into the database there 
     * @param unknown $userid
     * @param unknown $title
     * @param unknown $projectContactFirst
     * @param unknown $projectContactLast
     * @param unknown $projectContactEmail
     * @param unknown $projectContactPhone
     * @param unknown $projectContactPhoneExt
     * @param unknown $description
     * @param unknown $location
     * @param unknown $expectedTime
     * @param unknown $motivation
     * @param unknown $resources
     * @param unknown $constraints
     * @return NULL
     */
    public static function createApplication($userId,$title,$projectContactFirst,$projectContactLast,$projectContactEmail,$projectContactPhone,
            $projectContactPhoneExt,$description,$location,$expectedTime,$motivation,$resources,$constraints){

        self::emptyApplication();

        self::$application['app_id'] = null;
        self::$application['user_id'] = $userId;
        
        $insertQuery = Data::DB()->GetInsertSQL(self::$rs, self::$application);
        self::$rs = Data::DB()->Execute($insertQuery);
        
        if(self::$rs == null){
            return null;
        }
        
        $app_id = DB()->insertID(); //retrieves the last autoincremented field inserted
        createProjectInfo($appId,null,$userId,$title,$projectContactFirst,$projectContactLast,$projectContactEmail,$projectContactPhone,
            $projectContactPhoneExt,$description,$location,$expectedTime,$motivation,$resources,$constraints);
    }

    /**
     * fetches a empty application record from the database for createApplication() to fill
     */
    public static function emptyApplication(){
        
        $sql = "SELECT * FROM Applications a WHERE a.app_id = '0' LIMIT 1";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$application = self::$rs->fields;
        } else {
            self::$rs = null;
        }
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