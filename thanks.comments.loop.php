<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=comments.loop
Tags=comments.tpl:{COMMENTS_ROW_THANK_CAN},{COMMENTS_ROW_THANK_URL},{COMMENTS_ROW_THANK_LINK},{COMMENTS_ROW_THANK_COUNT}
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

?>
