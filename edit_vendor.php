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

			var selvalue=document.getElementById("city").value;
			if (selvalue != 0) {
				$('#display_state').load('ajax_building.php?selvalue='+selvalue);
			}
			else {
				document.getElementById("state").value = "";			
			}

		});	
	  </script>
<script>	
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
	var vendor_name=document.getElementById("name").value;
	if(vendor_name=="")
	{
		$('.myalignbuild').html('ERR 0009 : Enter The Vendor Name');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("name").focus();
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
	}
$(function () {		
	$('#clear').click(function(event) {
		$('#name').val()="";
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
$vendor_code=$_POST['code'];
$vendor_name=$_POST['name'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$address3=$_POST['address3'];
$city_vendor=$_POST['city'];
$contact_number=$_POST['contact_number'];
$alt_contact_number=$_POST['alt_contact_number'];
$user_id=$_SESSION['user_id'];
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");
$fgmembersite->DBLogin();
if(!mysql_query('update vendor SET vendor_code="'.$vendor_code.'",name="'.$vendor_name.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",city_id="'.$city_vendor.'",contact_number="'.$contact_number.'",alt_contact_number="'.$alt_contact_number.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
	$fgmembersite->RedirectToURL("view_vendor.php?success=update");
}

?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * from vendor where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$vendor_code=$row['vendor_code'];
$name=$row['name'];
$address1=$row['address1'];
$address2=$row['address2'];
$address3=$row['address3'];
$city_id=$row['city_id'];
$contact_number=$row['contact_number'];
$alt_contact_number=$row['alt_contact_number'];
}
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">VENDOR</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Vendor</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="135">Vendor Code</td>
			<td>
	<input type='text' name='code' id='code'  value="<?php echo $vendor_code;?>" readonly="true" size="4" />
			</td>
			</tr>
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="130">Vendor Name*</td>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td>
		<input type='text' name='name' id='name' tabindex="1" size="40" value="<?php echo $name;?>"/>
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
    <td width="111">Address Line 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type="text" id="address1" name="address1" size="35" autocomplete="off" maxlength="20" tabindex="2" value="<?php echo $address1;?>" /></td>
    </tr>
    
	<tr height="30">
     <td width="111"><span style="padding-left:55px;">Line 2</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address2" name="address2" size="35" autocomplete="off" tabindex="3" value="<?php echo $address2;?>" /></td>
	</tr>

	<tr height="30">
     <td width="111"><span style="padding-left:55px;">Line 3</span></td>
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
	<div id="display_state"><input type='text' type="text" name='state' id='state' readonly class="textbox" /></div>
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
    <td width="130">Contact Number*</td>
    <td><input type='text' name='contact_number' id='contact_number' tabindex="6" value="<?php echo $contact_number;?>"/></td>
    </tr>
	
</table><!-- end--->

<table width="50%" align="left"><!-- start--->
		
<tr height="30">
     <td width="148" nowrap="nowrap">Alternate Contact No.</td>
     <td><input type='text' name='alt_contact_number' id='alt_contact_number' tabindex="7" value="<?php echo $alt_contact_number;?>"/></td>
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
		 <input type="button" onclick="window.location='view_vendor.php'" class="buttons" value="View" name="View">
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