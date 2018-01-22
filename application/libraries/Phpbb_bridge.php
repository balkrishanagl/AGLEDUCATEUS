<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Phpbb_bridge{
 function __construct()
 {
   if (!isset($this->CI))
   {
     $this->CI =& get_instance();
   }
   // Set the variables scope
   global $phpbb_root_path, $phpEx, $user, $auth, $cache, $db, $config, $template, $table_prefix;
   $rootPath = $this->CI->config->item('root_path');
   define('IN_PHPBB', TRUE);
   define('FORUM_ROOT_PATH', $rootPath.'forum/');
   $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : FORUM_ROOT_PATH;
   $phpEx = substr(strrchr(__FILE__, '.'), 1);
   // Include needed files
   include($phpbb_root_path . 'common.' . $phpEx);
   include($phpbb_root_path . 'config.' . $phpEx);
   include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
   include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
   include($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
   include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
   // Initialize phpBB user session
   $user->session_begin();
   $auth->acl($user->data);
   $user->setup();
   // Save user data into $_user variable
   $this->_user = $user;
 }
 function user_add($email, $username, $password)
 {
   $user_row = array(
     'username'              => $username,
     'user_password'         => phpbb_hash($password),
     'user_email'            => $email,
     'group_id'              => 2, // by default, the REGISTERED user group is id 2
     'user_timezone'         => (float) date('T'),
     'user_lang'             => 'bg',
     'user_type'             => USER_NORMAL,
     'user_ip'               => $_SERVER['REMOTE_ADDR'],
     'user_regdate'          => time(),
   );
   return user_add($user_row, false);
 }
 function user_login($username, $password)
 {
   $auth = new auth();
   return $auth->login($username, $password);
 }
 function user_logout()
 {
   $this->_user->session_kill();
   $this->_user->session_begin();
 }
 function user_delete($user_id)
 {
   return user_delete('remove', $user_id, false);
 }
//}
function user_edit($username, $newPassword)
{
 global $db, $user, $auth, $config, $phpbb_root_path, $phpEx; if (empty($username) || empty($newPassword))
 {
   return false;
 }
 $sql = 'UPDATE ' . USERS_TABLE . ' SET user_password=\'' . $db->sql_escape(md5($newPassword)) . '\' WHERE username = \''.$db->sql_escape($username).'\'';
 $db->sql_query($sql);
 return true;
}
}
?>