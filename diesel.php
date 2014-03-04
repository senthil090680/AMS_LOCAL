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
	
		$user_id		=	$_SESSION['user_id'];
		$add_currency	=	$fgmembersite->getdbval($_POST['add_currency'],'id','name','currency');
		if(!mysql_query('insert into diesel SET generator_code="'.$generator_code.'",building_code="'.$building_code.'",date="'.$ddate.'",transaction_number="'.$tnumber.'",diesel_volume="'.$volume.'",dieprice="'.$dieprice.'",currency="'.$add_currency.'",diesel_cost="'.$dcost.'",created_by="'.$user_id.'"')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_diesel.php?success=create");
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
	height:200px;
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

	$("#dcost").on('blur',function() {

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

	$("#volume").on('blur',function() {

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
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		//alert(2323);
		var price_val				=	($('#dieprice').val().replace(/,/g,''));		
		//var price_value			=	parseInt(price_val.replace(/,/g,''));

		//alert(starting_reading);
		
		if(price_val == '') {
			return false;
		}
		var vol_readingval		=	parseInt(mcost.replace(/,/g,''));
		
		var total_cost			=	price_val * vol_readingval;

		var x=(total_cost.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$('#dcost').val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));			
	});

	$("#dieprice").on('blur',function() {

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

		var volume_val				=	($('#volume').val().replace(/,/g,''));		
		//var price_value			=	parseInt(price_val.replace(/,/g,''));

		//alert(starting_reading);
		
		if(volume_val == '') {
			return false;
		}
		var price_readingval		=	mcost.replace(/,/g,'');
		
		var total_cost				=	volume_val * price_readingval;

		var x=(total_cost.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$('#dcost').val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});
	
	$("#part_save").on("click", function() {
		//alert("232");
		var generator_code		=	$("#generator_code").val();
		var building_code		=	$("#building_code").val();
		var ddate				=	$("#ddate").val();
		var tnumber				=	$("#tnumber").val();
		var volumeval			=	$("#volume").val();
		var dieprice			=	$("#dieprice").val();
		var add_currency		=	$("#add_currency").val();
		var dcost				=	$("#dcost").val();
		
		var	currentdate			=	new Date();

		//alert(currentdate);
		//return false;

		var ddateval 		=	new Date(ddate.substring(6,10)+"/"+ddate.substring(3,5)+"/"+ddate.substring(0,2)).getTime();

		var currentdatevalue	=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();
		
		if(building_code == '0') {
			$('.myalignbuild').html('ERR : Select Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_code").focus();
			return false;
		} else if(generator_code == '0') {
			$('.myalignbuild').html('ERR : Select Generator Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#generator_code").focus();
			return false;
		} else if(tnumber == '') {
			$('.myalignbuild').html('ERR : Enter Transaction No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#tnumber").focus();
			return false;
		} else if(ddate == '') {
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#ddate").focus();
			return false;
		} else if(ddateval > currentdatevalue) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#ddate").focus();
			return false;
		}  else if(volumeval == '') {
			$('.myalignbuild').html('ERR : Enter Volume');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#volume").focus();
			return false;
		}  else if(add_currency == '') {
			$('.myalignbuild').html('ERR : Enter Currency');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#add_currency").focus();
			return false;
		} else if(dcost == '') {
			$('.myalignbuild').html('ERR : Enter Cost');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#dcost").focus();
			return false;
		} 
		$("#formsaveval").val('800');
		$("#diesel_save").submit();
	});
}); 
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">DIESEL CONSUMPTION</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">
<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Diesel Consumption</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Building Name*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT id,building_code,building_name from building");
			echo '<select name="building_code" id="building_code" tabindex="1" style="width:290px;" >';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state))
			{
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['building_name']).'</option>';

			}
			echo '</select>';
		?>
	</td>
    </tr>
    
	<tr height="30">
     <td width="120">Transaction No.</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <?php
			 if(!isset($_GET[id]) && $_GET[id] == '') {
				$cusid					=	"SELECT transaction_number FROM diesel ORDER BY id DESC";			
				$cusold					=	mysql_query($cusid) or die(mysql_error());
				$cuscnt					=	mysql_num_rows($cusold);
				//$cuscnt					=	0; // comment if live
				if($cuscnt > 0) {
					$row_cus					  =	 mysql_fetch_array($cusold);
					$cusnumber	  =	$row_cus['transaction_number'];

					$getcusno						=	abs(str_replace("DE",'',strstr($cusnumber,"DE")));
					$getcusno++;
					if($getcusno < 10) {
						$createdcode	=	"00".$getcusno;
					} else if($getcusno < 100) {
						$createdcode	=	"0".$getcusno;
					} else {
						$createdcode	=	$getcusno;
					}

					$customer_code				=	"DE".$createdcode;
				} else {
					$customer_code				=	"DE001";
				}
			}
		?>
     <td><input type='text' name='tnumber' id='tnumber' tabindex="3" readonly value="<?php echo $customer_code; ?>" size="12" autocomplete="off" class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Diesel Volume(l)*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='volume' id='volume' style="text-align:right;" tabindex="5" size="12" autocomplete="off" class="textbox"/></td>
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
		 <td width="120" nowrap="nowrap">Generator Name*</td>
		 <td><?php
		$result_state=mysql_query("SELECT id,generator_code,description from generator");
		echo '<select name="generator_code" id="generator_code" tabindex="2" style="width:310px;">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state))
		{
		echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['description']).'</option>';

		}
		echo '</select>';
	?></td>
	</tr>
     
	<tr height="30">
		<td width="120">Transaction Date</td>		
		<td><input type='text' name='ddate' id='ddate' tabindex="4" style="width:70px;" value="<?php echo date('d-m-Y'); ?>" class="datepicker textbox"/></td>
    </tr>

	<tr height="30">
		 <td width="120" nowrap="nowrap">Price</td>
		 <td><input type='text' name='dieprice' id='dieprice' style="text-align:right;" tabindex="6" size="12" autocomplete="off" class="textbox"/></td>
	</tr>
	
	<tr height="30">
		 <td width="120" nowrap="nowrap">Diesel Cost*</td>
		 <td><input type='text' name='dcost' id='dcost' style="text-align:right;" tabindex="8" size="12" autocomplete="off" class="textbox"/></td>
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
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_diesel.php'"/></td>
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