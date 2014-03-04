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
	$header_file='./layout/admin_header_bms.php';
}

if(file_exists($header_file))	{
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	
	//$sql=('insert into diesel SET generator_code="'.$generator_code.'",building_code="'.$building_code.'",date="'.$ddate.'",transaction_number="'.$tnumber.'",diesel_volume="'.$volume.'",currency="'.$add_currency.'",diesel_cost="'.$dcost.'",created_by="'.$user_id.'"');

	//echo $sql;
	//exit;
	
		$user_id			=	$_SESSION['user_id'];
		$add_currency		=	$fgmembersite->getdbval($_POST['add_currency'],'id','name','currency');
		if(!mysql_query('INSERT INTO nepa SET building_code="'.$building_code.'",nepa_meter_number="'.$mnumber.'",date="'.$mdate.'",fromdate="'.$fromdate.'",todate="'.$todate.'",paymentdate="'.$paymentdate.'",amount="'.$amount.'",currency="'.$add_currency.'",created_by="'.$user_id.'"')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_nepa.php?success=create");
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
	height:237px;
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

	$("#building_code").focus();
	
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

	$("#amount").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
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

	$("#mnumber").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[0-9]+$/;
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
		var building_code		=	$("#building_code").val();
		var mdate				=	$("#mdate").val();
		var mnumber				=	$("#mnumber").val();
		var fromdate			=	$("#fromdate").val();
		var todate				=	$("#todate").val();
		var paymentdate			=	$("#paymentdate").val();
		var amount				=	$("#amount").val();
		var add_currency		=	$("#add_currency").val();
		
		var	currentdate			=	new Date();
		//alert(currentdate);
		//return false;

		var mdateval 			=	new Date(mdate.substring(6,10)+"/"+mdate.substring(3,5)+"/"+mdate.substring(0,2)).getTime();

		var fromdateval 			=	new Date(fromdate.substring(6,10)+"/"+fromdate.substring(3,5)+"/"+fromdate.substring(0,2)).getTime();

		var todateval 			=	new Date(todate.substring(6,10)+"/"+todate.substring(3,5)+"/"+todate.substring(0,2)).getTime();

		var paymentdateval 			=	new Date(paymentdate.substring(6,10)+"/"+paymentdate.substring(3,5)+"/"+paymentdate.substring(0,2)).getTime();

		var currentdatevalue	=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();

		if(building_code == '0') {
			$('.myalignbuild').html('ERR : Select Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_code").focus();
			return false;
		} else if(mnumber == '') {
			$('.myalignbuild').html('ERR : Enter Meter No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#mnumber").focus();
			return false;
		} else if(mdate == '') {
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#mdate").focus();
			return false;
		} else if(mdateval > currentdatevalue) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#mdate").focus();
			return false;
		} else if(fromdate == '') {
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#fromdate").focus();
			return false;
		} else if(fromdateval > currentdatevalue) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#fromdate").focus();
			return false;
		} else if(todate == '') {
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#todate").focus();
			return false;
		} else if(todateval > currentdatevalue) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#todate").focus();
			return false;
		} else if(fromdateval > todateval) {
			$('.myalignbuild').html('ERR : From Date Greater Than To Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#todate").focus();
			return false;
		} else if(fromdateval == todateval) {
			$('.myalignbuild').html('ERR : From Date & To Date Cannot be Same');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#todate").focus();
			return false;
		} else if(paymentdate == '') {
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#paymentdate").focus();
			return false;
		} else if(paymentdateval > currentdatevalue) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#paymentdate").focus();
			return false;
		} else if(paymentdateval < todateval) {
			$('.myalignbuild').html('ERR : Payment Date Should be Greater Than To Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#paymentdate").focus();
			return false;
		}  else if(add_currency == '') {
			$('.myalignbuild').html('ERR : Enter Currency');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#add_currency").focus();
			return false;
		} else if(amount == '') {
			$('.myalignbuild').html('ERR : Enter Amount');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#amount").focus();
			return false;
		}  

		//alert(343);
		$("#formsaveval").val('800');
		//return false;
		//$("#diesel_save").submit();
	});
}); 
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">NEPA</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">
<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Nepa</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
	 <td width="120" nowrap="nowrap">Building Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><?php
		$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,building_code,building_name from building");
		echo '<select name="building_code" id="building_code" tabindex="1" style="width:290px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state))
		{
		echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['building_name']).'</option>';

		}
		echo '</select>';
	?></td>
	</tr>
    
	<!-- <tr height="30">
	     <?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency</td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<td><input type='text' name='add_currency' id='add_currency' value="<?php echo $row['name']; ?>" size="4" readonly class="textbox"/></td>
	</tr>-->

	<tr height="30">
     <td width="120">Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='mdate' id='mdate' tabindex="3" readonly style="width:70px;" value="<?php echo date('d-m-Y'); ?>" class="datepicker textbox"/></td>
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
     <td width="120">Nepa Meter No.*</td>
     <td><input type='text' name='mnumber' id='mnumber' style="text-align:right" tabindex="2" size="12" autocomplete="off"class="textbox"/></td>
	</tr>

	<!-- <tr height="30">
		 <td width="120" nowrap="nowrap">Amount Paid*</td>
		 <td><input type='text' name='amount' id='amount' style="text-align:right" tabindex="3" size="12" autocomplete="off" class="textbox"/></td>
	</tr>-->

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
  <legend ><strong>For Period</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
	 <td width="120" nowrap="nowrap">From Date*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><input type='text' name='fromdate' id='fromdate' tabindex="4" readonly style="width:70px;" value="<?php echo ""; ?>" class="datepicker textbox"/></td>
	</tr>
    
    <tr height="30">	     
		<td width="120" >Payment Date*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='paymentdate' id='paymentdate' tabindex="6" readonly style="width:70px;" value="<?php echo date('d-m-Y'); ?>" class="datepicker textbox"/></td>
	</tr>
	
	<tr height="30">
	     <?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency</td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<td><input type='text' name='add_currency' id='add_currency' tabindex="7" value="<?php echo $row['name']; ?>" size="4" readonly class="textbox"/></td>
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
     <td width="120">To Date*</td>
     <td><input type='text' name='todate' id='todate' tabindex="5" readonly style="width:70px;" value="<?php echo ""; ?>" class="datepicker textbox"/></td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap"></td>
		 <td></td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap">Amount Paid*</td>
		 <td><input type='text' name='amount' id='amount' style="text-align:right" tabindex="8" size="12" autocomplete="off" class="textbox"/></td>
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
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_nepa.php'"/></td>
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