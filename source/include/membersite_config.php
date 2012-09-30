<?php
require_once(FILE_ROOT."source/include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('lerne.in');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('webmaster.lerne@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'root',
                      /*database name*/'lerne',
                      /*table name*/'lerne_users');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('rNxpGJstrCC6yyS'); // Change this random key for your machine.

?>