<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=comments.loop
Tags=comments.tpl:{COMMENTS_ROW_THANK_CAN},{COMMENTS_ROW_THANK_URL},{COMMENTS_ROW_THANK_LINK},{COMMENTS_ROW_THANK_COUNT},{COMMENTS_ROW_THANK_USERS},{COMMENTS_ROW_USERS_DATES},{FORUMS_POSTS_ROW_THANKFUL}
[END_COT_EXT]
==================== */

/**
 * Thanks comments loop
 *
 * @package thanks
 * @version 1.2
 * @author Trustmaster
 * @copyright Copyright (c) Vladimir Sibirov 2011-2012
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('thanks', 'plug');
require_once cot_incfile('thanks', 'plug','resources');

global $db_thanks,$db_users,$db_com,$cfg,$db;

// <Added by Alexey Kobak>
$item = $row['com_id'];
$res = $db->query("SELECT t.*, c.com_id, u.user_name
	FROM $db_thanks AS t
		LEFT JOIN $db_users AS u ON t.th_fromuser = u.user_id
		LEFT JOIN $db_com AS c ON t.th_ext = 'comments' AND t.th_item = c.com_id
		WHERE `th_ext` = 'comments' AND `th_item` = $item
		ORDER BY th_date DESC
		LIMIT $d, {$cfg['plugin']['thanks']['maxrowsperpage']}
");

$th_users_list = '';
$th_users_list_dates = '';
// Already thanked
$th_thanked = false;
// Checking if user is in the thanked list
foreach ($res as $rows)
{
	if ( $cfg['plugin']['thanks']['short'] ){
	if ( !empty($th_users_list) ){
		$th_users_list .= ', ';
	}
	$th_users_list .= cot_rc_link(cot_url('users', 'm=details&id='.$rows['th_fromuser'].'&u='.($rows['user_name'])),$rows['user_name']);
		if ( $th_thanked || $usr['id'] == $rows['th_fromuser'] )
		 $th_thanked = true;

	}
	else{
		if ( !empty($th_users_list_dates) ){
			$th_users_list_dates .= ', ';
		}
		$th_users_list_dates .=	cot_rc_link(cot_url('users', 'm=details&id='.$rows['th_fromuser'].'&u='.($rows['user_name'])),$rows['user_name']);
		$th_users_list_dates .= $R['open'].cot_date('d-m-Y',cot_date2stamp($rows['th_date'])).$R['close'];
		if ( $th_thanked || $usr['id'] == $rows['th_fromuser'] )
			 $th_thanked = true;

	}

}

// Adding thanked users list to a comment
if ( $cfg['plugin']['thanks']['short'] )
$t->assign(array( 'COMMENTS_ROW_THANK_USERS' => $th_users_list ));
else
$t->assign(array( 'COMMENTS_ROW_USERS_DATES' => $th_users_list_dates ));
$t->assign(array( 'FORUMS_POSTS_ROW_THANKFUL' => $L['thanks_tag'] ));

// </Added by Alexey Kobak>

// Fallback
$t->assign(array(
	'COMMENTS_ROW_THANK_CAN' => false,
	'COMMENTS_ROW_THANK_URL' => cot_url('plug', 'e=thanks&ext=comments&item='.$row['com_id']),
	'COMMENTS_ROW_THANK_LINK' => '',
	'COMMENTS_ROW_THANK_COUNT' => (int) $row['thanks_count']
));

if (cot_auth('plug', 'thanks', 'W') && $usr['id'] != $row['com_authorid'])
{
	$thanks_today = $db->query("SELECT COUNT(*) FROM `$db_thanks` WHERE `th_fromuser` = {$usr['id']} AND DATE(`th_date`) = DATE(NOW())")->fetchColumn();
	$thanks_touser_today = $row['thanks_touser_today'];
	$thanks_toitem = $row['thanks_toitem'];

	if ($thanks_today < $cfg['plugin']['thanks']['maxday'] && $thanks_touser_today < $cfg['plugin']['thanks']['maxuser'] && $thanks_toitem < 1)
	{
		$t->assign(array(
			'COMMENTS_ROW_THANK_CAN' => true,
			'COMMENTS_ROW_THANK_URL' => cot_url('plug', 'e=thanks&a=thank&ext=comments&item='.$row['com_id']),
			'COMMENTS_ROW_THANK_LINK' => cot_rc_link(cot_url('plug', 'e=thanks&a=thank&ext=comments&item='.$row['com_id']), $L['thanks_thanks'])
		));
	}
}


