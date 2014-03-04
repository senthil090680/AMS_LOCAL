<?php
require_once("./include/membersite_config.php");
extract($_REQUEST);
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

$fgmembersite->DBLogin();

if($_POST["landlordval"]) {
	//echo "SELECT address1,address2,address3,city_id,contact_number,alt_contact_number,b.name as city_name, c.name as state_name FROM vendor_bms a, city b, state c where a.city_id=b.id AND b.state_id=c.id AND a.id='$landlordval'";
	$result		=	mysql_query("SELECT address1,address2,address3,city_id,contact_number,alt_contact_number,b.name as city_name, c.name as state_name FROM vendor_bms a, city b, state c where a.city_id=b.id AND b.state_id=c.id AND a.id='$landlordval'") or die(mysql_error());
	$row		=	mysql_fetch_array($result);
	echo $row['address1']."~".$row['address2']."~".$row['address3']."~".$row['contact_number']."~".$row['alt_contact_number']."~".$row['city_name']."~".$row['state_name'];
	exit(0);
}

if($_GET["selvalue"]) {
$selvalue=$_GET["selvalue"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result)) {
								$state=$row['state_name'];
						   }
?>
<input type='text' name='state' id='state' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}

if($_GET["selvalue_landlord"]) {
$selvalue=$_GET["selvalue_landlord"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$state=$row['state_name'];
							}
?>
<input type='text' name='state_landlord' id='state_landlord' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}
?>


<?php
if($_GET["selvalue_empcode"])
{
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
$emp_code=$_GET["selvalue_empcode"];
$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code=$emp_code order by emp_id",$bd);
while($row = mysql_fetch_array($result_emp_id))
  {
  	$first_name=$row['first_name'];  
  }
?>
<input type='text' name='empname' id='empname' class="textbox" value="<?php echo $first_name; ?>" readonly="true"/>
<?php
}
?>
<?php
if($_GET["selvalue_incharge_empcode"])
{
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
$emp_code=$_GET["selvalue_incharge_empcode"];
$result_emp_id=mysql_query("select first_name, from pim_emp_info where emp_code=$emp_code order by emp_id",$bd);
while($row = mysql_fetch_array($result_emp_id))
  {
  $first_name=$row['first_name'];  
  }
?>
<input type='text' name='leadername' id='leadername' class="textbox" value="<?php echo $first_name; ?>" readonly="true"/>
<?php
}
if($_GET["selvalue_incharge_empcode_driver"])
{
$selvalue=$_GET["selvalue_incharge_empcode_driver"];
$result=mysql_query("SELECT driver_code from driver where id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$emp_name=$row['driver_code'];
							}
?>
<input type='text' name='leadername' id='leadername' value="<?php echo $emp_name; ?>" readonly="true" size="10"/>
<?php 
}
if($_GET["building_code"])
{
$selvalue=$_GET["building_code"];
$result=mysql_query("SELECT id,generator_code from generator where building_code=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$emp_name=$row['generator_code'];
							$generator_id=$row['id'];
							}
?>
<input type='text' name='generator_code_id' id='generator_code_id' value="<?php echo $emp_name; ?>" readonly="true" size="10"/>
<input type='hidden' name='generator_code' id='generator_code' value="<?php echo $generator_id; ?>" readonly="true" size="10"/>
<?php 
}
if($_POST["building_id"])
{

$selvalue=$_POST["building_id"];
$postid=$_POST["edit_id"];
	if($_POST["edit_id"])
	{
		$result=mysql_query("SELECT id,building_code from generator where building_code=$selvalue") or die(mysql_error());
		$num_rows = mysql_num_rows($result);
		while($row=mysql_fetch_array($result))
							{
							$generator_id=$row['id'];
							}
		if ($num_rows == 1 and $generator_id==$postid)
		{
		$num_rows=0;
		}
		else
		{
		$num_rows=$num_rows;
		}
		echo $num_rows;
	}
	else
	{
	$result=mysql_query("SELECT building_code from generator where building_code=$selvalue") or die(mysql_error());
	$num_rows = mysql_num_rows($result);
	echo $num_rows;
	}
}
?>