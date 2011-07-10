<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=page.tags
Tags=page.tpl:{PAGE_THANK_CAN},{PAGE_THANK_URL},{PAGE_THANK_LINK}
[END_COT_EXT]
==================== */

/**
 * Thanks page tags
 *
 * @package thanks
 * @version 1.0
 * @author Trustmaster
 * @copyright Copyright (c) Vladimir Sibirov 2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('thanks', 'plug');

if (cot_auth('plug', 'thanks', 'W') && !thanks_check_item($usr['id'], 'page', $id) && $usr['id'] != $pag['page_ownerid'])
{
	$t->assign(array(
		'PAGE_THANK_CAN' => true,
		'PAGE_THANK_URL' => cot_url('plug', 'e=thanks&a=thank&ext=page&item='.$id),
		'PAGE_THANK_LINK' => cot_rc_link(cot_url('plug', 'e=thanks&a=thank&ext=page&item='.$id), $L['thanks_thanks'])
	));
}
else
{
	$t->assign(array(
		'PAGE_THANK_CAN' => false,
		'PAGE_THANK_URL' => cot_url('plug', 'e=thanks&ext=page&item='.$id),
		'PAGE_THANK_LINK' => ''
	));
}

?>
