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

if($_REQUEST['cost_element']!='') {
	$var = @$_REQUEST['cost_element'];
	$trimmed = trim($var);	
	$qry="SELECT cte.id AS CTEID,ce.name CENAME,ct.name CTNAME, ua.name AS UNAME FROM `costtypeelement` cte, costelement ce, costtype ct, uom_ams ua WHERE cte.cost_elementid = ce.id AND cte.cost_uom = ua.id AND cte.cost_typeid = ct.id AND ce.name LIKE '%".$trimmed."%'";
} else { 
	$qry="SELECT cte.id AS CTEID,ce.name CENAME,ct.name CTNAME, ua.name AS UNAME FROM `costtypeelement` cte, costelement ce, costtype ct, uom_ams ua WHERE cte.cost_elementid = ce.id AND cte.cost_uom = ua.id AND cte.cost_typeid = ct.id";
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);

$params			=	$cost_element."&".$sortorder."&".$ordercol;

/********************************pagination start***********************************/
$strPage = $_REQUEST[page];
//$params = $_REQUEST[params];

//if($_REQUEST[mode]=="Listing"){
//$Num_Rows = mysql_num_rows ($res_search);

########### pagins

$Per_Page = 1;   // Records Per Page

$Page = $strPage;
if(!$strPage)	{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($num_rows<=$Per_Page) {
	$Num_Pages =1;
}
else if(($num_rows % $Per_Page)==0) {
	$Num_Pages =($num_rows/$Per_Page) ;
} else {
	$Num_Pages =($num_rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
if($sortorder == "") {
	$orderby	=	"ORDER BY cte.id DESC";
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
.buttonsbigja{
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #686868;
	background-color:#c1c1c1;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#000;
	font-family:Calibri;
	font-size:12px;
	padding:3px;
	cursor:pointer;
	width: 177px;
	height:25px;
}
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
		window.location = "view_ctelement.php?id="+id+"&del=del";
	}
}
function reqviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var cost_element	=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_viewctelement.php",
		type: "get",
		dataType: "text",
		data : { "cost_element" : cost_element, "sortorder" : sortorder, "ordercol" : ordercol, "page" : page },
		success : function(dataval) {
			var trimval		=	$.trim(dataval);
			//alert(trimval);
			$("#colviewajaxid").html(trimval);
		}
	});
}
function searchreqviewajax(page) {  // For pagination and sorting of the Collection Deposited search in view page
	var cost_element	=	$("input[name='cost_element']").val();
	//alert(building_name);
	$.ajax({
		url : "ajax_viewctelement.php",
		type: "get",
		dataType: "text",
		data : { "cost_element" : cost_element, "page" : page },
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
<div><h2 align="center">COST ELEMENT</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add Cost Element" class="buttonsbigja" onclick="window.location='ctelement.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=1'"></span>

<div class="clearfix"></div>
 <div id="search">
        <input type="text" name="cost_element" value="<?php echo $_REQUEST['cost_element']; ?>" autocomplete='off' style="width:120px;" placeholder='Search By Cost Element'/>
        <input type="button" class="buttonsg" onclick="searchreqviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
 <div class="clearfix"></div>
        <?php
		if($_GET['id']!='' && $_GET['del'] == 'del'){
			$query = "DELETE FROM `costtypeelement` WHERE id = $id";
			//Run the query
			$result = mysql_query($query) or die(mysql_error());
			header("location:view_ctelement.php?success=del");
		 }		
		?>
		<div id="colviewajaxid">
			<div class="con">
			<table width="100%">
			<thead>
			<tr>
				<th>Cost Element</th>
				<?php //echo $sortorderby;
				if($sortorder == 'ASC') {
					$sortorderby = 'DESC';
				} elseif($sortorder == 'DESC') {
					$sortorderby = 'ASC';
				} else {
					$sortorderby = 'ASC';
				}
				$paramsval	=	$cost_element."&".$sortorderby."&ct.name"; ?>
				<th nowrap="nowrap" class="rounded" onClick="reqviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Cost Type<img src="images/sort.png" width="13" height="13" /></th>
				<th>UOM</th>				
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
				$id			=	$fetch['CTEID'];
			?>
			<tr>				
				<td><?php echo $fgmembersite->upperstate($fetch['CENAME']); ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['CTNAME']); ?></td>
				<td><?php echo $fgmembersite->upperstate($fetch['UNAME']); ?></td>
				<td nowrap="nowrap">
				<a href="edit_ctelement.php?id=<?php echo $fetch['CTEID'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="delcall('<?php echo $fetch['CTEID']; ?>','<?php echo $fgmembersite->upperstate($fetch['CENAME']); ?>')" ><img src="images/trash.png" alt="" title="" width="11" height="11" /></a>
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
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>