<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);
if($_REQUEST['vehicle_company_name']!='') {
	$var = @$_REQUEST['vehicle_company_name'] ;
	$trimmed = trim($var);	
	$qry="SELECT id,vehicle_regno,vehichle_reg_date,vehicle_comp_id,vehicle_company_name,insurance_number,insurance_company,insurance_date,currency,insurance_amount,insurance_duedate,tax_number,tax_authority,tax_date,tax_currency,tax_amount,tax_renewal_date,fitness_certificate_no,fit_date,next_inspection_date,certification_currency,fitness_certification_cost,pollution_certificate_no,pollution_certificate_date,pollution_inspection_date,pollution_currency,pollution_certificate_cost,make,model,year,model_currency,model_cost,maintain_currency,total_maintain_cost,cost_month,total_fuel_cost,cost_month_fuel,car_reg_attach,insurance_attach,tax_attach,pollution_attach,fitness_attach FROM `vehicle` WHERE vehicle_company_name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT 	id,vehicle_regno,vehichle_reg_date,vehicle_comp_id,vehicle_company_name,insurance_number,insurance_company,insurance_date,currency,insurance_amount,insurance_duedate,tax_number,tax_authority,tax_date,tax_currency,tax_amount,tax_renewal_date,fitness_certificate_no,fit_date,next_inspection_date,certification_currency,fitness_certification_cost,pollution_certificate_no,pollution_certificate_date,pollution_inspection_date,pollution_currency,pollution_certificate_cost,make,model,year,model_currency,model_cost,maintain_currency,total_maintain_cost,cost_month,total_fuel_cost,cost_month_fuel,car_reg_attach,insurance_attach,tax_attach,pollution_attach,fitness_attach FROM `vehicle`";	
}
//echo $qry;
//exit;
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);

$params			=	$vehicle_company_name."&".$sortorder."&".$ordercol;

/********************************pagination start***********************************/
$strPage = $_REQUEST[page];
//$params = $_REQUEST[params];

//if($_REQUEST[mode]=="Listing"){
//$Num_Rows = mysql_num_rows ($res_search);

########### pagins

$Per_Page = 1;   // Records Per Page

$Page = $strPage;
if(!$strPage) {
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
		$paramsval	=	$vehicle_company_name."&".$sortorderby."&vehichle_reg_date";
	?>
	<th nowrap="nowrap" >Vehicle Regn. No.</th>
	<th nowrap="nowrap" class="rounded" onClick="vehviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Vehicle Regn. Date<img src="images/sort.png" width="13" height="13" /></th>	
	<th nowrap="nowrap">Vehicle Company Name</th>
	<th nowrap="nowrap">Make</th>
	<th nowrap="nowrap">Model</th>
	<th nowrap="nowrap">Year</th>
	<th nowrap="nowrap">Currency</th>
	<th nowrap="nowrap">Cost</th>
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
$id			=	$fetch['id'];
?>
<tr>
	<td><?php echo $fetch['vehicle_regno']; ?></td>
	<td><?php echo $fetch['vehichle_reg_date']; ?></td>				
	<td><?php echo $fgmembersite->upperstate($fetch['vehicle_company_name']); ?></td>
	<td><?php echo $fetch['make']; ?></td>
	<td><?php echo $fetch['model']; ?></td>
	<td><?php echo $fetch['year']; ?></td>
	<td><?php echo $fgmembersite->getdbval($fetch['model_currency'],'name','id','currency'); ?></td>
	<td><?php echo $fetch['model_cost']; ?></td>
	<td align="right" nowrap="nowrap">
	<a href="edit_vehicle_sample.php?id=<?php echo $fetch['id'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['id']; ?>','<?php echo $fgmembersite->upperstate($fetch['vehicle_company_name']); ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
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
	$fgmembersite->rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'vehviewajax');   //need to uncomment
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