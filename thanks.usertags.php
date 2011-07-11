<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=usertags.main
[END_COT_EXT]
==================== */

/**
 * Thanks user tags
 *
 * @package thanks
 * @version 1.0
 * @author Trustmaster
 * @copyright Copyright (c) Vladimir Sibirov 2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

static $th_lang_loaded = false;

if (!$th_lang_loaded)
{
	require_once cot_langfile('thanks', 'plug');
	$th_lang_loaded = true;
}

$temp_array['THANKS'] = $user_data['user_thanks'];
$temp_array['THANKS_URL'] = cot_url('plug', 'e=thanks&user=' . $user_data['user_id']);
$temp_array['THANKS_TIMES'] = cot_declension($user_data['user_thanks'], 'Times', true);

?>

