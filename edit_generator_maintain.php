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
	$header_file='./layout/admin_header_bms.php';
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
<script type="text/javascript">
function validateForm() {
	var generator_code=document.getElementById("generator_code");
	if(generator_code.value==0) {
		$('.myalignbuild').html('ERR 0009 : Select Generator Code');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("generator_code").focus();
		return false;
	}	
	var mduedate=document.getElementById("mduedate");
	if(mduedate.value=="") {
		$('.myalignbuild').html('ERR 0009 : Select Maintenance Due Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("mduedate").focus();
		return false;
	}	
	var status=document.getElementById("status");
	if(status.value==0) {
		$('.myalignbuild').html('ERR 0009 : Select Status');
		$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
		document.getElementById("status").focus();
		return false;
	}	
	var donedate=document.getElementById("donedate");
	if(donedate.value=="") {
		$('.myalignbuild').html('ERR 0009 : Select Done Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("donedate").focus();
		return false;
	}	
	var nextduedate=document.getElementById("nextduedate");
	if(nextduedate.value=="") {
		$('.myalignbuild').html('ERR 0009 : Select Next Due Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("nextduedate").focus();
		return false;
	}	
	
	var enddate=document.getElementById("nextduedate").value;
	var enddateval = enddate.substring(6,10)+"/"+enddate.substring(3,5)+"/"+enddate.substring(0,2);
	var current_date=document.getElementById("hide_date").value;
	 var current_dateval = current_date.substring(6,10)+"/"+current_date.substring(3,5)+"/"+current_date.substring(0,2);

	var date_check=new Date(enddateval).getTime() > new Date(current_dateval).getTime();
	if (date_check==false)
	{
	$('.myalignbuild').html('ERR 0009 :Date should be greater than current date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("nextduedate").focus();
		return false;
	}
}
$(function () {		
	$('#clear').click(function(event) {
		$('#generator_code').val()=0;
		$('#mduedate').val()="";
		$('#status').val()=0;
		$('#donedate').val()="";
		$('#nextduedate').val()="";
		$('#desc').val()="";	
		$('#addcost').val()="";				
	});		
});
$(document).ready(function() {
	$("#addcost").blur(function() {
		var addcost=document.getElementById("addcost").value;
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!addcost.match(numericExpression)) {
			$('.myalignbuild').html('ERR 0009 : Only Numbers');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("addcost").value="";
			document.getElementById("addcost").focus();
			return false;
		}
		var x = $("#addcost").val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});
});
$(document).ready(function() { 
$("#building_code").change(function(event) {
		var building_code=document.getElementById("building_code").value;
		if (building_code != 0)
		{
			
			$('#code_display').load('ajax_building.php?building_code='+building_code);
		}
		else
		{
			document.getElementById("generator_code_id").value = "";
			document.getElementById("generator_code").value = "";
		}
    });		
	  });
	  $(document).ready(function() { 
		var building_code=document.getElementById("building_code").value;
		if (building_code != 0)
		{
			
			$('#code_display').load('ajax_building.php?building_code='+building_code);
		}
		else
		{
			document.getElementById("generator_code_id").value = "";
			document.getElementById("generator_code").value = "";
		}	
	  });
	</script>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) {
	$id=$_GET['id'];
	$query = "SELECT * FROM generator_maintain where id=$id"; 
	$result = mysql_query($query);
	if($result === FALSE) {
		die(mysql_error()); // TODO: better error handling
	}
	while($row = mysql_fetch_array($result)) {
		$generator_code=$row['generator_code'];
		$due_date=$row['due_date'];
		$status=$row['status'];
		$done_date=$row['done_date'];
		$next_due_date=$row['next_due_date'];
		$description=$row['description'];
		$cost=$row['cost'];
		$currency=$row['currency'];	
		$building_id=$row['building_id'];
	    $vendor_code=$row['vendor_code'];
	}
}
if(isset($_POST['save'])) {
	$building_id=$_POST['building_code'];
	$vendor=$_POST['vendor_code'];
	$generator_code=$_POST['generator_code'];
	$mduedate=$_POST['mduedate'];
	$status=$_POST['status'];
	$donedate=$_POST['donedate'];
	$nextduedate=$_POST['nextduedate'];
	$desc=$_POST['desc'];
	$addcost=$_POST['addcost'];
	$add_currency=$fgmembersite->getdbval($_POST['add_currency'],'id','name','currency');
	$user_id=$_SESSION['user_id'];
	$edit_id=$_POST['edit_id'];
	$current_date=date("Y-m-d H:i:s");
	if(!mysql_query('update  generator_maintain SET generator_code="'.$generator_code.'",due_date="'.$mduedate.'", 	status="'.$status.'",done_date="'.$donedate.'",next_due_date="'.$nextduedate.'",description="'.$desc.'",cost="'.$addcost.'",currency="'.$add_currency.'",vendor_code="'.$vendor_code.'",building_id="'.$building_id.'",updated_by="'.$user_id.'",updated_at="'.$current_date.'" WHERE id="'.$edit_id.'" ')) {
		die('Error: ' . mysql_error());
	}
	$fgmembersite->RedirectToURL("view_generator_maintain.php?success=update");
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">GENERATOR MAINTENANCE</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Generator Details</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			 <td width="149">Building Name*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				
				<?php
									$result_state=mysql_query("SELECT id,building_name from building");
									echo '<select name="building_code" id="building_code" tabindex="1"  style="width:220px;">';
									echo '<option value="0">--Select--</option>';
									while($row=mysql_fetch_array($result_state))
									{
									
									if($row['id'] == $building_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['building_name'])."</option>";
									
									}
									echo '</select>';
									?>&nbsp;
				
			  </td>
			</tr>
			<tr height="30">
			 <td width="120">Status*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>	
<?php
	$result_state=mysql_query("SELECT id,name from status_bms");
				echo '<select name="status" id="status" tabindex="3">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state)) {
				if($row['id'] == $status) {
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
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="120">Generator Code</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
				<div id="code_display">
				<input type='hidden' name='generator_code' id='generator_code' size="10" tabindex="4" autocomplete="off"/>
				<input type='text' name='generator_code_id' id='generator_code_id' size="10" tabindex="4" autocomplete="off"/>
				</div>
			</td>
			</tr>
			<tr height="30">
				<td width="120">Maint. Due Date*</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>				
				<td>
				<input type="text" name="mduedate" id="mduedate" value="<?php echo $due_date;?>" size="10" autocomplete='off' tabindex="2" class="datepicker"/>	
				</td>
				</tr>	
		</table><!-- end--->		
</fieldset>

<fieldset class="alignment" align="left">
  <legend><strong>Maintenance Details</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="135" style="white-space:nowrap;">Maint. Done Date*</td>
				 <td>&nbsp;&nbsp;&nbsp;</td>
				 <td>
					<input type='text' name='donedate' id='donedate' value="<?php echo $done_date;?>" size="10" tabindex="5" autocomplete="off" class="datepicker"/>
				  </td>
			</tr>
					
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
		<tr height="30">
			 <td width="155">Vendor Name*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<?php
					$result_state=mysql_query("SELECT id,name from vendor_bms");
					echo '<select name="vendor_code" id="vendor_code" tabindex="11" style="width:240px;">';
					echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state)) {
					
					if($row['id'] == $vendor_code){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['name'])."</option>";
					}
					echo '</select>';
				?>&nbsp;				
			  </td>
			</tr>
		</table><!-- end--->	

<table width="100%" align="left"><!-- start--->
			<tr height="30">
				 <td width="137">Description</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				 <td>					
					<input type='text' name='desc' id='desc' size="70" tabindex="4" autocomplete="off" value="<?php echo $description;?>"/>					
				  </td>
				</tr>
		</table>

<table width="50%" align="left"><!-- start--->
				<tr height="30">
			 <td width="120">Currency</td>
			 	<?php
					$result_state=mysql_query("select * from currency where id=1");
					while($row=mysql_fetch_array($result_state)) {
						$currency_id = $row['id'];
						$currency_name = $row['name'];
						$symbol=$row['symbol'];
					}							
				?>
			 <td width="10" ><img width="15px" height="15px" src="images/<?php echo $symbol;?>" style="vertical-align:middle;"></img></td>
			 <td><input type='text' name='add_currency' id='add_currency' value="<?php echo $currency_name;?>" size="4"  readonly="true" tabindex="7" autocomplete="off"/>
			 </td>
			</tr>
					<tr height="30">
				 <td width="120" style="white-space:nowrap;">Next Maint. Due Date*</td>
			 <td width="10"></td>
			 <td>				
				<input type="text" name="nextduedate" id="nextduedate" value="<?php echo $next_due_date;?>" size="10" autocomplete='off' tabindex="6" class="datepicker" />
				<input type='hidden' name='hide_date' id='hide_date' tabindex="10" value="<?php echo date('d-m-Y'); ?>"/>
			</td>
				 
				</tr>
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
		<tr height="30">
			 <td width="120"> Cost</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<input type="text" name="addcost" id="addcost" style="text-align:right;" size="10" autocomplete='off' tabindex="8" value="<?php echo $cost;?>" />				
			  </td>
			</tr>
		</table><!-- end--->			
</fieldset>

<?php if($_GET['success']=="error") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php } ?>
<br/>
</div><!--- mytableformreceipt1 div end-->
<table width="100%" style="clear:both">
  <tbody><tr height="50px;" align="center">
	<td><input type="submit" value="Save" class="buttons" id="save" name="save">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=2'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_generator_maintain.php'" class="buttons" value="View" name="View">
		 <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_GET['id'];?>"/>
	</td>
  </tr>
  <tr>
  <td>
  <div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
<?php if($_GET['success']=="update") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Data Updated Successfully"; ?></h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php } ?>
  </td>
  </tr>
</tbody></table>
</form>
</div><!--- mainarea  div end-->
<?php $footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>