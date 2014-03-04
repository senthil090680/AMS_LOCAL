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
	$qry="SELECT rej.id AS REJID,re.req_number AS REQ_NUM, jobs.job_desc AS jobdesc,request_number,ar.lead_name AS admin_lead_name, job_assigned_name,start_date,rej.expected_date AS EXP_DATE,rej.completion_date AS COM_DATE,rej.est_cost EST_COST,rej.actual_cost AS ACT_COST,no_revision FROM `requestjobs` rej LEFT JOIN jobs ON rej.job_id = jobs.id LEFT JOIN admin_responsibility AS ar ON rej.admin_res_name = ar.id LEFT JOIN request re ON rej.request_number = re.id WHERE jobs.job_desc LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT rej.id AS REJID,re.req_number AS REQ_NUM, jobs.job_desc AS jobdesc,request_number,ar.lead_name AS admin_lead_name, job_assigned_name,start_date,rej.expected_date AS EXP_DATE,rej.completion_date AS COM_DATE,rej.est_cost EST_COST,rej.actual_cost AS ACT_COST,no_revision FROM `requestjobs` rej LEFT JOIN jobs ON rej.job_id = jobs.id LEFT JOIN admin_responsibility AS ar ON rej.admin_res_name = ar.id LEFT JOIN request re ON rej.request_number = re.id";
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
	$orderby	=	"ORDER BY rej.id DESC";
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
	$paramsval	=	$job_name."&".$sortorderby."&admin_lead_name"; ?>
	<th nowrap="nowrap" class="rounded" onClick="reqviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Admin Responsibility<img src="images/sort.png" width="13" height="13" /></th>				
	<th>Job Assigned To</th>
	<th>Start Date</th>
	<th>Expected Date</th>
	<th>Completion Date</th>
	<th>No. of Revisions</th>
	<th >Estimated Cost</th>
	<th >Actual Cost</th>
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
	<td><?php echo $fetch['REQ_NUM']; ?></td>
	<td><?php echo $fetch['jobdesc']; ?></td>
	<td><?php echo $fetch['admin_lead_name']; ?></td>
	<td><?php  
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select first_name from pim_emp_info WHERE emp_code = '$fetch[job_assigned_name]' ",$bd) or die(mysql_error());
		$row=mysql_fetch_array($result_emp_id);
		echo $job_assigned_to	=	$fgmembersite->upperstate($row['first_name']);				
	?></td>
	<td><?php echo $fetch['start_date']; ?></td>
	<td><?php echo $fetch['EXP_DATE']; ?></td>
	<td><?php echo $fetch['COM_DATE']; ?></td>
	<td><?php echo $fetch['no_revision']; ?></td>
	<td><?php echo $fetch['EST_COST']; ?></td>
	<td><?php echo $fetch['ACT_COST']; ?></td>
	<td nowrap="nowrap">
	<a href="edit_requestjobs.php?id=<?php echo $fetch['REJID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['REJID']; ?>','<?php echo $fetch['REQ_NUM']; ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
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