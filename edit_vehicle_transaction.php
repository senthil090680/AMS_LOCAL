<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE);

extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
//exit;

if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if ($fgmembersite->usertype() == 1)	{
	//$header_file='./layout/admin_header_bms.php';
	$header_file='./layout/admin_header_fms.php';
}

$query_edit				=	"SELECT id,vehicle_reg_id,transaction_date,transaction_type_id,transaction_number,vendor_id,uom_id,units,currency_id,rate,cost,trans_desc,bought_by,emp_code,driver_code_id,others FROM vehicle_transaction WHERE id = '$id'";			
$res_edit				=	mysql_query($query_edit) or die(mysql_error());
$row_edit				=	mysql_fetch_array($res_edit);

if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {	
	$fgmembersite->DBLogin();
	$vehicle_reg_id			=	$_POST['vehicle_reg_id'];
	$transaction_date		=	$_POST['transaction_date'];
	$transaction_type_id	=	$_POST['transaction_type_id'];
	$transaction_number		=	$_POST['code'];
	$vendor_id				=	$_POST['vendor_id'];
	$uom_id					=	$_POST['uom'];
	$units					=	$_POST['units'];
	$currency_id			=	$fgmembersite->getdbval($_POST['total_currency'],'id','name','currency');
	$rate					=	$_POST['rate'];
	$cost					=	$_POST['cost'];
	$desc					=	$_POST['desc'];
	$bought_by				=	$_POST['bought_by'];
	if($bought_by == 1) {	
		$emp_code				=	$_POST['emp_bought_id'];
		$driver_code_id			=	'';
		$others					=	'';
	} else if ($bought_by == 2) {
		$emp_code				=	'';
		$driver_code_id			=	$_POST['driver_bought_id'];
		$others					=	'';
	} elseif ($bought_by == 3) {
		$emp_code				=	'';
		$driver_code_id			=	'';
		$others					=	$_POST['bought_id'];
	} 
	$user_id					=	$_SESSION['user_id'];
	//echo 'INSERT INTO vehicle_transaction SET vehicle_reg_id="'.$vehicle_reg_id.'",transaction_date="'.$transaction_date.'",transaction_type_id="'.$transaction_type_id.'",transaction_number="'.$transaction_number.'",vendor_id="'.$vendor_id.'",uom_id="'.$uom_id.'",units="'.$units.'",currency_id="'.$currency_id.'",rate="'.$rate.'",cost="'.$cost.'",trans_desc="'.$desc.'",bought_by="'.$bought_by.'",emp_code="'.$emp_code.'",driver_code_id="'.$driver_code_id.'",others="'.$others.'",created_by="'.$user_id.'" '; 
	//exit;
	if(!mysql_query('UPDATE vehicle_transaction SET vehicle_reg_id="'.$vehicle_reg_id.'",transaction_date="'.$transaction_date.'",transaction_type_id="'.$transaction_type_id.'",transaction_number="'.$transaction_number.'",vendor_id="'.$vendor_id.'",uom_id="'.$uom_id.'",units="'.$units.'",currency_id="'.$currency_id.'",rate="'.$rate.'",cost="'.$cost.'",trans_desc="'.$desc.'",bought_by="'.$bought_by.'",emp_code="'.$emp_code.'",driver_code_id="'.$driver_code_id.'",others="'.$others.'",created_by="'.$user_id.'" WHERE id = "'.$edit_id.'"')) {
	die('Error: ' . mysql_error());
}
	echo'<script> window.location="view_vehicle_transaction.php?success=update"; </script> ';
}
?>
<style type="text/css">
.confirmMAp {
	margin:0 auto;
	display:none;
	background:#EEEEEE;
	color:#fff;
	width:622px;
	height:350px;
	position:fixed;
	left:250px;
	top:100px;
	border:1px solid #EEEEEE;
	z-index:2;
	border-radius:5px 5px 5px 5px;
}
.ShowMap{
	display:none;
	z-index:2;
	position:fixed;
	_position:absolute; /* hack for internet explorer */
	width:620px;
	height:320px;
	color:#FFF;
	border-radius:5px;
	background-color:#FFF;
	border:1px solid #cecece;
}

#mainareabuild {
	width:100%;
	height:528px;
	background:#ebebeb;
	/* overflow-y:auto; */
}
.myalignbuild {
	padding-top:8px;
	margin:0 auto;
	color:#FF0000;
}
#mytableformbuild {
    background: none repeat scroll 0 0 #FFFFFF;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    width: 95%;
}
#errormsgbuild{
	width:45%;
	height:30px;
	background:#c1c1c1;
	margin-left:auto;
	margin-right:auto;
	border-radius:10px;
	padding-top:0px;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	-ms-border-radius:10px;
	-o-border-radius:10px;
	text-align:center;
}
#closebutton {
  position:relative;
  top:-35px;
  right:-219px;
  border:none;
  background:url(images/close_pop.png) no-repeat;
  color:transparent;
}
.scroll_box {
	height:268px;
	overflow:auto;
}
.alignment2 {
    font-size: 16px;
    margin-left: 10px;
    padding-left: 20px;
    width: 95%;
}
.alignment3 {
	font-size: 16px;
    margin-left: 10px;
    padding-left: 2px;
    width: 90%;
}
</style>
<script type="text/javascript" language="javascript">
$(document).live('ready',function() {

	$("#vehicle_reg_id").focus();
	
	$("#vendor_id").change(function(event){
		var selvalue_vendor_id=document.getElementById("vendor_id").value;
		if (selvalue_vendor_id != 0) {			 
	          $('#display_vendor_id').load('ajax_driver.php?selvalue_vendor_id='+selvalue_vendor_id);
		} else {
			document.getElementById("vendor_name").value = "";		
		}
	 });		

	$("#bought_by").live('change',function(event){
		var selvalue_bought_by=document.getElementById("bought_by").value;
		if (selvalue_bought_by != 0) {
	          $('#display_bought_by').load('ajax_driver.php?selvalue_bought_by='+selvalue_bought_by);
		}
	});		
	$("#driver_bought_id").live('change',function(event){
		var selvalue_bought_by=document.getElementById("driver_bought_id").value;
		if (selvalue_bought_by != 0) {
	          $('#display_bought_id').load('ajax_driver.php?driver_bought_id='+selvalue_bought_by);
		}
	});
	$("#emp_bought_id").live('change',function(event){
		var selvalue_bought_by=document.getElementById("emp_bought_id").value;
		if (selvalue_bought_by != 0) {
	          $('#display_bought_id').load('ajax_driver.php?emp_bought_id='+selvalue_bought_by);
		}
	});	
	
	$(function () {
		/*$('#closebutton').button({
			icons: {
				primary : "../images/close_pop.png",
			},
			text:false
		});*/
		
		$('#closebutton').click(function(event) {
			//alert('232');
			$('#errormsgbuild').hide();
			return false;
		});		
	});

	$("#units").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+$/;
		if(!mcost.match(numericExpression))
		{
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});

	$("#rate").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#cost").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});
	
	$("#part_save").on("click", function() {
		//alert("232");
		var vehicle_reg_id		=	$("#vehicle_reg_id").val();
		var transaction_date	=	$("#transaction_date").val();
		var transaction_type_id	=	$("#transaction_type_id").val();
		var tnumber				=	$("#code").val();
		var vendor_id			=	$("#vendor_id").val();
		var uom					=	$("#uom").val();
		var units				=	$("#units").val();
		var total_currency		=	$("#total_currency").val();
		var rate				=	$("#rate").val();
		var cost				=	$("#cost").val();
		var desc				=	$("#desc").val();
		var bought_by			=	$("#bought_by").val();

		var currentdate			=	new Date();

		var transaction_dateval	=	new Date(transaction_date.substring(6,10)+"/"+transaction_date.substring(3,5)+"/"+transaction_date.substring(0,2)).getTime();

		//alert(transaction_date.substring(0,2));
		var currentdateval		=	new Date(currentdate.getFullYear()+"/"+parseInt(currentdate.getMonth()+1)+"/"+currentdate.getDate()).getTime();	

		//alert(transaction_dateval);
		//alert(currentdateval);
		
		if(vehicle_reg_id == '0') {
			$('.myalignbuild').html('ERR : Select Registration Number');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vehicle_reg_id").focus();
			return false;
		} else if(transaction_dateval > currentdateval) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#transaction_date").focus();
			return false;
		} if(transaction_type_id == '0') {
			$('.myalignbuild').html('ERR : Select Transaction Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#transaction_type_id").focus();
			return false;
		} else if(vendor_id == '0') {
			$('.myalignbuild').html('ERR : Select Vendor Code');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vendor_id").focus();
			return false;
		}  else if(uom == '0') {
			$('.myalignbuild').html('ERR : Select UOM');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#uom").focus();
			return false;
		} else if(units == '') {
			$('.myalignbuild').html('ERR : Enter Units');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#units").focus();
			return false;
		} else if(total_currency == '') {
			$('.myalignbuild').html('ERR : Enter Currency');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#total_currency').hide();
			},5000);
			$("#dcost").focus();
			return false;
		} else if(rate == '') {
			$('.myalignbuild').html('ERR : Enter Rate');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#rate").focus();
			return false;
		} else if(cost == '') {
			$('.myalignbuild').html('ERR : Enter Cost');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#cost").focus();
			return false;
		} else if(desc == '') {
			$('.myalignbuild').html('ERR : Enter Description');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#desc").focus();
			return false;
		} else if(bought_by == '4') {
			$('.myalignbuild').html('ERR : Select Bought By');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#bought_by").focus();
			return false;
		}

		if(bought_by == '1') {
			if($('#emp_bought_id').val() == '0') {
				$('.myalignbuild').html('ERR : Select Employee Code');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#emp_bought_id").focus();
				return false;
			}
		} if(bought_by == '2') {
			if($('#driver_bought_id').val() == '0') {
				$('.myalignbuild').html('ERR : Select Driver Code');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#driver_bought_id").focus();
				return false;
			}
		} if(bought_by == '3') {
			if($('#bought_id').val() == '') {
				$('.myalignbuild').html('ERR : Enter Others');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#bought_id").focus();
				return false;
			}
		}
		//return false;
		$("#formsaveval").val('800');
		$("#diesel_save").submit();
	});
});  
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">VEHICLE TRANSACTIONS</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">
<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Vehicle Transactions</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120" style="white-space:nowrap;">Vehicle Regn. No.*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
		$result_state=mysql_query("select * from vehicle");
		echo '<select name="vehicle_reg_id" id="vehicle_reg_id" tabindex="1" style="width:270px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state))
		{
			if($row['id'] == $row_edit['vehicle_reg_id']){
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
     <td width="120">Transaction Type*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$result_state=mysql_query("SELECT * FROM transaction_type");
			echo '<select name="transaction_type_id" id="transaction_type_id" tabindex="3">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state))
			{
				if($row['id'] == $row_edit['transaction_type_id']){
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
		<td width="120" >Vendor Name*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='hidden' name='edit_id' id='edit_id' value="<?php echo $row_edit['id']; ?>" />
		<?php
				$result_state=mysql_query("select * from vendor");
				echo '<select name="vendor_id" id="vendor_id" tabindex="5" style="width:270px;">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{	
					if($row['id'] == $row_edit['vendor_id']){
						  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }							
					echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['name'])."</option>";
				}
				echo '</select>';
	           ?></td>
	</tr>
	
	<tr height="30">
     <td width="120">UOM*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("select * from uom");
			echo '<select name="uom" id="uom" tabindex="7">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state))
			{
				if($row['id'] == $row_edit['uom_id']){
					  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
				 } else {
					  $isSelected = ''; // else we remove any tag
				 }							
				echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['name'])."</option>";
			}
			echo '</select>';
			?></td>
	</tr>
	
	<tr height="30">
	     <?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency WHERE id = '$row_edit[currency_id]'");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency </td>
		<td><img width="15px" height="15px" src="images/<?php echo $row['symbol']; ?>"></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='total_currency' id='total_currency' tabindex="9" value="<?php echo $row['name']; ?>" size="4" readonly class="textbox"/></td>
	</tr>
	
	<tr height="30">
     <td width="120">Cost*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='cost' id='cost' size="10" value="<?php echo $row_edit['cost']; ?>" class="textbox" tabindex="11" autocomplete="off" style="text-align:right;" /></td>
	</tr>
	
	<tr height="30">
     <td width="120">Bought By*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><select name='bought_by' id='bought_by' tabindex="13" >
		<option value="4">--Select--</option>
		<option value="1" <?php if($row_edit['bought_by'] == 1) { echo "selected"; }; ?> >Employee</option>
		<option value="2" <?php if($row_edit['bought_by'] == 2) { echo "selected"; }; ?> >Driver</option>
		<option value="3" <?php if($row_edit['bought_by'] == 3) { echo "selected"; }; ?> >Others</option>
		</select>
	 </td>
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
     <td width="120">Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='transaction_date' id='transaction_date' size="10" tabindex="2" value="<?php echo $row_edit[transaction_date]; ?>" class="datepicker"/></td>
	</tr>
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">Transaction Number</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		<input type='text' name='code' id='code' size="6" tabindex="4" class="textbox" value="<?php echo $row_edit[transaction_number]; ?>" readonly="true" /></td>
	</tr>
     
    <tr height="30">
		<td width="120">Vendor Code</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><div id="display_vendor_id">
			<input type='text' name='vendor_name' id='vendor_name' size="10" value="<?php echo $fgmembersite->getdbval($row_edit[vendor_id], 'vendor_code', 'id', 'vendor'); ?>" tabindex="6" readonly autocomplete="off" class="textbox" />
			</div>
		</td>
    </tr>
    
	<tr height="30">
		 <td width="120" nowrap="nowrap">Units*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='units' id='units' size="10" value="<?php echo $row_edit[units]; ?>" class="textbox" tabindex="8" autocomplete="off" style="text-align:right;" /></td>
	</tr>

	<tr height="30">
		 <td width="120" nowrap="nowrap">Rate*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='rate' id='rate' size="10" value="<?php echo $row_edit[rate]; ?>" class="textbox" tabindex="10" autocomplete="off"  style="text-align:right;"/></td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap">Description*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='desc' id='desc' value="<?php echo ucfirst($row_edit[trans_desc]); ?>" size="36" tabindex="12" autocomplete="off" class="textbox" /></td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap">Employee/Driver/Others*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>		 
		  <div id="display_bought_by">		 	
			<?php
			$selvalue=$row_edit["bought_by"];
			if($selvalue==1) {
				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info order by emp_id",$bd);
				echo '<select name="emp_bought_id" id="emp_bought_id" style="width:172px;" tabindex="14" class="selectbox">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_emp_id)) {
					if($row['emp_code'] == $row_edit['emp_code']){
						  $isSelected 	= 	' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						  $first_name	=	$row["emp_code"];
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }							
					echo "<option value='".$row['emp_code']."'".$isSelected.">".$fgmembersite->upperstate($row['first_name'])."</option>";
				}
				echo '</select>&nbsp;<span id="display_bought_id"><input type="text" name="emp_nameval" id="emp_nameval" size="6" class="textbox" value="'.$first_name.'" readonly="true" /></span>';
			}
			if($selvalue==2) {
				$result_state=mysql_query("select * from driver");
				echo '<select name="driver_bought_id" id="driver_bought_id" tabindex="14" style="width:172px;" class="selectbox">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{	
					if($row['id'] == $row_edit['driver_code_id']){
						$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag		
						$driver_name	=	$row["driver_code"]; 
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }							
					echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['emp_name'])."</option>";
					//echo '<option value="'.$row['id'].'">'.$row['driver_code'].'</option>';
				}
				echo '</select>&nbsp;<span id="display_bought_id"><input type="text" name="vendor_name" id="vendor_name" size="6" class="textbox" value="'.$driver_name.'" readonly="true"/></span>';
			}			
			if($selvalue==3) {
				echo '<input type="text" name="bought_id" id="bought_id" value="'.$row_edit[others].'" class="textbox"/>';
			}
			?>
		  </div>
		 </td>
	</tr>

   </table>
  </td>
 </tr>
</table>

<!----------------------------------------------- Right Table End -------------------------------------->

</fieldset>
  </td>
</tr>
</table>

</div>


</div>
</div>
 <table width="100%" style="clear:both">
      <tr align="center" height="35px;">
      <td nowrap="nowrap">	  
	  <input type="submit" name="part_save" id="part_save" class="buttons" value="Save" />&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="hidden" name="formsaveval" id="formsaveval" /> <!-- This will give the value when form is submitted, otherwise it will empty -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=3'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_vehicle_transaction.php'"/></td>
	 </td>
     </tr>
  </table>
	<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
</form>
<!-- </div> -->
</div>

<div id="backgroundChatPopup"></div>
<!-- <div id="map-canvas" style="width: 500px; height: 300px"></div> -->
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>