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
	$header_file='./layout/admin_header_ams.php';
}

if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	
	//$fgmembersite->pre($_POST);
	//$fgmembersite->pre($_FILES);
	//exit;
	
	if(isset($_FILES["req_picture"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["req_picture"]["name"]);
		//$fgmembersite->pre($temp);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["req_picture"]["error"] > 0) {
				echo "Return Code: " . $_FILES["req_picture"]["error"] . "<br>";
			} else {
				//echo "user_picture/" . $_FILES["req_picture"]["name"];
				//exit;
				//$fgmembersite->pre($temp);
				$current_timestamp		=	time();				
				$cur_file_name			=	$current_timestamp."_".$temp[0].".".$temp[1];
				//$fgmembersite->pre($temp);
				//echo $cur_file_name;
				//exit;
				$req_picture=$cur_file_name;
				move_uploaded_file($_FILES["req_picture"]["tmp_name"],"user_picture/" . $cur_file_name);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		} else {
			$req_picture="";
		}
	}
	
	$fgmembersite->DBLogin();
	$req_code				=	$_POST['req_code'];
	$request_type			=	$_POST['request_type'];
		
	if($request_type == 1) {		
		$emp_request_id		=	$_POST[emp_request_id];
		$guest_request_id	=	'';
	} else if($request_type == 2) {		
		$emp_request_id		=	'';
		$guest_request_id	=	$_POST[guest_request_id];
	} 
	$comp_id				=	$_POST['comp_id'];
	$division_id			=	$_POST['division_id'];
	$city_id				=	$_POST['city_id'];
	$off_loc				=	$_POST['off_loc'];
	$off_buil				=	$_POST['off_buil'];
	$off_buil_id			=	$_POST['off_buil_id'];
	$off_floor				=	$_POST['off_floor'];
	$office_val				=	$_POST['office_val'];
	$res_buil_id			=	$_POST['res_buil_id'];
	$unit_num				=	$_POST['unit_num'];
	$email_id				=	$_POST['email_id'];
	$mobile_no				=	$_POST['mobile_no'];
	$alt_num				=	$_POST['alt_num'];
	$req_picture			=	$req_picture;
	
	$user_id					=	$_SESSION['user_id'];
	//echo 'INSERT INTO vehicle_transaction SET vehicle_reg_id="'.$vehicle_reg_id.'",transaction_date="'.$transaction_date.'",transaction_type_id="'.$transaction_type_id.'",transaction_number="'.$transaction_number.'",vendor_id="'.$vendor_id.'",uom_id="'.$uom_id.'",units="'.$units.'",currency_id="'.$currency_id.'",rate="'.$rate.'",cost="'.$cost.'",trans_desc="'.$desc.'",bought_by="'.$bought_by.'",emp_code="'.$emp_code.'",driver_code_id="'.$driver_code_id.'",others="'.$others.'",created_by="'.$user_id.'" '; 
	//exit;
	if(!mysql_query('INSERT INTO requestor SET req_code="'.$req_code.'",request_type="'.$request_type.'",emp_request_id="'.$emp_request_id.'",guest_request_id="'.$guest_request_id.'",comp_id="'.$comp_id.'",division_id="'.$division_id.'",city_id="'.$city_id.'",off_loc="'.$off_loc.'",off_buil="'.$off_buil.'",off_buil_id="'.$off_buil_id.'",off_floor="'.$off_floor.'",office_val="'.$office_val.'",res_buil_id="'.$res_buil_id.'",unit_num="'.$unit_num.'",email_id="'.$email_id.'",mobile_no="'.$mobile_no.'",alt_num="'.$alt_num.'",req_picture="'.$req_picture.'",created_by="'.$user_id.'" ')) {
	die('Error: ' . mysql_error());
}
	echo'<script> window.location="view_requestor.php?success=create"; </script> ';
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
	height:530px;
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
#errormsgbuild {
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
	height:420px;
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

	$('#req_picture').change(function() {
		
		var existing = new Array();
		var checkFile = new Array();
		var file = new Array();
		var fileUrl = new Array();
		var counter = 0;
		for (var i = 0; i < 1; i++) {
		    (function(index){
		        file[index] = document.getElementById('req_picture').files[0];
		        if(file[index]) {
		            fileUrl[index] = 'user_picture/' + file[index].name;
		            checkFile[index] = new XMLHttpRequest();
		            checkFile[index].onreadystatechange = function() {
		                if (checkFile[index].readyState == 4) {
		                    if (checkFile[index].status == 200) {
		                        existing[index] = true; 
		                        counter += 1;
		                    }
		                    else {
		                        existing[index] = false;
		                        counter += 1;
		                    }
		                    if (counter == fileUrl.length) { 
		                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
		                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
		                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
		                        if (existing.indexOf(true) == -1) {
		                            //none of the files to be uploaded are already on server
									var filenamee=document.getElementById("req_picture").value;
									var extension=filenamee.split('.').pop();
									if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
									{
										return true;
									}
									else
									{
										/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
										document.getElementById("saleagreement").value="";
										return false;*/
										$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
										$('#errormsgbuild').css('display','block');
										setTimeout(function() {
											//$('#errormsgbuild').hide();
										},5000);
										$("#req_picture").focus();
										$("#req_picture").val('');
									}
									//return true; 
		                        }
		                        else {
		                            //list filenames and/or upload field numbers of the files that already exist on server
		                            //   ->> inform user... 
									/*alert("The file name already exits");
									document.getElementById("saleagreement").value="";
		                            return false;*/

									/*$('.myalignbuild').html('ERR : This Filename Already Exits');
									$('#errormsgbuild').css('display','block');
									setTimeout(function() {
										$('#errormsgbuild').hide();
									},5000);
									$("#req_picture").focus();
									$("#req_picture").val('');*/
		                        }
		                    }
		                }
		            }
		            checkFile[index].open('HEAD', fileUrl[index], true);
		            checkFile[index].send();
		        }
		    })(i);
		}
		      return false;
		   });
	   
	//alert(12121);
	$("#request_type").focus();
	//alert(8989);

	$("#city_id").change(function(event) {
		var selvalue=document.getElementById("city_id").value;
		if (selvalue != 0) {
			$('#display_state').load('ajax_requestor.php?selvalue='+selvalue);
		}
		else {
			document.getElementById("state_name").value = "";			
		}
	});
	
	$("#off_buil_id").change(function(event){
		var selvalue_off_buil_id=document.getElementById("off_buil_id").value;
		if (selvalue_off_buil_id != 0) {			 
	          $('#display_off_buil_code').load('ajax_requestor.php?selvalue_off_buil_id='+selvalue_off_buil_id);
		} else {
			document.getElementById("off_buil_code").value = "";		
		}
	 });

	$("#res_buil_id").change(function(event){
		var selvalue_res_buil_id=document.getElementById("res_buil_id").value;
		if (selvalue_res_buil_id != 0) {			 
	          $('#display_res_buil_code').load('ajax_requestor.php?selvalue_res_buil_id='+selvalue_res_buil_id);
		} else {
			document.getElementById("res_buil_code").value = "";		
		}
	 });

	$("#request_type").live('change',function(event){
		var selvalue_request_type=$(this).val();
		if (selvalue_request_type != 0) {
	          $('#display_request_type').load('ajax_requestor.php?selvalue_request_type='+selvalue_request_type);
		}
	});		
	$("#guest_request_id").live('change',function(event){
		var selvalue_bought_by=document.getElementById("guest_request_id").value;
		if (selvalue_bought_by != 0) {
	          $('#display_request_id').load('ajax_requestor.php?guest_request_id='+selvalue_bought_by);
		}
	});
	$("#emp_request_id").live('change',function(event){
		var selvalue_bought_by=document.getElementById("emp_request_id").value;
		if (selvalue_bought_by != 0) {
	          $('#display_request_id').load('ajax_requestor.php?emp_request_id='+selvalue_bought_by);
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
	
	$("#part_save").on("click", function() {
		//alert("232");
		var request_type		=	$("#request_type").val();
		var comp_id				=	$("#comp_id").val();
		var division_id			=	$("#division_id").val();
		var city_id				=	$("#city_id").val();
		var off_loc				=	$("#off_loc").val();
		var off_buil			=	$("#off_buil").val();
		var off_buil_id			=	$("#off_buil_id").val();
		var off_floor			=	$("#off_floor").val();
		var office_val			=	$("#office_val").val();
		var res_buil_id			=	$("#res_buil_id").val();
		var unit_num			=	$("#unit_num").val();
		var email_id			=	$("#email_id").val();
		var mobile_no			=	$("#mobile_no").val();
		var alt_num				=	$("#alt_num").val();
		var req_picture			=	$("#req_picture").val();

		if(request_type == '0') {
			$('.myalignbuild').html('ERR : Select Requestor Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_type").focus();
			return false;
		} 
		if(request_type == '1') {
			if($('#emp_request_id').val() == '0') {
				$('.myalignbuild').html('ERR : Select Employee Name');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#emp_request_id").focus();
				return false;
			}
		} if(request_type == '2') {
			if($('#guest_request_id').val() == '0') {
				$('.myalignbuild').html('ERR : Select Guest Name');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#guest_request_id").focus();
				return false;
			}
		} 

		if(comp_id == '0') {
			$('.myalignbuild').html('ERR : Select Company');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#comp_id").focus();
			return false;
		} else if(division_id == '0') {
			$('.myalignbuild').html('ERR : Select Division');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#division_id").focus();
			return false;
		}  else if(city_id == '0') {
			$('.myalignbuild').html('ERR : Select City');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#city_id").focus();
			return false;
		} else if(off_buil_id == '0') {
			$('.myalignbuild').html('ERR : Select Office Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#off_buil_id").focus();
			return false;
		} else if(res_buil_id == '0') {
			$('.myalignbuild').html('ERR : Select Residence Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#res_buil_id").focus();
			return false;
		} else if(email_id == '') {
			$('.myalignbuild').html('ERR : Enter Email');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#email_id").focus();
			return false;
		} 

		if(email_id != '') {

			var reg				=	/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

			var email_to_lower	=	$("#emailid").val();
			var email_address	=	email_id.toLowerCase();
			if(reg.test(email_address) == false) {
				$('.myalignbuild').html('ERR : Invalid Email Address');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#email_id").focus();
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
<div align="center" class="headingsgr">REQUESTOR</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">
<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Requestor</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Requestor Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT req_code FROM requestor ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus					  =	 mysql_fetch_array($cusold);
				$cusnumber	  =	$row_cus['req_code'];

				$getcusno						=	abs(str_replace("REQ",'',strstr($cusnumber,"REQ")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"REQ".$createdcode;
			} else {
				$customer_code				=	"REQ001";
			}
		}
	?>
   <input type='text' name='req_code' id='req_code' tabindex="1" style="width:60px;" class="textbox" value="<?php echo $customer_code;?>" readonly="true"/></td>
	</tr>	
	
    <tr height="30">
     <td width="120">Employee/Guest*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><select name='request_type' id='request_type' tabindex="1" >
		<option value="0">--Select--</option>
		<option value="1">Employee</option>
		<option value="2">Guest</option>
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
		 <td width="120" nowrap="nowrap"></td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td></td>
	</tr>
	
   <tr height="30">
		 <td width="120" nowrap="nowrap">Employee/Guest*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><div id="display_request_type">
			<input type="text" name="request_option" id="request_option" tabindex="2" readonly="true" />
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


<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Company & Office Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Company*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select * from master_companies  order by comp_name",$bd);
		echo '<select name="comp_id" id="comp_id" class="selectbox" tabindex="3" style="width:270px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id)) {
			echo '<option value="'.$row['comp_id'].'">'.$fgmembersite->upperstate($row['comp_name']).'</option>';
		}
		echo '</select>';
		?>&nbsp;
	 </td>
	</tr>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">City*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("select id,name from city");
		echo '<select name="city_id" id="city_id" tabindex="5">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
		}
		echo '</select>';
	?>
	</td>
    </tr>
    
	<tr height="30">
     <td width="120">Office Location</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='off_loc' id='off_loc' tabindex="7" value="" class="textbox"/></td>
	</tr>

	<tr height="30">
		<td width="120" style="white-space:nowrap;">Office Bldg. Name*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT id,building_code,building_name FROM building WHERE building_type = '1'");
			echo '<select name="off_buil_id" id="off_buil_id" tabindex="9" style="width:270px;">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['building_name']).'</option>';
			}
			echo '</select>';
		?></td>
	</tr>

	<tr height="30">
     <td width="120">Office Floor</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='off_floor' id='off_floor' tabindex="11" value="" class="textbox"/></td>
	</tr>
	
	<tr height="30">
		<td width="120" style="white-space:nowrap;">Res. Bldg. Name*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT id,building_code,building_name FROM building WHERE building_type = '2'");
			echo '<select name="res_buil_id" id="res_buil_id" tabindex="13" style="width:270px;">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['building_name']).'</option>';
			}
			echo '</select>';
		?></td>
	</tr>
	
	<tr height="30">
     <td width="120">Unit Number</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='unit_num' id='unit_num' tabindex="15" value="" class="textbox"/></td>
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
		 <td width="120" nowrap="nowrap">Division*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><?php
				$result_state=mysql_query("select id,name from department");
				echo '<select name="division_id" id="division_id" tabindex="4" style="width:270px;">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{
					echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
				}
				echo '</select>';
			?>
		 </td>
	</tr>
	
   <tr height="30">
     <td width="120">State</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     <div id="display_state"><input type='text' name='state_name' id='state_name' tabindex="6" readonly value=""/ ></div>
     </td>
	</tr>
   
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">
		 <!-- Office Bldg.-->
		 </td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		 	<!-- <input type='text' name='off_buil' id='off_buil' tabindex="8" value="" class="textbox"/>-->
		 </td>
	</tr>
     
	<tr height="30">
		<td width="120">Office Bldg. Code</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><div id="display_off_buil_code">
			<input type='text' name='off_buil_code' id='off_buil_code' tabindex="10" size="6" readonly autocomplete="off" class="textbox" />
			</div>
		</td>
    </tr>

	<tr height="30">
		 <td width="120" nowrap="nowrap">Office</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='office_val' id='office_val' size="42" class="textbox" tabindex="12" autocomplete="off" /></td>
	</tr>
	
	<tr height="30">
		 <td width="120">Res. Bldg. Code</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><div id="display_res_buil_code">
			<input type='text' name='res_buil_code' id='res_buil_code' tabindex="14" size="6" readonly autocomplete="off" class="textbox" />
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


<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Contact Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Email ID*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='email_id' id='email_id' size="35" tabindex="16" autocomplete="off" class="textbox" /></td>
	</tr>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">Alternate No.</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='alt_num' id='alt_num' size="35" tabindex="18" autocomplete="off" class="textbox" /></td>
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
		 <td width="120" nowrap="nowrap">Mobile No.</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type="text" name="mobile_no" id="mobile_no" size="35" tabindex="17" autocomplete="off" class="textbox" /></td>
	</tr>
	
   <tr height="30">
     <td width="120">Picture</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='req_picture' id='req_picture' tabindex="19" value="" autocomplete="off" class="textbox" /></td>
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
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_requestor.php'"/></td>
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