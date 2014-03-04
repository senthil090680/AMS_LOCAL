<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

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
	$header_file='./layout/admin_header_bms.php';
}
if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}

if($_REQUEST['building_name']!='') {
	$var = @$_REQUEST['Challan_Number'] ;
	$trimmed = trim($var);	
	$qry="SELECT id,building_name,building_code,building_type,building_status,incharge_empcode,building_city,building_state FROM `building` WHERE building_name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT id,building_name,building_code,building_type,building_status,incharge_empcode,building_city,building_state FROM `building`"; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);			

$params			=	$Challan_Number."&".$sortorder."&".$ordercol;

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
	$orderby	=	"ORDER BY id DESC";
} else {
	$orderby	=	"ORDER BY $ordercol $sortorder";
}
$qry.=" $orderby LIMIT $Page_Start , $Per_Page";  //need to uncomment
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
		window.location = "view_building.php?id="+id+"&del=del";
	}
}
function buildviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var building_name	=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_viewbuilding.php",
		type: "get",
		dataType: "text",
		data : { "building_name" : building_name, "sortorder" : sortorder, "ordercol" : ordercol, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function searchcolviewajax(page) {  // For pagination and sorting of the Collection Deposited search in view page
	var building_name	=	$("input[name='building_name']").val();
	//alert(Product_name);
	$.ajax({
		url : "ajax_viewbuilding.php",
		type: "get",
		dataType: "text",
		data : { "building_name" : building_name, "page" : page },
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
<div><h2 align="center">BUILDING</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add Building" class="buttonsbig" onclick="window.location='building.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=2'"></span>

<div class="clearfix"></div>
 <div id="search">
        <input type="text" name="building_name" value="<?php echo $_REQUEST['building_name']; ?>" autocomplete='off' style="width:120px;" placeholder='Search By Buldg Name'/>
        <input type="button" class="buttonsg" onclick="searchcolviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
 <div class="clearfix"></div>
        <?php
		if($_GET['id']!='' && $_GET['del'] == 'del'){
			$query = "DELETE FROM `building` WHERE id = $id";
			//Run the query
			$result = mysql_query($query) or die(mysql_error());
			header("location:view_building.php?success=del");
		 }		
		?>
		<div id="colviewajaxid">
			<div class="con">
			<table width="100%">
			<thead>
			<tr>
				<?php //echo $sortorderby;
					if($sortorder == 'ASC') {
						$sortorderby = 'DESC';
					} elseif($sortorder == 'DESC') {
						$sortorderby = 'ASC';
					} else {
						$sortorderby = 'ASC';
					}
					$paramsval	=	$building_name."&".$sortorderby."&building_name";
				?>				
				<th nowrap="nowrap" class="rounded" onClick="buildviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Building Name<img src="images/sort.png" width="13" height="13" /></th>
				
				<th nowrap="nowrap" >Building Code</th>
				<th nowrap="nowrap">Building Type</th>
				<th nowrap="nowrap">Ownership</th>
				<!-- <th nowrap="nowrap">Liaison Employee</th> -->
				<th nowrap="nowrap">In-Charge Employee</th>
				<th nowrap="nowrap">City</th>
				<th nowrap="nowrap">State</th>
				<!-- <th nowrap="nowrap">Total Maintenance Costs</th> -->
				<th align="right">Edit/Del</th>
			</tr>
			</tr>
			</thead>
			<tbody>
			<?php
			if(!empty($num_rows)){
				$slno	=	($Page-1)*$Per_Page + 1;
			$c=0;$cc=1;
			while($fetch = mysql_fetch_array($results_dsr)) {
			if($c % 2 == 0){ $cls =""; } else{ $cls =" class='odd'"; }
			$id			=	$fetch['id'];
			$bu_sta		=	$fetch['building_status'];
			?>
			<tr>
				<td><?php echo $fgmembersite->upperstate($fetch['building_name']); ?></td>
				<td><?php echo $fetch['building_code']; ?></td>
				<td><?php echo $fgmembersite->getdbval($fetch['building_type'],'name','id','building_type');?></td>
				<td><?php if($bu_sta == 1) { echo "Owned"; } elseif ($bu_sta == 2) { echo "Rented"; } ?></td>
				<?php 
					$fgmembersite->DBLogin();
					$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
					or die("Opps some thing went wrong");
					mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");	
				?>
				<td><?php echo $fgmembersite->getdbval($fetch['incharge_empcode'],'first_name','emp_code','pim_emp_info'); ?></td>
				<td><?php $fgmembersite->DBLogin(); echo $fgmembersite->upperstate($fgmembersite->getdbval($fetch['building_city'],'name','id','city')); ?></td>
				<td align="right"><?php echo $fgmembersite->upperstate($fetch['building_state']); ?></td>
				<td align="right" nowrap="nowrap">

				<a href="edit_building.php?id=<?php echo $fetch['id'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <a href="view_building.php?id=<?php echo $fetch['id'];?>&del=del" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a> -->
				<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['id']; ?>','<?php echo $fgmembersite->upperstate($fetch['building_name']); ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
				</td>
			</tr>
			<?php $c++; $cc++; $slno++; }		 
			}else{  echo "<tr><td align='center' colspan='13'><b>No records found</b></td></tr>";}  ?>
			</tbody>
			</table>
			 </div>   
			 <div class="paginationfile" align="center">
			 <table>
			 <tr>
			 <th class="pagination" scope="col">          
			<?php 
			if(!empty($num_rows)){
				$fgmembersite->rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'buildviewajax');   //need to uncomment
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