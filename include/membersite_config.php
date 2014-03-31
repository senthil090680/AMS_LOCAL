<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('fmcl');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('raja.nuvento@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'192.168.1.145',
                      /*username*/'root',
                      /*password*/'hari',
                      /*database name*/'fmcl',
                      /*table name*/'users');
					$mysql_hostname = "192.168.1.145";
					$mysql_user = "root";
					$mysql_password = "hari";
					$mysql_database = "fmcl_host";
//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');
?>