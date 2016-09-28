<?php

error_reporting(false);
/** Include the database file */
include_once realpath(dirname(__FILE__) . '/db.php');

/**
 * The main class of login
 * All the necesary system functions are prefixed with _
 * examples, _login_action - to be used in the login-action.php file
 * _authenticate - to be used in every file where admin restriction is to be inherited etc...
 * @author Swashata <swashata@intechgrity.com>
 */
class itg_admin {

    /**
     * Holds the script directory absolute path
     * @staticvar
     */
    static $abs_path;

    const isSuperAdmin = 1;

    /**
     * Store the sanitized and slash escaped value of post variables
     * @var array
     */
    var $post = array();

    /**
     * Stores the sanitized and decoded value of get variables
     * @var array
     */
    var $get = array();
    var $urlToHIt;

    /**
     * The constructor function of admin class
     * We do just the session start
     * It is necessary to start the session before actually storing any value
     * to the super global $_SESSION variable
     */
    public function __construct() {
        session_start();

//store the absolute script directory
//note that this is not the admin directory
        self::$abs_path = dirname(dirname(__FILE__));

//initialize the post variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->post = $_POST;
            if (get_magic_quotes_gpc()) {
//get rid of magic quotes and slashes if present
                array_walk_recursive($this->post, array($this, 'stripslash_gpc'));
            }
        }

//initialize the get variable
        $this->get = $_GET;
//decode the url
        array_walk_recursive($this->get, array($this, 'urldecode'));
    }

    /**
     * Checks whether the user is authenticated
     * to access the admin page or not.
     *
     * Redirects to the login.php page, if not authenticates
     * otherwise continues to the page
     *
     * @access public
     * @return void
     */
    public function _authenticate() {
//first check whether session is set or not

        if (!isset($_SESSION['admin_session'])) {
            header("location: index.php");
            die();
        }
    }

    /**
     * Check for login in the action file
     */
    public function _login_action() {
//insufficient data provided
        if (!isset($this->post['email']) || $this->post['email'] == '' || !isset($this->post['password']) || $this->post['password'] == '') {
            header("location: index.php");
        }
//get the username and password
        $username = $this->post['email'];
        $password = md5(($this->post['password']));
        if ($this->_check_db($username, $password)) {
            $_SESSION['admin_session'] = 1;
            header("location: dashboard.php");
        } else {
            $_SESSION['admin_session'] = 0;
            header("location: index.php");
        }
        die();
    }

    /**
     * Check the database for login user
     * Get the password for the user
     * compare md5 hash over sha1
     * @param string $username Raw username
     * @param string $password expected to be md5 over sha1
     * @return bool TRUE on success FALSE otherwise
     */
    private function _check_db($username, $password) {
        global $db;

        $user_row = $db->get_row("SELECT * FROM `admin` WHERE `email`='" . $db->escape($username) . "'");
//general return
        if (is_object($user_row) && ($user_row->password) == $password)
            return true;
        else
            return false;
    }

    public function addState($state) {
        global $db;
        $result = array();
        $ifStateExist = 'SELECT count(*) FROM `state` WHERE `state` = "' . strtolower($state) . '"';
        $res = $db->get_results($ifStateExist, ARRAY_A);
        if ($res[0]['count(*)'] > 0) {
            $result['msg'] = 'State already exists!';
        } else {
            $insertState = "INSERT INTO `state` (`state`) "
                    . "VALUES ('" . $state . "')";
            $db->query(strtolower($insertState));
            $result['msg'] = 'State inserted!';
        }
        echo json_encode($result);
    }

    public function getStates() {
        global $db;
        $ifStateExist = 'SELECT * FROM `state`';
        $result = $db->get_results($ifStateExist, ARRAY_A);
        echo json_encode($result);
    }
    
    public function getStatesForAddData() {
        global $db;
        $ifStateExist = 'SELECT * FROM `state`';
        $result = $db->get_results($ifStateExist, ARRAY_A);
        return $result;
    }
    
    public function addDistrict($state,$district){
        global $db;
        $result = array();
        $ifStateExist = 'SELECT count(*) FROM `state` WHERE `state` = "' . strtolower($state) . '" and district = "'.  strtolower($district).'"';
        $res = $db->get_results($ifStateExist, ARRAY_A);
        if ($res[0]['count(*)'] > 0) {
            $result['msg'] = 'District already exists!';
        } else {
            $insertDistrict = "INSERT INTO `district` (`state`,`district`) "
                    . "VALUES ('" . $state . "','" . $district . "')";
            $db->query(strtolower($insertDistrict));
            $result['msg'] = 'District inserted!';
        }
        echo json_encode($result);
    }
}
