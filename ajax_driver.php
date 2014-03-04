<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if($_GET["selvalue_incharge_empcode"])
{
$emp_code=$_GET["selvalue_incharge_empcode"];
?>
<input type='text' name='emp_code' id='emp_code' class="textbox" value="<?php echo $emp_code; ?>" readonly="true"/>
<?php
}
if($_GET["selvalue_assno_start"]) {
	$selvalue=$_GET["selvalue_assno_start"];
	
	$result=mysql_query("SELECT from_date from vehicle_assignment WHERE id = $selvalue");
		while($row=mysql_fetch_array($result)) {
			$assno_start_date=$row['from_date'];
		}
	?>
	<input type='text' name='starting_date' id='starting_date' class="textbox" value="<?php echo $assno_start_date; ?>" readonly="true"/>
	<?php
}
if($_GET["selvalue_assno_end"]) {
	$selvalue=$_GET["selvalue_assno_end"];
	
	$result=mysql_query("SELECT to_date from vehicle_assignment WHERE id = $selvalue");
		while($row=mysql_fetch_array($result)) {
			$assno_end_date=$row['to_date'];
		}
	?>
	<input type='text' name='ending_date' id='ending_date' class="textbox" value="<?php echo $assno_end_date; ?>" readonly="true"/>
	<?php
}
if($_GET["emp_bought_id"]) {
	$selvalue=$_GET["emp_bought_id"];
	
	$fgmembersite->DBLogin();
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  WHERE emp_id = '$selvalue'",$bd);			
	while($row=mysql_fetch_array($result_emp_id)) {
		$first_name=$row['emp_code'];
	}
	?>
	<input type='text' name='emp_nameval' id='emp_nameval' size="6" class="textbox" value="<?php echo $first_name; ?>" readonly="true" />
	<?php
}
if($_GET["selvalue_driver_code"]) {
	$selvalue=$_GET["selvalue_driver_code"];
	$result=mysql_query("SELECT driver_code from driver WHERE id = $selvalue");
		while($row=mysql_fetch_array($result)) {
			$driver_codeval=$row['driver_code'];
		}
	?>
	<input type='text' name='driver_nameval' id='driver_nameval' tabindex="6" class="textbox" value="<?php echo $driver_codeval; ?>" readonly="true"/>
	<?php
}
if($_GET["driver_bought_id"]) {
	$selvalue=$_GET["driver_bought_id"];
	$result=mysql_query("SELECT driver_code from driver WHERE id = $selvalue");
		while($row=mysql_fetch_array($result)) {
			$driver_nameval=$row['driver_code'];
		}
	?>
	<input type='text' name='driver_nameval' id='driver_nameval' size="6" class="textbox" value="<?php echo $driver_nameval; ?>" readonly="true"/>
	<?php
}
if($_GET["selvalue_driver"]) {
$selvalue=$_GET["selvalue_driver"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$state=$row['state_name'];
							}
?>
<input type='text' name='state_driver' id='state_driver' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}
if($_GET["selvalue_vendor_id"])
{
$selvalue=$_GET["selvalue_vendor_id"];
$result=mysql_query("SELECT vendor_code from vendor where id=$selvalue");
						   while($row=mysql_fetch_array($result)) {
								$vendor_code=$row['vendor_code'];
							}
?>
<input type='text' name='vendor_name' id='vendor_name' size="10" tabindex="6" class="textbox" value="<?php echo $vendor_code; ?>" readonly="true"/>
<?php
}
if($_GET["selvalue_bought_by"]) {
	$selvalue=$_GET["selvalue_bought_by"];
	if($selvalue==1) {
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
		echo '<select name="emp_bought_id" id="emp_bought_id" style="width:172px;" tabindex="14" class="selectbox">';
		echo '<option value="0">--Employee--</option>';
		while($row=mysql_fetch_array($result_emp_id))
		{
			echo '<option value="'.$row['emp_code'].'">'.$fgmembersite->upperstate($row['first_name']).'</option>';
		}
		echo '</select>&nbsp;<span id="display_bought_id"></span>';
	}
	if($selvalue==2)
	{
						$result_state=mysql_query("select id,emp_name from driver");
						echo '<select name="driver_bought_id" id="driver_bought_id" tabindex="14" style="width:172px;" class="selectbox">';
						echo '<option value="0">--Driver--</option>';
						while($row=mysql_fetch_array($result_state))
						{
							echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['emp_name']).'</option>';
						}
						echo '</select>&nbsp;<span id="display_bought_id"></span>';
	}
	
	if($selvalue==3)
	{
		echo '<input type="text" name="bought_id" id="bought_id" tabindex="14" class="textbox"/>';
	}
	if($selvalue==4)
	{
		echo '<input type="text" name="bought_id" id="bought_id" tabindex="14" class="textbox" readonly="true"/>';
	}
}
?>