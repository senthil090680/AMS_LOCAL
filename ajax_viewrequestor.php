<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);
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
//exit;
$results_dsr = mysql_query($qry) or die(mysql_error());
/********************************pagination***********************************/

?>
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
	<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['REID']; ?>','<?php echo $fgmembersite->upperstate($requestor_name); ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
	</td>
</tr><?php $c++; $cc++; $slno++; }		 
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
<!-- <span id="printopen" style="padding-left:370px;padding-top:10px;<?php if($num_rows > 0 ) { echo "display:block;"; } else { echo "display:none;"; } ?>" ><input type="button" name="kdproduct" value="Print" class="buttons" onclick="print_pages('printbuildviewajax');"></span> -->
<form id="printbuildviewajax" target="_blank" action="printbuildviewajax.php" method="post">
	<input type="hidden" name="building_name" id="building_name" value="<?php echo $building_name; ?>" />
	<input type="hidden" name="sortorder" id="sortorder" value="<?php echo $sortorder; ?>" />
	<input type="hidden" name="ordercol" id="ordercol" value="<?php echo $ordercol; ?>" />
	<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST[page]; ?>" />
</form>
<?php exit(0); ?>