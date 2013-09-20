<?php
/**
 * Thanks API
 *
 * @package thanks
 * @version 1.0
 * @author Trustmaster
 * @copyright Copyright (c) Vladimir Sibirov 2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('thanks', 'plug');

global $db_thanks, $db_x;
$db_thanks = (isset($db_thanks)) ? $db_thanks : $db_x . 'thanks';

define('THANKS_ERR_NONE', 0);
define('THANKS_ERR_MAXDAY', 1);
define('THANKS_ERR_MAXUSER', 2);
define('THANKS_ERR_ITEM', 3);
define('THANKS_ERR_SELF', 4);

/**
 * Adds a new thank. Don't forget to use thanks_check() before calling this function.
 * 
 * @param int $touser Thank receiver ID
 * @param int $fromuser Thank sender ID
 * @param string $ext Extension code
 * @param int $item Item ID
 * @return bool 
 */
function thanks_add($touser, $fromuser, $ext, $item)
{
	global $db, $db_thanks, $db_users;
	$ins = $db->insert($db_thanks, array(
		'th_date' => 'NOW()',
		'th_touser' => $touser,
		'th_fromuser' => $fromuser,
		'th_ext' => $ext,
		'th_item' => $item
	));
	if ($ins)
	{
		/* === Hook === */
		foreach (cot_getextplugins('thanks.add.done') as $pl)
		{
			include $pl;
		}
		/* ===== */
		$db->query("UPDATE `$db_users` SET user_thanks = user_thanks + 1 WHERE user_id = ?", array($touser));
	}
	return (bool) $ins;
}

/**
 * Checks if it is correct to add a new thank
 * 
 * @param int $touser Thank receiver ID
 * @param int $fromuser Thank sender ID
 * @param string $ext Extension code
 * @param int $item Item ID
 * @return int One of the THANKS_ERR_* constants, THANKS_ERR_NONE if it is OK to add this thank. 
 */
function thanks_check($touser, $fromuser, $ext, $item)
{
	global $db, $db_thanks, $cfg;
	
	if ($touser == $fromuser)
	{
		return THANKS_ERR_SELF;
	}
	
	if ($db->query("SELECT COUNT(*) FROM `$db_thanks` WHERE `th_fromuser` = ? AND DATE(`th_date`) = DATE(NOW())", array($fromuser))->fetchColumn() >= $cfg['plugin']['thanks']['maxday'])
	{
		return THANKS_ERR_MAXDAY;
	}
	
	if ($db->query("SELECT COUNT(*) FROM `$db_thanks` WHERE `th_fromuser` = ? AND `th_touser` = ? AND DATE(`th_date`) = DATE(NOW())", array($fromuser, $touser))->fetchColumn() >= $cfg['plugin']['thanks']['maxuser'])
	{
		return THANKS_ERR_MAXUSER;
	}
	
	if ($db->query("SELECT COUNT(*) FROM `$db_thanks` WHERE `th_fromuser` = ? AND `th_ext` = ? AND `th_item` = ?", array($fromuser, $ext, $item))->fetchColumn() >= 1)
	{
		return THANKS_ERR_ITEM;
	}
	
	return THANKS_ERR_NONE;
}

/**
 * Returns TRUE if the user has already thanked for given item or FALSE otherwise.
 * 
 * @param int $fromuser Thank sender ID
 * @param string $ext Extension code
 * @param int $item Item ID
 * @return bool 
 */
function thanks_check_item($fromuser, $ext, $item)
{
	global $db, $db_thanks;
	return $db->query("SELECT COUNT(*) FROM `$db_thanks` WHERE `th_fromuser` = ? AND `th_ext` = ? AND `th_item` = ?", array($fromuser, $ext, $item))->fetchColumn() >= 1;
}

/**
 * Removes a thank by ID
 * 
 * @param int $id Thank ID
 * @return bool
 */
function thanks_remove($id)
{
	global $db, $db_thanks, $db_users;

	$touser = $db->query("SELECT th_touser FROM $db_thanks WHERE th_id = ?", array($id))->fetchColumn();
	$rm = $db->delete($db_thanks, "`th_id` = ?", array($id));
	if ($rm)
	{
		$db->query("UPDATE $db_users SET user_thanks = user_thanks - 1 WHERE user_id = ?", array($touser));
	}
	return (bool) $rm;
}

/**
 * Removes all thanks received by a user
 *
 * @param int $userid User ID
 * @return int Number of items removed
 */
function thanks_remove_user($userid)
{
	global $db, $db_thanks;
	return $db->delete($db_thanks, "`th_touser` = ?", array($userid));
}

?>
