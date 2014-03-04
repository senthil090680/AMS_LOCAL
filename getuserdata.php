<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

$emp_code= $_POST['selvalue'];
$result_emp_id=mysql_query("select first_name,emp_email,photo from pim_emp_info where emp_code=$emp_code order by emp_id");
$row = mysql_fetch_array($result_emp_id);
  echo $row['emp_email']."~".$row['first_name'];
?>


