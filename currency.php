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
document.getElementById("currency").value="";
document.getElementById("currency").focus();
return false;
}
</script>
<script>
function validateForm()
{
var currencyname=document.getElementById("currency").value;
if(currencyname=="")
{
document.getElementById( 'client_error' ).style.display="block";
	setTimeout(function() {
	document.getElementById( 'client_error' ).style.display="none";
	},1000);
document.getElementById("currency").focus();
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
		url : "ajax_currency.php",
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
		url : "ajax_currency.php",
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
	$qry="SELECT * FROM `currency` where name like '%".$trimmed."%'";
}
else
{ 
	$qry="SELECT *  FROM `currency`"; 
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
$currency=$_POST['currency'];
$query = "SELECT * FROM currency where name = '$currency'"; 
$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{
			$fgmembersite->RedirectToURL("currency.php?success=exists");
		}
		else
		{

			if ($currency != "")
			{
			if(!mysql_query('INSERT INTO currency (name,created_by)VALUES ("'.$currency.'","'.$user_id.'")'))
			{
			die('Error: ' . mysql_error());
			}
			$fgmembersite->RedirectToURL("currency.php?success=create");
			}
			else
			{
			$fgmembersite->RedirectToURL("currency.php?success=error");
			}
	  }
}
?>
<?php
if(isset($_POST['edit']))
{
$edit_id=$_POST['edit_id'];
$user_id=$_SESSION['user_id'];
$currency=$_POST['currency'];
$current_date=date("Y-m-d H:i:s");
$query = "SELECT * FROM currency where name = '$currency'"; 
$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{
			$fgmembersite->RedirectToURL("currency.php?success=exists");
		}
		else
		{
			if ($currency != "")
			{
			if(!mysql_query('UPDATE currency SET name="'.$currency.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
			{
			die('Error: ' . mysql_error());
			}
			$fgmembersite->RedirectToURL("currency.php?success=update");
			}
			else
			{
			$fgmembersite->RedirectToURL("currency.php?success=error");
			}
		}
}

?>

<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM currency where id=$id"; 

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
<div align="center" class="a"><h3>Currency</h3></div>



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
				<th nowrap="nowrap" class="rounded" onClick="colviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Currency<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap" align="right">Symbol</th>
	
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
				
				<td><?php echo $fetch['name'];?></td>
				
				<td align="right">
				<img height="15px" width="15px" style="vertical-align:middle;" src="images/<?php echo $fetch['symbol'];?>">
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
			 <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>
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