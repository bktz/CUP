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
     * @var Array A group of one or more projects meeting search criteria all all their information.
     */
    private static $projects = null;

    /**
     *  @var Object Connection object that contains the prototype of the object (before update) so that we know what has changed when updating.
     */
    private static $rs = null;

    public function __construct() {
    }

    public static function createProject($userId,$appID,$title,$projectContactFirst,$projectContactLast,$projectContactEmail,$projectContactPhone,
            $projectContactPhoneExt,$description,$location,$expectedTime,$motivation,$resources,$constraints){
    
        self::emptyApplication();
    
        self::$project['user_id'] = $userId;
        self::$project['app_id'] = $appId;
        
        $insertQuery = Data::DB()->GetInsertSQL(self::$rs, self::$application);
        self::$rs = Data::DB()->Execute($insertQuery);
    
        if(self::$rs == null){
            return null;
        }
    
        $projectId = DB()->insertID(); //retrieves the last autoincremented field inserted
        createProjectInfo($appId,$projectId,$userid,$title,$projectContactFirst,$projectContactLast,$projectContactEmail,$projectContactPhone,
        $projectContactPhoneExt,$description,$location,$expectedTime,$motivation,$resources,$constraints);
    }
    
    /**
     * fetches a empty project record from the database for createProject() to fill
     */
    public static function emptyApplication(){
    
        $sql = "SELECT * FROM Projects     p WHERE p.project_id = '0' LIMIT 1";
    
        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$project = self::$rs->fields;
        } else {
            self::$rs = null;
        }
    }
    
    /**
     * Retrieves a specific project from the database
     * @param unknown $project_id
     */
    public static function getProject($project_id){
        $sql = "SELECT * FROM Projects where project_id = ".$project_id;

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$project = self::$rs->fields;
            return self::$project;
        }
        else {
            self::$rs = null;
        }
    }

    public static function getProjectList($searchString,$tags){

        $regExpSearch = toRegExpString($searchString);
        $sqlInner = "SELECT * FROM Projects p, ProjectInfo i, where p.project_id = i.project_id AND i.title REGEXP '".$regExpSearch."'";

        $regExpTags = toRegExpList($searchString);
        $sqlOuter = "SELECT * FROM tagged";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$project = self::$rs->fields;
            return self::$project;
        }
        else {
            self::$rs = null;
        }
    }

    /**
     * Takes in the search string and converts it to a regular expression for sql REGEXP '' calls, assumes string is delimited by spaces
     * @param string $searchString the string to concatenate and delimit with '|'
     * @return the regular expression matching the users search
     */
    public static function toRegExpString($searchString){

        $searchString = preg_replace('!\s+!', '|', $searchString);
        return $searchString;
    }

    /**
     * Takes in a php list object and converts it to a regular expression for sql REGEXP '' calls
     * @param unknown $tags
     * @return unknown
     */
    public static function toRegExpList($tags){

        $tags = implode('|', $tags);

        return $tags;
    }

}
?>