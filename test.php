<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

extract($_REQUEST);
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if($_GET["selvalue_off_buil_id"]) {  // Ajax Show of Employee Code
	$selvalue_off_buil_id=$_GET["selvalue_off_buil_id"];	
	$fgmembersite->DBLogin();
	$result_off_buil_id=mysql_query("SELECT building_code FROM building  WHERE id = '$selvalue_off_buil_id' ");
	while($row_off_buil_id=mysql_fetch_array($result_off_buil_id)) {
		$off_buil_code=$row_off_buil_id['building_code'];
	}
	
	?>
	<input type='text' name='off_buil_code' id='off_buil_code' size="6" tabindex="10" class="textbox" value="<?php echo $off_buil_code; ?>" readonly="true" />
	<?php
}

if($_GET["selvalue_res_buil_id"]) {  // Ajax Show of Employee Code
	$selvalue_res_buil_id=$_GET["selvalue_res_buil_id"];	
	$fgmembersite->DBLogin();
	$result_res_buil_id=mysql_query("SELECT building_code FROM building WHERE id = '$selvalue_res_buil_id' ");
	while($row_res_buil_id=mysql_fetch_array($result_res_buil_id)) {
		$res_buil_code=$row_res_buil_id['building_code'];
	}
	?>
	<input type='text' name='res_buil_code' id='res_buil_code' size="6" tabindex="14" class="textbox" value="<?php echo $res_buil_code; ?>" readonly="true" />
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
	$result=mysql_query("SELECT guest_code from guest WHERE id = $selvalue");
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
		echo '<select name="emp_request_id" id="emp_request_id" tabindex="2" style="width:210px;" class="selectbox">';
		echo '<option value="0">--Employee--</option>';
		while($row=mysql_fetch_array($result_emp_id)) {
			echo '<option value="'.$row['emp_code'].'">'.$fgmembersite->upperstate($row['first_name']).'</option>';
		}
		echo '</select>&nbsp;<span id="display_request_id"></span>';
		$var_assigned 		=	array("singleton","factory","observer");
		//object oriented programming is an easy way of coding rather than using procedural or core php
		$variable_assigned		=	"ijoiesd"."this is an advanced type of coding";
		$rm_pattern				=	"mvc pattern is nothing ";
		$jquery_magic			=	"uom_joined_here_will_be_added";
		$pattern_with_design	=	"factory_pattern_is_the_way_working";
		$singleton_design		=	"singleton_design_pattern";
		$observer_pattern		=	"this is another employee through ams";
		$proxy_design			=	"this is a proxy design works that way";		
	}
	if($selvalue==2) {
		$result_state=mysql_query("select id,name from guest");
		echo '<select name="guest_request_id" id="guest_request_id" tabindex="2" style="width:210px;" class="selectbox">';
		echo '<option value="0">--Guest--</option>';
		while($row=mysql_fetch_array($result_state))
		{
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
		}
		echo '</select>&nbsp;<span id="display_request_id"></span>';
	}	
}

if($uom == $uomvalue) {
	$uomval = $readystatevalue;
	
	
}
?>
<script>
function checkajaxstatus() {
	var xmlhttp;
	xmlhttp = checkbrowser;
		


	
}
function checkbrowser() {
	var objxmlhttp	= null;
	if(window.XMLHttpRequest){
		objxmlhttp	=	new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		objxmlhttp	=	new ActiveXObject("Microsoft.XMLHTTP");
	}
	return objxmlhttp;	
}


function checkajax() {
	var xmlhttp;
	xmlhttp		=	checkbrowser();
	if(xmlhttp == null) {
		alert("Your browser does not Ajax");
	}

	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 || xmlhttp.readyState == 'Complete') {
			alert(xmlhttp.responseText);
		}
	}
	var url		=	"get.php";
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}
function checkbrowser() {
	var objxml	=	null;

	if(window.XMLHttpRequest) {
		objxml		=	new XMLHttpRequest();
	} else if(window.ActiveXObject){
		objxml		= 	new ActiveXObject("Microsoft.XMLHTTP");
	}
	return objxml;
}
</script>
<?php
class fruit {
	var $tree;
	private $grass;
	function 
	
	
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