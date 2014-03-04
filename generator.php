<?PHP
require_once("./include/membersite_config.php");
require_once ("./include/ajax_pagination.php");
$fgmembersite->DBLogin();
EXTRACT($_REQUEST);
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
if ($fgmembersite->usertype() == 1) {
	$header_file='./layout/admin_header_bms.php';
}
if(file_exists($header_file)) {
	include_once($header_file);
}
else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
?>
<script>
function myFunction() {
	document.getElementById("state").value="";
	document.getElementById("state").focus();
	return false;
}
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
$(function () {		
	$('#clear').click(function(event) {
		$('#desc').val()="";
		$('#building_code').val()=0;
		$('#make').val()="";
		$('#model').val()="";
		$('#rating').val()="";
		$('#genrator_status').val()=0;				
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
.scroll_box {
   height: 379px;
   overflow: auto;
}
#mainarea {
    background: none repeat scroll 0 0 #EBEBEB;
    height: 510px;
    width: 100%;
}
</style>
<script>
function validateForm() {
	var desc=document.getElementById("desc");
	if(desc.value=="") {
		$('.myalignbuild').html('ERR 0009 : Enter Description');
		$('#errormsgbuild').css('display','block');
		$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);		
		document.getElementById("desc").focus();
		return false;
	}	
	var building_code=document.getElementById("building_code");
	if(building_code.value==0) {
		$('.myalignbuild').html('ERR 0009 : Select Building Name');
		$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
		document.getElementById("building_code").focus();
		return false;
	}	
	
	var genrator_status=document.getElementById("genrator_status");
	if(genrator_status.value==0) {
		$('.myalignbuild').html('ERR 0009 : Select Ownership');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
		document.getElementById("genrator_status").focus();
		return false;
	}
	if(genrator_status.value==1) {		
		var cost=document.getElementById("cost");
		if(cost.value=="") {
			$('.myalignbuild').html('ERR 0009 : Enter Cost');
			$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
			document.getElementById("cost").focus();
			return false;
		}
		var datepurchase=document.getElementById("datepurchase").value;
		if(datepurchase==""||datepurchase==0 || !datepurchase) {
			$('.myalignbuild').html('ERR 0009 : Select Date Of Purchase');
			$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
			document.getElementById("datepurchase").focus();
			return false;
		}
		var contract_number=document.getElementById("contract_number");
		if(contract_number.value=="") {
			$('.myalignbuild').html('ERR 0009 : Enter Maintenance Contract No.');
			$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
			document.getElementById("contract_number").focus();
			return false;
		}		
		var vendor_code=document.getElementById("vendor_code");
		if(vendor_code.value==0) {
			$('.myalignbuild').html('ERR 0009 : Select Vendor Name');
			$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
			document.getElementById("vendor_code").focus();
			return false;
		}
		var maintain_period=document.getElementById("maintain_period");
		if(maintain_period.value==0) {
			$('.myalignbuild').html('ERR 0009 : Select Period');
				$('#errormsgbuild').css('display','block');
						setTimeout(function() {
							$('#errormsgbuild').hide();
						},5000);
			document.getElementById("maintain_period").focus();
			return false;
		}
		var mcost=document.getElementById("mcost");
		if(mcost.value=="") {
			$('.myalignbuild').html('ERR 0009 : Enter Maintenance Cost');
			$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
			document.getElementById("mcost").focus();
			return false;
		}						
		var renewaldate=document.getElementById("renewaldate").value;
		if(renewaldate==""||renewaldate==0 || !renewaldate) {
			$('.myalignbuild').html('ERR 0009 : Select Contract Renewal Date');
				$('#errormsgbuild').css('display','block');
						setTimeout(function() {
							$('#errormsgbuild').hide();
						},5000);
			document.getElementById("renewaldate").focus();
			return false;
		}		
	}
	if(genrator_status.value==2) {
		var rent=document.getElementById("rent");
		if(rent.value=="") {
			$('.myalignbuild').html('ERR 0009 : Enter Rent');
				$('#errormsgbuild').css('display','block');
						setTimeout(function() {
							$('#errormsgbuild').hide();
						},5000);
			document.getElementById("rent").focus();
			return false;
		}		
		var maintain_period_landlord=document.getElementById("maintain_period_landlord");
		if(maintain_period_landlord.value==0) {
			$('.myalignbuild').html('ERR 0009 : Select Period');
				$('#errormsgbuild').css('display','block');
						setTimeout(function() {
							$('#errormsgbuild').hide();
						},5000);
			document.getElementById("maintain_period_landlord").focus();
			return false;
		}
		var contract_number_landlord=document.getElementById("contract_number_landlord");
		if(contract_number_landlord.value=="") {
			$('.myalignbuild').html('ERR 0009 : Enter Maintenance Contract No.');
				$('#errormsgbuild').css('display','block');
						setTimeout(function() {
							$('#errormsgbuild').hide();
						},5000);
			document.getElementById("contract_number_landlord").focus();
			return false;
		}
		var vendor_code_landlord=document.getElementById("vendor_code_landlord");
		if(vendor_code_landlord.value==0) {
				$('.myalignbuild').html('ERR 0009 : Select Vendor Name');
			$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
			document.getElementById("vendor_code_landlord").focus();
			return false;
		}
		var mcost_landlord=document.getElementById("mcost_landlord");
		if(mcost_landlord.value=="") {
			$('.myalignbuild').html('ERR 0009 : Enter Maintenance Cost');
			$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
			document.getElementById("mcost_landlord").focus();
			return false;
		}
		var period_from=document.getElementById("period_from");
		if(period_from.value==0) {
			$('.myalignbuild').html('ERR 0009 : Select Period');
			$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
			document.getElementById("period_from").focus();
			return false;
		}
		var renewaldate_landlord=document.getElementById("renewaldate_landlord").value;
		if(renewaldate_landlord==""||renewaldate_landlord==0 || !renewaldate_landlord) {
			$('.myalignbuild').html('ERR 0009 : Enter Contract Renewal Date');
			$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
			document.getElementById("renewaldate_landlord").focus();
			return false;
		}				
	}
}
</script>
<script>
 $(document).ready(function() { 
    $("#cost").blur(function(){
	var cost=document.getElementById("cost").value;
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!cost.match(numericExpression))
		{
		$('.myalignbuild').html('ERR 0009 : Only Numbers');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("cost").value="";
			document.getElementById("cost").focus();
			return false;
		}
		var x = $("#cost").val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});
	});
	</script>
	
	<script>
 $(document).ready(function() { 
    $("#mcost").blur(function(){
	var mcost=document.getElementById("mcost").value;
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression))
		{
		$('.myalignbuild').html('ERR 0009 : Only Numbers');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("mcost").value="";
			document.getElementById("mcost").focus();
			return false;
		}
		var x = $("#mcost").val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});
	});
	</script>
	
	<script>
 $(document).ready(function() { 
    $("#mcost_landlord").blur(function(){
	
	var mcost_landlord=document.getElementById("mcost_landlord").value;
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost_landlord.match(numericExpression))
		{
		$('.myalignbuild').html('ERR 0009 : Only Numbers');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("mcost_landlord").value="";
			document.getElementById("mcost_landlord").focus();
			return false;
		}
		var x = $("#mcost_landlord").val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});
	});
	</script>
	<script>
		$(document).ready(function() { 
		$("#rent").blur(function(){
		var rent=document.getElementById("rent").value;
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!rent.match(numericExpression))
		{
		$('.myalignbuild').html('ERR 0009 : Only Numbers');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("rent").value="";
			document.getElementById("rent").focus();
			return false;
		}
		var x = $("#rent").val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});
	});
	$(document).ready(function() {
		$("#building_code").change(function(event) {
		var building_id=document.getElementById("building_code").value;
		
		$.ajax({
				url				:	"ajax_building.php",
				type				:	"post",
				dataType			:	"text",
				cache				:	false,
				data				:	{ "building_id" : building_id },
				success				:	function(ajaxval) {
					if (ajaxval!=0)
					{
						$('.myalignbuild').html('ERR 0009 : Generator Already Exists For The Building');
					$('#errormsgbuild').css('display','block');
						setTimeout(function() {
							$('#errormsgbuild').hide();
						},5000);
						document.getElementById("building_code").value=0;
						document.getElementById("building_code").focus();
						return false;
					}					
					
				}
			});
		
		});		
   });
   $(document).ready(function() {
		$("#genrator_status").change(function(event) {
			var selvalue_status=document.getElementById("genrator_status").value;
			//alert(selvalue_status);
			if (selvalue_status == 1 ) {
				document.getElementById("owned_display").style.display="block";
				document.getElementById("landlord_display").style.display="none";
			}
			if (selvalue_status == 2 ) {
				document.getElementById("owned_display").style.display="none";
				document.getElementById("landlord_display").style.display="block";
			}
			if (selvalue_status == 0 ) {
				document.getElementById("owned_display").style.display="none";
				document.getElementById("landlord_display").style.display="none";
			}		
		});		
   });
   </script>   
<?php
if(isset($_POST['save'])) {
	$generator_code=$_POST['code'];
	$desc=$_POST['desc'];
	$building_code=$_POST['building_code'];
	$make=$_POST['make'];
	$model=$_POST['model'];
	$rating=$_POST['rating'];

	$genrator_status=$_POST['genrator_status'];
	$total_currency=$fgmembersite->getdbval($_POST['total_currency'],'id','name','currency');
	$maintain_currency=$fgmembersite->getdbval($_POST['maintain_currency'],'id','name','currency');
	$datepurchase=$_POST['datepurchase'];
	$cost=$_POST['cost'];
	$contract_number=$_POST['contract_number'];
	$vendor=$_POST['vendor_code'];
	$mcost=$_POST['mcost'];
	$maintain_period=$_POST['maintain_period'];
	$renewaldate=$_POST['renewaldate'];
	$rent=$_POST['rent'];
	$maintain_period_landlord=$_POST['maintain_period_landlord'];
	$contract_number_landlord=$_POST['contract_number_landlord'];
	$vendor_code_landlord=$_POST['vendor_code_landlord'];
	$mcost_landlord=$_POST['mcost_landlord'];
	$period_from=$_POST['period_from'];
	$renewaldate_landlord=$_POST['renewaldate_landlord'];
	if ($genrator_status ==2) {
		$maintain_period=$maintain_period_landlord;
		$vendor=$vendor_code_landlord;
		$contract_number=$contract_number_landlord;
		$maintain_period=$maintain_period_landlord;
		$mcost=$mcost_landlord;
		$renewaldate=$renewaldate_landlord;
	}
	$user_id=$_SESSION['user_id'];
	if(!mysql_query('INSERT INTO generator SET generator_code="'.$generator_code.'",description="'.$desc.'",building_code="'.$building_code.'",make="'.$make.'",model="'.$model.'",rating="'.$rating.'",generator_status="'.$genrator_status.'",currency="'.$total_currency.'",cost="'.$cost.'",dateofpurchase="'.$datepurchase.'",rent="'.$rent.'",period="'.$period_from.'",contract_number="'.$contract_number.'",vendor="'.$vendor.'", maintenance_cost="'.$mcost.'",maintain_currency="'.$maintain_currency.'",maintain_period="'.$maintain_period.'",contract_renewaldate="'.$renewaldate.'",created_by="'.$user_id.'" '))
	{
		die('Error: ' . mysql_error());
	}
	$fgmembersite->RedirectToURL("view_generator.php?success=create");
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">GENERATOR</div>
<div id="mytableformreceipt1" align="center"><!--- mytableformreceipt1 div start-->
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box"><!--- scroll box div start-->
<fieldset class="alignment" align="left">
  <legend><strong>Generator</strong></legend>
  <table width="100%">
  <tr>
  <td width="40%">
		<table align="left">
		 <tr>
		  <td>
		  <table>
			<tr height="30">
			<td width="120">Generator Code</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<?php
			if(!isset($_GET[id]) && $_GET[id] == '') {
					$cusid					=	"SELECT generator_code FROM  generator ORDER BY id DESC";			
					$cusold					=	mysql_query($cusid) or die(mysql_error());
					$cuscnt					=	mysql_num_rows($cusold);
					//$cuscnt					=	0; // comment if live
					if($cuscnt > 0) {
						$row_cus					  =	 mysql_fetch_array($cusold);
						$cusnumber	  =	$row_cus['generator_code'];

						$getcusno						=	abs(str_replace("GE",'',strstr($cusnumber,"GE")));
						$getcusno++;
						if($getcusno < 10) {
							$createdcode	=	"00".$getcusno;
						} else if($getcusno < 100) {
							$createdcode	=	"0".$getcusno;
						} else {
							$createdcode	=	$getcusno;
						}

						$customer_code				=	"GE".$createdcode;
					} else {
						$customer_code				=	"GE001";
					}
				}
			?>
			<td>
			
			<input type="text" name="code" id="code" size="7" value="<?php echo $customer_code	;?>" readonly maxlength="10" autocomplete='off' readonly="true" tabindex="1"/>
			
			</td>
			</tr>
			
			<tr height="30">
			 <td width="120">Building Name*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				
				<?php
									$result_state=mysql_query("SELECT id,building_name from building");
									echo '<select name="building_code" id="building_code" tabindex="3"  style="width:230px;">';
									echo '<option value="0">--Select--</option>';
									while($row=mysql_fetch_array($result_state))
									{
									echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['building_name']).'</option>';

									}
									echo '</select>';
									?>&nbsp;
				
			  </td>
			</tr>
			<tr height="30">
			 <td width="120">Model</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<input type="text" name="model" id="model" size="10" autocomplete='off' tabindex="5" />				
			  </td>
			</tr>

		   </table>
		   </td>
		 </tr>
		</table>
</td>
<td width="40%" >
	 <table >
			 <tr>
			  <td>
			  <table>
				<tr height="30">
				<td width="120">Description*</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				
				<td>
				<input type="text" name="desc" id="desc" size="42" autocomplete='off' tabindex="2" />	
				</td>
				</tr>
				
				<tr height="30">
				 <td width="120">Make</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				 <td>
					<input type='text' name='make' id='make' size="30" tabindex="4" autocomplete="off" />
				  </td>
				</tr>
				<tr height="30">
				 <td width="120">Rating</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				 <td>
					
					<input type='text' name='rating' id='rating' size="10" tabindex="6" autocomplete="off"/>
					
				  </td>
				</tr>

			   </table>
			   </td>
			 </tr>
			</table>
		
 </td>	
</tr>
</table> 
</fieldset>
<fieldset class="alignment" align="left">
  <legend><strong>Ownership</strong></legend>
  <table width="100%">
  <tr height="30">
  <td width="142" nowrap="nowrap">Owned/Landlord's/Rented*&nbsp;&nbsp;&nbsp;</td>
  <td>
  <select name="genrator_status" id="genrator_status" tabindex="7">
	<option value="0">--Select--</option>
	<option value="1">Owned</option>
	<option value="2">Landlord/Rented</option>
</select>
  </td>
 </tr>
</table> 
</fieldset>
<div id="owned_display" style="display:none"><!--- owned_display div start-->
<fieldset class="alignment" align="left">
  <legend><strong>Owned</strong></legend>
  <table width="100%">
  <tr>
  <td width="45%">
		<table align="left">
		 <tr>
		  <td>
		  <table>			
			<tr height="30">
			 <td width="120">Currency</td>
			 	<?php
					$result_state=mysql_query("select * from currency where id=1");
					while($row=mysql_fetch_array($result_state)) {
						$currency_id = $row['id'];
						$currency_name = $row['name'];
						$symbol=$row['symbol'];
					}
				?>
			 <td><img width="15px" height="15px" src="images/<?php echo $symbol;?>" style="vertical-align:middle;"></img></td>
			 <td>			
				<input type='text' name='total_currency' id='total_currency' value="<?php echo $currency_name;?>" size="4"  readonly="true" tabindex="8" autocomplete="off"/>				
			  </td>
			</tr>						
			<tr height="30">
			<td width="120">Purchase Date*</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>			
				<input type='text' name='datepurchase' id='datepurchase' value="<?php echo date('d-m-Y'); ?>" class="datepicker" size="10" tabindex="10" autocomplete="off"/>	
			</td>
			</tr>
			<tr height="30">
			 <td width="120">Vendor Name*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<?php
					$result_state=mysql_query("SELECT id,name from vendor_bms");
					echo '<select name="vendor_code" id="vendor_code" tabindex="12" style="width:230px;">';
					echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state)) {
						echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
					}
					echo '</select>';
					?>&nbsp;				
			  </td>
			</tr>
			<tr height="30">
			 <td width="120">Currency</td>
			 <?php
				$result_state=mysql_query("select * from currency where id=1");
				while($row=mysql_fetch_array($result_state)) {
					$currency_id = $row['id'];
					$currency_name = $row['name'];
					$symbol=$row['symbol'];
				}
			?>
			 <td><img width="15px" height="15px" src="images/<?php echo $symbol;?>" style="vertical-align:middle;"></img></td>
			 <td>
				<input type='text' name='maintain_currency' id='maintain_currency' value="<?php echo $currency_name;?>" size="4"  readonly ="true" tabindex="13" autocomplete="off"/>					
			  </td>
			</tr>			
			<tr height="30">
			 <td width="120">Renewal Date*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<input type="text" name="renewaldate" id="renewaldate" value="" class="datepicker" size="10" autocomplete='off' tabindex="16" autocomplete="off"/>				
			  </td>
			</tr>
		   </table>
		   </td>
		 </tr>
		</table>
</td>
<td width="50%">
	 <table >
			 <tr>
			  <td>
			  <table>
			<tr height="30">
				<td width="120">Cost*</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>
					<input type="text" name="cost" id="cost" size="15" autocomplete='off' tabindex="9" style="text-align:right;" autocomplete="off"/>
				</td>
			</tr>
			<tr height="30">
			 <td width="120" style="white-space:nowrap;">Maint. Contract No.*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
			 <input type='text' name='contract_number' id='contract_number' size="15" tabindex="11" autocomplete="off"/>
			  </td>
			</tr>
			<tr height="30">
			 <td width="120">Period*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				 <select name="maintain_period" id="maintain_period" tabindex="15">
					<option value="0">--Select--</option>
					<option value="1">Monthly</option>
					<option value="2">Quarterly</option>
					<option value="3">Half Yearly</option>
					<option value="4">Yearly</option>
				</select>				
			  </td>
			</tr>
			<tr height="30">
				 <td width="120">Maint. Cost*</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				 <td>
					<input type='text' name='mcost' id='mcost' size="15" tabindex="14" style="text-align:right;" autocomplete="off"/>
				  </td>
			</tr>									
			<tr height="30">
			 <td width="120">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
			  </td>
			</tr>
		   </table>
		   </td>
		 </tr>			 
		</table>		
 </td>	
</tr>
</table>  
</fieldset>
</div><!--- owned_display div end-->
<div id="landlord_display" style="display:none"><!--- landlord_display div start-->
<fieldset class="alignment" align="left">
  <legend><strong>Landlord/Rented</strong></legend>
  <table width="100%">
  <tr>
  <td width="36%">
		<table align="left">
		 <tr>
		  <td>
		  <table>
			<tr height="30">
			<td width="120">Rent*</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>			
				<input type='text' name='rent' id='rent' size="15" tabindex="8" style="text-align:right;" autocomplete="off"/>			
			</td>
			</tr>
			<tr height="30">
			 <td width="120" style="white-space:nowrap;">Maint. Contract No.*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				<input type='text' name='contract_number_landlord' id='contract_number_landlord' size="15" tabindex="10" autocomplete="off"/>
			 </td>
			</tr>
			<tr height="30">
			 <td width="120">Currency</td>
			 <td><img width="15px" height="15px" src="images/<?php echo $symbol;?>" style="vertical-align:middle;"></img></td>
			 <td>
				<?php
					$result_state=mysql_query("select * from currency where id=1");
					while($row=mysql_fetch_array($result_state)) {
						$currency_id = $row['id'];
						$currency_name = $row['name'];
						$symbol= $row['symbol'];
					}					
				?>
				<input type='text' name='maintain_currency' id='maintain_currency' value="<?php echo $currency_name;?>" size="4" tabindex="12" readonly="true"/>				
			  </td>
			</tr>
				<tr height="30">
				 <td width="120">Period*</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				 <td>
					 <select name="period_from" id="period_from" tabindex="14">
						<option value="0">--Select--</option>
						<option value="1">Monthly</option>
						<option value="2">Quarterly</option>
						<option value="3">Half Yearly</option>
						<option value="4">Yearly</option>
					</select>					
				  </td>
				</tr>
		   </table>
		   </td>
		 </tr>
		</table>
</td>
<td width="40%" >
	 <table >
			 <tr>
			  <td>
			  <table>
				<tr height="30">
				 <td width="120">Period*</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				 <td>
					 <select name="maintain_period_landlord" id="maintain_period_landlord" tabindex="9">
						<option value="0">--Select--</option>
						<option value="1">Monthly</option>
						<option value="2">Quarterly</option>
						<option value="3">Half Yearly</option>
						<option value="4">Yearly</option>
					</select>
				  </td>
				</tr>
				<tr height="30">
			 <td width="120">Vendor Name*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<?php
					$result_state=mysql_query("SELECT id,name from vendor_bms");
					echo '<select name="vendor_code_landlord" id="vendor_code_landlord" tabindex="11" style="width:260px;">';
					echo '<option value="0">--Select--</option>';
					while($row=mysql_fetch_array($result_state)) {
						echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
					}
					echo '</select>';
				?>&nbsp;				
			  </td>
			</tr>
			<tr height="30">
			 <td width="120">Maint. Cost*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>
				<input type='text' name='mcost_landlord' id='mcost_landlord' size="15" tabindex="13"  style="text-align:right;" autocomplete="off"/>				
			</td>
			</tr>
			<tr height="30">
			 <td width="120">Renewal Date*</td>
			 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			 <td>				
				<input type="text" name="renewaldate_landlord" id="renewaldate_landlord"  value="<?php echo date('d-m-Y'); ?>" class="datepicker" size="10" autocomplete='off' tabindex="15"/>				
			  </td>
			</tr>
			   </table>
			   </td>
			 </tr>			 
			</table>
 </td>	
</tr>
</table>  
</fieldset>
</div><!--- landlord_display div end-->
</div><!--- scroll box div end-->

<?php if($_GET['success']=="update") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0002 : Data Updated Successfully "; ?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php } 
if($_GET['success']=="error") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php } ?>
<br/>
</div><!--- mytableformreceipt1 div end-->
<table width="100%" style="clear:both">
  <tbody><tr height="50px;" align="center">
	<td><input type="submit" value="Save" class="buttons" id="save" name="save">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=2'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_generator.php'" class="buttons" value="View" name="View">
	</td>
  </tr>
  <tr>
  <td>
<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
<?php if($_GET['success']=="create") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Data Entered Successfully"; ?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }?>
  </td>
  </tr>
</tbody></table>
</form>
</div><!--- mainarea  div end-->
<?php $footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>