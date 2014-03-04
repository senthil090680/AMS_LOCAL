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

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if ($fgmembersite->usertype() == 1)	{
	//$header_file='./layout/admin_header_bms.php';
	$header_file='./layout/admin_header_ams.php';
}

$query_edit				=	"SELECT id,responsibility_id,lead_code,lead_name,company_id,division_id,city_id,office_location,office_buil,office_building_id,office_floor,office,email_id,mobile_number,alt_number,alt_lead_code,alt_lead_name,picture FROM admin_responsibility WHERE id = '$id'";			
$res_edit				=	mysql_query($query_edit) or die(mysql_error());
$row_edit				=	mysql_fetch_array($res_edit);

if(file_exists($header_file))	{
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	
	if(isset($_FILES["picture"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["picture"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["picture"]["error"] > 0) {
				echo "Return Code: " . $_FILES["picture"]["error"] . "<br>";
			} else {
				
				if($picture_old == '') {
					$current_timestamp		=	time();				
					$cur_file_name			=	$current_timestamp."_".$temp[0].".".$temp[1];
				} else {					
					$cur_file_name			=	$picture_old;
				}
				
				$picture=$cur_file_name;
				move_uploaded_file($_FILES["picture"]["tmp_name"],"admin_resp/" . $cur_file_name);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		} else {
			$picture=$picture_old;
		}
	}
	
	$responsibility_id		=	$_POST['responsibility_id'];
	$incharge_empcode		=   $_POST['incharge_empcode'];	
	
	$fgmembersite->DBLogin();
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("SELECT first_name FROM pim_emp_info WHERE emp_code='$incharge_empcode'  ORDER BY emp_id",$bd);
	while($row=mysql_fetch_array($result_emp_id)) {
		$leader_name=$row['first_name'];
	}				
	$comp_id				=	$_POST['comp_id'];
	$division_id			=	$_POST['division_id'];
	$city_id				=	$_POST['city_id'];
	$off_loc				=	$_POST['off_loc'];
	$office_buil			=	$_POST['office_buil'];
	$off_buil_id			=	$_POST['off_buil_id'];
	$off_floor				=	$_POST['off_floor'];
	$office_val				=	$_POST['office_val'];
	$email_id				=	$_POST['email_id'];
	$mobile_no				=	$_POST['mobile_no'];
	$alt_num				=	$_POST['alt_num'];
	$picture				=	$picture;
	$incharge_empcode_alt	=   $_POST['incharge_empcode_alt'];	
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("SELECT first_name FROM pim_emp_info WHERE emp_code='$incharge_empcode_alt' ORDER BY emp_id",$bd);
	while($row=mysql_fetch_array($result_emp_id)) {
		$alt_leader_name=$row['first_name'];
	}
		
		//echo 'UPDATE admin_responsibility SET responsibility_id="'.$responsibility_id.'",lead_code="'.$incharge_empcode.'",lead_name="'.$leader_name.'",company_id="'.$comp_id.'",division_id="'.$division_id.'",city_id="'.$city_id.'", office_location="'.$off_loc.'",office_buil="'.$office_buil.'",office_building_id="'.$off_buil_id.'",office_floor="'.$off_floor.'",office="'.$office_val.'",email_id="'.$email_id.'",mobile_number="'.$mobile_no.'",alt_number="'.$alt_num.'",alt_lead_code="'.$incharge_empcode_alt.'",alt_lead_name="'.$alt_leader_name.'",picture="'.$picture.'",updated_by="'.$user_id.'",updated_at=NOW() WHERE id = "'.$edit_id.'"';
	
	//echo $sql;
	//exit;
	
	$user_id		=	$_SESSION['user_id'];
	$fgmembersite->DBLogin();
	if(!mysql_query('UPDATE admin_responsibility SET responsibility_id="'.$responsibility_id.'",lead_code="'.$incharge_empcode.'",lead_name="'.$leader_name.'",company_id="'.$comp_id.'",division_id="'.$division_id.'",city_id="'.$city_id.'", office_location="'.$off_loc.'",office_buil="'.$office_buil.'",office_building_id="'.$off_buil_id.'",office_floor="'.$off_floor.'",office="'.$office_val.'",email_id="'.$email_id.'",mobile_number="'.$mobile_no.'",alt_number="'.$alt_num.'",alt_lead_code="'.$incharge_empcode_alt.'",alt_lead_name="'.$alt_leader_name.'",picture="'.$picture.'",updated_by="'.$user_id.'",updated_at=NOW() WHERE id = "'.$edit_id.'"')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_admin_resp.php?success=update");
		echo "&nbsp;";
}
?>
<link href="css/popup.css" rel="stylesheet" type="text/css" />
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
	height:550px;
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
	height:440px;
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

$(document).ready(function() {

$('#picture').change(function() {
		
		var existing = new Array();
		var checkFile = new Array();
		var file = new Array();
		var fileUrl = new Array();
		var counter = 0;
		for (var i = 0; i < 1; i++) {
		    (function(index){
		        file[index] = document.getElementById('picture').files[0];
		        if(file[index]) {
		            fileUrl[index] = 'admin_resp/' + file[index].name;
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
									var filenamee=document.getElementById("picture").value;
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
										$("#picture").focus();
										$("#picture").val('');
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
	$("#responsibility_id").focus();
	//alert(8989);

	$("#incharge_empcode").change(function(event) {
		var selvalue_incharge_empcode=document.getElementById("incharge_empcode").value;
		if (selvalue_incharge_empcode != 0) {
			$('#leadername').val(selvalue_incharge_empcode);
		}
		else {
			document.getElementById("leadername").value = "";
		}
    });
	$("#incharge_empcode_alt").change(function(event) {
		var selvalue_incharge_empcode=document.getElementById("incharge_empcode_alt").value;
		if (selvalue_incharge_empcode != 0) {
			$('#alt_leader').val(selvalue_incharge_empcode);
		}
		else {
			document.getElementById("alt_leader").value = "";
		}
    });
	
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
		var responsibility_id	=	$("#responsibility_id").val();
		var incharge_empcode	=	$("#incharge_empcode").val();
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
		var incharge_empcode_alt		= $("#incharge_empcode_alt").val();

		if(responsibility_id == '0') {
			$('.myalignbuild').html('ERR : Select Responsibility Center');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#responsibility_id").focus();
			return false;
		} 
		if(incharge_empcode == '0') {
			$('.myalignbuild').html('ERR : Select Leader Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#incharge_empcode").focus();
			return false;
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
		}  else if(email_id == '') {
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
		
		if(incharge_empcode_alt == '0') {
			$('.myalignbuild').html('ERR : Select Alternate Leader Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#incharge_empcode_alt").focus();
			return false;
		}
		$("#formsaveval").val('800');
		$("#diesel_save").submit();
	});
}); 
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">ADMIN RESPONSIBILITIES</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">

<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Admin Responsibilities</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="123" >Responsibility Center</td>
     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row_edit[id]; ?>" />
	 <?php 
		$fgmembersite->DBLogin();
		$result_state=mysql_query("select id,name from responsibility");
		echo '<select name="responsibility_id" id="responsibility_id" tabindex="1">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			if($row['id'] == $row_edit['responsibility_id']){
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
		<td width="120">Leader Name*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
		<?php
			$fgmembersite->DBLogin();
			$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
			or die("Opps some thing went wrong");
			mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
			$result_emp_id=mysql_query("SELECT emp_code,first_name FROM pim_emp_info ORDER BY emp_id",$bd);
			echo '<select name="incharge_empcode" id="incharge_empcode" size="1" position="absolute" onclick="size=(size!=1)?2:1;" style="width:200px;" tabindex="2">';
			echo '<option value="0">--Employee--</option>';
			while($row=mysql_fetch_array($result_emp_id)) {
				if($row['emp_code'] == $row_edit['lead_code']) {
					  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					  $display_leader_code	=	$row['emp_code'];	
				 } else {
					  $isSelected = ''; // else we remove any tag
				 }
				echo "<option value='".$row['emp_code']."'".$isSelected.">".$row['first_name']."</option>";
			}
			echo '</select>';
			?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="display_inchargename"><input type='text' name='leadername' id='leadername' value="<?php echo $display_leader_code; ?>" size="5" readonly class="textbox"/></span>
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
		$result_emp_id=mysql_query("SELECT comp_id,comp_name FROM master_companies ORDER BY comp_name",$bd);
		echo '<select name="comp_id" id="comp_id" class="selectbox" tabindex="3" style="width:286px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id)) {
			if($row['comp_id'] == $row_edit['company_id']){
				  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
			 } else {
				  $isSelected = ''; // else we remove any tag
			 }
			 echo "<option value='".$row['comp_id']."'".$isSelected.">".$fgmembersite->upperstate($row['comp_name'])."</option>";
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
			if($row['id'] == $row_edit['city_id']){
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
     <td width="120">Office Location</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='off_loc' id='off_loc' tabindex="7" value="<?php echo $row_edit['office_location']; ?>" class="textbox"/></td>
	</tr>

	<tr height="30">
		<td width="120" style="white-space:nowrap;">Office Bldg. Name*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT id,building_code,building_name FROM building WHERE building_type = '1'");
			echo '<select name="off_buil_id" id="off_buil_id" tabindex="9" style="width:286px;">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				if($row['id'] == $row_edit['office_building_id']){
					$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag		
					$buil_off_code	=	$row['building_code'];
				 } else {
					  $isSelected = ''; // else we remove any tag
				 }							
				echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['building_name'])."</option>";
			}
			echo '</select>';
		?></td>
	</tr>

	<tr height="30">
     <td width="120">Office Floor</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='off_floor' id='off_floor' size="42" tabindex="11" value="<?php echo $row_edit['office_floor']; ?>" class="textbox"/></td>
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
					if($row['id'] == $row_edit['division_id']){
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
     <td width="120">State</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     <div id="display_state">
    <?php $result_state=mysql_query("SELECT st.name AS ST_NAME FROM city ci LEFT JOIN state st ON ci.state_id = st.id WHERE ci.id = '$row_edit[city_id]' "); 
    $row_state	=	mysql_fetch_array($result_state);
    ?>
     <input type='text' name='state_name' id='state_name' tabindex="6" readonly value="<?php echo $fgmembersite->upperstate($row_state[ST_NAME]); ?>" /></div>
     </td>
	</tr>
   
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">
		 <!-- Office Bldg.--></td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		 	<!-- <input type='text' name='office_buil' id='office_buil' tabindex="8" value="<?php echo $row_edit['office_buil']; ?>" class="textbox"/>-->
		 </td>
	</tr>
     
	<tr height="30">
		<td width="120">Office Bldg. Code</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><div id="display_off_buil_code">
			<input type='text' name='off_buil_code' id='off_buil_code' value="<?php echo $buil_off_code; ?>" tabindex="10" size="6" readonly autocomplete="off" class="textbox" />
			</div>
		</td>
    </tr>

	<tr height="30">
		 <td width="120" nowrap="nowrap">Office</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='office_val' id='office_val' size="42" value="<?php echo $row_edit[office]; ?>" class="textbox" tabindex="12" autocomplete="off" /></td>
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
     <td><input type='text' name='email_id' id='email_id' size="42" value="<?php echo $row_edit[email_id]; ?>" tabindex="13" autocomplete="off" class="textbox" /></td>
	</tr>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">Alternate No.</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='alt_num' id='alt_num' size="42" value="<?php echo $row_edit[alt_number]; ?>" tabindex="15" autocomplete="off" /></td>
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
		 <td><input type="text" name="mobile_no" id="mobile_no" size="42" value="<?php echo $row_edit[mobile_number]; ?>" tabindex="14" autocomplete="off"  /></td>
	</tr>
	
   <tr height="30">
     <td width="120">Picture</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php echo $row_edit[picture]; ?>     
     <input type='file' name='picture' id='picture' tabindex="16" value="" />
     <input type='hidden' name='picture_old' id='picture_old' value="<?php echo $row_edit[picture]; ?>" />     
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
  <legend ><strong>Alternate Leader/Substitute</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
   <table> 
	<tr height="30">
		<td width="120" >Name*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
		<?php
			$fgmembersite->DBLogin();
			$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
			or die("Opps some thing went wrong");
			mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
			$result_emp_id=mysql_query("SELECT emp_code,first_name FROM pim_emp_info ORDER BY emp_id",$bd);
			echo '<select name="incharge_empcode_alt" id="incharge_empcode_alt" size="1" position="absolute" onclick="size=(size!=1)?2:1;" style="width:272px;" tabindex="17" class="selectbox">';
			echo '<option value="0">--Employee--</option>';
			while($row=mysql_fetch_array($result_emp_id)) {
				if($row['emp_code'] == $row_edit['alt_lead_code']){
					  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag	
					  $display_lead_alt_code	=	$row['emp_code'];
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }							
					echo "<option value='".$row['emp_code']."'".$isSelected.">".$row['first_name']."</option>";
				echo '<option value="'.$row['emp_code'].'">'.$row['first_name'].'</option>';
			}
			echo '</select>';
			?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
		</td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120" nowrap="nowrap">Employee Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
	<span id="display_inchargename_alt"><input type='text' name='alt_leader' id='alt_leader' value="<?php echo $display_lead_alt_code; ?>" tabindex="18" size="5" readonly class="textbox"/></span>
	 </td>
	</tr>
    
    </table>
   </td>
 </tr>
</table>
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
	 <input type="hidden" name="formsaveval" id="formsaveval" /> <!-- This will give the value when form is submitted, otherwise it will be empty -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=1'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_admin_resp.php'"/></td>
	 </td>
     </tr>
  </table>
	<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
</form>
<!-- </div> -->
</div>

<div id="backgroundChatPopup"></div>
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>