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
$fgmembersite->DBLogin();
if(!mysql_query('insert into vendor SET vendor_code="'.$vendor_code.'",name="'.$vendor_name.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",city_id="'.$city_vendor.'",contact_number="'.$contact_number.'",alt_contact_number="'.$alt_contact_number.'",created_by="'.$user_id.'" '))
{
die('Error: ' . mysql_error());
}
	$fgmembersite->RedirectToURL("view_vendor.php?success=create");
}

?>

<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">Vendor</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<fieldset class="alignment" align="left">
  <legend><strong>Vendor</strong></legend>
<table width="50%" align="left"><!-- start--->
			<tr height="30">
			<td width="135">Vendor Code</td>
			<td>
			<?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT vendor_code FROM  vendor ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus					  =	 mysql_fetch_array($cusold);
				$cusnumber	  =	$row_cus['vendor_code'];

				$getcusno						=	abs(str_replace("VE",'',strstr($cusnumber,"VE")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"VE".$createdcode;
			} else {
				$customer_code				=	"VE001";
			}
		}
	?>
	<input type='text' name='code' id='code'  value="<?php echo $customer_code;?>" readonly="true" size="7"/>
			</td>
			</tr>
</table><!-- end--->

	 <table width="50%" align="left"><!-- start--->
			<tr height="30">
		<td width="128">Vendor Name*</td>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='name' id='name' size="40" tabindex="1"/>
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
    <td width="111" >Address Line 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type="text" id="address1" name="address1" size="35" autocomplete="off" maxlength="20" tabindex="2" class="areatext" /></td>
    </tr>
    
	<tr height="30">
     <td width="111" ><span style="padding-left:55px;">Line 2</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address2" name="address2" size="35" autocomplete="off" tabindex="3" class="areatext" /></td>
	</tr>

	<tr height="30">
     <td width="111" ><span style="padding-left:55px;">Line 3</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address3" name="address3" size="35" autocomplete="off" tabindex="4" class="areatext" /></td>
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
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
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
    <td><input type='text' name='contact_number' id='contact_number' tabindex="6" /></td>
    </tr>
	
</table><!-- end--->

<table width="50%" align="left"><!-- start--->
		
<tr height="30">
     <td width="148" nowrap="nowrap">Alternate Contact No.</td>
     <td><input type='text' name='alt_contact_number' id='alt_contact_number' tabindex="7"/></td>
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
		 <input type="button" onclick="window.location='view_vendor.php'" class="buttons" value="View" name="View">
	</td>
  </tr>
  <tr>
  <td>
  <div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
  <?php if($_GET['success']=="create")  {
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