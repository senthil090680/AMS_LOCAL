<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

echo "<pre>";
print_r($_FILES);
echo "</pre>";
exit;*/

if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if ($fgmembersite->usertype() == 1)	{
	$header_file='./layout/admin_header_fms.php';
}
if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}

if($_REQUEST['trans_desc']!='') {
	$var = @$_REQUEST['trans_desc'];
	$trimmed = trim($var);
	$qry="SELECT vt.id AS VTID,veh.vehicle_regno AS VEH_NUM, ve.name AS VE_NAME,um.name AS UOM_NAME,tt.name AS TT_NAME,transaction_date, transaction_number, units, cu.name AS CU_NAME,transaction_number,units,rate,cost,trans_desc,bought_by,emp_code,driver_code_id,others FROM `vehicle_transaction` vt LEFT JOIN vendor ve ON vt.vendor_id = ve.id LEFT JOIN vehicle veh ON veh.id = vt.vehicle_reg_id LEFT JOIN transaction_type tt ON vt.transaction_type_id = tt.id LEFT JOIN uom um ON vt.uom_id = um.id LEFT JOIN currency cu ON vt.currency_id = cu.id WHERE vt.trans_desc LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT vt.id AS VTID,veh.vehicle_regno AS VEH_NUM, ve.name AS VE_NAME,um.name AS UOM_NAME,tt.name AS TT_NAME,transaction_date, transaction_number, units, cu.name AS CU_NAME,transaction_number,units,rate,cost,trans_desc,bought_by,emp_code,driver_code_id,others FROM `vehicle_transaction` vt LEFT JOIN vendor ve ON vt.vendor_id = ve.id LEFT JOIN vehicle veh ON veh.id = vt.vehicle_reg_id LEFT JOIN transaction_type tt ON vt.transaction_type_id = tt.id LEFT JOIN uom um ON vt.uom_id = um.id LEFT JOIN currency cu ON vt.currency_id = cu.id"; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);			

$params			=	$trans_desc."&".$sortorder."&".$ordercol;

/********************************pagination start***********************************/
$strPage = $_REQUEST[page];
//$params = $_REQUEST[params];

//if($_REQUEST[mode]=="Listing"){
//$Num_Rows = mysql_num_rows ($res_search);

########### pagins

$Per_Page = 5;   // Records Per Page

$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($num_rows<=$Per_Page)
{
$Num_Pages =1;
}
else if(($num_rows % $Per_Page)==0)
{
$Num_Pages =($num_rows/$Per_Page) ;
}
else
{
$Num_Pages =($num_rows/$Per_Page)+1;
$Num_Pages = (int)$Num_Pages;
}
if($sortorder == "")
{
	$orderby	=	"ORDER BY vt.id DESC";
} else {
	$orderby	=	"ORDER BY $ordercol $sortorder";
}
$qry.=" $orderby LIMIT $Page_Start , $Per_Page";  //need to uncomment
//echo $qry;
//exit;
$results_dsr = mysql_query($qry) or die(mysql_error());
/********************************pagination***********************************/

?>
<style type="text/css">
#containerprforcd {
	padding:0px;
	width:100%;
	margin-left:auto;
	margin-right:auto;
}
#mainareadaily {
    background: none repeat scroll 0 0 #EBEBEB;
    height: 500px;
    width: 100%;
}
</style>
<script type="text/javascript" language="javascript">
function delcall(id,name) {
	var confirmdata		=	confirm("Are You Sure You Want to Delete : "+name);
	if(confirmdata) {
		window.location = "view_vehicle_transaction.php?id="+id+"&del=del";
	}
}
function vehtransviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var trans_desc		=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_viewvehtrans.php",
		type: "get",
		dataType: "text",
		data : { "trans_desc" : trans_desc, "sortorder" : sortorder, "ordercol" : ordercol, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function searchvehtransviewajax(page) {  // For pagination and sorting of the Collection Deposited search in view page
	var trans_desc	=	$("input[name='trans_desc']").val();
	//alert(trans_desc);
	$.ajax({
		url : "ajax_viewvehtrans.php",
		type: "get",
		dataType: "text",
		data : { "trans_desc" : trans_desc, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
</script>

<div id="mainareadaily">
<div class="mcf"></div>
<div><h2 align="center">VEHICLE TRANSACTION</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add Vehicle Transaction" class="buttonsbig" onclick="window.location='vehicle_transaction.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=3'"></span>

<div class="clearfix"></div>
 <div id="search">
        <input type="text" name="trans_desc" value="<?php echo $_REQUEST['trans_desc']; ?>" autocomplete='off' style="width:120px;" placeholder='Search By Description'/>
        <input type="button" class="buttonsg" onclick="searchvehtransviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
 <div class="clearfix"></div>
        <?php
		if($_GET['id']!='' && $_GET['del'] == 'del'){
			$query = "DELETE FROM `vehicle_transaction` WHERE id = $id";
			//Run the query
			$result = mysql_query($query) or die(mysql_error());
			header("location:view_vehicle_transaction.php?success=del");
		 }		
		?>
		<div id="colviewajaxid">
			<div class="con">
			<table width="100%">
			<thead>
			<tr>
				<th nowrap="nowrap">Vehicle Regn. No.</th>
				<th nowrap="nowrap">Trans. Date</th>
				<?php //echo $sortorderby;
				if($sortorder == 'ASC') {
					$sortorderby = 'DESC';
				} elseif($sortorder == 'DESC') {
					$sortorderby = 'ASC';
				} else {
					$sortorderby = 'ASC';
				}
				$paramsval	=	$trans_desc."&".$sortorderby."&vt.transaction_type_id"; ?>				
				<th nowrap="nowrap" class="rounded" onClick="vehtransviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Trans. Type<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap" >Trans. No.</th>
				<th nowrap="nowrap">Vendor</th>
				<th nowrap="nowrap">UOM</th>
				<th nowrap="nowrap">Units</th>
				<th nowrap="nowrap">Currency</th>
				<th nowrap="nowrap">Rate</th>
				<th nowrap="nowrap">Cost</th>
				<th nowrap="nowrap">Description</th>
				<th nowrap="nowrap">Bought By</th>
				<th align="right">Edit/Del</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if(!empty($num_rows)){
				$slno	=	($Page-1)*$Per_Page + 1;
			$c=0;$cc=1;
			while($fetch = mysql_fetch_array($results_dsr)) {
			if($c % 2 == 0){ $cls =""; } else{ $cls =" class='odd'"; }
			$id			=	$fetch['VTID'];
			?>
			<tr>
				<td><?php echo $fetch['VEH_NUM']; ?></td>
				<td><?php echo $fetch['transaction_date']; ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['TT_NAME']);?></td>
				<td><?php echo $fetch['transaction_number']; ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['VE_NAME']); ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['UOM_NAME']); ?></td>
				<td align="right"><?php echo $fetch['units']; ?></td>
				<td align="right"><?php echo $fetch['CU_NAME']; ?></td>
				<td align="right"><?php echo $fetch['rate']; ?></td>
				<td align="right"><?php echo $fetch['cost']; ?></td>
				<td align="right"><?php echo ucfirst($fetch['trans_desc'])."."; ?></td>
				<td align="right"><?php if($fetch['bought_by'] == "1") {
						$fgmembersite->DBLogin();
						$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
						or die("Opps some thing went wrong");
						mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
						echo $fgmembersite->getdbval($fetch['emp_code'],'first_name','emp_code','pim_emp_info');
					} elseif($fetch['bought_by'] == "2") {						
						echo $fgmembersite->getdbval($fetch['driver_code_id'],'emp_name','id','driver');
					} elseif($fetch['bought_by'] == "3") {
						echo $fetch['others'];
					} ?></td>				
				<td align="right" nowrap="nowrap">

				<a href="edit_vehicle_transaction.php?id=<?php echo $fetch['VTID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['VTID']; ?>','<?php echo $fetch['VEH_NUM']; ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
				</td>
			</tr>
			<?php $c++; $cc++; $slno++; }		 
			} else { echo "<tr><td align='center' colspan='13'><b>No records found</b></td></tr>";}  ?>
			</tbody>
			</table>
			 </div>   
			 <div class="paginationfile" align="center">
			 <table>
			 <tr>
			 <th class="pagination" scope="col">          
			<?php 
			if(!empty($num_rows)){
				$fgmembersite->rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'vehtransviewajax');   //need to uncomment
			} else { 
				echo "&nbsp;"; 
			} ?>      
			</th>
			</tr>
			</table>
		  </div>
		  <?php if($_GET['success']=="create") { ?>
			<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Data Entered Successfully"; 
		  ?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
			<?php } 
			if($_GET['success']=="update") { ?>
			<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0002 : Data Updated Successfully "; 
			?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
			<?php } 
			if($_GET['success']=="error") { ?>
			<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
			<?php } 
			if($_GET['success']=="del") {
			?>
			<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Data Deleted Successfully"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
			<?php } ?>

		<!-- <span id="printopen" style="padding-left:370px;padding-top:10px;<?php if($num_rows > 0 ) { echo "display:block;"; } else { echo "display:none;"; } ?>" ><input type="button" name="kdproduct" value="Print" class="buttons" onclick="print_pages('printbuildviewajax');"></span> -->
			<form id="printbuildviewajax" target="_blank" action="printbuildviewajax.php" method="post">
				<input type="hidden" name="building_name" id="building_name" value="<?php echo $Challan_Number; ?>" />
				<input type="hidden" name="sortorder" id="sortorder" value="<?php echo $sortorder; ?>" />
				<input type="hidden" name="ordercol" id="ordercol" value="<?php echo $ordercol; ?>" />
				<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST[page]; ?>" />
			</form>
	 </div>
     <!-- <div class="msg" align="center" <?php if($_REQUEST['id']!='' && $_REQUEST['del']=='del'){?>style="display:block;"<?php }else{?>style="display:none;"<?php }?>>
     <form action="" method="post">
     <input type="submit" name="submit" id="submit" class="buttonsdel" value="ConfirmDelete" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='CollectionDeposited.php'"/>
      </form>
     </div> -->  
   </div>
</div>
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile))
{
	include_once($footerfile);
}
else
{
	echo _FILENOTFOUNT.$footerfile;
}
?>