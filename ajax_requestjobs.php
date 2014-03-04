<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

extract($_REQUEST);
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if($_GET["selvalue_jobid"]) {  // Ajax Show of Employee Code
	$selvalue=$_GET["selvalue_jobid"];	
	$fgmembersite->DBLogin();
	$result_job_desc=mysql_query("SELECT job_code FROM jobs WHERE id = '$selvalue'");
	while($row_jobdesc=mysql_fetch_array($result_job_desc)) {
		$job_desc=$row_jobdesc['job_code'];
	}
	?>
	<input type='text' name='job_code' id='job_code' size="6" tabindex="3" class="textbox" value="<?php echo $job_desc; ?>" readonly="true" />
	<?php
}

if($_GET["selvalue_admin_res"]) {  // Ajax Show of Employee Code
	$selvalue=$_GET["selvalue_admin_res"];	
	$fgmembersite->DBLogin();
	$result_admin_res=mysql_query("SELECT lead_code FROM admin_responsibility WHERE id = '$selvalue'");
	while($row_admin_res=mysql_fetch_array($result_admin_res)) {
		$admin_res=$row_admin_res['lead_code'];
	}
	?>
	<input type='text' name='admin_res_code' id='admin_res_code' tabindex="5" size="6" class="textbox" value="<?php echo $admin_res; ?>" readonly="true" />
	<?php
}

if($_GET["selvalue_job_assigned"]) {  // Ajax Show of Employee Code
	$selvalue=$_GET["selvalue_job_assigned"];	
	$fgmembersite->DBLogin();
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("select emp_code from pim_emp_info  WHERE emp_code = '$selvalue'",$bd);
	while($row=mysql_fetch_array($result_emp_id)) {
		$emp_code_val=$row['emp_code'];
	}
	?>
	<input type='text' name='job_assigned_code' id='job_assigned_code' size="6" tabindex="7" class="textbox" value="<?php echo $emp_code_val; ?>" readonly="true" />
	<?php
}

if($_POST["request_number"]) {  // Ajax Show of Employee Code
	$selvalue=$_POST["request_number"];	
	$result_emp_id=mysql_query("SELECT req_number,expected_date,completion_date,est_cost,actual_cost FROM request WHERE id = '$selvalue'");
	$row				=	mysql_fetch_array($result_emp_id);
	$req_number			=	$row['req_number'];
	$expected_date		=	$row['expected_date'];
	$completion_date	=	$row['completion_date'];
	$est_cost			=	$row['est_cost'];
	$actual_cost		=	$row['actual_cost'];
	echo $req_number."~".$expected_date."~".$completion_date."~".$est_cost."~".$actual_cost;
}
?>