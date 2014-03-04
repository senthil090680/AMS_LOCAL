<?PHP
require_once("./include/membersite_config.php");
require_once ("./include/ajax_pagination.php");
$fgmembersite->DBLogin();
EXTRACT($_REQUEST);
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if ($fgmembersite->usertype() == 1) {
	$header_file='./layout/admin_header_fms.php';
}
if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
?>
<script>
function myFunction() {
	document.getElementById("state").value="";
	document.getElementById("state").focus();
	return false;
}
$(function () {
	$('#closebutton').button({
		icons: {
			primary : "../images/close_pop.png",
		},
		text:false
	});	
	$('#closebutton').click(function(event) {
		//alert('232');
		$('#errormsgbuild').hide();
		return false;
	});		
});
$(function () {		
	$('#clear').click(function(event) {
		$('#desc').val()="";
	});		
});
</script>
<style>
#closebutton {
    background: url("images/close_pop.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: rgba(0, 0, 0, 0);
    position: relative;
    right: -220px;
    top: -35px;
}
</style>
<script>
$(document).ready(function() { 
$("#incharge_empcode").change(function(event) {
		var selvalue_incharge_empcode=document.getElementById("incharge_empcode").value;
		if (selvalue_incharge_empcode != 0)
		{
			document.getElementById("leadername").value = selvalue_incharge_empcode;
			//$('#display_inchargename').load('ajax_building.php?selvalue_incharge_empcode='+selvalue_incharge_empcode);
		}
		else
		{
			document.getElementById("leadername").value = "";
		}
    });		
	  });	
	  
	  $(document).ready(function() {
	$("#city").change(function(event) {
			var selvalue=document.getElementById("city").value;
			if (selvalue != 0) {
				$('#display_state').load('ajax_building.php?selvalue='+selvalue);
			}
			else {
				document.getElementById("state").value = "";			
			}
		});	
		});	
	  </script>
	  <script>
function validateForm() 
	{
	var driver_id=document.getElementById("driver_id").value;
	if(driver_id==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Driver Name');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("driver_id").focus();
		return false;
	}
	
	var allocate_id=document.getElementById("allocate_id").value;
	if(allocate_id==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Allocation Type');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("allocate_id").focus();
		return false;
	}
	
	var incharge_empcode=document.getElementById("incharge_empcode").value;
	if(incharge_empcode==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Employee Name');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("incharge_empcode").focus();
		return false;
	}
	}
$(function () {		
	$('#clear').click(function(event) {
		$('#incharge_empcode').val()=0;
		$('#allocate_id').val()=0;
		$('#driver_id').val()=0;		
	});		
});
</script>
<?php
if(isset($_POST['save'])) 
{
$user_id=$_SESSION['user_id'];
$driver_id=$_POST['driver_id'];
$allocate_id=$_POST['allocate_id'];
$emp_id=$_POST['incharge_empcode'];

$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$emp_id'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}

if ($driver_id != "")
{
$fgmembersite->DBLogin();
if(!mysql_query('INSERT INTO driver_allocate (driver_id,allocate_type_id,emp_id,emp_name,created_by)VALUES ("'.$driver_id.'","'.$allocate_id.'","'.$emp_id.'","'.$emp_name.'","'.$user_id.'")'))
{
die('Error: ' . mysql_error());
}
	$fgmembersite->RedirectToURL("view_driver_allocate.php?success=create");
}
}

?>

<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">DRIVER ALLOCATION</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Driver Allocation</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="148">Driver Name*</td>
			<td>
	<?php
	$result_state=mysql_query("select * from driver");
				echo '<select name="driver_id" id="driver_id" tabindex="1" style="width:270px;">';
				echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['emp_name'].'</option>';

					}
					echo '</select>';
					?>
			</td>
			</tr>
			
			<tr height="30">
		<td width="128" style="white-space:nowrap;">Employee Name*</td>
		<td><?php
			$fgmembersite->DBLogin();
			$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
			or die("Opps some thing went wrong");
			mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
			$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
			echo '<select name="incharge_empcode" id="incharge_empcode" tabindex="3" style="width:270px;">';
			echo '<option value="0">--Employee--</option>';
			while($row=mysql_fetch_array($result_emp_id))
			{
			echo '<option value="'.$row['emp_code'].'">'.$row['first_name'].'</option>';

			}
			echo '</select>';
			?>
		</td>
    </tr>
			
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="128">Allocation Type*</td>
	
		<td>
		<?php 
		$fgmembersite->DBLogin();
		$result_state=mysql_query("select * from allocation_type");
				echo '<select name="allocate_id" id="allocate_id" tabindex="2" style="width:260px;">';
				echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

					}
					echo '</select>';
			?>
		</td>
    </tr>
	<tr height="30">
		<td width="128">Employee Code</td>
	
		<td>
	<span id="display_inchargename"><input type='text' name='leadername' id='leadername' readonly ="true" size="10"/></span>
		</td>
    </tr>
		</table><!-- end--->		
</fieldset>


<?php if($_GET['success']=="update") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0002 : Data Updated Successfully "; 
	?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php } 
if($_GET['success']=="error") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }?>
<br/>
</div><!--- mytableformreceipt1 div end-->
<table width="100%" style="clear:both">
  <tbody><tr height="50px;" align="center">
	<td><input type="submit" value="Save" class="buttons" id="save" name="save">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=3'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_driver_allocate.php'" class="buttons" value="View" name="View">
	</td>
  </tr>
  <tr>
  <td>
  <div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
  <?php if($_GET['success']=="create") 
{
?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Data Entered Successfully"; 
?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }?>
  </td>
  </tr>
</tbody></table>
</form>
</div><!--- mainarea  div end-->
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>