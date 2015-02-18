<?php
/* ====================
[BEGIN_COT_EXT]
Code=thanks
Name=Thanks
Category=community-social
Description=Users can thank each other for pages, posts and comments
Version=1.4
Date=2015-02-17
Author=Trustmaster
Copyright=All rights reserved (c) Vladimir Sibirov 2011-2015
Notes=BSD License
SQL=
Auth_guests=R
Lock_guests=12345A
Auth_members=RW
Lock_members=12345
Recommends_modules=page,forums
Recommends_plugins=comments
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
maxday=01:string::10:Max thanks a user can give a day
maxuser=02:string::5:Max thanks a day a user can give to a particular user
maxrowsperpage=03:string::20:Max thanks displayed per page
comorder=04:radio::0:Sort comments by thanks
short=05:radio::0: Short string - only user name, no date stamp
[END_COT_EXT_CONFIG]
==================== */

defined('COT_CODE') or die('Wrong URL');

?>
