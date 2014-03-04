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
function validateForm() 
	{
	var vehicle_reg_id=document.getElementById("vehicle_reg_id").value;
	if(vehicle_reg_id==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Vehicle Registration Number');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("vehicle_reg_id").focus();
		return false;
	}
	var status_id=document.getElementById("status_id").value;
	if(status_id==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Status');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("status_id").focus();
		return false;
	}
	}
$(function () {		
	$('#clear').click(function(event) {
		$('#vehicle_reg_id').val()=0;
		$('#status_id').val()=0;		
	});		
});
</script>
<?php
if(isset($_POST['save'])) 
{
$edit_id=$_POST['edit_id'];
$user_id=$_SESSION['user_id'];
$status_id=$_POST['status_id'];
$current_date=date("Y-m-d H:i:s");
			if ($status_id != "")
			{
			if(!mysql_query('UPDATE vehicle_status SET status_id="'.$status_id.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
			{
			die('Error: ' . mysql_error());
			}
				$fgmembersite->RedirectToURL("view_vehicle_status.php?success=update");
			}
}

?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM vehicle_status where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
	$vehicle_reg_id=$row['vehicle_reg_id'];
	$status_id=$row['status_id'];
	
}
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">VEHICLE STATUS</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Vehicle Status</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="148">Vehicle Regn. No*</td>
			<td>
	<?php
					$result_state=mysql_query("select * from vehicle where id=$vehicle_reg_id");
					while($row=mysql_fetch_array($result_state))
					{
					$reg_no=$row['vehicle_regno']; 
					}
					
					?>
					<input type='text' name='vehicle_reg_id' id='vehicle_reg_id'  maxlength="50" size="42" autocomplete='off' value="<?php echo $reg_no; ?>" readonly="true"/>
			</td>
			</tr>
					
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="128">Status*</td>
	
		<td>
		<?php 			
				$result_state=mysql_query("select * from status");
				echo '<select name="status_id" id="status_id" tabindex="2">';
					echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state))
					{
					if($row['id'] == $status_id){
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
		</table><!-- end--->		
</fieldset>


<?php if($_GET['success']=="update") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0002 : Data Updated Successfully "; 
	?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php } 
if($_GET['success']=="error") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }

?>
<br/>
</div><!--- mytableformreceipt1 div end-->
<table width="100%" style="clear:both">
  <tbody><tr height="50px;" align="center">
	<td><input type="submit" value="Save" class="buttons" id="save" name="save">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='hidden' name='edit_id' id='edit_id' value='<?php echo $_GET['id'];?>'/>
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=3'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_vehicle_status.php'" class="buttons" value="View" name="View">
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
<?php 
}
?>
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