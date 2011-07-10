<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=forums.posts.loop
Tags=forums.posts.tpl:{FORUMS_POSTS_ROW_THANK_CAN},{FORUMS_POSTS_ROW_THANK_URL},{FORUMS_POSTS_ROW_THANK_LINK}
[END_COT_EXT]
==================== */

/**
 * Thanks forum posts tags
 *
 * @package thanks
 * @version 1.0
 * @author Trustmaster
 * @copyright Copyright (c) Vladimir Sibirov 2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

if (!isset($thanks_auth_write))
{
	require_once cot_langfile('thanks', 'plug');
	$thanks_auth_write = cot_auth('plug', 'thanks', 'W');
}

if ($thanks_auth_write && $usr['id'] != $row['fp_posterid'])
{
	$t->assign(array(
		'FORUMS_POSTS_ROW_THANK_CAN' => true,
		'FORUMS_POSTS_ROW_THANK_URL' => cot_url('plug', 'e=thanks&a=thank&ext=forums&item='.$row['fp_id']),
		'FORUMS_POSTS_ROW_THANK_LINK' => cot_rc_link(cot_url('plug', 'e=thanks&a=thank&ext=forums&item='.$row['fp_id']), $L['thanks_thanks'])
	));
}
else
{
	$t->assign(array(
		'FORUMS_POSTS_ROW_THANK_CAN' => false,
		'FORUMS_POSTS_ROW_THANK_URL' => '',
		'FORUMS_POSTS_ROW_THANK_LINK' => ''
	));
}

?>
