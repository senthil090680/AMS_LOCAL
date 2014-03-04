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
	
	$fgmembersite->DBLogin();
	$job_code				=	$_POST['job_code'];
	$admin_res_code			=	$_POST['admin_res_code'];
	$user_id				=	$_SESSION['user_id'];
	//echo 'INSERT INTO jobs SET job_code="'.$job_code.'",job_desc="'.$job_desc.'",job_type_id="'.$job_type_id.'",created_by="'.$user_id.'"  '; 
	//exit;
	if(!mysql_query('INSERT INTO jobadmin SET job_code="'.$job_code.'",admin_res_code="'.$admin_res_code.'",created_by="'.$user_id.'" ')) {
	die('Error: ' . mysql_error());
}
	echo'<script> window.location="view_jobadmin.php?success=create"; </script> ';
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
	height:500px;
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
	height:145px;
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
.nowrapcls {
	white-space:nowrap;
}

</style>
<script type="text/javascript" language="javascript">
$(document).live('ready',function() {

	//var names = ["Mike","Matt","Nancy","Adam","Jenny","Nancy","Carl"];	
	var names = "Mike,Matt,Nancy,Adam,Jenny,Nancy,Carl";
	var nameArr = names.split(",");
	var uniqueNames = [];
	$.each(nameArr, function(i, el){
	    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});
	
	console.log(uniqueNames);
	   
	//alert(12121);
	$("#job_desc").focus();
	//alert(8989);	
	
	$("#job_desc").change(function(event) {
		var selvalue=document.getElementById("job_desc").value;
		if (selvalue != 0) {
			$('#job_code').val(selvalue);
		}
		else {
			document.getElementById("job_code").value = "";			
		}
	});

	$("#admin_res_code").change(function(event) {
		var selvalue=document.getElementById("admin_res_code").value;
		if (selvalue != 0) {
			$('#lead_code').val(selvalue);
		}
		else {
			document.getElementById("lead_code").value = "";			
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
		var job_code			=	$("#job_code").val();
		var job_desc			=	$("#job_desc").val();
		var admin_res_code		=	$("#admin_res_code").val();
	
		if(job_desc == '0') {
			$('.myalignbuild').html('ERR : Select Job Description');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#job_desc").focus();
			return false;
		}
		if(admin_res_code == '0') {
			$('.myalignbuild').html('ERR : Select Leader Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#admin_res_code").focus();
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
<div align="center" class="headingsgr">JOB-ADMIN RESPONSIBILITY</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">

<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Job-Admin Responsibility</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120" class="nowrapcls">Job Description*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,job_code,job_desc FROM jobs");
		echo '<select name="job_desc" id="job_desc" style="width:150px;" tabindex="3">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['job_code'].'">'.$row['job_desc'].'</option>';
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
     <td width="75" style="white-space: nowrap; ">Job Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     	<div id="display_jobcode">
     		<input type='text' name='job_code' id='job_code' size="52" tabindex="2" readonly class="textbox"/>
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
  <legend ><strong>Admin Responsibility</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>  
	
	<tr height="30">
     <td width="120" class="nowrapcls">Leader Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,lead_code,lead_name FROM admin_responsibility");
		echo '<select name="admin_res_code" id="admin_res_code" style="width:150px;" tabindex="3">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['lead_code'].'">'.$fgmembersite->upperstate($row['lead_name']).'</option>';
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
     <td width="75" style="white-space: nowrap; ">Leader Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     	<div id="display_leadcode">
     		<input type='text' name='lead_code' id='lead_code' size="50" tabindex="2" readonly class="textbox"/>
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
	 <input type="hidden" name="edit_id" id="edit_id" /> <!-- This is the partial saved id of the building table when partial save is completed, it will get the id from the db (ajax) -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=1'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_jobadmin.php'"/></td>
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