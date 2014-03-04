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
	  </script>
	  <script>
function validateForm() {
	var allocation_type_id=document.getElementById("allocation_type_id").value;
	if(allocation_type_id==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Allocation Type');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("allocation_type_id").focus();
		return false;
	}
	
	var department_id=document.getElementById("department_id").value;
	if(department_id==0)
	{
	$('.myalignbuild').html('ERR 0009 : Select The Department');
	$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
	document.getElementById("department_id").focus();
	return false;
	}
	var incharge_empcode=document.getElementById("incharge_empcode").value;
	if(incharge_empcode==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select The Employee Name');
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
		$('#allocation_type_id').val()=0;
		$('#department_id').val()=0;
		$('#incharge_empcode').val()=0;				
	});		
});
</script>
<?php
if(isset($_POST['save'])) {
$user_id=$_SESSION['user_id'];
$allocation_type_id=$_POST['allocation_type_id'];
$department_id=$_POST['department_id'];
$empcode=$_POST['incharge_empcode'];
$edit_id=$_POST['edit_id'];
$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$empcode'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}
$current_date=date("Y-m-d H:i:s");
if ($allocation_type_id!= "")
{
$fgmembersite->DBLogin();
if(!mysql_query('UPDATE vehicle_allocation_type SET allocation_type_id="'.$allocation_type_id.'",department_id="'.$department_id.'",emp_code="'.$empcode.'",emp_name="'.$emp_name.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
	$fgmembersite->RedirectToURL("view_vehicle_allocate.php?success=update");
}
}
?>

<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM vehicle_allocation_type where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{

$allocation_type_id=$row['allocation_type_id'];
$department_id=$row['department_id'];
$empcode=$row['emp_code'];
$emp_name=$row['emp_name'];
}
}
?>

<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">VEHICLE ALLOCATION</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Vehicle Allocation</strong></legend>
  <br/>
  <table width="100%">
  <tr>
  <td width="50%">
		<table align="left">
		 <tr>
		  <td>
		  <table>
			<tr height="30">
			<td width="120">Allocation Type*</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
			<?php
				$result_state=mysql_query("select * from allocation_type");
				echo '<select name="allocation_type_id" id="allocation_type_id" tabindex="1">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{
				if($row['id'] == $allocation_type_id){
						  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }
					 echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";
				}
				echo '</select>';
			?>
			</td>
			</tr>
			
		
			<tr height="30">
			 <td width="120" style="white-space:nowrap;">Employee Name*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				<?php			 
				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
				echo '<select name="incharge_empcode" id="incharge_empcode" tabindex="3" style="width:310px;">';
				echo '<option value="0">--Employee--</option>';
				while($row=mysql_fetch_array($result_emp_id))
				{
				if($row['emp_code'] == $empcode){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
							
							echo "<option value='".$row['emp_code']."'".$isSelected.">".$row['first_name']."</option>";
				}
				echo '</select>';
				?>
			</td>
			</tr>
		   </table>
		   </td>
		 </tr>
		</table>
</td>
<td width="40%" >

	 <table >
			 <tr>
			  <td>
			  <table>
			  	<tr height="30">
			 <td width="120">Division/Department*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>	
				<?php		
				$fgmembersite->DBLogin();				
				$result_state=mysql_query("select * from department");
				echo '<select name="department_id" id="department_id" tabindex="2" style="width:210px;">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{
				if($row['id'] == $department_id){
						  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }
					 echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";
				}
				echo '</select>';	
				?>					
			  </td>
			</tr>
				<tr height="30">
				<td width="120">Employee Code</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>				
				<td>
			<span id="display_inchargename"><input type='text' name='leadername' id='leadername' readonly class="textbox" tabindex="4" size="10" value="<?php echo $empcode;?>"/></span>
				</td>
				</tr>				
		   </table>
		   </td>
		 </tr>
		</table>		
 </td>	
</tr>
</table> 
<br/>
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
	<td><input type='hidden' name='edit_id' id='edit_id' value='<?php echo $_GET['id'];?>'/>
	<input type="submit" value="Save" class="buttons" id="save" name="save">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=3'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_vehicle_allocate.php'" class="buttons" value="View" name="View">
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