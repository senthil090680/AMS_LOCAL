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
			
		document.getElementById("leadername").value = selvalue_incharge_empcode;	//$('#display_inchargename').load('ajax_building.php?selvalue_incharge_empcode='+selvalue_incharge_empcode);
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
	var incharge_empcode=document.getElementById("incharge_empcode").value;
	if(incharge_empcode==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select Employee Code');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("incharge_empcode").focus();
		return false;
	}
	var address1=document.getElementById("address1").value;
	if(address1=="")
	{
		$('.myalignbuild').html('ERR 0009 : Enter The Address Line 1');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("address1").focus();
		return false;
	}
	var city=document.getElementById("city").value;
	if(city==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select City');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("city").focus();
		return false;
	}
	var contact_number=document.getElementById("contact_number").value;
	if(contact_number=="")
	{
		$('.myalignbuild').html('ERR 0009 : Enter The Contact Number');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("contact_number").focus();
		return false;
	}
	var licence_number=document.getElementById("licence_number").value;
	if(licence_number=="")
	{
		$('.myalignbuild').html('ERR 0009 : Enter The Licence Number');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("licence_number").focus();
		return false;
	}
	var license_date=document.getElementById("license_date").value;
	if(license_date=="")
	{
		$('.myalignbuild').html('ERR 0009 : Select The License Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("license_date").focus();
		return false;
	}
	var renewal_date=document.getElementById("renewal_date").value;
	if(renewal_date=="")
	{
		$('.myalignbuild').html('ERR 0009 : Select The Renewal Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("renewal_date").focus();
		return false;
	}
	var enddate=document.getElementById("renewal_date").value;
	var enddateval = enddate.substring(6,10)+"/"+enddate.substring(3,5)+"/"+enddate.substring(0,2);
	var current_date=document.getElementById("hide_date").value;
	 var current_dateval = current_date.substring(6,10)+"/"+current_date.substring(3,5)+"/"+current_date.substring(0,2);

	var date_check=new Date(enddateval).getTime() > new Date(current_dateval).getTime();
	if (date_check==false)
	{
	$('.myalignbuild').html('ERR 0009 :Date should be greater than or equal to current date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("renewal_date").focus();
		return false;
	}
	
	
	
	}
$(function () {		
	$('#clear').click(function(event) {
		$('#incharge_empcode').val()=0;
		$('#city').val()=0;
		$('#contact_number').val()="";
		$('#alt_contact_number').val()="";
		$('#licence_number').val()="";	
		$('#address1').val()="";	
		$('#address2').val()="";
		$('#address3').val()="";		
	});		
});
</script>
<?php
if(isset($_POST['save'])) {
$driver_code=$_POST['code'];
$emp_code=$_POST['incharge_empcode'];

				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$emp_code'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}
				
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$address3=$_POST['address3'];
$city_driver=$_POST['city'];
$contact_number=$_POST['contact_number'];
$alt_contact_number=$_POST['alt_contact_number'];
$licence_number=$_POST['licence_number'];
$license_date=$_POST['license_date'];
$renewal_date=$_POST['renewal_date'];
$user_id=$_SESSION['user_id'];
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");
$fgmembersite->DBLogin();
if(!mysql_query('update driver SET driver_code="'.$driver_code.'",emp_name="'.$emp_name.'",emp_code="'.$emp_code.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",city_id="'.$city_driver.'",contact_number="'.$contact_number.'",alt_contact_number="'.$alt_contact_number.'",license_number="'.$licence_number.'",license_date="'.$license_date.'",renewal_date="'.$renewal_date.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
	$fgmembersite->RedirectToURL("view_driver.php?success=update");
}

?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT *,c.name as state_name  FROM driver a ,city b, state c  where a.city_id=b.id and b.state_id=c.id and a.id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$driver_code=$row['driver_code'];
$emp_name=$row['emp_name'];
$emp_code=$row['emp_code'];
$address1=$row['address1'];
$address2=$row['address2'];
$address3=$row['address3'];
$city_id=$row['city_id'];
$contact_number=$row['contact_number'];
$alt_contact_number=$row['alt_contact_number'];
$license_number=$row['license_number'];
$license_date=$row['license_date'];
$renewal_date=$row['renewal_date'];
$state_name=$row['state_name'];
}
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">DRIVER</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Driver</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="148">Driver Code</td>
			<td>
	<input type='text' name='code' id='code'  value="<?php echo $driver_code;?>" readonly="true" size="7"/>
			</td>
			</tr>
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="128">Employee Name*</td>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td><?php
			$fgmembersite->DBLogin();
			$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
			or die("Opps some thing went wrong");
			mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
			$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
			echo '<select name="incharge_empcode" id="incharge_empcode" tabindex="1" class="selectbox" style="width:202px;">';
			echo '<option value="0">--Employee--</option>';
			while($row=mysql_fetch_array($result_emp_id))
			{
			if($row['emp_code'] == $emp_code){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
						 echo "<option value='".$row['emp_code']."'".$isSelected.">".$row['first_name']."</option>";
			}
			echo '</select>';
			?>
			&nbsp;
			<span id="display_inchargename"><input type='text' name='leadername' id='leadername' size="5" readonly class="textbox" value="<?php echo $emp_code;?>"/></span>
		</td>
    </tr>
		</table><!-- end--->		
</fieldset>


<fieldset align="left" class="alignment">
  <legend><strong>Address</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="125" >Address Line 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type="text" id="address1" name="address1" size="35" autocomplete="off" maxlength="20" tabindex="2" value="<?php echo $address1;?>" /></td>
    </tr>
    
	<tr height="30">
     <td width="111" ><span style="padding-left:55px;">Line 2</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address2" name="address2" size="35" autocomplete="off" tabindex="3" value="<?php echo $address2;?>" /></td>
	</tr>

	<tr height="30">
     <td width="111" ><span style="padding-left:55px;">Line 3</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address3" name="address3" size="35" autocomplete="off" tabindex="4" value="<?php echo $address3;?>" /></td>
	</tr>
</table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
  <table> 
  <tr height="30">
		<td width="146">City*</td>
		<td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
			echo '<select name="city" id="city" tabindex="5" >';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				if($row['id'] == $city_id){
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
     <td width="120" nowrap="nowrap">State</td>
     <td>
	<div id="display_state"><input type='text' type="text" name='state' id='state' readonly class="textbox" value="<?php echo $state_name; ?>"/></div>
	 </td>
	</tr>
      </table>
       </td>
     </tr>
</table>
</fieldset>

<fieldset class="alignment" align="left">
  <legend><strong>Contact Details</strong></legend>
<table width="50%" align="left"><!-- start--->
		
  <tr height="30">
    <td width="148">Contact Number*</td>
    <td><input type='text' name='contact_number' id='contact_number' tabindex="6" size="35" value="<?php echo $contact_number;?>"/></td>
    </tr>
	
</table><!-- end--->

<table width="50%" align="left"><!-- start--->
		
<tr height="30">
     <td width="148" nowrap="nowrap">Alternate Contact No.</td>
     <td><input type='text' name='alt_contact_number' id='alt_contact_number' size="35" tabindex="7" value="<?php echo $alt_contact_number;?>"/></td>
	</tr>
	
	
	
</table><!-- end--->			
</fieldset>
<fieldset class="alignment" align="left">
  <legend><strong>License Details</strong></legend>
<table width="50%" align="left"><!-- start--->
		
  <tr height="30">
    <td width="148">Driving License No.*</td>
    <td><input type='text' name='licence_number' id='licence_number' size="35" tabindex="8" value="<?php echo $license_number;?>"/></td>
    </tr>
			
<tr height="30">
<td width="148" nowrap="nowrap">Renewal Date</td>
     <td><input type='text' name='renewal_date' id='renewal_date' tabindex="10" size="10" class="datepicker" value="<?php echo $renewal_date;?>"/>
	 <input type='hidden' name='hide_date' id='hide_date' tabindex="10" value="<?php echo date('d-m-Y'); ?>"/></td>
	 </td>
	 
    
	</tr>
</table><!-- end--->

<table width="50%" align="left"><!-- start--->
		
<tr height="30">
      <td width="148" nowrap="nowrap">License Date</td>
     <td><input type='text' name='license_date' id='license_date' tabindex="9" size="10" class="datepicker" value="<?php echo $license_date;?>"/></td>
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
		 <input type="button" onclick="window.location='view_driver.php'" class="buttons" value="View" name="View">
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