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
		var selvalue_incharge_empcode=document.getElementById("driver_id").value;
		if (selvalue_incharge_empcode != 0)
		{
			$('#display_inchargename').load('ajax_building.php?selvalue_incharge_empcode_driver='+selvalue_incharge_empcode);
		}
		else
		{
			document.getElementById("leadername").value = "";
		}
	
	  });	  
	  </script>
<script>
$(document).ready(function() { 
$("#driver_id").change(function(event) {
		var selvalue_incharge_empcode=document.getElementById("driver_id").value;
		if (selvalue_incharge_empcode != 0)
		{
			$('#display_inchargename').load('ajax_building.php?selvalue_incharge_empcode_driver='+selvalue_incharge_empcode);
		}
		else
		{
			document.getElementById("leadername").value = "";
		}
    });		
	  });	
	  
	  </script>
	  <script>
function validateForm() 
	{
	var vehicle_regno=document.getElementById("vehicle_regno").value;
	if(vehicle_regno==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Vehicle Registration Number');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("vehicle_regno").focus();
		return false;
	}
	
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
	
	var mdate=document.getElementById("mdate").value;
	if(mdate=="")
	{
		$('.myalignbuild').html('ERR 0009 : Select The Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("mdate").focus();
		return false;
	}
	
	var assignment_type=document.getElementById("assignment_type").value;
	if(assignment_type==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Assignment Type');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("assignment_type").focus();
		return false;
	}
	
	var from_date=document.getElementById("from_date").value;
	if(from_date=="")
	{
		$('.myalignbuild').html('ERR 0009 : Select The From Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("from_date").focus();
		return false;
	}
	
	
	var to_date=document.getElementById("to_date").value;
	if(to_date=="")
	{
		$('.myalignbuild').html('ERR 0009 : Select The To Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("to_date").focus();
		return false;
	}
	var enddate=document.getElementById("to_date").value;
	var enddateval = enddate.substring(6,10)+"/"+enddate.substring(3,5)+"/"+enddate.substring(0,2);
	var current_date=document.getElementById("from_date").value;
	 var current_dateval = current_date.substring(6,10)+"/"+current_date.substring(3,5)+"/"+current_date.substring(0,2);

	var date_check=new Date(enddateval).getTime() >= new Date(current_dateval).getTime();
	if (date_check==false)
	{
	$('.myalignbuild').html('ERR 0009 :To Date should be greater than or equal to From Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("to_date").focus();
		return false;
	}
	
	}
$(function () {		
	$('#clear').click(function(event) {
		$('#vehicle_regno').val()=0;
		$('#driver_id').val()=0;
		$('#assignment_type').val()=0;
		$('#desc').val()="";			
	});		
});
</script>
<?php
if(isset($_POST['save'])) 
{
$code=$_POST['code'];
$vehicle_regno=$_POST['vehicle_regno'];
$driver_code=$_POST['driver_id'];
$mdate=$_POST['mdate'];
$assignment_type=$_POST['assignment_type'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$desc=$_POST['desc'];
$user_id=$_SESSION['user_id'];
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");

if(!mysql_query('update vehicle_assignment SET  assignment_no="'.$code.'",vehicle_registration_id="'.$vehicle_regno.'",driver_code_id="'.$driver_code.'",assignment_date="'.$mdate.'",assignment_type_id="'.$assignment_type.'",from_date="'.$from_date.'",to_date="'.$to_date.'",assignment_desc="'.$desc.'",updated_by="'.$user_id.'",updated_at="'.$current_date.'" WHERE id="'.$edit_id.'"'))
{
die('Error: ' . mysql_error());
}	
$fgmembersite->RedirectToURL("view_vehicle_assignment.php?success=update");

}

?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM vehicle_assignment where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$assignment_no=$row['assignment_no'];
$vehicle_registration_id=$row['vehicle_registration_id'];
$driver_code_id=$row['driver_code_id'];
$assignment_date=$row['assignment_date'];
$assignment_type_id=$row['assignment_type_id'];
$from_date=$row['from_date'];
$to_date=$row['to_date'];
$assignment_desc=$row['assignment_desc'];
}
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">VEHICLE ASSIGNMENT</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Vehicle Assignment</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="128">Assignment number</td>
		<td>
	<input type='text' name='code' id='code' readonly ="true" value="<?php echo $assignment_no; ?>" size="7"/>
		</td>
    </tr>
	<tr height="30">
			<td width="148">Driver Name*</td>
			<td>
	<?php
	$result_state=mysql_query("select * from driver");
				echo '<select name="driver_id" id="driver_id" tabindex="2" style="width:270px;">';
				echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state))
					{
					if($row['id'] == $driver_code_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['emp_name']."</option>";

					}
					echo '</select>';
					?>
			</td>
			</tr>
			
			<tr height="30">
			<td width="148">Date</td>
			<td>
		<input type='text' name='mdate' id='mdate' class="datepicker" size="10"  tabindex="3" value="<?php echo $assignment_date;?>"/>
		
			</td>
			</tr>
			<tr height="30">
			<td width="148">From Date</td>
			<td>
		<input type='text' name='from_date' id='from_date' tabindex="5"  size="10" class="datepicker" value="<?php echo $from_date;?>"/>
		
			</td>
			</tr>
			<tr height="30">
			<td width="148">Assignment Desc.</td>
			<td>
		<input type='text' name='desc' id='desc' autocomplete="off" tabindex="7"  size="30" value="<?php echo $assignment_desc;?>"/>
		
			</td>
			</tr> 
			
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="180">Vehicle Regn. No.*</td>
	
		<td>
		<?php 
		$result_state=mysql_query("SELECT id,vehicle_regno from vehicle");
							echo '<select name="vehicle_regno" id="vehicle_regno" style="width:270px;" tabindex="1" >';
							echo '<option value="0">--Select--</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $vehicle_registration_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['vehicle_regno']."</option>";
							}
							echo '</select>';
			?>
		</td>
    </tr>
	<tr height="30">
		<td width="128">Driver Code</td>
	
		<td>
	<span id="display_inchargename"><input type='text' name='leadername' id='leadername' readonly ="true" size="10"/></span>
		</td>
    </tr>
			<tr height="30">
		<td width="128">Assignment Type*</td>
	
		<td>
		<?php 
		$result_state=mysql_query("select * from assignment_type");
							echo '<select name="assignment_type" id="assignment_type" style="width:270px;" tabindex="4">';
							echo '<option value="0">--Select--</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $assignment_type_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['name'])."</option>";

							}
							echo '</select>';
			?>
		</td>
    </tr>
	<tr height="30">
			<td width="148">To Date</td>
			<td>
		<input type='text' name='to_date' id='to_date' class="datepicker" tabindex="6" size="10" value="<?php echo $to_date;?>"/>
		
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
	<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_GET['id'];?>"/>
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=3'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_vehicle_assignment.php'" class="buttons" value="View" name="View">
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