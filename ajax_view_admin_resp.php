<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);
if($_REQUEST['lead_name']!='') {
	$var = @$_REQUEST['lead_name'] ;
	$trimmed = trim($var);
	$qry="SELECT ar.id AS ARID,de.name AS division_name,ci.name AS CI_NAME,bu.building_code AS BU_OFF_CODE,bu.building_name  AS BU_OFF_NAME,respon.name AS RES_NAME, lead_code,lead_name,company_id,office_location,office_buil,office_floor,office,email_id,mobile_number,alt_number,alt_lead_code,alt_lead_name,picture FROM `admin_responsibility` ar LEFT JOIN building bu ON ar.office_building_id = bu.id LEFT JOIN city ci ON ar.city_id = ci.id LEFT JOIN department de ON ar.division_id = de.id LEFT JOIN responsibility respon ON ar.responsibility_id = respon.id WHERE lead_name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT ar.id AS ARID,de.name AS division_name,ci.name AS CI_NAME,bu.building_code AS BU_OFF_CODE,bu.building_name  AS BU_OFF_NAME,respon.name AS RES_NAME, lead_code,lead_name,company_id,office_location,office_buil,office_floor,office,email_id,mobile_number,alt_number,alt_lead_code,alt_lead_name,picture FROM `admin_responsibility` ar LEFT JOIN building bu ON ar.office_building_id = bu.id LEFT JOIN city ci ON ar.city_id = ci.id LEFT JOIN department de ON ar.division_id = de.id LEFT JOIN responsibility respon ON ar.responsibility_id = respon.id";
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);

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
else if(($num_rows % $Per_Page)==0) {
	$Num_Pages 	=	($num_rows/$Per_Page);
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
//exit;
$results_dsr = mysql_query($qry) or die(mysql_error());
/********************************pagination***********************************/

?>
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
	<th >Email-ID</th>
	<th >Mobile No.</th>
	<th >Alt. No.</th>
	<th >Alt. Leader Name</th>
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
$id			=	$fetch['REJID'];
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