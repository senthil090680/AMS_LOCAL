<?php
require_once("./include/membersite_config.php");

$fgmembersite->DBLogin(); 
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
extract($_REQUEST);
if($_REQUEST['job_name']!='') {
	$var = @$_REQUEST['job_name'] ;
	$trimmed = trim($var);
	$qry="SELECT rjc.id AS RJCID,re.req_number AS REQ_NUM, jobs.job_desc AS jobdesc,request_number,CONCAT(UCASE(LEFT(ce.name, 1)),LCASE(SUBSTRING(ce.name, 2))) AS CENAME,rjc.est_cost EST_COST,rjc.actual_cost AS ACT_COST FROM `requestjobcost` rjc, jobs, costtypeelement cte, costelement ce, request re WHERE rjc.job_id = jobs.id AND rjc.request_number = re.id AND rjc.cost_element = cte.cost_elementid AND cte.cost_elementid = ce.id AND jobs.job_desc LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT rjc.id AS RJCID,re.req_number AS REQ_NUM, jobs.job_desc AS jobdesc,request_number,CONCAT(UCASE(LEFT(ce.name, 1)),LCASE(SUBSTRING(ce.name, 2))) AS CENAME,rjc.est_cost EST_COST,rjc.actual_cost AS ACT_COST FROM `requestjobcost` rjc, jobs, costtypeelement cte, costelement ce, request re WHERE rjc.job_id = jobs.id AND rjc.request_number = re.id AND rjc.cost_element = cte.cost_elementid AND cte.cost_elementid = ce.id";
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);

$params			=	$job_name."&".$sortorder."&".$ordercol;

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
	$orderby	=	"ORDER BY rjc.id DESC";
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
	<th>Request Number</th>
	<th>Job Name</th>
	<?php //echo $sortorderby;
	if($sortorder == 'ASC') {
		$sortorderby = 'DESC';
	} elseif($sortorder == 'DESC') {
		$sortorderby = 'ASC';
	} else {
		$sortorderby = 'ASC';
	}
	$paramsval	=	$job_name."&".$sortorderby."&ce.name"; ?>
	<th nowrap="nowrap" class="rounded" onClick="reqviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Element Name<img src="images/sort.png" width="13" height="13" /></th>				
	<th>Estimated Cost</th>
	<th>Actual Cost</th>
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
$id			=	$fetch['RJCID'];
?>
<tr>
	<td><?php echo $fetch['REQ_NUM']; ?></td>
	<td><?php echo $fetch['jobdesc']; ?></td>
	<td><?php echo $fetch['CENAME']; ?></td>
	<td><?php echo $fetch['EST_COST']; ?></td>
	<td><?php echo $fetch['ACT_COST']; ?></td>
	<td nowrap="nowrap">
	<a href="edit_requestjobcost.php?id=<?php echo $fetch['RJCID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['RJCID']; ?>','<?php echo $fetch['REQ_NUM']; ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
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