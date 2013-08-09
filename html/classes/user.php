<?php

/**
 * This is the user class that conaitsn, update & creates all the information needed for a user.
 * This class requires the database class.
 */
class User {
    /* containts all the user information */

    private static $user = null;
    private static $users = null;
    /* containts the prototype of a user (before update) so that we know what has changed when updating a user */
    private static $rs = null;

    /**
     * This is the user class, it contains all the information that has been saved for a user in the database.
     *
     */
    public function __construct() {
        include_once(CLASSES_PATH.'db.php');
    }

    /**
     * This function uses an email and a password to lookup a user in the database and then saves that information into the user variable.
     * @param type $email The email of the user to look up in the database
     * @param type $password The password entered by the user to look up in the database.
     * @return boolean true if the user exists, false otherwise
     */
    public static function getUser($email, $password) {

        $pass = self::hashPassword($password);

        $sql = "SELECT * FROM User u WHERE u.email = '" . $email . "' AND password = '" . $pass . "' LIMIT 1";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$user = self::$rs->fields;
            return true;
        } else {
            self::$rs = null;
            return false;
        }
    } /**
    * This function queries the database for all the pantries and returns them as a 2d array.
    * @return Array An array of all the users and all of their information.
    */
    public static function getAllUsers(){
         
        $sql = "SELECT * FROM User order by user_id";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$users = self::$rs->getall();
            return self::$users;
        }
        else {
            self::$rs = null;
        }
    }

    /**
     * This function logs in the user of the guelph single sign on service
     * @param type $email The email of the user to look up in the database
     * @param unknown $SSID the unique key for that user from their single sign on account
     * @return boolean true if the user exists, false otherwise
     */
    public static function getSingalSignOnUser($email, $SSID) {

        $sql = "SELECT * FROM Users u, SingleSignOn s WHERE u.email = '" . $email . "' AND s.SSID = '" . $SSID . "' LIMIT 1";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$user = self::$rs->fields;
            return true;
        } else {
            self::$rs = null;
            return false;
        }
    }

    /**
     * This function gets the user based on a user_id and saves the information into the local $user variable. If no user is found, the user variable is set to null.
     * @param String $user_id The user_id of a user in the user table.
     */
    public static function getUserId($user_id) {

        $sql = "SELECT * FROM User WHERE user_id = '" . $user_id . "' LIMIT 1";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$user = self::$rs->fields;
        } else {
            self::$rs = null;
        }
    }

    /**
     * This function checks what has been changed in the user and updates those specific fields.
     */
    public static function updateUser() {
        //        self::$rs->fields = self::$user;
        $updateQuery = Data::DB()->GetUpdateSQL(self::$rs, self::$user);
        $rs = Data::DB()->Execute($updateQuery);
    }

    /**
     * This function creates a user and inserts it into the database.
     * @param String $email User email address.
     * @param String $password User password (unhashed).
     * @param Boolean $is_farmer 1 for farmer, 0 for regular user.
     * @param Boolean $is_newsletter 1 for newsletter signup, otherwise 0.
     * @param String $first_name User first name.
     * @param String $last_name User last name.
     * @param String $phone_number User phone number.
     * @param String $address User address.
     * @param String $city User city.
     * @param String $postal_code User postal Code.
     * @param String $provice_state Enum state or prove ('ON','AB','BC','NB','NL','NS','NU','PE','QC','SK','YT','MB','NT')
     * @param String $socialNetworkName the name of the social media site that the account was created with
     * @param Int $socialNetwork_id the user_id of the signed up account from the social media API
     * @return User returns null if required fields are missing or if a record was not inserted.
     */
    public static function createUser($userType,$email,$password,$firstName=null,$lastName=null,$organization=null,$phoneNo=null,$phoneNoExt=null,$address=null,$city=null,$postalCode=null,$province=null,$SSID=null) {

        //verify minimum user accout requirements
        if ($email == null || ($password == null && $SSID == null) || (($first_name == null && $last_name == null) || $organization==null)) {
            return null;
        } else {

            self::emptyUser();

            self::$user['user_id'] = null;
            self::$user['user_type'] = $userType;
            self::$user['email'] = $email;
            self::$user['password'] = self::hashPassword($password);
            self::$user['first_name'] = $firstName;
            self::$user['last_name'] = $lastName;
            self::$user['organization'] = $organization;
            self::$user['phone_number'] = $phoneNo;
            self::$user['phone_number_ext'] = $phoneNoExt;
            self::$user['address'] = $address;
            self::$user['city'] = $city;
            self::$user['postal_code'] = $postalCode;
            self::$user['province'] = $provice;
            self::$user['SSID'] = $SSID;
            
            $insertQuery = Data::DB()->GetInsertSQL(self::$rs, self::$user);
            self::$rs = Data::DB()->Execute($insertQuery);

            if($SSID != null)
            {
                /*$sql = "SELECT user_id FROM User WHERE email=\"$email\"";
                $new_user = Data::DB()->Execute($sql);

                $socialNetwork = array();
                $socialNetwork['socialNetwork_id'] = $socialNetwork_id;
                $socialNetwork['User_id'] = $new_user->fields[0];
                $socialNetwork['SocialNetworkName'] = $socialNetworkName;
                $socialNetwork['OAUTH_id'] = $access_token;

                $sql = "SELECT * FROM SocialNetwork WHERE User_id = '0' LIMIT 1";
                $rs = Data::DB()->Execute($sql);

                $insertQuery = Data::DB()->GetInsertSQL($rs,$socialNetwork);
                Data::DB()->Execute($insertQuery);*/
            }
            if(self::$rs == null){
                return null;
            }
        }
    }

    private static function emptyUser() {

        $sql = "SELECT * FROM User u WHERE u.user_id = '0' LIMIT 1";

        self::$rs = Data::DB()->Execute($sql);
        if (!self::$rs->EOF) {
            self::$user = self::$rs->fields;
        } else {
            self::$rs = null;
        }
    }

    public static function hashPassword($pass) {
        return hash('sha256', Data::SALT() . $pass);
    }

    /**
     * This function take the password that was provided, salts it, and hashes the password. Run the updateUser function aftewards
     * to save the new password for the user in the database.
     * @param type $pass The new password to set
     */
    public static function setPassword($pass) {
        self::$user['password'] = self::hashPassword($pass);
    }

    /**
     * This function updates a value of an attirbute for a user. (DO NOT USE THIS TO SET UPDATE THE PASSWORD!)
     * @param type $attribute The attribute to set (eg. first_name) This is the name of the column in the User table in the database
     * @param type $value The value to set for that attribute (eg. John)
     */
    public static function setAttribute($attribute, $value) {
        self::$user[$attribute] = $value;
    }

    /**
     * This function is a getter for the user varaiable
     * @return Array Of all the user information from the database
     */
    public static function getUserInfo() {
        return self::$user;
    }

    /**
     * This function set the the user variable within the object.
     * @param Array $user The user variable to be set
     */
    public static function setUserInfo($user) {
        self::$user = $user;
    }

    /**
     * This function checks if the password that is curretnly in the object matches the password passed in as a variable.
     * @param type $pass The password to check.
     * @return boolean true if password is a match otherwise false.
     */
    public static function verifyPassword($pass){
        if(self::$user[password] == self::hashPassword($pass)){
            return true;
        }
        else{
            return false;
        }
    }

}
