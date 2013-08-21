<?php

/**
 * This is the project info class that contains all of the functions needed to manipulate the information for a project or application either via creating it or modifying it
 */
class ProjectInfo {

    /**
     * @var Array A single application and all of its information.
     */
    private static $projectInfo = null;

    /**
     *  @var Object Connection object that contains the prototype of the object (before update) so that we know what has changed when updating.
     */
    private static $rs = null;

    public function __construct() {
    }

    /**
     * This function is used to create new projectInfo for an application or project or simply update it, these arguments mirror the fields of the 
     * projectInfo table
     * @param unknown $appId
     * @param unknown $projectId
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
    public static function createProjectInfo($appId,$projectId,$userid,$title,$projectContactFirst,$projectContactLast,$projectContactEmail,$projectContactPhone,
            $projectContactPhoneExt,$description,$location,$expectedTime,$motivation,$resources,$constraints){
        
        self::emptyProjectInfo();
        
        self::$projectInfo['app_id'] = $app_id;
        self::$projectInfo['project_id'] = $project_id;
        self::$projectInfo['user_id'] = $userid;
        self::$projectInfo['title'] = $title;
        self::$projectInfo['$project_contact_first'] = $projectContactFirst;
        self::$projectInfo['project_contact_last'] = $projectContactLast;
        self::$projectInfo['project_contact_email'] = $projectContactEmail;
        self::$projectInfo['project_contact_phone'] = $projectContactPhone;
        self::$projectInfo['project_contact_phone_ext'] = $projectContactPhoneExt;
        self::$projectInfo['$description'] = $description;
        self::$projectInfo['$location'] = $location;
        self::$projectInfo['$expectedTime'] = $expectedTime;
        self::$projectInfo['$motivation'] = $motivation;
        self::$projectInfo['$resources'] = $resources;
        self::$projectInfo['$constraints'] = $constraints;
        
        $insertQuery = Data::DB()->GetInsertSQL(self::$rs, self::$projectInfo);
        self::$rs = Data::DB()->Execute($insertQuery);
        
        if(self::$rs == null){
            return null;
        }
    }

    /**
     * fetches a empty projectInfo record from the database for createProjectInfo to fill
     */
    private static function emptyProjectInfo() {
    
        $sql = "SELECT * FROM projectInfo p WHERE p.info_id = '0' LIMIT 1";
    
        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$projectInfo = self::$rs->fields;
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