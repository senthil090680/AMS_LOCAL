<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);
if($_REQUEST['trip_desc']!='') {
	$var = @$_REQUEST['trip_desc'] ;
	$trimmed = trim($var);
	$qry="SELECT vl.id AS VLID,veh.vehicle_regno AS VEH_NUM, dr.emp_name AS DR_NAME,dr.driver_code AS DR_CODE,um.name AS UOM_NAME,va.assignment_no AS ASS_NO,trip_no, trip_desc, starting_date, starting_time,ending_date,ending_time,starting_reading,ending_reading,total_distance,UOM_log,desc_log FROM `vehicle_log` vl LEFT JOIN driver dr ON vl.driver_code = dr.id LEFT JOIN vehicle veh ON veh.id = vl.vehicle_reg_no LEFT JOIN vehicle_assignment va ON vl.assignment_number = va.id LEFT JOIN uom um ON vl.UOM_log = um.id WHERE vl.trip_desc LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT vl.id AS VLID,veh.vehicle_regno AS VEH_NUM, dr.emp_name AS DR_NAME,dr.driver_code AS DR_CODE,um.name AS UOM_NAME,va.assignment_no AS ASS_NO,trip_no, trip_desc, starting_date, starting_time,ending_date,ending_time,starting_reading,ending_reading,total_distance,UOM_log,desc_log FROM `vehicle_log` vl LEFT JOIN driver dr ON vl.driver_code = dr.id LEFT JOIN vehicle veh ON veh.id = vl.vehicle_reg_no LEFT JOIN vehicle_assignment va ON vl.assignment_number = va.id LEFT JOIN uom um ON vl.UOM_log = um.id"; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);

$params			=	$trip_desc."&".$sortorder."&".$ordercol;

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
if($num_rows<=$Per_Page) {
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
	$orderby	=	"ORDER BY vl.id DESC";
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
	<?php //echo $sortorderby;
	if($sortorder == 'ASC') {
		$sortorderby = 'DESC';
	} elseif($sortorder == 'DESC') {
		$sortorderby = 'ASC';
	} else {
		$sortorderby = 'ASC';
	}
	$paramsval	=	$trip_desc."&".$sortorderby."&veh.vehicle_regno"; ?>
	<th class="rounded" onClick="vehlogviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Vehicle Regn. No. <img src="images/sort.png" width="13" height="13" /></th>
	<th >Assignment No.</th>								
	<th >Driver Code</th>
	<th >Driver Name</th>
	<th >Trip No.</th>
	<th >Trip Desc.</th>
	<th >Start Date & Time</th>
	<th >End Date & Time</th>
	<th >Start Reading</th>
	<th >End Reading</th>
	<th >Total Distance</th>
	<th >UOM</th>
	<th >Travel Desc.</th>
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
$id			=	$fetch['VLID'];
?>
<tr>
	<td><?php echo $fetch['VEH_NUM']; ?></td>
	<td><?php echo $fetch['ASS_NO']; ?></td>
	<td><?php echo $fetch['DR_CODE'];?></td>
	<td><?php echo $fetch['DR_NAME']; ?></td>
	<td><?php echo $fetch['trip_no']; ?></td>
	<td><?php echo ucfirst($fetch['trip_desc']); ?></td>
	<td align="right"><?php echo $fetch['starting_date']." ".$fetch['starting_time']; ?></td>
	<td align="right"><?php echo $fetch['ending_date']." ".$fetch['ending_time']; ?></td>
	<td align="right"><?php echo $fetch['starting_reading']; ?></td>
	<td align="right"><?php echo $fetch['ending_reading']; ?></td>
	<td align="right"><?php echo $fetch['total_distance']; ?></td>				
	<td align="right"><?php echo ucfirst($fetch['UOM_NAME']); ?></td>
	<td align="right"><?php echo ucfirst($fetch['desc_log'])."."; ?></td>		
	<td align="right" nowrap="nowrap">

	<a href="edit_vehicle_log.php?id=<?php echo $fetch['VLID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['VLID']; ?>','<?php echo $fetch['VEH_NUM']; ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
	</td>
</tr><?php $c++; $cc++; $slno++; }
}else{  echo "<tr><td align='center' colspan='14'><b>No records found</b></td></tr>";}  ?>
</tbody>
</table>
 </div>   
 <div class="paginationfile" align="center">
 <table>
 <tr>
 <th class="pagination" scope="col">          
<?php 
if(!empty($num_rows)){
	$fgmembersite->rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'vehlogviewajax');   //need to uncomment
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