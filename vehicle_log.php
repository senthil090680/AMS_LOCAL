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

if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	$fgmembersite->DBLogin();
	$vehicle_reg_no			=	$_POST['vehicle_reg_no'];
	$assignment_number		=	$_POST['assignment_number'];
	$driver_code			=	$_POST['driver_code'];
	$trip_no				=	$_POST['trip_no'];
	$trip_desc				=	$_POST['trip_desc'];
	$starting_date			=	$_POST['starting_date'];
	$starting_time			=	$_POST['starting_time'];
	$ending_date			=	$_POST['ending_date'];
	$ending_time			=	$_POST['ending_time'];
	$starting_reading		=	$_POST['starting_reading'];
	$ending_reading			=	$_POST['ending_reading'];
	$total_distance			=	$_POST['total_distance'];
	$UOM_log				=	$_POST['uom_log'];
	$desc_log				=	$_POST['desc_log'];

	$user_id				=	$_SESSION['user_id'];
	//echo 'INSERT INTO vehicle_log SET vehicle_reg_no="'.$vehicle_reg_no.'",assignment_number="'.$assignment_number.'",driver_code="'.$driver_code.'",trip_no="'.$trip_no.'",trip_desc="'.$trip_desc.'",starting_date="'.$starting_date.'",starting_time="'.$starting_time.'",ending_date="'.$ending_date.'",ending_time="'.$ending_time.'",starting_reading="'.$starting_reading.'",ending_reading="'.$ending_reading.'",total_distance="'.$total_distance.'",UOM_log="'.$UOM_log.'",desc_log="'.$desc_log.'",created_by="'.$user_id.'" '; 
	//exit;
	if(!mysql_query('INSERT INTO vehicle_log SET vehicle_reg_no="'.$vehicle_reg_no.'",assignment_number="'.$assignment_number.'",driver_code="'.$driver_code.'",trip_no="'.$trip_no.'",trip_desc="'.$trip_desc.'",starting_date="'.$starting_date.'",starting_time="'.$starting_time.'",ending_date="'.$ending_date.'",ending_time="'.$ending_time.'",starting_reading="'.$starting_reading.'",ending_reading="'.$ending_reading.'",total_distance="'.$total_distance.'",UOM_log="'.$UOM_log.'",desc_log="'.$desc_log.'",created_by="'.$user_id.'" ')) {
	die('Error: ' . mysql_error());
}
	echo'<script> window.location="view_vehicle_log.php?success=create"; </script> ';
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
	height:280px;
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
function validate_time(timeStr) {
	var valid = (timeStr.search(/^\d{2}:\d{2}$/) != -1) &&
	            (timeStr.substr(0,2) >= 0 && timeStr.substr(0,2) <= 23) &&
	            (timeStr.substr(3,2) >= 0 && timeStr.substr(3,2) <= 59) &&
	            (timeStr.substr(6,2) >= 0 && timeStr.substr(6,2) <= 59);
    return valid;
}
$(document).live('ready',function() {

	$("#vehicle_reg_no").focus();
	
	$("#assignment_number").change(function(event){
		var selvalue_assno_log=document.getElementById("assignment_number").value;
		if (selvalue_assno_log != 0) {			 
	          $('#display_starting_date').load('ajax_driver.php?selvalue_assno_start='+selvalue_assno_log);
	          $('#display_ending_date').load('ajax_driver.php?selvalue_assno_end='+selvalue_assno_log);
		} else {
			$('#starting_date').val('');
	        $('#ending_date').val('');
		}
	 });		

	$("#driver_code").live('change',function(event){
		var selvalue_bought_by=document.getElementById("driver_code").value;
		if (selvalue_bought_by != 0) {
	          $('#display_driver_id').load('ajax_driver.php?selvalue_driver_code='+selvalue_bought_by);
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

	$("#starting_reading").on('blur',function() {

		var mcost=$(this).val();
		//var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		var numericExpression = /^[0-9,]+$/;
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

		var ending_reading		=	($('#ending_reading').val().replace(/,/g,''));		
		var ending_read			=	parseInt(ending_reading.replace(/,/g,''));

		//alert(starting_reading);
		
		if(ending_reading == '') {
			return false;
		}
		var starting_readingval	=	parseInt(mcost.replace(/,/g,''));
		if(starting_readingval > ending_read) {
			$('.myalignbuild').html('ERR : Starting Reading Greater Than Ending');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).focus();
			$(this).val('');
			$("#total_distance").val('');
			return false;
		}
		var total_disc			=	ending_read - parseInt(mcost.replace(/,/g,''));
		new_total_disc			=	total_disc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		$('#total_distance').val(new_total_disc);
		
	});

	$("#ending_reading").on('blur',function() {

		var starting_reading	=	($('#starting_reading').val().replace(/,/g,''));
		var starting_read		=	parseInt(starting_reading.replace(/,/g,''));

		//alert(starting_reading);
		
		if(starting_reading == '') {
			$('.myalignbuild').html('ERR : Enter Starting Reading');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#starting_reading").val("");
			$("#starting_reading").focus();
			return false;
		}
		var mcost=$(this).val();
		var numericExpression = /^[0-9,]+$/;
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
		var ending_readingval	=	parseInt(mcost.replace(/,/g,''));
		if(starting_read > ending_readingval) {
			$('.myalignbuild').html('ERR : Starting Reading Greater Than Ending');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).focus();
			$("#total_distance").val('');
			$(this).val('');
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		
		var total_disc			=	parseInt(mcost.replace(/,/g,'')) - starting_read;
		new_total_disc			=	total_disc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		//alert("2323");
		$('#total_distance').val(new_total_disc);
	});
	
	$("#part_save").on("click", function() {
		//alert("232");
		var vehicle_reg_no		=	$("#vehicle_reg_no").val();
		var assignment_number	=	$("#assignment_number").val();
		var driver_code			=	$("#driver_code").val();
		var trip_no				=	$("#trip_no").val();
		var starting_date		=	$("#starting_date").val();
		var starting_time		=	$("#starting_time").val();
		var ending_date			=	$("#ending_date").val();
		var ending_time			=	$("#ending_time").val();
		var starting_reading	=	$("#starting_reading").val();
		var ending_reading		=	$("#ending_reading").val();
		var total_distance		=	$("#total_distance").val();
		var uom_log				=	$("#uom_log").val();

		//alert(uom_log);
				
		if(vehicle_reg_no == '0') {
			$('.myalignbuild').html('ERR : Select Registration Number');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vehicle_reg_no").focus();
			return false;
		} else if(assignment_number == '0') {
			$('.myalignbuild').html('ERR : Select Assignment Number');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#assignment_number").focus();
			return false;
		} else if(driver_code == '0') {
			$('.myalignbuild').html('ERR : Select Driver Code');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#driver_code").focus();
			return false;
		} else if(starting_date == '') {
			$('.myalignbuild').html('ERR : Enter Starting Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#starting_date").focus();
			return false;
		}  else if(starting_time == '') {
			$('.myalignbuild').html('ERR : Enter Starting Time');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#starting_time").focus();
			return false;
		} else {
			if(starting_time != '') {
				var timeresult = validate_time(starting_time);
				if(!timeresult) {
					$('.myalignbuild').html('ERR : Invalid Time Format');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#starting_time").focus();
					return false;
				}
			}
		}
		
		if(ending_date == '') {
			$('.myalignbuild').html('ERR : Enter Ending Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#ending_date").focus();
			return false;
		} else if(ending_time == '') {
			$('.myalignbuild').html('ERR : Enter Ending Time');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#total_currency').hide();
			},5000);
			$("#ending_time").focus();
			return false;
		} else {
			if(ending_time != '') {
				var timeresult = validate_time(ending_time);

				if(!timeresult) {
					$('.myalignbuild').html('ERR : Invalid Time Format');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#ending_time").focus();
					return false;
				}
			}
		}

		if(starting_reading == '') {
			$('.myalignbuild').html('ERR : Enter Starting Reading');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#starting_reading").focus();
			return false;
		} else if(ending_reading == '') {
			$('.myalignbuild').html('ERR : Enter Ending Reading');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#ending_reading").focus();
			return false;
		} else if(uom_log == '0') {
			$('.myalignbuild').html('ERR : Select UOM');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#uom_log").focus();
			return false;
		}
		
		//return false;
		$("#formsaveval").val('800');
		$("#diesel_save").submit();
	});
}); 
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">VEHICLE LOG</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' >
<div class="scroll_box">
<div id="firstdiv">
<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Vehicle Log</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120" nowrap="nowrap">Vehicle Regn. No.*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
		$result_state=mysql_query("select id,vehicle_regno from vehicle");
		echo '<select name="vehicle_reg_no" id="vehicle_reg_no" tabindex="1" style="width:270px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['id'].'">'.$row['vehicle_regno'].'</option>';
		}
		echo '</select>';
	?>
	</td>
    </tr>
    
	<tr height="30">
     <td width="120">Driver Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$result_state=mysql_query("SELECT id,emp_name FROM driver");
			echo '<select name="driver_code" id="driver_code" tabindex="3" style="width:270px;">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['emp_name']).'</option>';
			}
			echo '</select>';
      	?>
     </td>
	</tr>

	<tr height="30">
		<td width="120" >Trip Number</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT trip_no FROM  vehicle_log ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus			=	 mysql_fetch_array($cusold);
				$cusnumber	  		=	$row_cus['trip_no'];

				$getcusno			=	abs(str_replace("TRIP",'',strstr($cusnumber,"TRIP")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"TRIP".$createdcode;
			} else {
				$customer_code				=	"TRIP001";
			}
		}
	?>
   <input type='text' name='trip_no' id='trip_no' tabindex="5" style="width:80px;" class="textbox" value="<?php echo $customer_code;?>" readonly="true"/>
       </td>
	</tr>

	<tr height="30">
     <td width="120" nowrap="nowrap">Starting Date & Time*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     	<span id="display_starting_date">
     	<input type="text" name="starting_date" id="starting_date" size="10" value="<?php echo date('d-m-Y'); ?>" readonly tabindex="7" autocomplete="off" />
     	</span>
     	<input type="text" name="starting_time" id="starting_time" size="5" maxlength="5" class="textbox" tabindex="8" autocomplete="off" />(Eg: 19:47)
     </td>
	</tr>
	
	<tr height="30">
     <td width="120">Starting Reading*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
		<input type="text" name="starting_reading" id="starting_reading" tabindex="11" class="textbox" autocomplete="off" style="text-align:right;" />
	 </td>
	</tr>
	
	<tr height="30">
     <td width="120">Total Distance</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='total_distance' id='total_distance' tabindex="13" readonly class="textbox" autocomplete="off" style="text-align:right;" /></td>
	</tr>
	
	<tr height="30">
     <td width="120">Travel Description</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='desc_log' id='desc_log' size="42" class="textbox" tabindex="15" autocomplete="off" />
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
     <td width="120">Assignment No.*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$result_state=mysql_query("SELECT id,assignment_no FROM vehicle_assignment");
			echo '<select name="assignment_number" id="assignment_number" tabindex="2">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$row['assignment_no'].'</option>';
			}
			echo '</select>';
      	?>
     </td>
	</tr>
   
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">Driver Code</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><div id="display_driver_id">
			<input type='text' name='driver_nameval' id='driver_nameval' tabindex="4" readonly autocomplete="off" class="textbox" />
			</div></td>
	</tr>
     
	<tr height="30">
		<td width="120">Trip Description</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><div id="display_vendor_id">
			<input type='text' name='trip_desc' id='trip_desc' size="42" tabindex="6" autocomplete="off" class="textbox" />
			</div>
		</td>
    </tr>

	<tr height="30">
		 <td width="120" nowrap="nowrap">Ending Date & Time*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		 	<span id="display_ending_date">
		 	<input type='text' name='ending_date' id='ending_date' size="10" value="<?php echo date('d-m-Y'); ?>" readonly class="textbox" tabindex="9" autocomplete="off" />
		 	</span>
		 	<input type='text' name='ending_time' id='ending_time' size="5" maxlength="5" class="textbox" tabindex="10" autocomplete="off" />(Eg: 19:47)
		 </td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap">Ending Reading*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='ending_reading' id='ending_reading' class="textbox" tabindex="12" autocomplete="off"  style="text-align:right;"/></td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap">UOM*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("select id,name from uom");
			echo '<select name="uom_log" id="uom_log" tabindex="14">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
			}
			echo '</select>';
			?>
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
	 <input type="hidden" name="edit_id" id="edit_id" /> <!-- This is the partial saved id of the building table when partial save is completed, it will get the id from the db (ajax) -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=3'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_vehicle_log.php'"/></td>
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