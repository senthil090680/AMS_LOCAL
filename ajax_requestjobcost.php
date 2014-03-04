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

if($_GET["costelementid"]) {  // Ajax Show of Employee Code
	$selvalue=$_GET["costelementid"];	
	$result_costunits=mysql_query("SELECT u.name AS UOMVAL FROM costtypeelement cte, uom u WHERE cte.cost_uom = u.id AND cost_elementid = '$selvalue'");
	while($row=mysql_fetch_array($result_costunits)) {
		$cost_units=$fgmembersite->upperstate($row['UOMVAL']);
	}
	?>
	<input type='text' name='cost_units' id='cost_units' size="10" tabindex="11" value="<?php echo $cost_units; ?>" readonly class="textbox"/>
	<?php
}

if($_POST["request_number"]) {  // Ajax Show of Employee Code
	$selvalue=$_POST["request_number"];	
	$result_emp_id=mysql_query("SELECT j.job_desc AS JOBNAME,j.id AS JOBID,j.job_code AS JOBCODE,est_cost,actual_cost FROM requestjobs rj, jobs j WHERE rj.id = '$selvalue' AND rj.job_id = j.id");
	$row				=	mysql_fetch_array($result_emp_id);
	$jobname			=	$row['JOBNAME'];
	$jobcode			=	$row['JOBCODE'];
	$jobid				=	$row['JOBID'];
	$est_cost			=	$row['est_cost'];
	$actual_cost		=	$row['actual_cost'];
	echo $jobname."~".$jobcode."~".$jobid."~".$est_cost."~".$actual_cost;
}
?>