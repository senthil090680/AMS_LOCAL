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
	$header_file='./layout/admin_header_ams.php';
}
if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}

if($_REQUEST['lead_name']!='') {
	$var = @$_REQUEST['lead_name'] ;
	$trimmed = trim($var);	
	$qry="SELECT ar.id AS ARID,de.name AS division_name,ci.name AS CI_NAME,bu.building_code AS BU_OFF_CODE,bu.building_name  AS BU_OFF_NAME,respon.name AS RES_NAME, lead_code,lead_name,company_id,office_location,office_buil,office_floor,office,email_id,mobile_number,alt_number,alt_lead_code,alt_lead_name,picture FROM `admin_responsibility` ar LEFT JOIN building bu ON ar.office_building_id = bu.id LEFT JOIN city ci ON ar.city_id = ci.id LEFT JOIN department de ON ar.division_id = de.id LEFT JOIN responsibility respon ON ar.responsibility_id = respon.id WHERE lead_name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT ar.id AS ARID,de.name AS division_name,ci.name AS CI_NAME,bu.building_code AS BU_OFF_CODE,bu.building_name  AS BU_OFF_NAME,respon.name AS RES_NAME, lead_code,lead_name,company_id,office_location,office_buil,office_floor,office,email_id,mobile_number,alt_number,alt_lead_code,alt_lead_name,picture FROM `admin_responsibility` ar LEFT JOIN building bu ON ar.office_building_id = bu.id LEFT JOIN city ci ON ar.city_id = ci.id LEFT JOIN department de ON ar.division_id = de.id LEFT JOIN responsibility respon ON ar.responsibility_id = respon.id "; 
}
$results	=	mysql_query($qry);
$num_rows	=	mysql_num_rows($results);			

$params			=	$lead_name."&".$sortorder."&".$ordercol;

/********************************pagination start***********************************/
$strPage = $_REQUEST[page];
//$params = $_REQUEST[params];

//if($_REQUEST[mode]=="Listing"){
//$Num_Rows = mysql_num_rows ($res_search);

########### pagins

$Per_Page = 1;   // Records Per Page

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
	$orderby	=	"ORDER BY ar.id DESC";
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
		window.location = "view_admin_resp.php?id="+id+"&del=del";
	}
}
function reqviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var lead_name		=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];

	var ajaxData		=	{ "lead_name" : lead_name, "sortorder" : sortorder, "ordercol" : ordercol, "page" : page };
	
	ajaxData.fromdatevalue	= 	"2013-08-12"; 	//it was sent as dummy value for testing
	ajaxData.todatevalue 	=	"2014-01-24";	//it was sent as dummy value for testing
	ajaxData.freq 			=	4;				//it was sent as dummy value for testing
	
	console.log(ajaxData);
	
	$.ajax({
		url : "ajax_view_admin_resp.php",
		type: "get",
		dataType: "text",
		data : ajaxData,
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function searchreqviewajax(page) {  // For pagination and sorting of the Collection Deposited search in view page
	var lead_name	=	$("input[name='lead_name']").val();
	//alert(building_name);
	$.ajax({
		url : "ajax_view_admin_resp.php",
		type: "get",
		dataType: "text",
		data : { "lead_name" : lead_name, "page" : page },
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
<div><h2 align="center">ADMIN RESPONSIBILITIES</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add Admin Responsibilities" class="buttonsbig" onclick="window.location='admin_responsibility.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=1'"></span>

<div class="clearfix"></div>
 <div id="search">
        <input type="text" name="lead_name" value="<?php echo $_REQUEST['lead_name']; ?>" autocomplete='off' style="width:120px;" placeholder='Search By Leader Name'/>
        <input type="button" class="buttonsg" onclick="searchreqviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
 <div class="clearfix"></div>
        <?php
		if($_GET['id']!='' && $_GET['del'] == 'del'){
			$query = "DELETE FROM `admin_responsibility` WHERE id = $id";
			//Run the query
			$result = mysql_query($query) or die(mysql_error());
			header("location:view_admin_resp.php?success=del");
		 }		
		?>
		<div id="colviewajaxid">
			<div class="con">
			<table width="100%">
			<thead>
			<tr>
				<th>Responsibility Center</th>
				<th>Leader Name</th>
				<th>Company</th>
				<th>Division</th>
				<th>City</th>
				<?php //echo $sortorderby;
				if($sortorder == 'ASC') {
					$sortorderby = 'DESC';
				} elseif($sortorder == 'DESC') {
					$sortorderby = 'ASC';
				} else {
					$sortorderby = 'ASC';
				}
				$paramsval	=	$lead_name."&".$sortorderby."&BU_OFF_NAME"; ?>
				<th nowrap="nowrap" class="rounded" onClick="reqviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Office Building<img src="images/sort.png" width="13" height="13" /></th>
				<th>Email-ID</th>
				<th>Mobile No.</th>
				<th>Alt. No.</th>
				<th>Alt. Leader Name</th>
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
			$id			=	$fetch['ARID'];
			?>
			<tr>
				<td><?php echo $fgmembersite->upperstate($fetch['RES_NAME']); ?></td>
				<td><?php echo $fetch['lead_name']; ?></td>
				<td><?php $fgmembersite->DBLogin();
					$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
					or die("Opps some thing went wrong");
					mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
					$result_comp_id=mysql_query("SELECT * FROM master_companies WHERE comp_id = '$fetch[company_id]'",$bd);
					$row_comp=mysql_fetch_array($result_comp_id); {
						echo $fgmembersite->upperstate($row_comp[comp_name]);
					}
				?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['division_name']); ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['CI_NAME']); ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['BU_OFF_NAME']); ?></td>				
				<td><?php echo $fetch['email_id']; ?></td>
				<td><?php echo $fetch['mobile_number']; ?></td>
				<td><?php echo $fetch['alt_number']; ?></td>
				<td><?php echo $fetch['alt_lead_name']; ?></td>
				<td nowrap="nowrap">
				<a href="edit_admin_resp.php?id=<?php echo $fetch['ARID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['ARID']; ?>','<?php echo $fetch[lead_name]; ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
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
				$fgmembersite->rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'reqviewajax');   //need to uncomment
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
if(file_exists($footerfile)) {
	include_once($footerfile);
}
else {
	echo _FILENOTFOUNT.$footerfile;
}
?>