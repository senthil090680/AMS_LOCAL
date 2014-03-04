<?PHP
require_once("./include/membersite_config.php");
require_once ("./include/ajax_pagination.php");
$fgmembersite->DBLogin();
EXTRACT($_REQUEST);
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
if ($fgmembersite->usertype() == 1)
{
$header_file='./layout/admin_header_bms.php';
}
if(file_exists($header_file))
{
include_once($header_file);
}
else
{
$fgmembersite->RedirectToURL("index.php");
exit;
}
?>
<script>
function myFunction()
{
document.getElementById("state").value="";
document.getElementById("state").focus();
return false;
}
</script>
<script>
function validateForm()
{
var statename=document.getElementById("state").value;
if(statename=="")
{
document.getElementById( 'client_error' ).style.display="block";
	setTimeout(function() {
	document.getElementById( 'client_error' ).style.display="none";
	},1000);
document.getElementById("state").focus();
return false;
}
}
</script>
<script>
function colviewajax(page,params){   // For pagination and sorting of the Collection Deposited view page
	var splitparam		=	params.split("&");
	var searchname	=	splitparam[0];
	var sortorder		=	splitparam[1];
	var ordercol		=	splitparam[2];
	$.ajax({
		url : "ajax_state.php",
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
		url : "ajax_state.php",
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

</script>

<?php
if($_REQUEST['searchname']!='')
{
	$var = @$_REQUEST['searchname'] ;
	$trimmed = trim($var);	
	$qry="SELECT * FROM `state` where name like '%".$trimmed."%'";
}
else
{ 
	$qry="SELECT *  FROM `state`"; 
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
<?php
if(isset($_POST['save']))
{

$user_id=$_SESSION['user_id'];
$state=$_POST['state'];
$query = "SELECT * FROM state where name = '$state'"; 
$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{
			$fgmembersite->RedirectToURL("state.php?success=exists");
		}
		else
		{
			if ($state != "")
			{
			if(!mysql_query('INSERT INTO state (name,created_by)VALUES ("'.$state.'","'.$user_id.'")'))
			{
			die('Error: ' . mysql_error());
			}
			$fgmembersite->RedirectToURL("state.php?success=create");
			}
			else
			{
			$fgmembersite->RedirectToURL("state.php?success=error");
			}
		}
}
?>
<?php
if(isset($_POST['edit']))
{
$edit_id=$_POST['edit_id'];
$user_id=$_SESSION['user_id'];
$state=$_POST['state'];
$current_date=date("Y-m-d H:i:s");

$query = "SELECT * FROM state where name = '$state'"; 
$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{
			$fgmembersite->RedirectToURL("state.php?success=exists");
		}
		else
		{
			if ($state != "")
			{
			if(!mysql_query('UPDATE state SET name="'.$state.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
			{
			die('Error: ' . mysql_error());
			}
			$fgmembersite->RedirectToURL("state.php?success=update");
			}
			else
			{
			$fgmembersite->RedirectToURL("state.php?success=error");
			}
		}
}

?>

<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM state where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
	$name=$row['name'];
	
}
}
?>
<!------------------------------- Form -------------------------------------------------->
<div id="mainarea">
<div class="mcf"></div>
<div align="center" class="headings">State</div>
<div id="mytable" align="center">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="validation"  onsubmit="return validateForm();">
<table>
  <tr height="60px">
     <td class="pclr" width="100">State*</td>
     <td>
	 
	 <?php if(isset($_GET['id'])){ ?>
							<input type='text' name='state' id='state'  value="<?php echo $name; ?>" maxlength="50" autocomplete='off'/>
				
						<?php } else {?>
							<input type='text' name='state' id='state'  maxlength="50" autocomplete='off'/>
						<?php }?>
	 </td>
   </tr>
   <tr align="center" height="130px;">
       <td colspan="10">
	   <?php if(isset($_GET['id'])){ ?>
			 <input type="submit" name="edit" id="edit" class="buttons" value="Save" />
			<input type='hidden' name='edit_id' id='edit_id' value='<?php echo $_GET['id'];?>'/>
			<?php } else {?>
			 <input type="submit" name="save" id="save" class="buttons" value="Save" />
			<?php }?>
	   
	   &nbsp;&nbsp;&nbsp;&nbsp;
       <input type="reset" name="reset" class="buttons" value="Clear" id="clear" onclick="return myFunction();"/>&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>
       </td>
      </tr>
</table>
</form>
</div>
<?php if($_GET['success']=="create") 
{
?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Data Entered Successfully"; 
?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }?>
<?php if($_GET['success']=="update") 
{
?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0002 : Data Updated Successfully "; 
?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }?>
<?php if($_GET['success']=="error") 
{
?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }?>
<?php if($_GET['success']=="exists") 
{
?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 :Data Already Exists"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }?>

<div id="client_error" style="display:none">
<div id="errormsg" class="mydiv3" ><h3 align="center" class="myalign"><?php echo "ERR 0009 : Please enter all mandatory (*) data"; ?> </h3><button id="closebutton" class="ui-button ui-widget ui-city-default ui-corner-all ui-button-icon-only" role="button" title="Close"><span class="ui-button-text">Close</span></button></div>
</div>
<div id="search">
        <input type="text" name="searchname" id="searchname" value="<?php echo $_REQUEST['searchname']; ?>" autocomplete='off' placeholder='Search By State'/>
        <input type="button" class="buttonsg" onclick="searchcolviewajax('<?php echo $Page; ?>');" value="GO"/>
 </div>
<div id="container">
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
				$paramsval	=	$searchname."&".$sortorderby."&name"; ?>
				<th nowrap="nowrap" class="rounded" onClick="colviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">State<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap" align="right">Edit</th>
	
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
			$id= $fetch['id'];
			?>
			<tr>
				
				<td><?php echo $fgmembersite->upperstate($fetch['name']);?></td>
				
				<td align="right">
				<a href="state.php?id=<?php echo $fetch['id'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>
				</td>
			</tr>
			<?php $c++; $cc++; $slno++; }		 
			}else{  echo "<tr><td align='center' colspan='2'><b>No records found</b></td></tr>";}  ?>
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
</div>
</div>
</div>
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile))
{
include_once($footerfile);
}
else
{
echo _FILENOTFOUNT.$footerfile;
}
?>