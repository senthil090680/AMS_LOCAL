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
	$cost_element			=	$_POST['cost_element'];
	$est_cost				=	$_POST['est_cost'];
	$actual_cost			=	$_POST['actual_cost'];
	
	$user_id					=	$_SESSION['user_id'];
	//echo 'INSERT INTO requestjobs SET request_number="'.$request_number.'",job_id="'.$job_id.'",admin_res_name="'.$admin_res_name.'",job_assigned_name="'.$job_assigned_name.'",start_date="'.$start_date.'",expected_date="'.$expected_date.'",completion_date="'.$completion_date.'",no_revision="'.$no_revision.'",est_cost="'.$est_cost.'",actual_cost="'.$actual_cost.'",created_by="'.$user_id.'" '; 
	//exit;
	if(!mysql_query('INSERT INTO requestjobcost SET request_number="'.$request_number.'",job_id="'.$job_id.'",cost_element="'.$cost_element.'",est_cost="'.$est_cost.'",actual_cost="'.$actual_cost.'",created_by="'.$user_id.'" ')) {
	die('Error: ' . mysql_error());
}
	echo'<script> window.location="view_requestjobcost.php?success=create"; </script> ';
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
	height:207px;
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
	$("#request_number").focus();
	//alert(8989);	
		
	$("#cost_element").live('change',function(event) {
		var selvalue_jobid=$(this).val();
		console.log(selvalue_jobid);
		if(selvalue_jobid!= 0) {
			$('#display_cost_units').load('ajax_requestjobcost.php?costelementid='+selvalue_jobid);
		}
	});
		
	$("#request_number").live('change',function(event){
		var selvalue_request_number=document.getElementById("request_number").value;
		if (selvalue_request_number != 0) {
			$.ajax({
				url			:	"ajax_requestjobcost.php",
				type		:	"post",
				dataType	:	"text",
				data		:	{ "request_number" : selvalue_request_number },
				cache		:	false,
				success		:	function(dataval) {
					var splitval	=	dataval.split("~");
					$("#job_name").val(splitval[0]);
					$("#job_code").val(splitval[1]);
					$("#job_id").val(splitval[2]);
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
		var cost_element		=	$("#cost_element").val();
	
		if(request_number == '0') {
			$('.myalignbuild').html('ERR : Select Request Number');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_number").focus();
			return false;
		}
		if(cost_element == '0') {
			$('.myalignbuild').html('ERR : Select Cost Element');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#cost_element").focus();
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
<div align="center" class="headingsgr">REQUEST-JOB-COST</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">

<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Request-Job-Cost</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120" class="nowrapcls">Request Number*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT rj.id AS REQID,r.req_number AS REQNUM FROM requestjobs rj,request r WHERE rj.request_number = r.id");
		echo '<select name="request_number" id="request_number" tabindex="1">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['REQID'].'">'.$row['REQNUM'].'</option>';
		}
		echo '</select>';
	?>
   </td>
	</tr>	
	
   <tr height="30">
     <td width="120">Job Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_jobname"><input type='text' name='job_name' id='job_name' size="44" tabindex="2" readonly class="textbox"/>
     <input type='hidden' name='job_id' id='job_id' size="44" tabindex="3" class="textbox"/>
     
     </div></td>
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
  <legend ><strong>Cost Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">Cost Element</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT cte.cost_elementid AS CEID,ce.name CENAME FROM costtypeelement cte, costelement ce WHERE cte.cost_elementid = ce.id");
		echo '<select name="cost_element" id="cost_element" style="width:150px;" tabindex="4">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			echo '<option value="'.$row['CEID'].'">'.$fgmembersite->upperstate($row['CENAME']).'</option>';
		}
		echo '</select>';
	 ?></td>
    </tr>
    
	<tr height="30">
     <td width="120">Estimated Cost</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='est_cost' id='est_cost' tabindex="6" style="text-align:right;" value="" readonly class="textbox"/></td>
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
		<td width="120">Units</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
			<div id="display_cost_units">
				<input type='text' name='cost_units' id='cost_units' size="10" tabindex="5" value="" readonly class="textbox"/>
			</div>
			</td>
    </tr>
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">Actual Cost</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='actual_cost' id='actual_cost' style="text-align:right;" tabindex="7" value="" readonly class="textbox"/></td>
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
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_requestjobcost.php'"/></td>
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