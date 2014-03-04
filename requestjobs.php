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
	$request_number			=	$_POST['request_number'];
	$job_id					=	$_POST['job_id'];		
	$admin_res_name			=	$_POST['admin_res_name'];
	$job_assigned_name		=	$_POST['job_assigned_name'];
	$start_date				=	$_POST['start_date'];
	$expected_date			=	$_POST['expected_date'];
	$completion_date		=	$_POST['completion_date'];
	$no_revision			=	$_POST['no_revision'];
	$est_cost				=	$_POST['est_cost'];
	$actual_cost			=	$_POST['actual_cost'];
	
	$user_id					=	$_SESSION['user_id'];
	//echo 'INSERT INTO requestjobs SET request_number="'.$request_number.'",job_id="'.$job_id.'",admin_res_name="'.$admin_res_name.'",job_assigned_name="'.$job_assigned_name.'",start_date="'.$start_date.'",expected_date="'.$expected_date.'",completion_date="'.$completion_date.'",no_revision="'.$no_revision.'",est_cost="'.$est_cost.'",actual_cost="'.$actual_cost.'",created_by="'.$user_id.'" '; 
	//exit;
	if(!mysql_query('INSERT INTO requestjobs SET request_number="'.$request_number.'",job_id="'.$job_id.'",admin_res_name="'.$admin_res_name.'",job_assigned_name="'.$job_assigned_name.'",start_date="'.$start_date.'",expected_date="'.$expected_date.'",completion_date="'.$completion_date.'",no_revision="'.$no_revision.'",est_cost="'.$est_cost.'",actual_cost="'.$actual_cost.'",created_by="'.$user_id.'" ')) {
	die('Error: ' . mysql_error());
}
	echo'<script> window.location="view_requestjobs.php?success=create"; </script> ';
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
	height:369px;
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

	//var names = ["Mike","Matt","Nancy","Adam","Jenny","Nancy","Carl"];	
	var names = "Mike,Matt,Nancy,Adam,Jenny,Nancy,Carl";
	var nameArr = names.split(",");
	var uniqueNames = [];
	$.each(nameArr, function(i, el){
	    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});

	console.log(uniqueNames);
	   
	//alert(12121);
	$("#request_number").focus();
	//alert(8989);

	$("#est_cost").on('blur',function() {
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
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#actual_cost").on('blur',function() {
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
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});
		
	$("#job_id").live('change',function(event) {
		var selvalue_jobid=$(this).val();
		console.log(selvalue_jobid);
		if(selvalue_jobid!= 0) {
			$('#display_jobcode').load('ajax_requestjobs.php?selvalue_jobid='+selvalue_jobid);
		}
	});
	$("#admin_res_name").live('change',function(event){
		var selvalue_admin_res=$(this).val();
		console.log(selvalue_admin_res);
		if(selvalue_admin_res!= 0) {
			$('#display_admin_res').load('ajax_requestjobs.php?selvalue_admin_res='+selvalue_admin_res);
		}
	});

	$("#job_assigned_name").live('change',function(event){
		//alert($("#job_assigned_name").val());
		var selvalue_job_assigned=$(this).val();
		console.log(selvalue_job_assigned);
		if(selvalue_job_assigned!= 0) {
			$('#display_job_assigned').load('ajax_requestjobs.php?selvalue_job_assigned='+selvalue_job_assigned);
		}
	});			
	$("#request_number").live('change',function(event){
		var selvalue_request_number=document.getElementById("request_number").value;
		if (selvalue_request_number != 0) {
			$.ajax({
				url			:	"ajax_requestjobs.php",
				type		:	"post",
				dataType	:	"text",
				data		:	{ "request_number" : selvalue_request_number },
				cache		:	false,
				success		:	function(dataval) {
					var splitval	=	dataval.split("~");
					$("#expected_date").val(splitval[1]);
					$("#completion_date").val(splitval[2]);
					$("#est_cost").val(splitval[3]);
					$("#actual_cost").val(splitval[4]);					
				} 
			});	          
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
		var request_number		=	$("#request_number").val();
		var job_id				=	$("#job_id").val();
		var admin_res_name		=	$("#admin_res_name").val();
		var job_assigned_name	=	$("#job_assigned_name").val();
		var start_date			=	$("#start_date").val();
		var expected_date		=	$("#expected_date").val();
		var est_cost			=	$("#est_cost").val();
		var actual_cost			=	$("#actual_cost").val();
		var completion_date		=	$("#completion_date").val();
		var no_revision			=	$("#no_revision").val();
		
		var	currentdate					=	new Date();

		var start_dateval 				=	new Date(start_date.substring(6,10)+"/"+start_date.substring(3,5)+"/"+start_date.substring(0,2)).getTime();

		var expected_dateval			=	new Date(expected_date.substring(6,10)+"/"+expected_date.substring(3,5)+"/"+expected_date.substring(0,2)).getTime();

		var completion_dateval			=	new Date(completion_date.substring(6,10)+"/"+completion_date.substring(3,5)+"/"+completion_date.substring(0,2)).getTime();
		
		var currentdatevalue			=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();
		
		if(request_number == '0') {
			$('.myalignbuild').html('ERR : Select Request Number');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_number").focus();
			return false;
		} 
		if(job_id == '0') {
			$('.myalignbuild').html('ERR : Select Job');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#job_id").focus();
			return false;
		} if(admin_res_name == '0') {
			$('.myalignbuild').html('ERR : Select Admin Responsibility');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#admin_res_name").focus();
			return false;
		} 

		if (job_assigned_name == '0'){
			$('.myalignbuild').html('ERR : Select Job Assigned To');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#job_assigned_name").focus();
			return false;
		} 
		if (start_date == ''){
			$('.myalignbuild').html('ERR : Select Start Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#start_date").focus();
			return false;
		}
		if (start_dateval < currentdatevalue){
			$('.myalignbuild').html('ERR : Date Less Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#start_date").focus();
			return false;
		} 	
	
		if (expected_dateval == ''){
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#expected_date").focus();
			return false;
		} 
		if (expected_dateval < currentdatevalue){
			$('.myalignbuild').html('ERR : Date Less Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#expected_date").focus();
			return false;
		} 

		if (completion_dateval == ''){
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#completion_date").focus();
			return false;
		} 
		if (completion_dateval < currentdatevalue){
			$('.myalignbuild').html('ERR : Date Less Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#completion_date").focus();
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
<div align="center" class="headingsgr">REQUEST-JOBS</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">

<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Request-Jobs</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Request Number*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,req_number FROM request");
		echo '<select name="request_number" id="request_number" tabindex="1">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['id'].'">'.$row['req_number'].'</option>';
		}
		echo '</select>';
	?>
   </td>
	</tr>	
	
   <tr height="30">
     <td width="120">Job Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,job_desc FROM jobs");
		echo '<select name="job_id" id="job_id" style="width:300px;" tabindex="2">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['id'].'">'.$row['job_desc'].'</option>';
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
		 <td width="120" nowrap="nowrap"></td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td></td>
	</tr>

    <tr height="30">
     <td width="120">Job Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_jobcode"><input type='text' name='job_code' id='job_code' size="6" tabindex="3" readonly class="textbox"/></div></td>
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
     <td width="120">Employee Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,lead_name FROM admin_responsibility");
		echo '<select name="admin_res_name" id="admin_res_name" tabindex="4" style="width:300px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['lead_name']).'</option>';
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
     <td width="120">Employee Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_admin_res"><input type='text' name='admin_res_code' id='admin_res_code' size="6" tabindex="5" readonly class="textbox"/></div></td>
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
  <legend ><strong>Job Assigned To</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Employee Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("SELECT * FROM pim_emp_info  ORDER BY first_name",$bd);
		echo '<select name="job_assigned_name" id="job_assigned_name" class="selectbox" tabindex="6" style="width:300px;">';
		echo '<option value="0">--Employee--</option>';
		while($row=mysql_fetch_array($result_emp_id)) {
			echo '<option value="'.$row['emp_code'].'">'.$fgmembersite->upperstate($row['first_name']).'</option>';
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
     <td width="120">Employee Code</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_job_assigned"><input type='text' name='job_assigned_code' id='job_assigned_code' size="6" tabindex="7" readonly class="textbox"/></div></td>
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
  <legend ><strong>Duration & Cost Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">Start Date</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input name='start_date' id='start_date' tabindex="8" size="10" value="<?php echo date("d-m-Y")?>" class="datepicker" /></td>
    </tr>
    
    <tr height="30">
		<td width="120" nowrap="nowrap">Rev. Compl. Date</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input name='completion_date' id='completion_date' tabindex="10" size="10" value="<?php echo date("d-m-Y")?>" class="datepicker"></td>
	</tr>
	
	<tr height="30">
     <td width="120">Estimated Cost</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='est_cost' id='est_cost' tabindex="12" style="text-align:right;" value="" class="textbox"/></td>
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
     <td width="120" nowrap="nowrap">Exp. Compl. Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input name='expected_date' id='expected_date' tabindex="9" size="10" value="<?php echo date("d-m-Y")?>" class="datepicker" /></td>
	</tr>
   
   <tr height="30">
		<td width="120">No. of Revisions</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='no_revision' id='no_revision' size="6" tabindex="11" value="" class="textbox"/></td>
    </tr>
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">Actual Cost</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='actual_cost' id='actual_cost' style="text-align:right;" tabindex="13" value="" class="textbox"/></td>
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
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_requestjobs.php'"/></td>
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