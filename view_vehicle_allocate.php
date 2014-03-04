<?PHP
require_once("./include/membersite_config.php");
require_once ("./include/ajax_pagination.php");
$fgmembersite->DBLogin();
EXTRACT($_REQUEST);
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if ($fgmembersite->usertype() == 1) {
	$header_file='./layout/admin_header_fms.php';
}
if(file_exists($header_file)) {
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
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

.buttonsbig1 {
    background-color: #C1C1C1;
    border: 1px solid #686868;
    border-radius: 5px;
    box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.2);
    color: #000000;
    cursor: pointer;
    font-family: Calibri;
    font-size: 12px;
    height: 25px;
    padding: 3px;
    width: 160px;
}
</style>
<script>
function colviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var searchname	=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_vehicle_allocation_type.php",
		type: "get",
		dataType: "text",
		data : { "searchname" : searchname, "sortorder" : sortorder, "ordercol" : ordercol, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function searchcolviewajax(page){  // For pagination and sorting of the Collection Deposited search in view page
	var searchname	=	$("input[name='searchname']").val();
	//alert(Product_name);
	$.ajax({
		url : "ajax_vehicle_allocation_type.php",
		type: "get",
		dataType: "text",
		data : { "searchname" : searchname, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function show_confirm(name) {
	var r=confirm("Are You Sure You Want to Delete : "+name);
	if(r==true) {
		return true;
	} else {
		return false;
	}
}
</script>
<?php
if(isset($_GET['delete_id']) && intval($_GET['delete_id'])) {
	if ($_GET['delete'] ==1) {
		$id=$_GET['delete_id'];
		$query = "SELECT * FROM vehicle_allocation_type where id=$id"; 
		$result = mysql_query($query);
		if($result === FALSE) {
			die(mysql_error()); // TODO: better error handling
		}
	if(!mysql_query("delete FROM vehicle_allocation_type where id=$id")) {
		die('Error: ' . mysql_error());
	}
	$fgmembersite->RedirectToURL("view_vehicle_allocate.php?success=delete");
	// 
	//echo "hi";
	}
}
if($_REQUEST['searchname']!='') {
	$var = @$_REQUEST['searchname'] ;
	$trimmed = trim($var);	
	$qry="SELECT a.name as allocate_name,b.name as dep_name,c.emp_name,c.id,c.emp_code  FROM allocation_type a,department b ,vehicle_allocation_type c  where c.allocation_type_id=a.id and c.department_id=b.id and emp_name like '%".$trimmed."%'";
} else { 
	$qry="SELECT a.name as allocate_name,b.name as dep_name,c.emp_name,c.id,c.emp_code  FROM allocation_type a,department b ,vehicle_allocation_type c  where c.allocation_type_id=a.id and c.department_id=b.id"; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);			
$params			=	$searchname."&".$sortorder."&".$ordercol;

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
else {
	$Num_Pages =($num_rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
if($sortorder == "") {
	$orderby	=	"ORDER BY id DESC";
} else {
	$orderby	=	"ORDER BY $ordercol $sortorder";
}
$qry.=" $orderby LIMIT $Page_Start , $Per_Page";  //need to uncomment
//exit;
$results_dsr = mysql_query($qry) or die(mysql_error());
/********************************pagination***********************************/
?>

<!------------------------------- Form -------------------------------------------------->

<div id="mainareadaily">
<div class="mcf"></div>
<div><h2 align="center">VEHICLE ALLOCATION</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add Vehicle Allocation" class="buttonsbig1" onclick="window.location='vehicle_allocation_type.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=3'"></span>

<div class="clearfix"></div>

<div id="search">
        <input type="text" name="searchname" id="searchname" value="<?php echo $_REQUEST['searchname']; ?>" autocomplete='off' placeholder='Search By Employee Name'/>
        <input type="button" class="buttonsg" onclick="searchcolviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
  <div class="clearfix"></div>
<div class="mcf"></div>
       <div id="colviewajaxid">
			<div class="con2">
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
				$paramsval	=	$searchname."&".$sortorderby."&allocate_name"; ?>
				<th nowrap="nowrap" class="rounded" onClick="colviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Allocation Type<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap" >Department</th>
				<th nowrap="nowrap" >Employee Code</th>
				<th nowrap="nowrap" >Employee Name</th>
				<th nowrap="nowrap" >Edit</th>
				<th nowrap="nowrap" >Delete</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if(!empty($num_rows)){
				$slno	=	($Page-1)*$Per_Page + 1;
			$c=0;$cc=1;
			while($fetch = mysql_fetch_array($results_dsr)) {
			if($c % 2 == 0){ $cls =""; } else{ $cls =" class='odd'"; }
			$id= $fetch['id'];
			?>
			<tr>				
				<td><?php echo $fetch['allocate_name'];?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['dep_name']); ?></td>
				<td><?php echo $fetch['emp_code'];?></td>
				<td><?php echo $fetch['emp_name'];?></td>
				<td >
				<a href="edit_vehicle_allocate.php?id=<?php echo $fetch['id'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>
				</td>
				<td>
				<a href="view_vehicle_allocate.php?delete_id=<?php echo $fetch['id'];?>&delete=1"><img src="images/trash.png" alt="" title="" width="11" height="11" onclick="return show_confirm('<?php echo $fgmembersite->upperstate($fetch['allocate_name']); ?>');"/></a>
				</td>
			</tr>
			<?php $c++; $cc++; $slno++; }		 
			}else{  echo "<tr><td align='center' colspan='6'><b>No records found</b></td></tr>";}  ?>
			</tbody>
			</table>
			 </div>   
			 <div class="paginationfile" align="center">
			 <table>
			 <tr>
			 <th class="pagination" scope="col">          
			<?php 
			if(!empty($num_rows)){
				rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'colviewajax');   //need to uncomment
			} else { 
				echo "&nbsp;"; 
			} ?>      
			</th>
			</tr>
			</table>
		  </div>
<?php if($_GET['success']=="delete") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "Data Deleted Successfully"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php } ?>
<?php if($_GET['success']=="create") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Data Entered Successfully"; ?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }?>
<?php if($_GET['success']=="update") 
{
?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0002 : Data Updated Successfully "; 
?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }?>
</div>
</div>
</div>
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>
