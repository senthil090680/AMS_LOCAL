<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);
if($_REQUEST['building_name']!='') {
	$var = @$_REQUEST['building_name'] ;
	$trimmed = trim($var);	
	$qry="SELECT id,building_name,building_code,building_type,building_status,incharge_empcode,building_city,building_state FROM `building` WHERE building_name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT id,building_name,building_code,building_type,building_status,incharge_empcode,building_city,building_state FROM `building`"; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);

$params			=	$building_name."&".$sortorder."&".$ordercol;

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
<!-- <span id="printopen" style="padding-left:370px;padding-top:10px;<?php if($num_rows > 0 ) { echo "display:block;"; } else { echo "display:none;"; } ?>" ><input type="button" name="kdproduct" value="Print" class="buttons" onclick="print_pages('printbuildviewajax');"></span> -->
<form id="printbuildviewajax" target="_blank" action="printbuildviewajax.php" method="post">
	<input type="hidden" name="building_name" id="building_name" value="<?php echo $building_name; ?>" />
	<input type="hidden" name="sortorder" id="sortorder" value="<?php echo $sortorder; ?>" />
	<input type="hidden" name="ordercol" id="ordercol" value="<?php echo $ordercol; ?>" />
	<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST[page]; ?>" />
</form>
<?php exit(0); ?>