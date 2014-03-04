<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);

$check_qry		=	"SELECT id FROM markers WHERE building_code = '$building_code'";
$res_qry		=	mysql_query($check_qry) or die(mysql_error());
$row_qry		=	mysql_num_rows($res_qry);
if($row_qry > 0) {
	$rowval_qry		=	mysql_fetch_array($res_qry);
	$marker_id		=	$rowval_qry['id'];
}

if($row_qry == 0) {
	$query		=	sprintf("INSERT INTO markers " .
		 " (id, name, address, lat, lng, type, building_code ) " .
		 " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s');",
		 mysql_real_escape_string($name),
		 mysql_real_escape_string($address),
		 mysql_real_escape_string($lat),
		 mysql_real_escape_string($lng),
		 mysql_real_escape_string($type),
		 mysql_real_escape_string($building_code));		 
		 $result = mysql_query($query);
		 $marker_id		=	mysql_insert_id();
} elseif($row_qry > 0) {
	$query		=	sprintf("UPDATE markers SET name = '%s',address = '%s',lat = '%s',lng = '%s',type = '%s' WHERE building_code = '%s' ;",mysql_real_escape_string($name),mysql_real_escape_string($address),mysql_real_escape_string($lat),mysql_real_escape_string($lng),mysql_real_escape_string($type),mysql_real_escape_string($building_code));
	//echo $query;
	//exit;	
	$result = mysql_query($query);
}

if (!$result) {
  die('Invalid query: ' . mysql_error());
} else {
	echo $marker_id;
	//echo "erere";
	//exit;
	//echo mysql_insert_id();
}
exit(0); ?>