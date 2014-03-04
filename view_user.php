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
	$header_file='./layout/admin_header_ams.php';
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

</script>
<script>
function colviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var searchname	=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_viewuser.php",
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
		url : "ajax_viewuser.php",
		type: "get",
		dataType: "text",
		data : { "searchname" : searchname, "page" : page
		},
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
function show_confirm1(name) {
	var r=confirm("Are You Sure You Want to Deactivate : "+name);
	if(r==true) {
		return true;
	} else {
		return false;
	}
}
function show_confirm2(name) {
	var r=confirm("Are You Sure You Want to Activate : "+name);
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
		$query = "SELECT * FROM users where user_id=$id"; 
		$result = mysql_query($query);
		if($result === FALSE) {
			die(mysql_error()); // TODO: better error handling
		}
	if(!mysql_query("delete FROM users where user_id=$id")) {
		die('Error: ' . mysql_error());
	}
	$fgmembersite->RedirectToURL("view_user.php?success=delete");
	// 
	//echo "hi";
	}
}

if(isset($_GET['active_id']) && intval($_GET['active_id'])) {
	if ($_GET['active'] ==1) {
	
		$id=$_GET['active_id'];
		if ($_GET['act'] ==2)
		{
			if(!mysql_query("update users set confirmcode='n' where user_id=$id")) {
				die('Error: ' . mysql_error());
			}
			$fgmembersite->RedirectToURL("view_user.php?success=deactivate");
		}
		if ($_GET['act'] ==1)
		{
			if(!mysql_query("update users set confirmcode='y' where user_id=$id")) {
				die('Error: ' . mysql_error());
			}
			$fgmembersite->RedirectToURL("view_user.php?success=activate");
		}
	
	// 
	//echo "hi";
	}
}

if($_REQUEST['searchname']!='') {
	$var = @$_REQUEST['searchname'] ;
	$trimmed = trim($var);	
	$qry="SELECT * FROM users where username like '%".$trimmed."%'";
} else { 
	$qry="SELECT * FROM users"; 
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
	$orderby	=	"ORDER BY user_id DESC";
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
<div><h2 align="center">User</h2></div> 

<div id="containerprforcd">

<span style="float:left;"><input type="button" name="kdproduct" value="Add User" class="buttonsbig1" onclick="window.location='register.php'"></span><span style="float:right;"><input type="button" name="kdproduct" value="Close" class="buttons" onclick="window.location='ams_temp.php?id=1'"></span>

<div class="clearfix"></div>

<div id="search">
        <input type="text" name="searchname" id="searchname" value="<?php echo $_REQUEST['searchname']; ?>" autocomplete='off' placeholder='Search By User Name'/>
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
				$paramsval	=	$searchname."&".$sortorderby."&username"; ?>
				<th nowrap="nowrap" class="rounded" onClick="colviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">User Name<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap" >Email</th>
				<th nowrap="nowrap" >Activate/Deactivate</th>
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
			$id= $fetch['user_id'];
			?>
			<tr>				
				<td><?php echo $fgmembersite->upperstate($fetch['username']);?></td>
				<td><?php echo  $fetch['email']; ?></td>
				<td>
				<?php if($fetch['confirmcode']=="y"){?>
				<a href="view_user.php?active_id=<?php echo $fetch['user_id'];?>&active=1&act=2"><img src="images/activate.png" alt="" title="" width="15" height="15" onclick="return show_confirm1('<?php echo $fetch['username']; ?>');"/></a>
				<?php 
					}
				else
				{
				?>
				<a href="view_user.php?active_id=<?php echo $fetch['user_id'];?>&active=1&act=1"><img src="images/delete.png" alt="" title="" width="15" height="15" onclick="return show_confirm2('<?php echo $fetch['username']; ?>');"/></a>
				<?php
				}
				?>
				</td>
				<td>
				<a href="view_user.php?delete_id=<?php echo $fetch['user_id'];?>&delete=1"><img src="images/trash.png" alt="" title="" width="11" height="11" onclick="return show_confirm('<?php echo $fetch['username']; ?>');"/></a>
				</td>
			</tr>
			<?php $c++; $cc++; $slno++; }		 
			}else{  echo "<tr><td align='center' colspan='4'><b>No records found</b></td></tr>";}  ?>
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
<?php if($_GET['success']=="deactivate") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "User Deactivated Successfully"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php } ?>
<?php if($_GET['success']=="activate") { ?>
	<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "User Activated Successfully"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php } ?>
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
