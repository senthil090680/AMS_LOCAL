<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

extract($_REQUEST);
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if($_GET["request_takenby"]) {  // Ajax Show of Employee Code
	$selvalue=$_GET["request_takenby"];	
	$fgmembersite->DBLogin();
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("select emp_code from pim_emp_info  WHERE emp_code = '$selvalue'",$bd);
	while($row=mysql_fetch_array($result_emp_id)) {
		$emp_code_val=$row['emp_code'];
	}
	?>
	<input type='text' name='emp_codetakenby' id='emp_codetakenby' tabindex="9" size="6" class="textbox" value="<?php echo $emp_code_val; ?>" readonly="true" />
	<?php
}


if($_GET["emp_request_id"]) {  // Ajax Show of Employee Code
	$selvalue=$_GET["emp_request_id"];	
	$fgmembersite->DBLogin();
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("select emp_code from pim_emp_info  WHERE emp_code = '$selvalue'",$bd);
	while($row=mysql_fetch_array($result_emp_id)) {
		$emp_code_val=$row['emp_code'];
	}
	?>
	<input type='text' name='emp_codeval' id='emp_codeval' size="6" class="textbox" value="<?php echo $emp_code_val; ?>" readonly="true" />
	<?php
}
if($_GET["guest_request_id"]) {  // Ajax Show of Guest Code
	$selvalue=$_GET["guest_request_id"];
	$result=mysql_query("SELECT guest_code FROM guest WHERE id = $selvalue");
		while($row=mysql_fetch_array($result)) {
			$guest_codeval=$row['guest_code'];
		}
	?>
	<input type='text' name='guest_codeval' id='guest_codeval' size="6" class="textbox" value="<?php echo $guest_codeval; ?>" readonly="true"/>
	<?php
}
if($_GET["selvalue_request_type"]) {  // Ajax Replace of Employee/Guest Name
	$selvalue=$_GET["selvalue_request_type"];
	if($selvalue==1) {
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by first_name",$bd) or die(mysql_error());
		echo '<select name="emp_request_id" id="emp_request_id" tabindex="3" style="width:210px;" class="selectbox">';
		echo '<option value="0">--Employee--</option>';
		while($row=mysql_fetch_array($result_emp_id))
		{
			echo '<option value="'.$row['emp_code'].'">'.$fgmembersite->upperstate($row['first_name']).'</option>';
		}
		echo '</select>&nbsp;<span id="display_request_id"></span>';
	}
	if($selvalue==2) {
		$result_state=mysql_query("select id,name from guest");
		echo '<select name="guest_request_id" id="guest_request_id" tabindex="3" style="width:210px;" class="selectbox">';
		echo '<option value="0">--Guest--</option>';
		while($row=mysql_fetch_array($result_state))
		{
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
		}
		echo '</select>&nbsp;<span id="display_request_id"></span>';
	}	
}

if($_GET["selvalue"]) { //Ajax Replace of State in Requestor Page 
	$selvalue=$_GET["selvalue"];
	$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
	while($row=mysql_fetch_array($result)) {
		$state=$row['state_name'];
	}
	?>
	<input type='text' name='state_name' id='state_name' tabindex="6" class="textbox" value="<?php echo $state; ?>" readonly="true"/>
	<?php
}
?>