<?php
/*Update under Database and values in cookie_decrypt() function with your site's values*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */
$cms = "laravel-5";
$dbms = "mysql";
define('SET_SESSION_NAME','');			// Session name
define('SWITCH_ENABLED','1');
define('INCLUDE_JQUERY','1');
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($dbms == "mssql" && file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.'sqlsrv_func.php')){
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'sqlsrv_func.php');
}

// if(file_exists(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php')){
// 	include_once( dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php');
// 	include_once( dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'app.php');
// 	if(file_exists(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'Auth'.DIRECTORY_SEPARATOR.'app.php')){
// 		include_once( dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'Auth'.DIRECTORY_SEPARATOR.'app.php');
// 	}
// 	$db = include_once( dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.php');
// }
/* DATABASE */
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',			'localhost'				); // Database host
define('DB_PORT',			"3306"											); // Database port
define('DB_USERNAME',		'jobcallme'		); // Database username
define('DB_PASSWORD',		'jcm1411'			); // Database password
define('DB_NAME',			'jobcallme'			); // Database name


$table_prefix = 'jcm_';									// Table prefix(if any)
$db_usertable = 'users';							// Users or members information table name
$db_usertable_userid = 'userId';						// UserID field in the users or members table
$db_usertable_name = 'username';					// Name containing field in the users or members table
$db_avatartable = ' ';
$db_avatarfield = ' '.$table_prefix.$db_usertable.'.profilePhoto ';
$db_linkfield = ' '.$table_prefix.$db_usertable.'.'.$db_usertable_userid.' ';

/*COMETCHAT'S INTEGRATION CLASS USED FOR SITE AUTHENTICATION */

class Integration{

	function __construct(){
		if(!defined('TABLE_PREFIX')){
			$this->defineFromGlobal('table_prefix');
			$this->defineFromGlobal('db_usertable');
			$this->defineFromGlobal('db_usertable_userid');
			$this->defineFromGlobal('db_usertable_name');
			$this->defineFromGlobal('db_avatartable');
			$this->defineFromGlobal('db_avatarfield');
			$this->defineFromGlobal('db_linkfield');
		}
	}

	function defineFromGlobal($key){
		if(isset($GLOBALS[$key])){
			define(strtoupper($key), $GLOBALS[$key]);
			unset($GLOBALS[$key]);
		}
	}


	function getUserID() {
		$userid = 0;
		if (!empty($_SESSION['basedata']) && $_SESSION['basedata'] != 'null') {
			$_REQUEST['basedata'] = $_SESSION['basedata'];
		}

		if (!empty($_REQUEST['basedata'])) {
			if (function_exists('mcrypt_encrypt') && defined('ENCRYPT_USERID') && ENCRYPT_USERID == '1') {
				$key = "";
				if( defined('KEY_A') && defined('KEY_B') && defined('KEY_C') ){
					$key = KEY_A.KEY_B.KEY_C;
				}
				$uid = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(rawurldecode($_REQUEST['basedata'])), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
				if (intval($uid) > 0) {
					$userid = $uid;
				}
			} else {
				$userid = $_REQUEST['basedata'];
			}
		}
		// if (!empty($_COOKIE['laravel_session'])) {
		// 	$app = app();
		// 	$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
		// 	$response = $kernel->handle(
		// 		$request = Illuminate\Http\Request::capture()
		// 		);
		// 	$id = $app['encrypter']->decrypt($_COOKIE[$app['config']['session.cookie']]);
		// 	$app['session']->driver()->setId($id);
		// 	$app['session']->driver()->start();
		// 	if($app['auth']->user()!= NULL || !empty($app['auth']->user())){
		// 		$user_details = $app['auth']->user();
		// 		$userid = $user_details['user_id'];
		// 	}
		// }
		$userid = intval($userid);
		// echo getUserDetails($userid); die();
		return $userid;
	}

	function chatLogin($userName,$userPass) {

		$userid = 0;
		global $guestsMode;

		if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
			$sql = ("SELECT * FROM `".TABLE_PREFIX.DB_USERTABLE."` WHERE email = '".sql_real_escape_string($userName)."'");
		} else {
			$sql = ("SELECT * FROM `".TABLE_PREFIX.DB_USERTABLE."` WHERE username = '".sql_real_escape_string($userName)."'");
		}
		$result = sql_query($sql, array(), 1);
		$row = sql_fetch_assoc($result);

		$salted_password = md5($row1['value'].$userPass.$row['salt']);
		if ($row['password'] == $salted_password) {
			$userid = $row['user_id'];
		}
		if(!empty($userName) && !empty($_REQUEST['social_details'])) {
			$social_details = json_decode($_REQUEST['social_details']);
			$userid = socialLogin($social_details);
		}
		if(!empty($_REQUEST['guest_login']) && $userPass == "CC^CONTROL_GUEST" && $guestsMode == 1){
			$userid = getGuestID($userName);
		}
		if(!empty($userid) && isset($_REQUEST['callbackfn']) && $_REQUEST['callbackfn'] == 'mobileapp'){
			$sql = ("insert into cometchat_status (userid,isdevice) values ('".sql_real_escape_string($userid)."','1') on duplicate key update isdevice = '1'");
                sql_query($sql, array(), 1);
		}
		if($userid && function_exists('mcrypt_encrypt') && defined('ENCRYPT_USERID') && ENCRYPT_USERID == '1') {
			$key = "";
			if( defined('KEY_A') && defined('KEY_B') && defined('KEY_C') ){
				$key = KEY_A.KEY_B.KEY_C;
			}
			$userid = rawurlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $userid, MCRYPT_MODE_CBC, md5(md5($key)))));
		}

		return $userid;
	}

	function getFriendsList($userid,$time) {
		global $hideOffline;
		$offlinecondition = '';
		$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".DB_LINKFIELD." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice, cometchat_status.readreceiptsetting readreceiptsetting from ".TABLE_PREFIX."friends join ".TABLE_PREFIX.DB_USERTABLE." on  ".TABLE_PREFIX."friends.toid = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX."friends.fromid = '".sql_real_escape_string($userid)."' order by username asc");
		if ((defined('MEMCACHE') && MEMCACHE <> 0) || DISPLAY_ALL_USERS == 1) {
			if ($hideOffline) {
				$offlinecondition = "where ((cometchat_status.lastactivity > (".sql_real_escape_string($time)."-".((ONLINE_TIMEOUT)*2).")) OR cometchat_status.isdevice = 1) and (cometchat_status.status IS NULL OR cometchat_status.status <> 'invisible' OR cometchat_status.status <> 'offline')";
			}
			$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".DB_LINKFIELD." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice, cometchat_status.readreceiptsetting readreceiptsetting from  ".TABLE_PREFIX.DB_USERTABLE."   left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." ".$offlinecondition ." order by username asc");
		}

		return $sql;
	}

	function getFriendsIds($userid) {

		$sql = ("SELECT toid as friendid FROM `friends` WHERE status =1 and fromid = '".sql_real_escape_string($userid)."' union SELECT fromid as myfrndids FROM `friends` WHERE status = 1 and toid = '".sql_real_escape_string($userid)."'");

		return $sql;
	}

	function getUserDetails($userid) {
		$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".DB_LINKFIELD." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice, cometchat_status.readreceiptsetting readreceiptsetting from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".sql_real_escape_string($userid)."'");

		return $sql;
	}

	function getActivechatboxdetails($userids) {
		$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".DB_LINKFIELD." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice, cometchat_status.readreceiptsetting readreceiptsetting from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." IN (".$userids.")");

		return $sql;
	}

	function getUserStatus($userid) {
		$sql = ("select cometchat_status.message, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status from cometchat_status where userid = '".sql_real_escape_string($userid)."'");

		return $sql;
	}

	function fetchLink($link) {
		return '';
	}

	function getAvatar($image) {
		// echo $image."here"; die();
		if(!empty($image))
		{
			return BASE_URL.'../profile-photos/'.$image;
		}
		else{
			return BASE_URL.'images/noavatar.png';
		}

	}

	function getTimeStamp() {
		return time();
	}

	function processTime($time) {
		return $time;
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/* HOOKS */

		function hooks_message($userid,$to,$unsanitizedmessage,$dir,$origmessage='') {

	}

	function hooks_forcefriends() {

	}

	function hooks_updateLastActivity($userid) {

	}

	function hooks_statusupdate($userid,$statusmessage) {

	}

	function hooks_activityupdate($userid,$status) {

	}

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'license.php');
$x = "\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
