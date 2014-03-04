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

if($_REQUEST['division_name']!='') {
	$var = @$_REQUEST['division_name'] ;
	$trimmed = trim($var);	
	$qry="SELECT re.id AS REID,de.name AS division_name,ci.name AS CI_NAME,bu.building_code AS BU_OFF_CODE,bu.building_name  AS BU_OFF_NAME,res_buil_id,req_code,request_type,emp_request_id,guest_request_id,comp_id,off_loc,off_buil,off_floor,office_val,unit_num,email_id,mobile_no,alt_num FROM `requestor` re LEFT JOIN building bu ON re.off_buil_id = bu.id LEFT JOIN city ci ON re.city_id = ci.id LEFT JOIN department de ON re.division_id = de.id WHERE de.name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT re.id AS REID,de.name AS division_name,ci.name AS CI_NAME,bu.building_code AS BU_OFF_CODE,bu.building_name  AS BU_OFF_NAME,res_buil_id,req_code,request_type,emp_request_id,guest_request_id,comp_id,off_loc,off_buil,off_floor,office_val,unit_num,email_id,mobile_no,alt_num FROM `requestor` re LEFT JOIN building bu ON re.off_buil_id = bu.id LEFT JOIN city ci ON re.city_id = ci.id LEFT JOIN department de ON re.division_id = de.id"; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);			

$params			=	$division_name."&".$sortorder."&".$ordercol;

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
	$orderby	=	"ORDER BY re.id DESC";
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
		window.location = "view_requestor.php?id="+id+"&del=del";
	}
}
function reqviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var division_name	=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_viewrequestor.php",
		type: "get",
		dataType: "text",
		data : { "division_name" : division_name, "sortorder" : sortorder, "ordercol" : ordercol, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function searchreqviewajax(page) {  // For pagination and sorting of the Collection Deposited search in view page
	var division_name	=	$("input[name='division_name']").val();
	//alert(building_name);
	$.ajax({
		url : "ajax_viewrequestor.php",
		type: "get",
		dataType: "text",
		data : { "division_name" : division_name, "page" : page },
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
<div><h2 align="center">REQUESTOR</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add Requestor" class="buttonsbig" onclick="window.location='requestor.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=1'"></span>

<div class="clearfix"></div>
 <div id="search">
        <input type="text" name="division_name" value="<?php echo $_REQUEST['division_name']; ?>" autocomplete='off' style="width:120px;" placeholder='Search By Division Name'/>
        <input type="button" class="buttonsg" onclick="searchreqviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
 <div class="clearfix"></div>
        <?php
		if($_GET['id']!='' && $_GET['del'] == 'del'){
			$query = "DELETE FROM `requestor` WHERE id = $id";
			//Run the query
			$result = mysql_query($query) or die(mysql_error());
			header("location:view_requestor.php?success=del");
		 }		
		?>
		<div id="colviewajaxid">
			<div class="con">
			<table width="100%">
			<thead>
			<tr>
				<th >Request Code</th>
				<th >Request Type</th>
				<th >Employee/Guest Name</th>
				<th nowrap="nowrap">Company</th>
				<th nowrap="nowrap">Division</th>
				<th nowrap="nowrap">City</th>
				<!-- <th nowrap="nowrap">Office Location</th>-->
				<th >Office Building</th>
				<!-- <th nowrap="nowrap">Office Floor</th>-->
				<!-- <th nowrap="nowrap">Office</th>--> 
				<th >Residence Building</th>
				<th >Unit Number</th>
				<?php //echo $sortorderby;
				if($sortorder == 'ASC') {
					$sortorderby = 'DESC';
				} elseif($sortorder == 'DESC') {
					$sortorderby = 'ASC';
				} else {
					$sortorderby = 'ASC';
				}
				$paramsval	=	$division_name."&".$sortorderby."&email_id"; ?>
				<th nowrap="nowrap" class="rounded" onClick="reqviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Email ID<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap">Mobile No.</th>
				<th nowrap="nowrap">Alternate No.</th>
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
			$id			=	$fetch['REID'];
			?>
			<tr>
				<td ><?php echo $fetch['req_code']; ?></td>
				<td><?php if($fetch['request_type'] == 1) { echo "Employee"; } elseif($fetch['request_type'] == 2) { echo "Guest"; }  ?></td>
				<td><?php if($fetch['request_type'] == 1) { 
					$fgmembersite->DBLogin();
					$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
					or die("Opps some thing went wrong");
					mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
					$result_emp_id=mysql_query("select first_name from pim_emp_info WHERE emp_code = '$fetch[emp_request_id]' ",$bd) or die(mysql_error());
					$row=mysql_fetch_array($result_emp_id);
					echo $requestor_name	=	$row['first_name'];
				} elseif($fetch['request_type'] == 2) {						
					$fgmembersite->DBLogin();
					$result_guest_id=mysql_query("select name from guest WHERE id = ' $fetch[guest_request_id]' ") or die(mysql_error());
					$row_guest=mysql_fetch_array($result_guest_id);
					echo $requestor_name	=	$row_guest['name'];
				}
				?></td>
				<td><?php $fgmembersite->DBLogin();
					$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
					or die("Opps some thing went wrong");
					mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
					$result_comp_id=mysql_query("select * from master_companies WHERE comp_id = '$fetch[comp_id]'",$bd);
					$row_comp=mysql_fetch_array($result_comp_id); {
						echo $fgmembersite->upperstate($row_comp[comp_name]);
					}
				?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['division_name']); ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['CI_NAME']); ?></td>
				<!-- <td><?php echo $fetch['off_loc']; ?></td>
				<td><?php echo $fetch['off_buil']; ?></td>-->
				<td><?php echo $fgmembersite->upperstate($fetch['BU_OFF_NAME']); ?></td>
				<!-- <td><?php echo $fetch['off_floor']; ?></td>
				<td><?php echo $fetch['office_val']; ?></td>-->
				<td><?php $fgmembersite->DBLogin();
					$result_res_id=mysql_query("select building_name from building WHERE id = '$fetch[res_buil_id]'");
					$row_res=mysql_fetch_array($result_res_id); {
						echo $fgmembersite->upperstate($row_res[building_name]);
					}
				?></td>
				
				<td ><?php echo $fetch['unit_num']; ?></td>
				<td ><?php echo $fetch['email_id']; ?></td>
				<td ><?php echo $fetch['mobile_no']; ?></td>
				<td ><?php echo $fetch['alt_num']; ?></td>
				<td nowrap="nowrap">
				<a href="edit_requestor.php?id=<?php echo $fetch['REID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['REID']; ?>','<?php echo $requestor_name; ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
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
			?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></spa
			n><span class="ui-button-text">Close</span></button></a></div>
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